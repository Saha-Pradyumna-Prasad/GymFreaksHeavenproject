<?php
// $host = "sql205.infinityfree.com";
// $user = "if0_41073530";
// $pass = "nFkjFJSUr8xBqMW";
// $db_name = "if0_41073530_gym_shop"; // As defined in your DB.txt file
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "gym_shop"; // As defined in your DB.txt file

$conn = mysqli_connect($host, $user, $pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>