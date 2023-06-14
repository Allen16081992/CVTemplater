<?php
  // Start a session for holding the user.
  require_once 'config/peripherals/session_start.config.php'; 

  // Only load the page when signed in.
  require_once 'config/peripherals/redirect.config.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CV Templater - Tutorial</title>
        <!-- Favicon -->
        <?php include 'config/peripherals/favicon.config.php';?>
        <!-- Boxicons -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <!-- Styling Sheets -->
        <link rel="stylesheet" href="css/trongate.css">
        <link rel="stylesheet" href="css/templater.css">
   </head> 
   <style>
    header > h1 {
        margin-left:100px;
    }
    img {
        width: 900px;
        height: auto;
        margin-top: 15%;
        margin-left: 250px;
    }
    p {
        color: white;
        margin-left: 250px;
    }
    .Builder {
      height: auto;
      width: 500px;
    }
   </style>
<body>
    <header>
        <h1>Tutorial</h1>
        <img class="logo" src="img/CV-headed-eagle.png" alt="Brand Signature">
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav> 
          <?php include 'config/peripherals/nav_username.config.php'; ?>
          <a href="config/logout.config.php">Logout</a>
        </nav>
      </header>

      <img src="img/tutorials/tutorial1.PNG" alt="Resume Name">
      <p></p>
      <img src="img/tutorials/tutorial2.PNG" alt="Profile">
      <p></p>
      <img src="img/tutorials/tutorial3.PNG" alt="Work Experience">
      <p></p>
      <img src="img/tutorials/tutorial4.PNG" alt="Education">
      <p></p>
      <img src="img/tutorials/tutorial5.PNG" alt="Skills">
      <p></p>
      <div class="Builder">
      <img src="img/tutorials/tutorial6.PNG" alt="Resume Builder">
      </div>
      <p></p>
    
</body>
</html>