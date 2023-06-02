<?php session_start(); ?>
<!--
  User Experience - Waarom vragen ze zoveel bij het registreren?
-->
<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CV Templater</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon//site.webmanifest">
    <link rel="mask-icon" href="img/favicon//safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Styling Sheets -->
    <link rel="stylesheet" href="css/trongate.css">
    <link rel="stylesheet" href="css/templater.css">
    <!-- Javascript -->
    <script defer src="javascript/popup.window.js"></script>
    <script defer src="javascript/messages.js"></script>
    <script src="javascript/audio.js"></script>
  </head>
  <body>
    <!-- Upper Navigation Panel -->
    <header>
      <img class="logo" src="img/CV-headed-eagle.png" alt="Brand Signature">
      <i class='bx bx-menu' id="menu-icon"></i>
      <?php
        if (isset($_SESSION['error'])) {
        echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
        $_SESSION['error'] = null; // Clear the error message in the session
        }
        if (isset($_SESSION['success'])) {
            echo '<div class="success-message">' . $_SESSION['success'] . '</div>';
            $_SESSION['success'] = null; // Clear the error message in the session
        }
      ?>
      <nav>
        <a class="current">Home</a>
        <a data-window-target="#window">Login</a>
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

      <!-- Sign In Window -->
      <div class="window" id="window">
        <div class="window-title">
          <div class="title">Login</div>
          <button class="close-button alt" onclick="location.href='signup.html';">Signup</button>
          <button data-window-close class="close-button">&#215;</button>
        </div>
        <form class="window-body" name="popup" action="config/login.config.php" method="post">
          <p class="error-uid"></p>
          <p class="error-pwd"></p>
          <label for="username">Username</label>
          <input type="text" name="username" placeholder="Username" autocomplete="off">
          <label for="pwd">Password</label>
          <input type="password" name="pwd" placeholder="Password">
          <button type="submit" name="submit">Login</button>
          <span>Don't have an account yet? <a href="signup.html">Register</a>
          </span>
        </form>
      </div>

      <!-- When any Window opens, darken the background -->
      <div id="overlay"></div>

      <!-- Audio file -->
      <audio id="mySound" src="audio/The Wolf and the Moon.mp3"></audio>
    </main>
  </body>
</html>