<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login2.php");
    exit();
}


$conn = mysqli_connect("localhost", "root", "", "MojaRakovica"); 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found.");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    
    if ($new_username != $user['username']) {
        $update_sql = "UPDATE user SET username = ? WHERE username = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ss", $new_username, $user['username']);
        if ($stmt->execute()) {
           
            $_SESSION['username'] = $new_username; 
            header("Location: " . $_SERVER['PHP_SELF']);
exit();
        } else {
            echo "Error updating username.";
        }
    }

    if ($new_email != $user['email']) {
        $update_sql = "UPDATE user SET email = ? WHERE username = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ss", $new_email, $user['username']);
        $stmt->execute();
        header("Location: " . $_SERVER['PHP_SELF']);
exit();
        
    }


    if ($new_password) {
       
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE user SET password = ? WHERE username = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ss", $hashed_password, $user['username']);
        $stmt->execute();
    }

    echo "Profile updated successfully!";
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .profile-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin-bottom: 20px;
        }

        .greeting {
            font-size: 22px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .submit-btn {
            background-color: #f39c12;
            color: white;
            padding: 12px 20px;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            border-radius: 30px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #e67e22;
        }

        .logout-btn {
            background-color: #e74c3c;
            color: white;
            padding: 12px 20px;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            border-radius: 30px;
            width: 100%;
            margin-top: 20px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        .home-btn {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            border-radius: 30px;
            width: 100%;
            margin-top: 10px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .home-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <h1>User Profile</h1>

    <div class="profile-container">
     
        <p class="greeting">Hi, <?php echo htmlspecialchars($user['username']); ?>!</p>

       
        <form method="POST" action="">
            <input type="text" class="input-field" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" placeholder="Change Username" />
            <input type="email" class="input-field" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" placeholder="Change Email" />
            <input type="password" class="input-field" name="password" placeholder="Change Password" />
            <button type="submit" class="submit-btn">Update Profile</button>
        </form>

        <form action="index.php" method="get">
            <button type="submit" class="home-btn">Return to Home Page</button>
        </form>

      
        <form action="logout.php" method="POST">
            <button type="submit" class="logout-btn">Log Out</button>
        </form>
    </div>

</body>
</html>
