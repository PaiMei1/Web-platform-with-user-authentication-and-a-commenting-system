<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MojaRakovica";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
         
        
        $user = $result->fetch_assoc();

        
        if (password_verify($password, $user['password'])) {
            
           
            $_SESSION['username'] = $user['username'];

     
            echo "Successfully logged in to your account, redirecting to home page...";
            echo "<script>setTimeout(function(){location.href = 'http://localhost/projekat/index.php';}, 1500);</script>";
            exit();
        } else {
            
            $error_message = "Invalid username or password!";
        }
    } else {
       
        $error_message = "Invalid username or password!";
    }

    
    $stmt->close();
}

$conn->close();
?>


