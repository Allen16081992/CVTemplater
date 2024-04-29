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
  </head> 
  <style>
    p {
      color: white;
      font-weight: bold;
      margin-bottom: 10%;
    }
    .tips {
      background: var(--bg-color);
      border-radius: 25px;
      padding:20px;
      border: 1px solid var(--primary-color-dark);
    }
    @media (orientation: portrait) {
      .container {
        margin-top: 8rem;
        padding-bottom:3rem;
      }
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
        <!--<li><a style="color:grey;"><i class='bx bx-plus-circle bx-md'></i></a></li>
        <li><a style="color:grey;"><i class='bx bx-x-circle bx-md'></i></a></li>-->
        <li><a href="./client.php"><i class='bx bxs-file bx-md'></i></li>
        <li><a class="m-on"><i class='bx bxs-videos bx-md'></i></a></li>
        <li><a href="./tutorial.php"><i class='bx bxs-crown bx-md'></i></a></li>
        <li><a href="./account.php"><i class='bx bxs-cog bx-md'></i></a></li>
      </ul>
    </section>

    <!-- Main Content -->
    <main class="container">
      <p class="tips">Check out <a href="https://www.youtube.com/watch?v=pjqi_M3SPwY" target="_blank">video 1</a> or <a href="https://www.youtube.com/watch?v=IW472-d_8bs" target="_blank">video 2</a>. They contain useful advice for improving your resume and increasing your chance at interviews.</p>
      <p class="tips">Watch this <a href="https://www.youtube.com/watch?v=Y2AzUbDLRXs" target="_blank">video</a> so you can arrow down your resume to specific targets. Be sure to enable subtitles to follow the Dutch language in this video.</p>
      <p class="tips">Did you know 87% of online vacancies are written with vague 'general' descriptions and misleading Job titles, known as 'workplace jargon'?<br>
      <a href="https://www.intermediair.nl/werk-en-carriere/solliciteren/waar-moet-ik-op-letten-bij-het-lezen-van-een-vacature?referrer=https%3A%2F%2Fwww.google.com%2F" target="_blank">Read a vacancy this way</a> and
      <a href="https://www.intermediair.nl/werk-en-carriere/solliciteren/lees-tussen-de-regels-van-de-vacaturetekst-door" target="_blank">Read between the lines of vacancy texts</a>.
      </p>
    </main>
</body>
</html>