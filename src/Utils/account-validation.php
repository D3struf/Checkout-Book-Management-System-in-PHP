<?php
    include('../../config/db.php');
    session_start();

    if (isset($_POST['submit-sign-up'])) {
        // Get form data
        $firstName = $_POST['first-name-signup'];
        $lastName = $_POST['last-name-signup'];
        $email = $_POST['email-signup'];
        $pass = $_POST['password-signup'];
        $accountType = $_POST['account-type'];
        if ($_POST['account-type'] != 'librarian') {
            $membershipType = $_POST['membership-type'];
        } else {
            $membershipType = NULL;
        }

        print($firstName);
        print($lastName);
        print($email);
        print($pass);
        print($membershipType);
        $checkQuery = "SELECT * FROM `account` WHERE `EmailAddress` = '$email'";
        $result = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            // Account already exists
            print('Account already exists!!!');
            header('Location: ../sign-in.php?error=Account already exists');
            exit();
        } else {
            // Insert new account first
            $AccountQuery = "INSERT INTO `account` (`AccountID`, `EmailAddress`, `Password`, `AccountType`) VALUES (NULL, '$email', '$pass', '$accountType');";

            if(mysqli_query($conn, $AccountQuery)) {
                print('Successfully Added Account');
                // Get the last inserted AccountID
                $lastAccountId = mysqli_insert_id($conn);
                print('Last Account'.$lastAccountId);
                $_SESSION['user_id'] = $lastAccountId;
                print('Last Account'.$_SESSION['user_id']);
                
                $checkFullName = "SELECT * FROM `librarymember`
                WHERE `FirstName` = '$firstName' AND `LastName` = '$lastName';";

                if(mysqli_query($conn, $checkFullName)) {
                    print('Member already exists');
                    header('Location:../sign-in.php?error=Member already exists');
                    exit();
                } else {
                    // Insert new account first
                    $MemberQuery = "INSERT INTO `librarymember` (`MemberID`, `FirstName`, `LastName`, `MembershipType`, `AccountID`, `ProfileImage`) VALUES (NULL, '$firstName', '$lastName', '$membershipType', '$lastAccountId', NULL)";
                    if (mysqli_query($conn, $MemberQuery)) {
                        print('Successfully Added Member');
                        $_SESSION['user_id'] = $email;
                        if ($row['AccountType'] == 'student') {
                            header("Location: ../Client/dashboard.php");
                            exit();
                        } else {
                            print('Librarian');
                            // header("Location: ../Admin/index.php");
                            // exit();
                        }
                    } else {
                        header('Location: ../sign-in.php?error=' . urlencode('Error: ' . mysqli_error($conn)));
                        exit();
                    }
                }
            }
        }
        // Close the result set
        mysqli_free_result($result);
    }

    if (isset($_POST['submit-log-in'])) {
        // Get form data
        $email = $_POST['email'];
        $pass = $_POST['password-signup'];

        print($email);
        print($pass);
        $checkQuery = "SELECT * FROM `account` WHERE `EmailAddress` = '$email'";
        $result = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($result) == 0) {
            // Account does not exists
            header("Location: ../sign-in.php?error=Account does not exists!");
            exit();
        } else {
            // Account exists
            $row = mysqli_fetch_assoc($result);
            if ($row['Password'] == $pass) {
                print('Successfully Logged In');
                $_SESSION['user_id'] = $email;

                if ($row['AccountType'] == 'student') {
                    header("Location: ../Client/dashboard.php");
                    exit();
                } else {
                    print('Librarian');
                    // header("Location: ../Admin/index.php");
                    // exit();
                }
            } else {
                header("Location: ../sign-in.php?error=Incorrect Password!");
                exit();
            }
        }
        // Close the result set
        mysqli_free_result($result);
    }

    // Close the connection
    mysqli_close($conn);
?>