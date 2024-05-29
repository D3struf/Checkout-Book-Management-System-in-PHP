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
            // Insert new member
            $setQuery = "INSERT INTO `librarymember` (`MemberID`, `FirstName`, `LastName`, `MembershipType`) VALUES (NULL, '$firstName', '$lastName', '$membershipType');";
            if (mysqli_query($conn, $setQuery)) {
                header('Location: ../Admin/member.php?success=Membership added successfully');
                exit();
            } else {
                header('Location: ../Admin/member.php?error=' . urlencode('Error: ' . mysqli_error($conn)));
                exit();
            }
        }
    }

    if (isset($_POST['submit-book'])) {
        // Get form data
        $title = $_POST['title'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $checkQuery = "SELECT * FROM `book` WHERE `Title` = '$title' AND `Author` = '$author'";
        $result = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            // Book already exists
            header('Location: ../Admin/book.php?error=Book already exists');
            exit();
        } else {
            $setQuery = "INSERT INTO `book` (`BookID`, `Title`, `Author`, `ISBN`) VALUES (NULL, '$title', '$author', '$isbn');";
            if (mysqli_query($conn, $setQuery)) {
                echo '<script>alert("Book added successfully!");</script>';
                header('Location: ../Admin/book.php?success=Book added successfully');
                exit();
            } else {
                header('Location: ../Admin/book.php?error=' . urlencode('Error: ' . mysqli_error($conn)));
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
            header('Location: ../Admin/checkout.php');
            exit();
        } else {
            echo '<script>alert("Error: ' . $setQuery . '<br>' . mysqli_error($conn) . '");</script>';
        }
    }
?>