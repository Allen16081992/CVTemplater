<?php // Dhr. Allen Pieter
  // Start a session for handling data and error messages.
  require_once 'config/peripherals/session_start.config.php'; 
  require_once 'config/peripherals/redirect.config.php';
  // Load PHP files to retrieve data
  require_once "config/ViewResumes.config.php";
  require_once "config/FetchResumeTables.config.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Templater - MyResume</title>
    <!-- Favicon -->
    <?php include_once 'config/peripherals/favicon.config.php';?>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Styling Sheets -->
    <link rel="stylesheet" href="css/templater.css">
    <!-- Javascript -->
    <?php require_once 'config/peripherals/javascript_load.config.php'; ?>
    <script defer src="javascript/dropdown.submit.js"></script>
    <script defer src="javascript/mobile.pdf.helper.js"></script>
    <!--<script defer src="javascript/clear.fields.js"></script>-->
  </head>
  <body>
    <!-- Upper Navigation Panel -->
    <header>
      <img class="logo" src="img/CV-headed-eagle.png" alt="Brand Signature">
      <i class='bx bx-menu' id="menu-icon"></i>
      <?php require_once 'config/peripherals/server_messages.config.php'; ?>
      <nav> 
        <?php include_once 'config/peripherals/nav_username.config.php'; ?>
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
        <li><a href="error404.php"><i class='bx bxs-crown'></i>Premium</a></li>
        <li><a href="tutorial.php"><i class='bx bxs-videos'></i>Tutorial</a></li>
        <li><a href="account.php"><i class='bx bxs-cog'></i>Account Settings</a></li>
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
        <li><a href="./tutorial.php"><i class='bx bxs-videos bx-md'></i></a></li>
        <li><a href="./account.php"><i class='bx bxs-cog bx-md'></i></a></li>
      </ul>
    </section>

    <!-- Main Content -->
    <main class="container">

      <!-- Resume Builder -->
      <div class="collapse">

        <!-- Resume Title Tab -->
        <input class="check" type="checkbox" id="collapse-head1">
        <label for="collapse-head1">Resume Name</label>       
        <div class="collapse-text" id="field1">
          <form name="resume" action="config/updateresume.config.php" method="post"> 
            <p class="error-resume-tab"></p>        
            <label for="resid">Resume ID</label>
            <input type="text" placeholder="*ID is Protected." disabled>
            <input type="text" name="resid" value="<?= isset($resumeID) ? $resumeID : '' ?>" hidden>
            <label for="cvname">Name</label>
            <input type="text" name="cvname" placeholder="Ex: Professional Dredger" value="<?= isset($_SESSION['resumetitle']) ? $_SESSION['resumetitle'] : '' ?>">
            <div class="left"> 
              <button type="submit" class="Save" name="saveResume">Save</button>
            </div> 
          </form>
          <!--<button class="alt" name="clearResume">Clear</button>-->
          <button class="alt" id="PDF">Download</button><!-- id is needed for js -->
        </div>

        <!-- Profile Tab -->
        <input class="check" type="checkbox" id="collapse-head2">
        <label for="collapse-head2">Profile</label>
        <div class="collapse-text" id="field2">
          <p>Edit your profile image</p>       
          <form name="profile" action="config/profile.config.php" enctype="multipart/form-data" method="post">
            <input type="text" name="resumeid" value="<?= isset($resumeID) ? $resumeID : '' ?>" hidden>
            <div class="left">
              <?php if (isset($userID) && !empty($data['profile'])) { ?>
                <?php foreach ($data['profile'] as $profile): ?>
                  <!-- Verify if the image is readable -->
                  <?php $filePath = "img/avatars/".$profile['fileName'];
                  if (is_readable($filePath)) {
                      echo 'File is readable.';
                  } else {
                    echo 'File is not readable.';
                  } ?>
                  <?php if (!empty($profile['fileName'])) { ?>
                    <label for="file-upload" class="custom-file-upload"><img src="img/avatars/<?= $profile['fileName']; ?>" alt=""></label>
                  <?php } else { ?><label for="file-upload" class="custom-file-upload"><img src="img/av-placehold.png" alt=""></label><?php } ?>
                <?php endforeach; ?>
              <?php } else { ?>
                <label for="file-upload" class="custom-file-upload"><img src="img/av-placehold.png" alt=""></label>
              <?php } ?>
              <input id="file-upload" name="file-upload" type="file"/>  
            </div>
            <div class="left">
              <label for="intro">Introduction</label>
              <?php if (isset($userID) && !empty($data['profile'])) { ?>
                <?php foreach ($data['profile'] as $profile): ?>
                  <input type="text" name="intro" placeholder="Write a short introduction" value="<?= $profile['profileintro']; ?>">
                <?php endforeach; ?>
              <?php } else { ?>
                <input type="text" name="intro" placeholder="Write a short introduction">
              <?php } ?>
            </div>
            <div class="left">
              <label for="desc">Description</label>
              <?php if (isset($userID) && !empty($data['profile'])) { ?>
                <?php foreach ($data['profile'] as $profile): ?>
                  <textarea name="desc" rows="2" placeholder="Write your summary"><?= $profile['profiledesc']; ?></textarea>
                <?php endforeach; ?>
              <?php } else { ?>
                <textarea name="desc" rows="2" placeholder="Write your summary"></textarea>
              <?php } ?>
            </div>
            <div class="left">   
              <button type="submit" class="Save" name="saveProfile">Save</button> 
              <button type="submit" class="Trash" name="trashProfile">Trash</button>        
            </div>
          </form> 
        </div>

        <!-- Work Experience Tab -->
        <input class="check" type="checkbox" id="collapse-head3">
        <label for="collapse-head3">Work Experience</label>
        <div class="collapse-text" id="field3">
          <p class="error-work-tab"></p>
          <div class="label-container">
            <div class="label-group">
              <label for="from">From</label>
              <label for="until">Until</label>
              <label for="profession">Profession</label>
              <label for="company">Company</label>
            </div>
          </div>
          <?php if (isset($userID) && !empty($data['experience'])) { ?>
            <?php foreach ($data['experience'] as $experience): 
            echo '<form name="experience" action="config/createexperience.config.php" method="post">
                <div class="input-container">
                  <div class="input-group">
                      <input type="text" name="from" placeholder="1956-02-01" value="'.$experience['firstDate'].'">
                  </div>
                  <div class="input-group">
                      <input type="text" name="until" placeholder="1956-02-01" value="'.$experience['lastDate'].'">
                  </div>
                  <div class="input-group">
                      <input type="text" name="profession" placeholder="Marketing Manager" value="'.$experience['worktitle'].'">
                  </div>
                  <div class="input-group">
                      <input type="text" name="company" placeholder="DHL" value="'.$experience['company'].'">
                  </div>
                </div>
                <textarea name="workdesc" rows="2" placeholder="Write your job description here...">'.$experience['workdesc'].'</textarea>
                <input type="hidden" name="workID" value="'.$experience['workID'].'">
                <div class="button-container"> 
                  <button type="submit" class="Save" name="saveExperience">Save</button> 
                  <button type="submit" class="Trash" name="trashExperience">Trash</button>     
                </div>
              </form>';
            endforeach; ?> 
            <!-- Dynamically produce an empty form as well -->
            <form name="experience" action="config/createexperience.config.php" method="post">
              <div class="input-container">
                <div class="input-group">
                    <input type="text" name="from" placeholder="1956-02-01">
                </div>
                <div class="input-group">
                    <input type="text" name="until" placeholder="1956-02-01">
                </div>
                <div class="input-group">
                    <input type="text" name="profession" placeholder="Marketing Manager">
                </div>
                <div class="input-group">
                    <input type="text" name="company" placeholder="DHL">
                </div>
              </div>
              <textarea name="workdesc" rows="2" placeholder="Write your job description here..."></textarea>
              <div class="button-container">
                <button type="submit" class="Add" name="addExperience">Add</button>
              </div>
            </form>               
          <?php } else { 
            echo '<form name="experience" action="config/createexperience.config.php" method="post">
              <div class="input-container">
                <div class="input-group">
                    <input type="text" name="from" placeholder="1956-02-01">
                </div>
                <div class="input-group">
                    <input type="text" name="until" placeholder="1956-02-01">
                </div>
                <div class="input-group">
                    <input type="text" name="profession" placeholder="Marketing Manager">
                </div>
                <div class="input-group">
                    <input type="text" name="company" placeholder="DHL">
                </div>
              </div>
              <textarea name="workdesc" rows="2" placeholder="Write your job description here..."></textarea>
              <div class="button-container">
                <button type="submit" class="Add" name="addExperience">Add</button>
              </div>
            </form>'; 
          } ?>
        </div>

        <!-- Education Tab -->
        <input class="check" type="checkbox" id="collapse-head4">
        <label for="collapse-head4">Education</label>
        <div class="collapse-text" id="field4">
            <p class="error-education-tab"></p>
            <div class="label-container">
              <div class="label-group">
                <label for="from">From</label>
                <label for="until">Until</label>
                <label for="edutitle">Program</label>
                <label for="company">Institution</label>
              </div>
            </div>
            <?php if (isset($userID) && !empty($data['education'])) { ?>
              <?php foreach ($data['education'] as $college):
                echo '<form name="education" action="config/createeducation.config.php" method="post">
                  <div class="input-container">
                    <div class="input-group">
                        <input type="text" name="from" placeholder="1956-02-01" value="'.$college['firstDate'].'">
                    </div>
                    <div class="input-group">
                        <input type="text" name="until" placeholder="1956-02-01" value="'.$college['lastDate'].'">
                    </div>
                    <div class="input-group">
                        <input type="text" name="program" placeholder="Electrical Engineering" value="'.$college['edutitle'].'">
                    </div>
                    <div class="input-group">
                        <input type="text" name="company" placeholder="LTS Technical School" value="'.$college['company'].'">
                    </div>
                  </div>
                  <textarea name="edudesc" rows="2" placeholder="Write your program description here...">'.$college['edudesc'].'</textarea>
                  <input type="hidden" name="eduID" value="'.$college['eduID'].'">
                  <div class="button-container"> 
                    <button type="submit" class="Save" name="saveEducation">Save</button> 
                    <button type="submit" class="Trash" name="trashEducation">Trash</button>     
                  </div>
                </form>';
              endforeach; ?>
              <!-- Dynamically produce an empty form as well -->
              <form name="education" action="config/createeducation.config.php" method="post">
                <div class="input-container">
                  <div class="input-group">
                      <input type="text" name="from" placeholder="1956-02-01">
                  </div>
                  <div class="input-group">
                      <input type="text" name="until" placeholder="1956-02-01">
                  </div>
                  <div class="input-group">
                      <input type="text" name="program" placeholder="Electrical Engineering">
                  </div>
                  <div class="input-group">
                      <input type="text" name="company" placeholder="LTS Technical School">
                  </div>
                </div>
                <textarea name="workdesc" rows="2" placeholder="Write your program description here..."></textarea>
                <div class="button-container">
                  <button type="submit" class="Add" name="addEducation">Add</button>
                </div>
              </form>
            <?php } else {
              echo '<form name="education" action="config/createeducation.config.php" method="post">
                <div class="input-container">
                  <div class="input-group">
                      <input type="text" name="from" placeholder="1956-02-01">
                  </div>
                  <div class="input-group">
                      <input type="text" name="until" placeholder="1956-02-01">
                  </div>
                  <div class="input-group">
                      <input type="text" name="program" placeholder="Electrical Engineering">
                  </div>
                  <div class="input-group">
                      <input type="text" name="company" placeholder="LTS Technical School">
                  </div>
                </div>
                <textarea name="workdesc" rows="2" placeholder="Write your program description here..."></textarea>
                <div class="button-container">
                  <button type="submit" class="Add" name="addEducation">Add</button>
                </div>
              </form>'; 
            } ?>
          </div>

        <!-- Technical Skills Tab -->
        <input class="check" type="checkbox" id="collapse-head5">
        <label for="collapse-head5">Skills</label>
        <div class="collapse-text" id="field5">        
            <!-- Languages, Technical Skills, Interests -->
            <p class="error-skill-tab"></p>
            <div class="label-container">
              <div class="label-group">
                <label for="technical">Technical Skill</label>
                <label for="language">Languages</label>
                <label for="interest">Interests</label>
              </div>
            </div>
            
              <?php if (isset($userID) && !empty($data['technical']) && !empty($data['languages']) && !empty($data['interests'])) { ?>
                <form name="skills" action="config/createskills.config.php" method="post">
                  <div class="input-container">
                    <?php foreach ($data['technical'] as $technical):
                      echo '
                        <input type="hidden" name="tech_id" value="'.$technical['techID'].'">
                        <div class="input-group">
                          <input type="text" name="technical" placeholder="Analyzing data" value="'.$technical['techtitle'].'">
                        </div>
                      '; 
                    endforeach; ?>
                    <?php foreach ($data['languages'] as $lang):
                      echo'
                        <input type="hidden" name="lang_id" value="'.$lang['langID'].'">
                        <div class="input-group">
                          <input type="text" name="language" placeholder="Maghrebi Arabic" value="'.$lang['language'].'">
                        </div>
                      ';
                    endforeach; ?>
                    <?php foreach ($data['interests'] as $hobby):
                      echo'
                        <input type="hidden" name="interest_id" value="'.$hobby['interestID'].'">
                        <div class="input-group">
                          <input type="text" name="interest" placeholder="Maghrebi Arabic" value="'.$hobby['interest'].'">
                        </div>
                      ';             
                    endforeach; ?>
                  </div>
                  <div class="button-container"> 
                    <button type="submit" class="Save" name="saveSkill">Save</button> 
                    <button type="submit" class="Trash" name="trashSkill">Trash</button>     
                  </div>

                  <div class="input-container">
                    <div class="input-group">
                      <input type="text" name="technical" placeholder="Analyzing data">
                    </div>
                    <div class="input-group">
                      <input type="text" name="language" placeholder="Maghrebi Arabic">
                    </div>                     
                    <div class="input-group">
                      <input type="text" name="interest" placeholder="Checking out women">
                    </div>
                  </div>
                  <div class="button-container"> 
                    <button type="submit" class="Add" name="addSkill">Add</button>     
                  </div>
                </form>
              <?php } else {
                echo'<form name="skills" action="config/createskills.config.php" method="post">
                  <div class="input-container">
                    <div class="input-group">
                      <input type="text" name="technical" placeholder="Analyzing data">
                    </div>
                    <div class="input-group">
                      <input type="text" name="language" placeholder="Maghrebi Arabic">
                    </div>                     
                    <div class="input-group">
                      <input type="text" name="interest" placeholder="Checking out women">
                    </div>
                  </div>
                  <div class="button-container"> 
                    <button type="submit" class="Add" name="addSkill">Add</button>     
                  </div>
                </form>';
              } ?>
          </form>
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
            <option value="">(None selected)</option><!-- the value="" is needed for javascript -->
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