<?php // Dhr. Allen Pieter
  // Start a session for handling data and error messages.
  require 'config/peripherals/session_start.config.php'; 

  // Only load the page when signed in.
  require 'config/peripherals/redirect.config.php';

  // Include PHP files to retrieve data
  require "config/ViewResumes.config.php";

  // Create an instance of ViewResume
  $resume = new ViewResumes();
  $resumeData = $resume->viewResumeTitles();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Templater - MyResume</title>
    <!-- Favicon -->
    <?php include 'config/peripherals/favicon.config.php';?>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Styling Sheets -->
    <link rel="stylesheet" href="css/trongate.css">
    <link rel="stylesheet" href="css/templater.css">
    <!-- Javascript -->
    <?php require 'config/peripherals/javascript_load.config.php'; ?>
    <script defer src="javascript/dropdown.submit.js"></script>
  </head>
  <body>
    <!-- Upper Navigation Panel -->
    <header>
      <img class="logo" src="img/CV-headed-eagle.png" alt="Brand Signature">
      <i class='bx bx-menu' id="menu-icon"></i>
      <?php include 'config/peripherals/server_messages.config.php'; ?>
      <nav> 
        <?php include 'config/peripherals/nav_username.config.php'; ?>
        <a href="config/logout.config.php">Logout</a>
      </nav>
    </header>

    <!-- Resume Side Panel -->
    <section class="sidebar">
      <h5>Resume Builder</h5>
      <button class="New" data-window-target="#window">New Resume</button>
      <button data-window-target="#window2">Delete Resume</button> 
           
      <ul>
        <form action="config/SelectResume.config.php" method="post">
          <select class="dropdown" name="selectCv" onchange="submitForm(this.form)">
            <option selected disabled hidden>Select Resume:</option>
            <?php if (!empty($resumeData)) { ?>
            <?php foreach ($resumeData as $resume): ?>
              <option class="resume-select"><?= $resume['resumetitle']; ?></option>
            <?php endforeach; ?> <?php } ?>
          </select>
        </form>

        <li class="on"><i class='bx bxs-file'></i>Resume Builder</li>
        <li><a><i class='bx bxs-crown'></i>Premium</a></li>
        <li><a><i class='bx bxs-videos'></i>Tutorial</a></li>
        <li><a href="./account.php"><i class='bx bxs-cog'></i>Account Settings</a></li>
      </ul>
    </section>

    <!-- (Mobile) Resume Side Panel -->
    <section id="#mobilecv">
      <form action="config/SelectResume.config.php" method="post">
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
        <li><a><i class='bx bxs-videos bx-md'></i></a></li>
        <li><a href="./account.php"><i class='bx bxs-cog bx-md'></i></a></li>
      </ul>
    </section>

    <!-- Main Content -->
    <main class="container">

      <!-- Resume Builder -->
      <div class="collapse">

        <!-- Resume Name Field -->
        <input class="check" type="checkbox" id="collapse-head1">
        <label for="collapse-head1">Resume Name</label>       
        <div class="collapse-text" id="field1">
          <form name="resume" action="" method="post">
            <div class="left">
              <label for="resumetitle">Title</label>
              <input type="text" name="resumetitle" placeholder="Ex: Human Resource Manager" value="<?= isset($cv['resumetitle']) ? $cv['resumetitle'] : '' ?>" autocomplete="off">
            </div>  
            <button type="submit" name="saveResume">Save Changes</button> 
          </form>
          <button class="alt" name="clearResume">Clear</button>
          <button class="alt">View Resume</button>
        </div>
     
        <!-- Profile Fields -->
        <input class="check" type="checkbox" id="collapse-head2">
        <label for="collapse-head2">Profile</label>
        <div class="collapse-text" id="field2">
          <p>Edit your profile image</p>       
          <form name="profile" action="config/UploadFile.config.php" enctype="multipart/form-data" method="post">
            <div class="left">
              <label for="file-upload" class="custom-file-upload"><img src="img/av-placehold.png" alt=""></label>
              <input id="file-upload" name="file-upload" type="file"/>  
            </div>
            <div class="left">
              <label for="intro">Introduction</label>
              <input type="text" name="intro" id="profIntro" value="<?= isset($profile['intro']) ? $profile['intro'] : '' ?>" placeholder="Write a short introduction" autocomplete="off">
            </div>
            <div class="left">
              <label for="desc">Description</label>
              <textarea name="desc" rows="2" value="<?= isset($profile['desc']) ? $profile['desc'] : '' ?>" placeholder="Write your summary"></textarea>
            </div>
            <div class="left">   
              <button type="submit" name="saveProfile">Save Changes</button>       
            </div>
          </form>
          <button class="alt" name="clearProfile">Clear</button>
        </div>

        <!-- Work Experience Fields -->
        <input class="check" type="checkbox" id="collapse-head3">
        <label for="collapse-head3">Work Experience</label>
        <div class="collapse-text" id="field3">
          <form name="experience" action="" method="post">
            <div class="left">
              <label for="joined">From</label>
              <input type="date"  name="joined" value="<?= isset($exp['firstDate']) ? $exp['firstDate'] : '' ?>" placeholder=".">        
            </div>
            <div class="left">
              <label for="leave">Until</label>
              <input type="date"  name="joined" value="<?= isset($exp['lastDate']) ? $exp['lastDate'] : '' ?>" placeholder=".">         
            </div>
            <div class="left">    
              <label for="wtitle">Profession</label>
              <input type="text"  name="title" value="<?= isset($exp['worktitle']) ? $exp['worktitle'] : '' ?>" placeholder="Your profession">
            </div>   
            <div class="left">  
              <label for="wdesc">Description</label>
              <input type="text"  name="desc" value="<?= isset($exp['workdesc']) ? $exp['workdesc'] : '' ?>" placeholder="Description">
            </div>
            <div class="left">
              <label for="company">Company</label>
              <input type="text"  name="company" value="<?= isset($exp['company']) ? $exp['company'] : '' ?>" placeholder="Name of company">
            </div>
            <div class="left">   
              <button type="submit" name="saveExperience">Save Changes</button>       
            </div> 
          </form>
          <button class="alt" onclick="">Clear</button>
        </div>

        <!-- Education Fields -->
        <input class="check" type="checkbox" id="collapse-head4">
        <label for="collapse-head4">Education</label>
        <div class="collapse-text" id="field4">
          <!-- <p> zet hier maar wat leuks in... of haal weg </p> -->
          <form name="education" action="" method="post">
            <div class="left">
              <label for="eTitle">Education</label>
              <input type="text"  name="title" value="<?= isset($college['edutitle']) ? $college['edutitle'] : '' ?>" placeholder="Your course">
            </div>
            <div class="left">
              <label for="desc">Description</label>
              <input type="text"  name="desc" value="<?= isset($college['edudesc']) ? $college['edudesc'] : '' ?>" placeholder="short escription">
            </div>
            <div class="left">
              <label for="company">Company</label>
              <input type="text"  name="Company" value="<?= isset($college['company']) ? $college['company'] : '' ?>" placeholder="Education institute">
            </div>
            <div class="left">
              <label for="joined">From</label>
              <input type="date"  name="joined" value="<?= isset($college['firstDate']) ? $college['firstDate'] : '' ?>" placeholder=".">        
            </div>
            <div class="left">
              <label for="leave">Until</label>
              <input type="date" name="leave" value="<?= isset($college['lastDate']) ? $college['lastDate'] : '' ?>" placeholder=".">         
            </div>
            <div class="left">   
              <button type="submit" name="saveEducation">Save Changes</button>       
            </div> 
          </form>
          <button class="alt" onclick="">Clear</button>
        </div>

        <!-- Technical Skills Fields -->
        <input class="check" type="checkbox" id="collapse-head5">
        <label for="collapse-head5">Skills</label>
        <div class="collapse-text" id="field5">
          <!-- <p> zet hier maar wat leuks in... of haal weg </p> -->
          <form name="skills" action="" method="post">
            <!-- Languages, Technical Skills, Interests -->
            <div class="left">
              <label for="techTitle">Technical Skill</label>
              <input type="text" name="techTitle" value="<?= isset($tech['techtitle']) ? $tech['techtitle'] : '' ?>" placeholder="Technical skills">
            </div>
            <div class="left"> 
              <label for="lang">Language</label>
              <input type="text" name="lang" value="<?= isset($lang['language']) ? $lang['languge'] : '' ?>" placeholder="Language">
            </div>
            <div class="left">
              <label for="interests">Interests</label>
              <input type="text" name="interests" value="<?= isset($hobby['interest']) ? $hobby['interest'] : '' ?>" placeholder="Hobby and interests">
            </div>
            
            <!-- -- -- -- Portfolio Fields -- -- -- -->
            <div class="left">
              <label for="IMGpath">Picture of Project</label>
              <input type="file" name="IMGpath" placeholder="image">
            </div>
            <div class="left"> 
              <label for="IMGtitle">Image Title</label>
              <input type="text" name="IMGtitle" placeholder="image">
            </div>
            <div class="left">   
              <button type="submit" name="saveSkills">Save Changes</button>       
            </div> 
          </form>
          <button class="alt" onclick="">Clear</button>
        </div>
      </div>

      <!-- Create New Resume Window -->
      <div class="window" id="window">
        <div class="window-title">
          <div class="title">Your New Resume</div>
          <button data-window-close class="close-button">&#215;</button>
        </div>
        <form class="window-body" name="popup2" action="config/createresume.config.php" method="post">
          <p class="error-res"></p>
          <label for="cv-name">Let's give it a name</label>
          <input type="text" name="cv-name" placeholder="Name your new resume...">
          <button type="submit" name="creResume">Save Resume</button>
        </form>
      </div>

      <!-- Delete a Resume Window -->
      <div class="window" id="window2">
        <div class="window-title">
          <div class="title">Delete Resume</div>
          <button data-window-delclose class="close-button">&#215;</button>
        </div>
        <form class="window-body" name="popup3" action="" method="post">
          <p>Do you really want to delete a resume?</p>
          <p class="error-select"></p>
          <label for="selectCv">Select a resume to remove</label>
          <select name="selectCv">
            <option value="">(None selected)</option>
            <?php if (!empty($resumeData)) { ?>
            <?php foreach ($resumeData as $resume): ?>
              <option><?php echo $resume['resumetitle']; ?></option>
            <?php endforeach; ?> <?php } ?>
          </select>
          <button class="Del" type="submit" name="delResume">Delete</button>
        </form>
      </div>

      <!-- When any Window opens, darken the background -->
      <div id="overlay"></div>
    </main>
  </body>
</html>