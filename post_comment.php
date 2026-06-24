<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login2.html");
    exit;
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MojaRakovica";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_text'])) {
    
    $comment_text = $conn->real_escape_string($_POST['comment_text']);
    $username = $_SESSION['username'];
    $time = date('Y-m-d H:i:s');

   
    $sql = "INSERT INTO Forum (username, comment, time) VALUES ('$username', '$comment_text', '$time')";

    if ($conn->query($sql) === TRUE) {
        header("Location: forum.php"); 
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
