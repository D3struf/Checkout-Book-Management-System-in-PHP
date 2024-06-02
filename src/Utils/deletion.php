<?php 

include('../../config/db.php');

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    $query = "DELETE FROM `checkout` WHERE `CheckoutID` = '$id'";

    if (mysqli_query($conn, $query)) {
        header('Location: checkout.php?success=Checkout deleted successfully!');
        exit();
    } else {
        header('Location: checkout.php?error=Error deleting Checkout: ' . mysqli_error($conn) . '');
        exit();
    }
}

if (isset($_GET['deleteidM'])) {
    $id = $_GET['deleteidM'];
    $query = "DELETE FROM `librarymember` WHERE `MemberID` = '$id'";
    
    if (mysqli_query($conn, $query)) {
        header('Location: member.php?success=Member deleted successfully!');
        exit();
    } else {
        header('Location: member.php?error=Error deleting Checkout: ' . mysqli_error($conn) . '');
        exit();
    }
}

if (isset($_GET['deleteidB'])) {
    $id = $_GET['deleteidB'];
    $query = "DELETE FROM `book` WHERE `BookID` = '$id'";
    
    if (mysqli_query($conn, $query)) {
        header('Location: book.php?success=Book deleted successfully!');
        exit();
    } else {
        header('Location: book.php?error=Error deleting Book: ' . mysqli_error($conn) . '');
        exit();
    }
}

?>