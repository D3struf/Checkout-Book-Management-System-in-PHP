<?php
// Include your database connection file
include '../../config/db.php';

if (isset($_POST['submit-edit-book'])) {
    // Get the form data
    $bookID = $_POST['bookID'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];

    // Validate and sanitize the input data as necessary
    $bookID = intval($bookID);
    $title = mysqli_real_escape_string($conn, $title);
    $author = mysqli_real_escape_string($conn, $author);
    $isbn = mysqli_real_escape_string($conn, $isbn);

    // Create the SQL UPDATE statement
    $sql = "UPDATE book SET Title='$title', Author='$author', ISBN='$isbn' WHERE BookID='$bookID'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        header('Location: ../Admin/book.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}

if (isset($_POST['submit-edit-member'])) {
    // Get the form data
    $memberID = $_POST['memberID'];
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $membershipType = $_POST['membership-type'];

    // Validate and sanitize the input data as necessary
    $memberID = intval($memberID);
    $firstName = mysqli_real_escape_string($conn, $firstName);
    $lastName = mysqli_real_escape_string($conn, $lastName);
    $membershipType = mysqli_real_escape_string($conn, $membershipType);

    // Create the SQL UPDATE statement
    $sql = "UPDATE librarymember SET FirstName='$firstName', LastName='$lastName', MembershipType='$membershipType' WHERE MemberID='$memberID'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        header('Location: ../Admin/member.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}

if (isset($_POST['submit-edit-checkout'])) {
    // Get the form data
    $checkoutId = $_POST['checkoutID'];
    $returnDate = $_POST['returnDate'];

    // Validate and sanitize the input data as necessary
    $checkoutId = intval($checkoutId);
    $formattedReturnDate = date('Y-m-d H:i:s', strtotime($returnDate));

    // Create the SQL UPDATE statement
    $sql = "UPDATE checkout SET ReturnDates='$formattedReturnDate' WHERE CheckoutID='$checkoutId'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        header('Location: ../Admin/checkout.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
