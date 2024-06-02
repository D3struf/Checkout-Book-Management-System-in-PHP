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

    // Create the SQL UPDATE statement
    $sql = "UPDATE book SET Title='$title', Author='$author', ISBN='$isbn', CoverImage='$imgContent' WHERE BookID='$bookID'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        header('Location: ../Admin/book.php?success=Updated Book Successfully!');
        exit();
    } else {
        header('Location: ../Admin/book.php?error=Error updating record: ' . mysqli_error($conn));
        exit();
    }
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
        header('Location: ../Admin/member.php?success=Updated Member Successfully!');
        exit();
    } else {
        header('Location: ../Admin/book.php?error=Error updating record: ' . mysqli_error($conn));
        exit();
    }
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
        header('Location: ../Admin/checkout.php?success=Updated Checkout Successfully!');
        exit();
    } else {
        header('Location: ../Admin/book.php?error=Error updating record: ' . mysqli_error($conn));
        exit();
    }
}
?>
