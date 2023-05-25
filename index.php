<?php session_start(); ?>
<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CV Templater</title>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Styling Sheets -->
    <link rel="stylesheet" href="css/trongate.css">
    <link rel="stylesheet" href="css/templater.css">
    <!-- Javascript -->
    <script defer src="javascript/popup.window.js"></script>
    <script defer src="javascript/messages.js"></script>
  </head>
  <body>
    <!-- Upper Navigation Panel -->
    <header>
      <a href="#" class="logo">.</a>
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

      <!-- Sign In Window -->
      <button data-window-target="#window">Let's get started!</button>
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
          <input type="text" name="username" placeholder="Username" id="user" autocomplete="off">
          <label for="pwd">Password</label>
          <input type="password" name="pwd" id="pass" placeholder="Password">
          <button type="submit" name="submit">Login</button>
          <span>Don't have an account yet? <a href="signup.html">Register</a>
          </span>
        </form>
      </div>

      <!-- When any Window opens, darken the background -->
      <div id="overlay"></div>
    </main>
  </body>
</html>