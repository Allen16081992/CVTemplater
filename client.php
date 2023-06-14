<?php // Dhr. Allen Pieter
  // Start a session for handling data and error messages.
  require_once 'config/peripherals/session_start.config.php'; 

  // Only load the page when signed in.
  require_once 'config/peripherals/redirect.config.php';

  // Include PHP files to retrieve data
  require_once "config/ViewResumes.config.php";
  require_once "config/FetchResumeTables.config.php";

  // Create an instance of ViewResume
  $resume = new ViewResumes();
  $resumeData = $resume->viewResumeTitles();

  if (isset($_SESSION['resumeID'])) {
    $resumeID = $_SESSION['resumeID'];
    $resumetitle = $_SESSION['resumetitle'];
    
    // Create a new instance of FetchData
    $fetchData = new FetchData();
    // Fetch all the data
    $data = $fetchData->fetchAllData($resumeID, $userID);
  }
  if (isset($resumeID)) { //test.. goofing around
    $_SESSION['golden'] = 'Resume: '.$resumetitle;
  }
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
    <!--<script defer src="javascript/clear.fields.js"></script>-->
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
        <form action="config/FetchResume.config.php" method="post">
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
        <li><a href="./Tutorial.php"><i class='bx bxs-videos'></i>Tutorial</a></li>
        <li><a href="./account.php"><i class='bx bxs-cog'></i>Account Settings</a></li>
        <?php echo "<i class='bx bxs-user-account bx-ms'></i> ".$userID; ?>
      </ul>
    </section>

    <!-- (Mobile) Resume Side Panel -->
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

    <!-- Main Content -->
    <main class="container">

      <!-- Resume Builder -->
      <div class="collapse">

        <!-- Resume Name Field -->
        <input class="check" type="checkbox" id="collapse-head1">
        <label for="collapse-head1">Resume Name</label>       
        <div class="collapse-text" id="field1">
          <form name="resume" action="" method="post">         
            <label for="resumeid">Resume ID</label>
            <input type="text" name="resumeid" placeholder="Ex: 0" value="<?= isset($resumeID) ? $resumeID : '' ?>" disabled>
            <label for="resumetitle">Name</label>
            <input type="text" name="resumetitle" placeholder="Ex: Sales" value="<?= isset($resumetitle) ? $resumetitle : '' ?>" autocomplete="off">
            <div class="left"> 
              <button type="submit" name="saveResume">Save Changes</button>
            </div> 
          </form>
          <!--<button class="alt" name="clearResume">Clear</button>-->
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
              <input type="text" name="intro" id="profIntro" value="<?= isset($profile['profileintro']) ? $profile['profileintro'] : '' ?>" placeholder="Write a short introduction" autocomplete="off">
            </div>
            <div class="left">
              <label for="desc">Description</label>
              <textarea name="desc" rows="2" value="<?= isset($profile['profiledesc']) ? $profile['profiledesc'] : '' ?>" placeholder="Write your summary"></textarea>
            </div>
            <div class="left">   
              <button type="submit" name="saveProfile">Save Changes</button>       
            </div>
          </form>
          <!--<button class="alt" name="clearProfile">Clear</button>-->
        </div>

        <!-- Work Experience Fields -->
        <input class="check" type="checkbox" id="collapse-head3">
        <label for="collapse-head3">Work Experience</label>
        <div class="collapse-text" id="field3">
          <form name="experience" action="config/createexperience.config.php" method="post">
            <?php if(isset($resumeID)) { ?>
              <input type="hidden" name="work" placeholder="">
              <label for="from">From - Until</label>
              <input type="text" name="from" placeholder="1800-01-01">
              <input type="text" name="until" placeholder="2000-01-01">
              <label for="worktitle">Profession and Description</label>
              <input type="text" name="worktitle" placeholder="Leader">
              <input type="text" name="company" placeholder="Rulecorp">
              <textarea name="workdesc" rows="2" placeholder="Write your summary"></textarea>               
            <?php } ?>
            <?php if (!empty($data)) { ?>
            <?php foreach ($data['experience'] as $experience): ?>
              <?= $experience['firstDate']; ?><?=" ".$experience['firstDate']; ?><?= " ".$experience['worktitle']; ?><?= " ".$experience['workdesc']; ?>

              <input type="hidden" name="work" value="<?= $experience['workID']; ?>">
              <label for="from">From - Until</label>
              <input type="text" name="from" value="<?= $experience['firstDate']; ?>">
              <input type="text" name="until" value="<?= $experience['lastDate']; ?>">
              <label for="worktitle">Profession and Description</label>
              <input type="text" name="worktitle" value="<?= $experience['worktitle']; ?>">
              <input type="text" name="company" value="<?= $experience['company']; ?>">
              <textarea name="workdesc" rows="2" placeholder="Write your summary"><?= $experience['workdesc']; ?></textarea>
            <?php endforeach; } else { ?>
              <label for="from">From - Until</label>
              <input type="text" name="from" placeholder="1800-01-01">
              <input type="text" name="until" placeholder="2000-01-01">
              <label for="worktitle">Profession and Description</label>
              <input type="text" name="worktitle" placeholder="Leader">
              <input type="text" name="company" placeholder="Rulecorp">
              <textarea name="workdesc" rows="2" placeholder="Write your summary"></textarea>               
            <?php } ?>

            <div class="left">
              <button type="submit" class="New" name="addExperience">Add</button>  
              <button type="submit" name="saveExperience">Save Changes</button>       
            </div>       
          </form>
          <!--<button class="alt" name="clearWork">Clear</button>-->
        </div>

        <!-- Education Fields -->
        <input class="check" type="checkbox" id="collapse-head4">
        <label for="collapse-head4">Education</label>
        <div class="collapse-text" id="field4">
          <form name="education" action="config/createeducation.config.php" method="post">
            <?php if (!empty($data)) { ?>
            <?php foreach ($data['education'] as $college): ?>
              <?= $college['firstDate']; ?><?=" ".$college['firstDate']; ?><?= " ".$college['edutitle']; ?><?= " ".$college['edudesc']; ?>

              <input type="hidden" name="edu_id" value="<?= $college['eduID']; ?>">
              <label for="from">From - Until</label>
              <input type="text" name="from" value="<?= $college['firstDate']; ?>">
              <input type="text" name="until" value="<?= $college['lastDate']; ?>">
              <label for="profession">Profession and Description</label>
              <input type="text" name="edutitle" value="<?= $college['edutitle']; ?>">
              <input type="text" name="company" value="<?= $college['company']; ?>">
              <textarea name="desc" rows="2" placeholder="Write your summary"><?= $college['edudesc']; ?></textarea>
            <?php endforeach; } else { ?>
              <label for="from">From - Until</label>
              <input type="text" name="from" placeholder="1800-01-01">
              <input type="text" name="until" placeholder="2000-01-01">
              <label for="worktitle">Profession and Description</label>
              <input type="text" name="worktitle" placeholder="Leader">
              <input type="text" name="company" placeholder="Rulecorp">
              <textarea name="workdesc" rows="2" placeholder="Write your summary"></textarea>               
            <?php } ?>
            <?php if(isset($resumeID)) { ?>
              <input type="hidden" name="edu_id" value="<?= $college['eduID']; ?>">
              <label for="from">From - Until</label>
              <input type="text" name="from" placeholder="1923-12-30">
              <input type="text" name="until" placeholder="2002-08-01">
              <label for="profession">Profession and Description</label>
              <input type="text" name="edutitle" placeholder="Ex: History Teacher">
              <input type="text" name="company" placeholder="Ex: Rotterdamse Technische School">
            <?php } ?>  
            <div class="left">
              <button type="submit" class="New" name="addEducation">Add</button>  
              <button type="submit" name="saveEducation">Save Changes</button>  
            </div>       
          </form>
          <!--<button class="alt">Clear</button>--> 
        </div>

        <!-- Technical Skills Fields -->
        <input class="check" type="checkbox" id="collapse-head5">
        <label for="collapse-head5">Skills</label>
        <div class="collapse-text" id="field5">        
          <form name="skills" action="" method="post">
            <!-- Languages, Technical Skills, Interests -->
            <label for="skills">Skills</label>
            <?php if (!empty($data)) { ?>
            <?php foreach ($data['technical'] as $tech): ?>
              <input type="text" name="technical" placeholder="Ex: 0" value="<?= $tech['techtitle']; ?>">
            <?php endforeach; ?><?php } else { ?> <input type="text" name="skills" placeholder="Ex: Planning"> <?php } ?>

            <label for="language">Languages</label>
            <?php if (!empty($data)) { ?>
            <?php foreach ($data['languages'] as $lang): ?>
              <input type="text" name="language" placeholder="Ex: Sales" value="<?= $lang['language']; ?>">
            <?php endforeach; ?><?php } else { ?> <input type="text" name="language" placeholder="Ex: Berber"> <?php } ?>

            <label for="hobby">Hobby</label>
            <?php if (!empty($data)) { ?>
            <?php foreach ($data['interests'] as $hobby): ?>
              <input type="text" name="hobby" placeholder="Ex: Sales" value="<?= $hobby['interest']; ?>">
            <?php endforeach; ?><?php } else { ?> <input type="text" name="hobby" placeholder="Ex: Bingewatching"> <?php } ?>

            <div class="left"> 
              <button type="submit" class="New" name="addSkills">Add</button>   
              <button type="submit" name="saveSkills">Save Changes</button>       
            </div> 
          </form>
          <!--<button class="alt" onclick="">Clear</button>-->
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
          <label for="cvname">Let's give it a name</label>
          <input type="text" name="cvname" placeholder="Name your new resume...">
          <button type="submit" name="creResume">Save Resume</button>
        </form>
      </div>

      <!-- Delete a Resume Window -->
      <div class="window" id="window2">
        <div class="window-title">
          <div class="title">Delete Resume</div>
          <button data-window-delclose class="close-button">&#215;</button>
        </div>
        <form class="window-body" name="popup3" action="config/delete.resume.config.php" method="post">
          <p class="error-select"></p>
          <p>Do you really want to delete a resume?</p>
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