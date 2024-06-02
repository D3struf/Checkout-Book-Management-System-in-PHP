<?php
    include('../../config/db.php');
    
    // To add member
    if (isset($_POST['submit-member'])) {
        // Get form data
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $membershipType = $_POST['membership-type'];
        print($firstName);
        print($lastName);
        print($membershipType);
        $checkQuery = "SELECT * FROM `librarymember` WHERE `FirstName` = '$firstName' AND `LastName` = '$lastName'";
        $result = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            // Member already exists
            header('Location: ../Admin/member.php?error=Member already exists');
            exit();
        } else {
            // Insert new account first
            // Defaults Account
            $AccountQuery = "INSERT INTO `account` (`AccountID`, `EmailAddress`, `Password`, `AccountType`) VALUES (NULL, '123@gmail.com', '12345', 'student');";

            if(mysqli_query($conn, $AccountQuery)) {
                print('Successfully Added Account');
                // Get the last inserted AccountID
                $lastAccountId = mysqli_insert_id($conn);

                // Insert new member
                $setQuery = "INSERT INTO `librarymember` (`MemberID`, `FirstName`, `LastName`, `MembershipType`, `AccountID`, `ProfileImage`) VALUES (NULL, '$firstName', '$lastName', '$membershipType', '$lastAccountId', NULL);";
                if (mysqli_query($conn, $setQuery)) {
                    header('Location: ../Admin/member.php?success=Membership added successfully');
                    exit();
                } else {
                    header('Location: ../Admin/member.php?error=' . urlencode('Error: ' . mysqli_error($conn)));
                    exit();
                }
            }
        }
    }

    if (isset($_POST['submit-book'])) {
        // Get form data
        $title = $_POST['title'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];

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
            } else {
                header('Location: ../Admin/book.php?error=Sorry, only JPG, JPEG, PNG and GIF images are supported.');
                exit();
            }
        } else {
            header('Location: ../Admin/book.php?error=' . urlencode('Error: ' . mysqli_error($conn)));
            exit();
        }

        $checkQuery = "SELECT * FROM `book` WHERE `Title` = '$title' AND `Author` = '$author'";
        $result = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            // Book already exists
            header('Location: ../Admin/book.php?error=Book already exists');
            exit();
        } else {
            $setQuery = "INSERT INTO `book` (`BookID`, `Title`, `Author`, `ISBN`, `CoverImage`) VALUES (NULL, '$title', '$author', '$isbn', '$imgContent');";
            if (mysqli_query($conn, $setQuery)) {
                echo '<script>alert("Book added successfully!");</script>';
                header('Location: ../Admin/book.php?success=Book added successfully');
                exit();
            } 
        }

    }

    if (isset($_POST['submit-checkout'])) {
        // Get form data
        $checkoutMember = $_POST['checkout-member'];
        $checkoutBook = $_POST['checkout-book'];
        // echo $checkoutMember;
        // echo $checkoutBook;
        $currentDateTime = date('Y-m-d H:i:s');
        // echo $currentDateTime;

        $setQuery = "INSERT INTO `checkout` (`CheckoutID`, `BookID`, `MemberID`, `CheckoutDates`, `ReturnDates`) 
        VALUES (NULL, '$checkoutBook', '$checkoutMember', '$currentDateTime', NULL);";
        if (mysqli_query($conn, $setQuery)) {
            echo '<script>alert("Checkout successfully!");</script>';
            header('Location: ../Admin/checkout.php?success=Checkout added successfully!');
            exit();
        } else {
            header('Location: ../Admin/checkout.php?error=Error: ' . $setQuery . '' . mysqli_error($conn) . '');
            exit();
        }
    }
?>