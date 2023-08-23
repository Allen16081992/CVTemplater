<?php // Dhr. Allen Pieter
  // Start a session for handling data and error messages.
  require_once 'config/peripherals/session_management.config.php'; 
?>
<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Templater - Contact Us</title>
    <!-- Favicon -->
    <?php include_once 'config/peripherals/favicon.config.php';?>
    <!-- Boxicons - Only used for Hamburger Icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Styling Sheets -->
    <link rel="stylesheet" href="css/templater.css">
    <!-- Javascript -->
    <?php require_once 'config/peripherals/javascript_load.config.php'; ?>
  </head>
  <style>
    .window-title { border-bottom: none; animation: fadeIn 3s forwards; /* Apply the fadeIn animation */ }
    @keyframes fadeIn {
      from {opacity: 0;}
      to {opacity: 1;}
    }
    h4 { color: #ccc; }
    .window-body { animation: moveIn 1s forwards; }
    @keyframes moveIn {
      from { transform: translateY(-200px); }
      to { transform: translateY(0); }
    }
    .window-body label, .window-body input, .window-body textarea, .window-body button {
      display: block; color:aliceblue; width:20rem; margin-bottom: 15px;
    }
    .window-body input, .window-body textarea { background: rgba(0, 0, 0, 0.427); }
    .window-body label, .window-body input { animation: moveInFromTop 2s forwards; }
    .window-body button, .input-group label, .input-group textarea { animation: moveInFromBottom 2s forwards; }
    @keyframes moveInFromTop {
      from { transform: translateY(-400px); }
      to { transform: translateY(0); }
    }
    @keyframes moveInFromBottom {
      from { transform: translateY(600px); }
      to { transform: translateY(0); }
    }
    /* Two Media queries for screen orientation */
    @media (orientation: landscape) {
      .window-body label, .window-body input, .window-body textarea, .window-body button {width:30rem;}
    }
    @media (orientation: portrait) {
      .window-body label, .window-body input, .window-body textarea, .window-body button {width:20rem;}
    }
    @media screen and (min-width:700px) and (max-width:912px) {
      .window-body label, .window-body input, .window-body textarea, .window-body button {width:40rem;}
      .window-body label {margin-top:-6px;}
      .window-title { margin-top:-40px; }
    }
  </style>
  <body>
    <header><!-- Upper Navigation Panel -->
      <img class="logo" src="img/CV-headed-eagle.png" alt="Brand Signature">
      <i class='bx bx-menu' id="menu-icon"></i>
      <nav>
        <a href="index.php">Home</a>
        <a class="current">Contact</a>
      </nav>
    </header>
    <main class="container">
      <!-- Recovery Window -->
      <div id="slide-window">
        <div class="window-title">
          <h4>Leave a message</h4>
        </div>
        <form class="window-body" name="contact" <?php require_once 'config/peripherals/contact_submission.config.php'; ?> method="post">
          <p class="error-uid"></p>

          <input type="hidden" name="_subject" value="New submission!">
          <input type="hidden" name="_template" value="table">
          <input type="hidden" name="_blacklist" value="spammy pattern, banned term, phrase">
          <input type="hidden" name="_autoresponse" value="Your message is on its way">

          <label for="username">Name or Username</label>
          <input type="text" name="username" placeholder="..." autocomplete="off">

          <label for="email">Your Email</label>
          <input type="text" name="email" placeholder="Enter your email">

          <div class="input-group">
              <label for="message">Your Message</label>
              <textarea name="message" rows="4"></textarea>
          </div>

          <button type="submit" name="submit">Send Message</button>
        </form>
      </div>
    </main>
  </body>
</html>