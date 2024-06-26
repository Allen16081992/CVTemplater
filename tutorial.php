<?php // Loubna Faress
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
    <title>CV Templater - Tutorial</title>
    <!-- Favicon -->
    <?php include_once 'config/peripherals/favicon.config.php';?>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Styling Sheets -->
    <link rel="stylesheet" href="css/templater.css">
    <!-- Javascript -->
    <script defer src="javascript/error.messages.js"></script>
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
      <i class='bx bx-menu' id="menu-icon"></i>
      <nav> 
        <?php include_once 'config/peripherals/nav_username.config.php'; ?>
        <a href="config/logout.config.php">Logout</a>
      </nav>
    </header>

    <!-- Resume Side Panel -->
    <section class="sidebar">
      <h5>Tutorial</h5>
      <!--<button class="New" data-window-target="#window">New Resume</button>
      <button data-window-target="#window2">Delete Resume</button>-->    
      <ul>
        <!--<form>
          <select class="dropdown" name="selectCv">
            <option selected>Select Resume:</option>
            <option class="resume-select">This is an example</option>
          </select>
        </form>-->
        <li><a href="./client.php"><i class='bx bxs-file'></i>Resume Builder</li>
        <li><a href="useful_tips.php"><i class='bx bxs-videos'></i>Useful Tips</a></li>
        <li class="on"><i class='bx bxs-crown'></i>Tutorial</a></li>
        <li><a href="./account.php"><i class='bx bxs-cog'></i>Account Settings</a></li>
      </ul>
    </section>

    <!-- (Mobile) Resume Side Panel -->
    <section id="mobilecv">
      <form>
        <select class="m-dropup" name="selectCv">
          <option selected>Select Resume:</option>
          <option class="resume-select">This is an example</option>
        </select>
      </form>
    </section>
    
    <section class="m-sidebar">
      <ul>
        <!--<li><a style="color:grey;"><i class='bx bx-plus-circle bx-md'></i></a></li>
        <li><a style="color:grey;"><i class='bx bx-x-circle bx-md'></i></a></li>-->
        <li><a href="./client.php"><i class='bx bxs-file bx-md'></i></li>
        <li><a href="./useful_tips.php"><i class='bx bxs-videos bx-md'></i></a></li>
        <li><a class="m-on"><i class='bx bxs-crown bx-md'></i></a></li>
        <li><a href="./account.php"><i class='bx bxs-cog bx-md'></i></a></li>
      </ul>
    </section>

    <!-- Main Content -->
    <main class="container">
      <img src="img/tutorials/tutorial1.PNG" alt="Resume Name">
      <p>1. The Resume Id is the serienumber.<br></br>
         2. The name is changeable.<br></br>
         3. click on Download to save your Resume.<br></br>
      </p>
      <img src="img/tutorials/tutorial2.PNG" alt="Profile">
      <p>1. Introduce yourself.<br></br>
         2. Place here a short description about yourself.<br></br>
         3. You can put a picture of yourself.<br></br>
         4. Click on Save to save your changes.
         5. Click on Trash to Delete everything in this tab.
      </p>
      <div class="Experience">
        <img src="img/tutorials/tutorial3.PNG" alt="Work Experience">
      </div>
      <p> 1. Put your date of employment and date of leaving.<br></br>
          2. Write your profession.<br></br>
          3. Click on Add to include a new job.
      </p>
      <img src="img/tutorials/tutorial4.PNG" alt="Education">
      <p> 1. Put your date of enlisting and gradution.<br></br>
          2. Put here your study description.<br></br>
          3. Click on Add to add a new institute.
      </p>
      <img src="img/tutorials/tutorial5.PNG" alt="Skills">
      <p>1. Put here your skills.<br></br>
         2. Your languages.<br></br>
         3. Your hobby's.<br></br>
         4. click on Add to add new rows.   
      </p>
      <div class="Builder">
        <img src="img/tutorials/tutorial6.PNG" alt="Resume Builder">
      </div>
      <p>1. Click on New Resume to create one.<br></br>
        2. Click on Delete Resume to delete one.<br></br>
        3. Select Resume to see and edit.  
      </p>
      <div class="Delete">
        <img src="img/tutorials/tutorial7.PNG" alt="Delete function">
      </div>
      <div class="Account">        
        <p>Go to Account Settings if you want to remove your Account.</p>
      </div>

      <!-- Create New Resume Window -->
      <div class="window" id="window">
        <div class="window-title">
          <div class="title">Your New Resume</div>
          <button data-window-close class="close-button">&#215;</button>
        </div>
        <form class="window-body" name="popup2">
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
        <form class="window-body" name="popup3">
          <p>Do you really want to delete your resume?</p>
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