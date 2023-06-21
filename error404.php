<?php
    // Wipe everything related to the session.
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Not Found</title>
  <!-- Favicon -->
  <?php include 'config/peripherals/favicon.config.php';?>
  <!-- Styling Sheets -->
  <link rel="stylesheet" href="css/templater.css">
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 40px;
      text-align: center;
    }
    
    h1 {
      margin-top:15rem;
      font-size: 36px;
      color: #ddd;
      margin-bottom: 20px;
    }
    
    p {
      font-size: 18px;
      color: #999;
    }
    
    a {
      color: #333;
      text-decoration: none;
      font-weight: bold;
    }
    #linkout:hover { color:#ddd;}
  </style>
</head>
<body>
    <!-- Upper Navigation Panel -->
    <header>
      <img class="logo" src="img/CV-headed-eagle.png" alt="Brand Signature">
      <i class='bx bx-menu' id="menu-icon"></i>
      <?php include 'config/peripherals/server_messages.config.php'; ?>
      <nav>
        <a class="current">Home</a>
        <a data-window-target="#window">Login</a>
      </nav>
    </header>

    <div class="container">
        <h1>Page Not Found</h1>
        <p>The requested page could not be found.</p>
        <p>Please check the URL for any mistakes or go back to the previous page.</p>
        <p><a id="linkout" href="index.php">Back to Home</a></p>
    </div>
</body>
</html>