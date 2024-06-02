<?php
include('../../config/db.php');
session_start();

if (isset($_POST['admin-btn'])) {
    $_SESSION['user_id'] = 'admin';
    $pass = $_POST['admin-password'];

    if ($pass == 'admin'){
        header('Location: ../Admin/index.php');
        exit();
    } else {
        header('Location: ../sign-in.php?error=Admin Password Incorrect!');
        exit();
    }

}

?>