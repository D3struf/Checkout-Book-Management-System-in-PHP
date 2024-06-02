<?php
$servername = "127.0.0.1";
$username = 'root';
$password = '';
$dbname = 'test2';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

?>