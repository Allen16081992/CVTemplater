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
      position:absolute;
      margin-left:100px;
      /* font-size: ; */
    }
    .sidebar {
      margin-top: 4.8%;
    }
    img {
      width: 900px;
      height: auto;
      margin-top: 5%;
      margin-left: 320px;
    }
    p {
      color: white;
      margin-left: 320px;
      font-weight: bold;
    }
    .Builder {
      height: auto;
      width: 500px;
      margin-top: 15%;
    }
    .Delete {
      height: auto;
      width: 500px;
      margin-top: 15%;
    }
    .Experience {
      height: auto;
      width: 900px;
    }
  </style>
<body>
    <header>
      <img class="logo" src="img/CV-headed-eagle.png" alt="Brand Signature">
      <h1>Tutorial</h1>
      <i class='bx bx-menu' id="menu-icon"></i>
      <nav> 
        <?php include 'config/peripherals/nav_username.config.php'; ?>
        <a href="config/logout.config.php">Logout</a>
      </nav>
    </header>

    <section class="sidebar">
      <h5>Resume Builder</h5>
      <button class="New" data-window-target="#window">New Resume</button>
      <button data-window-target="#window2">Delete Resume</button> 
           
      <ul>
        <form action="config/FetchResume.config.php" method="post">
          <select class="dropdown" name="selectCv" onchange="submitForm(this.form)">
            <option selected disabled hidden>Select Resume:</option>
            <?php if (!empty($resumeData)) { ?>
            <?php foreach ($resumeData as $resume): ?>
              <option class="resume-select"><?= $resume['resumetitle']; ?></option>
            <?php endforeach; ?> <?php } ?>
          </select>
        </form>

        <li><a href="./client.php"><i class='bx bxs-file'></i>Resume Builder</li>
        <li><a><i class='bx bxs-crown'></i>Premium</a></li>
        <li class="on"><i class='bx bxs-videos'></i>Tutorial</a></li>
        <li><a href="./account.php"><i class='bx bxs-cog'></i>Account Settings</a></li>
        <?php echo "<i class='bx bxs-user-account bx-ms'></i> ".$userID; ?>
      </ul>
    </section>

    <section id="mobilecv">
      <form action="config/FetchResume.config.php" method="post">
        <select class="m-dropup" name="selectCv" onchange="submitForm(this.form)">
          <option selected disabled hidden>Select Resume:</option>
          <?php if (!empty($resumeData)) { ?>
          <?php foreach ($resumeData as $resume): ?>
            <option><?= $resume['resumetitle']; ?></option>
          <?php endforeach; ?> <?php } ?>
        </select>
      </form>
    </section>
    <section class="m-sidebar">
      <ul>
        <li><a data-window-target="#window"><i class='bx bx-plus-circle bx-md'></i></a></li>
        <li><a data-window-target="#window2"><i class='bx bx-x-circle bx-md'></i></a></li>
        <li><a><i class='bx bxs-crown bx-md'></i></a></li>
        <li><a href="./Tutorial.php"><i class='bx bxs-videos bx-md'></i></a></li>
        <li><a href="./account.php"><i class='bx bxs-cog bx-md'></i></a></li>
      </ul>
    </section>

      <img src="img/tutorials/tutorial1.PNG" alt="Resume Name">
      <p>De Resume Id is de serienummer van je CV.<br></br>
         De naam is aan te passen.<br></br>
         Klik op Save Changes om je wijzigingen op je Resume op te slaan.<br></br>
         Klik op View Resume om je CV te bekijken.  
      </p>
      <img src="img/tutorials/tutorial2.PNG" alt="Profile">
      <p>Zet onder Introduction een korte introductie over jezelf.<br></br>
         Zet onder Description een sammenvatting over wie je bent/wat je doet etc.<br></br>
         Klik op Save Changes om je wijzigingen op je profiel op te slaan.
      </p>  
      <div class="Experience">
      <img src="img/tutorials/tutorial3.PNG" alt="Work Experience">
      </div>
      <p> Zet hier wanneer je in dienst bent geweest en wanneer je bent gestopt.<br></br>
          Zet hier je functie, bedrijfsnaam en een korte beschrijving.<br></br>
          Klik op Add om er één bij te voegen en op Save Changes om een bestaande op te slaan.
      </p>
      <img src="img/tutorials/tutorial4.PNG" alt="Education">
      <p> Zet hier wanneer je bent gestart en wanneer je bent gestopt.<br></br>
          Zet hier je opleidingnaam, schoolnaam en een korte beschrijving.<br></br>
          Klik op Add om er één opleiding bij te voegen en op Save Changes om een bestaande op te slaan.
      </p>
      <img src="img/tutorials/tutorial5.PNG" alt="Skills">
      <p></p>
      <div class="Builder">
      <img src="img/tutorials/tutorial6.PNG" alt="Resume Builder">
      </div>
      <p></p>
      <div class="Delete">
      <img src="img/tutorials/tutorial7.PNG" alt="Delete function">
      </div>
      <p>Verwijder je CV onder het tabblad Account Settings.</p>
</body>
</html>