<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "MojaRakovica"); 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_destroy();
session_unset();


header("Location: index.php");
$conn->close();
?>