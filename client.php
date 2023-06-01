<?php // Dhr. Allen Pieter
  // Start a session for handling data and error messages.
  session_start(); 
?>
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
    <script defer src="javascript/clear.fields.js"></script>
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

      <!-- Resume Builder -->
      <div class="collapse">

        <!-- Resume Name Field -->
        <input class="check" type="checkbox" id="collapse-head1">
        <label for="collapse-head1">Resume Name</label>       
        <div class="collapse-text" id="field1">
          <form name="resume" action="config/setAccount.config.php" method="post">
            <div class="left">
              <label for="resumetitle"></label>
              <input type="text" name="resumetitle" placeholder="Ex: Human Resource Manager" autocomplete="off">
            </div>
            <button type="submit" name="saveResume">Save Changes</button>       
          </form>
          <div class="left">
            <button class="alt" name="clearResume">Clear</button>
            <button class="alt">View Entire Resume</button>
          </div>
        </div>
     
        <!-- Profile Fields -->
        <input class="check" type="checkbox" id="collapse-head2">
        <label for="collapse-head2">Profile</label>
        <div class="collapse-text" id="field2">
          <p>Edit your profile image</p>       
          <form name="profile" action="config/setAccount.config.php" enctype="multipart/form-data" method="post">
            <div class="left">
              <label for="file-upload" class="custom-file-upload"><img src="img/av-placehold.png" alt=""></label>
              <input id="file-upload" name="file-upload" type="file"/>  
            </div>
            <div class="left">
              <label for="intro">Introduction</label>
              <input type="text" name="intro" placeholder="Write a short introduction" autocomplete="off">
            </div>
            <div class="left">
              <label for="desc">Description</label>
              <textarea name="desc" rows="2" placeholder="Write your summary"></textarea>
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
          <form name="experience" action="config/setAccount.config.php" method="post">

        <div class="left">    
          <label for="wtitle">Profession</label>
          <input type="text"  name="wtitle" placeholder="Your profession">
        </div>
        
                
        <div class="left">  
          <label for="wdesc">Description</label>
          <input type="text"  name="wdesc" placeholder="Description">
        </div>


        <div class="left">
          <label for="company">Company</label>
          <input type="text"  name="company" placeholder="Name of company">
        </div>


        <div class="left">
          <label for="joined">From</label>
          <input type="date"  name="joined" placeholder=".">        
        </div>


        <div class="left">
          <label for="leave">Until</label>
          <input type="date"  name="joined" placeholder=".">         
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
          <form name="education" action="config/setAccount.config.php" method="post">

          <div class="left">
            <label for="eTitle">Education</label>
            <input type="text"  name="eTitle" placeholder="Your course">
          </div>


          <div class="left">
            <label for="desc">Description</label>
            <input type="text"  name="desc" placeholder="short escription">
          </div>


          <div class="left">
            <label for="company">Company</label>
            <input type="text"  name="Company" placeholder="Education institute">
          </div>


          <div class="left">
            <label for="joined">From</label>
            <input type="date"  name="joined" placeholder=".">        
          </div>


          <div class="left">
            <label for="leave">Until</label>
            <input type="date" name="leave" placeholder=".">         
          </div>


            <div class="left">   
              <button type="submit" name="saveEducation">Save Changes</button>       
            </div> 
          </form>
          <button class="alt" onclick="">Clear</button>
        </div>

        <!-- All Skills Fields -->
        <input class="check" type="checkbox" id="collapse-head5">
        <label for="collapse-head5">Skills</label>
        <div class="collapse-text" id="field5">
        <!-- <p> zet hier maar wat leuks in... of haal weg </p> -->
          <form name="skills" action="config/setAccount.config.php" method="post">
              <!-- Languages, Technical Skills, Interests -->

            <div class="left"> 
              <label for="lang">Language</label>
              <input type="text"  name="lang" placeholder="Language">
            </div> 


            <div class="left">
              <label for="techTitle">Technical Skill</label>
              <input type="text"  name="techTitle" placeholder="Technical skills">
            </div>


            <div class="left">
              <label for="interests">Interests</label>
              <input type="text"  name="interests" placeholder="Hobby and interests">
            </div>
            
              <!-- -- -- -- Portfolio Fields -- -- -- -->

            <div class="left"> 
              <label for="IMGtitle">Image Title</label>
              <input type="text"  name="IMGtitle" placeholder="image">
            </div> 


            <div class="left">
              <label for="IMGpath">Picture of Project</label>
              <input type="file"  name="IMGpath" placeholder="image">
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
        <form class="window-body" name="popup2" action="config/Classes/createresume.php" method="post">
          <p class="error-res"></p>
          <label for="cv-name">Let's give it a name</label>
          <input type="text" name="cv-name" placeholder="Name your new resume...">
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