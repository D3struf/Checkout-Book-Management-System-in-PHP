<?php
session_start();
include('../../config/db.php');

$email = $_SESSION['email'];

// Fetch user data
$query = "SELECT `account`.`EmailAddress`, `account`.`AccountID`, `account`.`Password`, `account`.`AccountType`, `librarymember`.`FirstName`, `librarymember`.`LastName`, `librarymember`.`MembershipType`, `librarymember`.`ProfileImage`  
FROM `account` 
JOIN `librarymember` ON `account`.`AccountID` = `librarymember`.`AccountID` 
WHERE `account`.`EmailAddress` = '$email'";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
    exit();
}

if (isset($_POST['save-password'])) {
    $old_password = $_POST['old-password'];
    $new_password = $_POST['new-password'];
    $confirm_new_password = $_POST['confirm-new-password'];
    $accountID = $user['AccountID'];

    // Verify the old password
    if ($old_password === $user['Password']) {
        // Check if new passwords match
        if ($new_password === $confirm_new_password) {
            print('Password changed successfully');
            // Hash the new password
            // $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Update the password in the database
            $updatePasswordQuery = "UPDATE account SET Password = '$new_password' WHERE AccountID = '$accountID'";

            if (mysqli_query($conn, $updatePasswordQuery)) {
                header('Location: ../account-setting.php?success=Password changed successfully!');
                exit();
            } else {
                header('Location: ../account-setting.php?error="Error updating password: "' . mysqli_error($conn));
                exit();
            }
        } else {
            header('Location: ../account-setting.php?error=New passwords do not match.');
            exit();
        }
    } else {
        header('Location: ../account-setting.php?error=Old password is incorrect.');
        exit();
    }
}

?>