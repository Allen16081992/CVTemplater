<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Templater - MyResume</title>
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
      <nav> 
        <?php
          if(isset($_SESSION['user_id'])) {
              echo '<a class="current">'.$_SESSION['user_name'].'</a>';
          } else { echo '<a class="current">MyID</a>'; }
        ?>
        <a href="config/logout.config.php">Logout</a>
      </nav>
    </header>

    <!-- Resume Side Panel -->
    <section class="sidebar">
      <h5>Resume Builder</h5>
      <button class="New" data-window-target="#window">New Resume</button>
      <button data-window-target="#window2">Delete Resume</button> 
      <ul>
        <li class="on"><i class='bx bxs-file'></i>Resume Builder</li>
        <li><a><i class='bx bxs-crown'></i>Premium</a></li>
        <li><a><i class='bx bxs-videos'></i>Tutorial</a></li>
        <li><a href="account.php"><i class='bx bxs-cog'></i>Account Settings</a></li>
      </ul>
    </section>

    <!-- (Mobile) Resume Side Panel -->
    <section class="m-sidebar">
      <ul>
        <li><a data-window-target="#window"><i class='bx bx-plus-circle bx-md'></i></a></li>
        <li><a><i class='bx bx-x-circle bx-md'></i></a></li>
        <li><a><i class='bx bxs-crown bx-md'></i></a></li>
        <li><a><i class='bx bxs-videos bx-md'></i></a></li>
        <li><a><i class='bx bxs-cog bx-md'></i></a></li>
      </ul>
    </section>

    <!-- Main Content -->
    <main class="container">

      <!-- Create New Resume Window -->
      <div class="window" id="window">
        <div class="window-title">
          <div class="title">Your New Resume</div>
          <button data-window-close class="close-button">&#215;</button>
        </div>
        <form class="window-body" name="popup2" action="" method="post">
          <p class="error-res"></p>
          <label for="cvname">Let's give it a name</label>
          <input type="text" name="cvname" placeholder="Name your new resume...">
          <button type="submit" name="creResume">Save Resume</button>
        </form>
      </div>

      <!-- Delete a Resume Window -->
      <div class="window" id="window2">
        <div class="window-title">
          <div class="title">Do you really want to delete one?</div>
          <button data-window-delclose class="close-button">&#215;</button>
        </div>
        <form class="window-body" name="popup3" action="" method="post">
          <p class="error-select"></p>
          <label for="selectCv">Select a resume to remove</label>
          <select name="selectCv">
            <option value="">(None selected)</option>
            <option>....</option>
            <?php foreach($data as $option) { ?>
              <option><?php echo $option; ?></option>
            <?php } ?>
          </select>
          <button class="Del" type="submit" name="delResume">Delete</button>
        </form>
      </div>

      <!-- When any Window opens, darken the background -->
      <div id="overlay"></div>
    </main>
  </body>
</html>