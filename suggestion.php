<?php // Dhr. Allen Pieter
  // Start a session for holding the user.
  require_once 'config/peripherals/session_management.config.php'; 
  redirectUnauthorized(); // Access denied
  sessionRegen(); // Call the periodic session regeneration
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Templater - Useful Tips</title>
    <!-- Favicon -->
    <?php include_once 'config/peripherals/favicon.config.php';?>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Styling Sheets -->
    <link rel="stylesheet" href="css/templater.css">
    <!-- Javascript -->
    <script defer src="javascript/popup.window.js"></script>
  </head> 
  <style>
    .sidebar {
      min-width:19rem;
    }
    p {
      color: white;
      font-weight: bold;
      margin-bottom: 10%;
    }
    .video-container {
      position: relative;
      padding-bottom: 56.25%; /* 16:9 aspect ratio (change this value as needed) */
      height: 0; margin-top:8rem;
      overflow: hidden;
    }
    .video-container iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
    .tips {
      background: var(--bg-color);
      border-radius: 25px;
      padding:20px;
      border: 1px solid var(--primary-color-dark);
      margin: 25px; margin-bottom:8rem;
    }
  </style>
<body>
    <!-- Upper Navigation Panel -->
    <header>
      <img class="logo" src="img/CV-headed-eagle.png" alt="Brand Signature">
      <i class='bx bx-menu' id="menu-icon"></i>
      <nav> 
        <?php include_once 'config/peripherals/nav_username.config.php'; ?>
        <a href="config/logout.config.php">Logout</a>
      </nav>
    </header>

    <!-- Resume Side Panel -->
    <section class="sidebar">
      <h5>Useful Tips</h5>          
      <ul>
        <li><a href="./client.php"><i class='bx bxs-file'></i>Resume Builder</a></li>
        <li class="on"><i class='bx bxs-videos'></i>Useful Tips</li>
        <li><a href="./tutorial.php"><i class='bx bxs-crown'></i>Tutorial</a></li>
        <li><a href="./account.php"><i class='bx bxs-cog'></i>Account Settings</a></li>
      </ul>
    </section>

    <!-- (Mobile) Resume Side Panel -->
    <section class="m-sidebar">
      <ul>
        <li><a href="./client.php"><i class='bx bxs-file bx-md'></i></li>
        <li><a class="m-on"><i class='bx bxs-videos bx-md'></i></a></li>
        <li><a href="./tutorial.php"><i class='bx bxs-crown bx-md'></i></a></li>
        <li><a href="./account.php"><i class='bx bxs-cog bx-md'></i></a></li>
      </ul>
    </section>

    <!-- Main Content -->
    <main class="container">
      <div class="video-container">
        <iframe src="https://www.youtube.com/embed/pjqi_M3SPwY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </div>
      <p class="tips">Check out this video! It contains useful constructive suggestions for improving your resume and increasing your chance at job offers.</p>
      <div class="video-container">
        <iframe src="https://www.youtube.com/embed/Y2AzUbDLRXs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </div>
      <p class="tips">Watch this video so you can arrow down your resume to specific targets. Be sure to enable subtitles to follow the Dutch language in this video.</p>
    </main>
</body>
</html>