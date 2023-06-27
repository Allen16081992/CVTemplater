<?php // Loubna Faress
  // Start a session for holding the user.
  require_once 'config/peripherals/session_start.config.php'; 
  require_once 'config/peripherals/redirect.config.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Templater - Tutorial</title>
    <!-- Favicon -->
    <?php include_once 'config/peripherals/favicon.config.php';?>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Styling Sheets -->
    <link rel="stylesheet" href="css/templater.css">
    <!-- Javascript -->
    <?php require_once 'config/peripherals/javascript_load.config.php'; ?>
  </head> 
  <style>
    header > h1 {
      position:absolute;
      margin-left:110px;
      font-size:2rem;
    }
    img {
      width: 900px;
      height: auto;
      margin-top: 5%;
      /*margin-left: 320px;*/
    }
    p {
      color: white;
      font-weight: bold;
      /*margin-left: 320px;*/
      margin-bottom: 10%;
    }
    .Account > p {
      margin-bottom: 10%;
      margin-top: -10%;
      height: 5rem;
      width: auto;
    }
    .Builder {
      height: auto;
      width: 500px;
      margin-top: 8%;
    }
    .Delete {
      height: auto;
      width: 500px;
      margin-top: 8%;
      margin-bottom: 10%;
    }
    .Experience {
      height: auto;
      width: 900px;
    }
    @media (orientation: portrait) {
      header > h1 {
        margin-top:-3rem;
        margin-left:-8px;
        font-size:1rem;
      }
      img, p, .Builder, .Delete, .Experience {
        width:100%;
      }
      .Account { margin-bottom:8rem; }
    }
  </style>
<body>
    <!-- Upper Navigation Panel -->
    <header>
      <img class="logo" src="img/CV-headed-eagle.png" alt="Brand Signature">
      <h1>Tutorial</h1>
      <i class='bx bx-menu' id="menu-icon"></i>
      <nav> 
        <?php include_once 'config/peripherals/nav_username.config.php'; ?>
        <a href="config/logout.config.php">Logout</a>
      </nav>
    </header>

    <!-- Resume Side Panel -->
    <section class="sidebar">
      <h5>Tutorial</h5>
      <button class="New" data-window-target="#window">New Resume</button>
      <button data-window-target="#window2">Delete Resume</button>        
      <ul>
        <form action="#" method="post">
          <select class="dropdown" name="selectCv">
            <option selected>Select Resume:</option>
            <option class="resume-select">This is an example</option>
          </select>
        </form>
        <li><a href="./client.php"><i class='bx bxs-file'></i>Resume Builder</li>
        <li><a href="suggestion.php"><i class='bx bxs-videos'></i>Useful Tips</a></li>
        <li class="on"><i class='bx bxs-crown'></i>Tutorial</a></li>
        <li><a href="./account.php"><i class='bx bxs-cog'></i>Account Settings</a></li>
      </ul>
    </section>

    <!-- (Mobile) Resume Side Panel -->
    <section id="mobilecv">
      <form action="#" method="post">
        <select class="m-dropup" name="selectCv">
          <option selected>Select Resume:</option>
          <option class="resume-select">This is an example</option>
        </select>
      </form>
    </section>
    
    <section class="m-sidebar">
      <ul>
        <li><a data-window-target="#window"><i class='bx bx-plus-circle bx-md'></i></a></li>
        <li><a data-window-target="#window2"><i class='bx bx-x-circle bx-md'></i></a></li>
        <li><a href="./client.php"><i class='bx bxs-file bx-md'></i></li>
        <li><a href="./suggestion.php"><i class='bx bxs-videos bx-md'></i></a></li>
        <li><a class="m-on"><i class='bx bxs-crown bx-md'></i></a></li>
        <li><a href="./account.php"><i class='bx bxs-cog bx-md'></i></a></li>
      </ul>
    </section>

    <!-- Main Content -->
    <main class="container">
      <img src="img/tutorials/tutorial1.PNG" alt="Resume Name">
      <p>1. De Resume Id is de serienummer van je CV.<br></br>
         2. De naam is aan te passen.<br></br>
         3. Klik op Save Changes om de wijzigingen op je CV op te slaan.<br></br>
         4. Klik op View Resume om je CV te bekijken.  
      </p>
      <img src="img/tutorials/tutorial2.PNG" alt="Profile">
      <p>1. Zet onder Introduction een korte introductie over jezelf.<br></br>
         2. Zet onder Description een sammenvatting over wie je bent/wat je doet etc.<br></br>
         3. Plaats linksboven een foto van jezelf.<br></br>
         4. Klik op Save Changes om je wijzigingen op je profiel op te slaan.
      </p>
      <div class="Experience">
        <img src="img/tutorials/tutorial3.PNG" alt="Work Experience">
      </div>
      <p> 1. Zet hier wanneer je in dienst bent geweest en wanneer je bent gestopt.<br></br>
          2. Zet hier je functie, bedrijfsnaam en een korte beschrijving.<br></br>
          3. Klik op Add om er één bij te voegen en op Save Changes om een bestaande op te slaan.
      </p>
      <img src="img/tutorials/tutorial4.PNG" alt="Education">
      <p> 1. Zet hier wanneer je bent gestart en wanneer je bent gestopt.<br></br>
          2. Zet hier je opleidingnaam, schoolnaam en een korte beschrijving.<br></br>
          3. Klik op Add om één opleiding bij te voegen en op Save Changes om een bestaande op te slaan.
      </p>
      <img src="img/tutorials/tutorial5.PNG" alt="Skills">
      <p>1. Zet hier al je skills die je beheerst.<br></br>
         2. Geef aan welke talen je beheerst.<br></br>
         3. Zet hier wat je hobby's zijn.<br></br>
         4. Klik op Add om een skill bij te voegen en op Save Changes om een bestaande op te slaan.   
      </p>
      <div class="Builder">
        <img src="img/tutorials/tutorial6.PNG" alt="Resume Builder">
      </div>
      <p>1. Wil je een nieuwe CV aanmaken? Klik dan op New Resume.<br></br>
        2. Wil je een gemaakte CV verwijderen? Klik dan op Delete Resume.<br></br>
        3. Wil je een gemaakte CV bekijken? Zoek hem dan op via Select Resume.  
      </p>
      <div class="Delete">
        <img src="img/tutorials/tutorial7.PNG" alt="Delete function">
      </div>
      <div class="Account">        
        <p>Ga naar het tabblad Account Settings en klik dan op Delete Account om je account te verwijderen.</p>
      </div>

      <!-- Create New Resume Window -->
      <div class="window" id="window">
        <div class="window-title">
          <div class="title">Your New Resume</div>
          <button data-window-close class="close-button">&#215;</button>
        </div>
        <form class="window-body" name="popup2" action="#" method="post">
          <label for="cvname">Let's give it a name</label>
          <input type="text" name="cvname" placeholder="This is an example">
          <button type="submit" name="creResume">Save Resume</button>
        </form>
      </div>

      <!-- Delete a Resume Window -->
      <div class="window" id="window2">
        <div class="window-title">
          <div class="title">Delete Resume</div>
          <button data-window-delclose class="close-button">&#215;</button>
        </div>
        <form class="window-body" name="popup3" action="#" method="post">
          <p>Do you really want to delete a resume?</p>
          <label for="selectCv">Select a resume to remove</label>
          <select name="selectCv">
            <option>(None selected)</option>
            <option>This is an example</option>
          </select>
          <button class="Del" type="submit" name="delResume">Delete</button>
        </form>
      </div>

      <!-- When any Window opens, darken the background -->
      <div id="overlay"></div>
    </main>
</body>
</html>