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

    
    .profile-icon {
      background-color: transparent;
      padding: 12px;
      font-size: 24px;
      border-radius: 50%;
      color: #fff;
      text-decoration: none;
    }

    .profile-icon:hover {
      background-color: #f39c12;
      transform: scale(1.1);
    }

    
    h1 {
      text-align: center;
      font-size: 48px;
      color: #2c3e50;
      margin-top: 60px;
      font-weight: 700;
    }

   
    .slideshow-container {
      max-width: 1000px;
      position: relative;
      margin: auto;
      margin-top: 30px;
      border-radius: 10px;
      overflow: hidden;
    }

    .mySlides {
      display: none;
      width: 100%;
    }

   
    .mySlides img {
      width: 100%;
      border-radius: 10px;
    }

    
    .text {
      position: absolute;
      bottom: 15px;
      left: 15px;
      font-size: 24px;
      color: white;
      background-color: rgba(0, 0, 0, 0.5);
      padding: 10px;
      border-radius: 5px;
    }

   
    .dot {
      height: 15px;
      width: 15px;
      margin: 0 5px;
      background-color: #bbb;
      border-radius: 50%;
      display: inline-block;
      transition: background-color 0.6s ease;
      cursor: pointer;
    }

    .active, .dot:hover {
      background-color: #f39c12;
    }

  
    .prev, .next {
      position: absolute;
      top: 50%;
      color: white;
      font-size: 24px;
      padding: 16px;
      background-color: rgba(0, 0, 0, 0.5);
      border-radius: 50%;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .prev:hover, .next:hover {
      background-color: rgba(0, 0, 0, 0.8);
    }

    .prev {
      left: 10px;
    }

    .next {
      right: 10px;
    }

   
    footer {
      text-align: center;
      background-color: #2c3e50;
      color: white;
      padding: 20px;
      margin-top: 40px;
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

 
  <h1>Welcome to Moja Rakovica</h1>


  <div class="slideshow-container">
    <div class="mySlides fade">
      <img src="1.jpg" alt="Nature">
      <div class="text">Monastery</div>
    </div>

    <div class="mySlides fade">
      <img src="2.jpeg" alt="Snow">
      <div class="text">Ugly building</div>
    </div>

    <div class="mySlides fade">
      <img src="3.jpeg" alt="Mountains">
      <div class="text">Majestic View</div>
    </div>

    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>
  </div>

  <div style="text-align:center; margin-top: 20px;">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>

  <footer>
    <p>&copy; 2025 Moja Rakovica. All rights reserved.</p>
  </footer>

  
  <script>
    let slideIndex = 0;
    showSlides();

    setInterval(function() {
      plusSlides(1);
    }, 3000);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides() {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      let dots = document.getElementsByClassName("dot");
      if (slideIndex >= slides.length) { slideIndex = 0; }
      if (slideIndex < 0) { slideIndex = slides.length - 1; }
      
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }

      slides[slideIndex].style.display = "block";
      dots[slideIndex].className += " active";
    }
  </script>
</body>
</html>
