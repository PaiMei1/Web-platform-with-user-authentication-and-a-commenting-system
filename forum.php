<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Moja Rakovica</title>
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
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #2c3e50;
      padding: 15px 30px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-left a {
      color: #fff;
      text-decoration: none;
      margin: 0 20px;
      font-size: 18px;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .navbar-left a:hover {
      color: #f39c12;
    }

    
    .navbar-right a {
      background-color: #f39c12;
      color: white;
      text-decoration: none;
      padding: 12px 25px;
      font-size: 18px;
      font-weight: 500;
      cursor: pointer;
      border-radius: 30px;
      display: inline-block;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .navbar-right a:hover {
      background-color: #e67e22;
      transform: scale(1.05);
    }

    
    h1 {
      text-align: center;
      font-size: 48px;
      color: #2c3e50;
      margin-top: 60px;
      font-weight: 700;
    }

    
    .comment-form {
      width: 70%;
      margin: 30px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .comment-form textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      resize: vertical;
      font-size: 16px;
    }

    .comment-form button {
      padding: 10px 20px;
      background-color: #f39c12;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 10px;
    }

    .comment-form button:hover {
      background-color: #e67e22;
    }

    table {
      width: 70%;
      margin: 30px auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    table th, table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ccc;
    }

    table th {
      background-color: #2c3e50;
      color: #fff;
    }

    table td {
      color: #333;
    }

    table tr:hover {
      background-color: #f4f4f9;
    }

    
    footer {
      text-align: center;
      background-color: #2c3e50;
      color: white;
      padding: 20px;
      margin-top: 40px;
    }

    
    .login-alert {
      background-color: #e74c3c;
      color: white;
      padding: 15px;
      text-align: center;
      margin-top: 20px;
      border-radius: 8px;
    }
  </style>
</head>
<body>

  
  <nav class="navbar">
    <div class="navbar-left">
      <a href="index.php">Home</a>
      <a href="about.php">About</a>
      <a href="forum.php">Forum</a>
      <a href="#">Contact</a>
    </div>
    <div class="navbar-right">
      <?php
      
        if (isset($_SESSION['username'])) {
         
          echo '<a href="profile.php" class="profile-icon"><i class="fas fa-user"></i></a>';
        } else {
          
          echo '<a href="login2.html"><i class="fas fa-sign-in-alt"></i> Login</a>';
        }
      ?>
    </div>
  </nav>

  >


  
  <?php
  if (isset($_SESSION['username'])) {
    echo '
    <div class="comment-form">
      <h3>Post a Comment</h3>
      <form action="post_comment.php" method="POST">
        <textarea name="comment_text" rows="4" cols="50" placeholder="Write your comment here..." required></textarea><br>
        <button type="submit">Post Comment</button>
      </form>
    </div>';
  } else {
    
    echo '<div class="login-alert">You must be logged in to post a comment.</div>';
  }
  ?>

  
  <div>
    <h3>Comments</h3>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "MojaRakovica";
    
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    

   
    $sql = "SELECT username, comment, time FROM Forum ORDER BY time DESC";
    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
      echo '<table>
              <tr><th>Username</th><th>Comment</th><th>Posted On</th></tr>';
      
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["comment"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["time"]) . "</td>";
        echo "</tr>";
      }

      echo '</table>';
    } else {
      echo 'No comments yet.';
    }

    // Close the database connection
    $conn->close();
    ?>
  </div>

  <footer>
    <p>&copy; 2025 Moja Rakovica. All rights reserved.</p>
  </footer>

</body>
</html>
