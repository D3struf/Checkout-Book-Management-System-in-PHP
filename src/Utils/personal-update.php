<?php
session_start();
include('../../config/db.php');

$user_id = $_SESSION['user_id'];

// Fetch user data
$query = "SELECT `account`.`EmailAddress`, `account`.`AccountID`, `account`.`Password`, `account`.`AccountType`, `librarymember`.`FirstName`, `librarymember`.`LastName`, `librarymember`.`MembershipType`, `librarymember`.`ProfileImage`  
FROM `account` 
JOIN `librarymember` ON `account`.`AccountID` = `librarymember`.`AccountID` 
WHERE `account`.`EmailAddress` = '$user_id'";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
    exit();
}

if (isset($_POST['save-personal'])) {
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    // $photo = $_POST['file-upload'];
    // print($_FILES["file-upload"]["name"]);
    $membershipType = $user['MembershipType'];
    $accountID = $user['AccountID'];

    $imgContent = NULL;
    if(!empty($_FILES["file-upload"]["name"])){
        // Get the image info
        $fileName = basename($_FILES["file-upload"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes)){
            $image = $_FILES['file-upload']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
            print('Allow Image');
        } else {
            header('Location: ../account-setting.php?error=Sorry, only JPG, JPEG, PNG and GIF images are supported.');
            exit();
        }
    } else {
        header('Location: ../account-setting.php');
        exit();
    }

    // Update Account First
    $accountQuery = "UPDATE account SET EmailAddress='$email' WHERE AccountID='$accountID'";
    mysqli_query($conn, $accountQuery);

    // Update query with ProfileImage
    $updateQuery = "UPDATE librarymember 
                    SET FirstName='$firstName', LastName='$lastName', MembershipType='$membershipType', ProfileImage='$imgContent' 
                    WHERE AccountID='$accountID'";
    mysqli_query($conn, $updateQuery);
    
    // Update librarymember table
    if ($imgContent) {
        $memberQuery = "UPDATE librarymember 
                        SET FirstName='$firstName', LastName='$lastName', MembershipType='$membershipType', ProfileImage='$imgContent' 
                        WHERE AccountID='$accountID'";
    } else {
        $memberQuery = "UPDATE librarymember 
                        SET FirstName='$firstName', LastName='$lastName', MembershipType='$membershipType' 
                        WHERE AccountID='$accountID'";
    }
    mysqli_query($conn, $memberQuery);

    // Commit transaction
    mysqli_commit($conn);
    header("Location: ../account-setting.php?success=Profile updated successfully!");
    exit();
    
}

?>