<?php // Dhr. Allen Pieter
  // Start a session for displaying error messages.
  require_once 'config/peripherals/session_management.config.php'; 
?>
<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CV Templater</title>
    <!-- Favicon -->
    <?php include_once 'config/peripherals/favicon.config.php';?>
    <!-- Boxicons - Only used for Hamburger Icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Styling Sheets -->
    <link rel="stylesheet" href="css/templater.css">
    <!-- Javascript -->
    <?php require_once 'config/peripherals/javascript_load.config.php'; ?>
    <?php include_once 'config/peripherals/inx_taglines.config.php' ?>
    <!--<script defer src="javascript/audio.js"></script>-->
  </head>
  <style>
    p {
      color: white;
      font-weight: bold;
    }
  </style>
  <body>
    <header><!-- Upper Navigation Panel -->
      <img class="logo" src="img/CV-headed-eagle.png" alt="Brand Signature">
      <i class='bx bx-menu' id="menu-icon"></i>
      <?php require_once 'config/peripherals/server_messages.config.php'; ?>
      <nav>
        <a class="current">Home</a>
        <a data-window-target="#window">Login</a>
        <a href="contact.php">Contact</a>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
      
      <!-- Sphere of Influence -->
      <div id="round"></div>
      <!-- Resume Icon Call-to-action -->
      <button data-window-target="#window" id="action" onmouseover="PlaySound('mySound')"><img  src="img/logo_CV_Icon.png" alt=""></button><!--<button data-window-target="#window">Let's get started!</button>-->
      <!-- Sphere Animation -->
      <svg>
        <filter id="wavy">
          <feTurbulence x="0" y="0" baseFrequency="0.009" numOctaves="5" seed="2">
            <animate attributeName="baseFrequency" dur="60s" values="0.02;0.005;0.02" repeatCount="indefinite"></animate>
          </feTurbulence>
          <feDisplacementMap in="SourceGraphic" scale="30"></feDisplacementMap>        
        </filter>
      </svg>
      <div class="tagline"><p>"<?= $selectedTagline; ?>"</p></div>
      <!-- Sign In Window -->
      <div class="window" id="window">
        <div class="window-title">
          <div class="title">Login</div>
          <button class="close-button alt" onclick="location.href='signup.php';">Signup</button>
          <button data-window-close class="close-button">&#215;</button>
        </div>
        <form class="window-body" name="login" action="config/login.config.php" method="post">
          <p class="error-uid"></p>
          <p class="error-pwd"></p>
          <label for="username">Username</label>
          <input type="text" name="username" placeholder="Username" autocomplete="off">
          <label for="pwd">Password</label>
          <input type="password" name="pwd" placeholder="Password">
          <button type="submit" name="submit">Login</button>
          <span>Don't have an account yet? <a href="signup.php">Register</a></span>
        </form>
      </div>

      <!-- When any Window opens, darken the background -->
      <div id="overlay"></div>

      <!-- Audio file -->
      <audio id="mySound" src="audio/The Wolf and the Moon.mp3"></audio>
    </main>
  </body>
</html>