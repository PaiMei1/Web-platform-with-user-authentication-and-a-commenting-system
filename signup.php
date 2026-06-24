<?php
session_start();


error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "MojaRakovica"); 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['name'], $_POST['email'], $_POST['username'], $_POST['password'])) {
    

    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])) {
        die("Error: Please fill in all fields.");
    }

    
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    
    $stmt = $conn->prepare("INSERT INTO user (Name, email, username, password) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    
    $stmt->bind_param("ssss", $_POST['name'], $_POST['email'], $_POST['username'], $hashed_password);

   
    if ($stmt->execute()) {
        $_SESSION['username'] = $_POST['username'];
        echo "Successfully registered, redirecting to home page...";
        echo "<script>setTimeout(\"location.href = 'http://localhost/projekat/index.php';\",1500);</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

   
    $stmt->close();
} else {
    echo "Please fill in all fields.";
}


$conn->close();
?>
