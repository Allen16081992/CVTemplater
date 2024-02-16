<?php // Dhr. Allen Pieter
  // Start a session for handling data and error messages.
  require_once 'config/peripherals/session_management.config.php'; 
  redirectUnauthorized(); // Access denied
  sessionRegen(); // Call the periodic session regeneration
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
              <option class="resume-select"><?= htmlspecialchars($resume['resumetitle']); ?></option>
            <?php endforeach; ?> <?php } ?>
          </select>
        </form>
        <li class="on"><i class='bx bxs-file'></i>Resume Builder</li>
        <li><a href="useful_tips.php"><i class='bx bxs-videos'></i>Useful Tips</a></li>
        <li><a href="tutorial.php"><i class='bx bxs-crown'></i>Tutorial</a></li>
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
            <option><?= htmlspecialchars($resume['resumetitle']); ?></option>
          <?php endforeach; ?> <?php } ?>
        </select>
      </form>
    </section>

    <section class="m-sidebar">
      <ul>
        <li><a data-window-target="#window"><i class='bx bx-plus-circle bx-md'></i></a></li>
        <li><a data-window-target="#window2"><i class='bx bx-x-circle bx-md'></i></a></li>
        <li><a class="m-on"><i class='bx bxs-file bx-md'></i></li>
        <li><a href="./useful_tips.php"><i class='bx bxs-videos bx-md'></i></a></li>
        <li><a href="./tutorial.php"><i class='bx bxs-crown bx-md'></i></a></li>
        <li><a href="./account.php"><i class='bx bxs-cog bx-md'></i></a></li>
      </ul>
    </section>

    <!-- Main Content -->
    <main class="container">
      <!-- Resume Builder -->
      <div class="collapse">
      <?php if (isset($resumeID)): ?> 
        <!-- Resume Title Tab -->
        <input class="check" type="checkbox" id="collapse-head1">
        <label for="collapse-head1">Resume Name</label>       
        <div class="collapse-text" id="field1">
          <form name="resume" action="config/updateresume.config.php" method="post"> 
            <p class="error-resume-tab"></p>
            <div class="input-container">
              <div class="input-group">
                <label for="resid">Resume ID</label>
                <input type="text" name="cvid" placeholder="*ID is Protected." disabled>
                <input type="hidden" name="resid" value="<?= isset($resumeID) ? htmlspecialchars($resumeID) : '' ?>">
              </div>                     
              <div class="input-group">
                <label for="cvname">Name</label>
                <input type="text" name="cvname" placeholder="Ex: Professional Dredger" value="<?= isset($_SESSION['resumetitle']) ? htmlspecialchars($_SESSION['resumetitle']) : '' ?>">
              </div>
            </div>
            <div class="left"> 
              <button type="submit" class="Save" name="saveResume">Save</button>
            </div> 
          </form>
          <button data-window-target="#window3" class="alt Dld">Download</button>
        </div>

        <!-- Profile Tab -->
        <input class="check" type="checkbox" id="collapse-head2">
        <label for="collapse-head2">Profile</label>
        <div class="collapse-text" id="field2">
          <p>Edit your profile image</p>
          <!-- id 'profile' is needed to target buttons in css -->       
          <form id="profile" name="profile" action="config/profile.config.php" enctype="multipart/form-data" method="post">
            <input type="hidden" name="resumeid" value="<?= isset($resumeID) ? htmlspecialchars($resumeID) : '' ?>">
            <div class="left">
              <?php if (isset($userID) && !empty($data['profile'])) { ?>
                <?php foreach ($data['profile'] as $profile): ?>
                  <!-- Verify if the image is readable -->
                  <?php $filePath = "img/avatars/".$profile['fileName'];
                    if (!empty($profile['fileName'])) {
                        echo 'File is readable.';
                    } 
                  ?>
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
                  <input type="text" name="intro" placeholder="Write a short introduction" value="<?= htmlspecialchars($profile['profileintro']); ?>">
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
            <button type="submit" class="Save" name="saveProfile">Save</button> 
            <button type="submit" class="Trash" name="trashProfile">Trash</button>   
          </form> 
        </div>

        <!-- Work Experience Tab -->
        <input class="check" type="checkbox" id="collapse-head3">
        <label for="collapse-head3">Work Experience</label>
        <div class="collapse-text" id="field3">
          <p class="error-work-tab"></p>
          <?php if (isset($userID) && !empty($data['experience'])) { ?>
            <?php foreach ($data['experience'] as $experience): 
              // Split the firstDate into day, month, and year
              list($work_first_day, $work_first_month, $work_first_year) = explode('/', $experience['firstDate']);
              list($work_last_day, $work_last_month, $work_last_year) = explode('/', $experience['lastDate']);       
            ?>
              <form name="experience" action="config/experience.config.php" method="post">
                <div class="input-container">
                  <div class="input-group">
                      <label for="from">From</label>
                      <?php require 'config/peripherals/date_select/work_date_select_1.config.php'; ?>
                  </div>
                  <div class="input-group">
                      <label for="until">Until</label>
                      <?php require 'config/peripherals/date_select/work_date_select_2.config.php'; ?>
                  </div>
                  <div class="input-group">
                      <label for="profession">Profession</label>
                      <input type="text" name="profession" placeholder="Profession" value="<?= htmlspecialchars($experience['worktitle']); ?>">
                  </div>
                  <div class="input-group">
                      <label for="company">Company</label>
                      <input type="text" name="company" placeholder="Company" value="<?= htmlspecialchars($experience['company']); ?>">
                  </div>
                </div>
                <textarea name="workdesc" rows="2" placeholder="Write your job description here..."><?= htmlspecialchars($experience['workdesc']); ?></textarea>
                <input type="hidden" name="workID" value="<?= $experience['workID']; ?>">
                <div class="button-container"> 
                  <button type="submit" class="Save" name="saveExperience">Save</button> 
                  <button type="submit" class="Trash" name="trashExperience">Trash</button>     
                </div>
              </form>
            <?php endforeach; ?> 
            <!-- Dynamically produce an empty form as well -->
            <form name="experience" action="config/experience.config.php" method="post">
              <div class="input-container">
                <div class="input-group">
                  <label for="from">From</label>
                  <?php require 'config/peripherals/date_select/empty_date_select_1.config.php'; ?>
                </div>
                <div class="input-group">
                  <label for="until">Until</label>
                  <?php require 'config/peripherals/date_select/empty_date_select_2.config.php'; ?>
                </div>
                <div class="input-group">
                  <label for="profession">Profession</label>
                  <input type="text" name="profession" placeholder="Profession">
                </div>
                <div class="input-group">
                  <label for="company">Company</label>
                  <input type="text" name="company" placeholder="Company">
                </div>
              </div>
              <textarea name="workdesc" rows="2" placeholder="Write your job description here..."></textarea>
              <div class="button-container">
                <button type="submit" class="Add" name="addExperience">Add</button>
              </div>
            </form>               
          <?php } else { ?>
            <form name="experience" action="config/experience.config.php" method="post">
              <div class="input-container">
                <div class="input-group">
                  <label for="from">From</label>
                  <?php require 'config/peripherals/date_select/empty_date_select_1.config.php'; ?>
                </div>
                <div class="input-group">
                  <label for="until">Until</label>
                  <?php require 'config/peripherals/date_select/empty_date_select_2.config.php'; ?>
                </div>
                <div class="input-group">
                  <label for="profession">Profession</label>
                  <input type="text" name="profession" placeholder="Profession">
                </div>
                <div class="input-group">
                  <label for="company">Company</label>
                  <input type="text" name="company" placeholder="Company">
                </div>
              </div>
              <textarea name="workdesc" rows="2" placeholder="Write your job description here..."></textarea>
              <div class="button-container">
                <button type="submit" class="Add" name="addExperience">Add</button>
              </div>
            </form>
          <?php } ?>
        </div>

        <!-- Education Tab -->
        <input class="check" type="checkbox" id="collapse-head4">
        <label for="collapse-head4">Education</label>
        <div class="collapse-text" id="field4">
          <p class="error-education-tab"></p>
          <?php if (isset($userID) && !empty($data['education'])) { ?>
            <?php foreach ($data['education'] as $college): 
              // Split the firstDate into day, month, and year
              list($edu_first_day, $edu_first_month, $edu_first_year) = explode('/', $college['firstDate']);
              list($edu_last_day, $edu_last_month, $edu_last_year) = explode('/', $college['lastDate']);
            ?>
              <form name="education" action="config/education.config.php" method="post">
                <div class="input-container">
                  <div class="input-group">
                    <label for="from">From</label>
                    <?php require 'config/peripherals/date_select/edu_date_select_1.config.php'; ?>
                  </div>
                  <div class="input-group">
                    <label for="until">Until</label>
                    <?php require 'config/peripherals/date_select/edu_date_select_2.config.php'; ?>
                  </div>
                  <div class="input-group">
                    <label for="edutitle">Program</label>
                    <input type="text" name="program" placeholder="Electrical Engineering" value="<?= htmlspecialchars($college['edutitle']); ?>">
                  </div>
                  <div class="input-group">
                    <label for="company">Institution</label>
                    <input type="text" name="company" placeholder="LTS Technical School" value="<?= htmlspecialchars($college['company']); ?>">
                  </div>
                </div>
                <textarea name="edudesc" rows="2" placeholder="Write your program description here..."><?= htmlspecialchars($college['edudesc']); ?></textarea>
                <input type="hidden" name="eduID" value="<?= $college['eduID']; ?>">
                <div class="button-container"> 
                  <button type="submit" class="Save" name="saveEducation">Save</button> 
                  <button type="submit" class="Trash" name="trashEducation">Trash</button>     
                </div>
              </form>
            <?php endforeach; ?>
            <!-- Dynamically produce an empty form as well -->
            <form name="education" action="config/education.config.php" method="post">
              <div class="input-container">
                <div class="input-group">
                  <label for="from">From</label>
                  <?php require 'config/peripherals/date_select/empty_date_select_1.config.php'; ?>
                </div>
                <div class="input-group">
                  <label for="until">Until</label>
                  <?php require 'config/peripherals/date_select/empty_date_select_2.config.php'; ?>
                </div>
                <div class="input-group">
                  <label for="edutitle">Program</label>
                  <input type="text" name="program" placeholder="Electrical Engineering">
                </div>
                <div class="input-group">
                  <label for="company">Institution</label>
                  <input type="text" name="company" placeholder="LTS Technical School">
                </div>
              </div>
              <textarea name="edudesc" rows="2" placeholder="Write your program description here..."></textarea>
              <div class="button-container">
                <button type="submit" class="Add" name="addEducation">Add</button>
              </div>
            </form>
          <?php } else { ?>
            <form name="education" action="config/education.config.php" method="post">
              <div class="input-container">
                <div class="input-group">
                  <label for="from">From</label>
                  <?php require 'config/peripherals/date_select/empty_date_select_1.config.php'; ?>
                </div>
                <div class="input-group">
                  <label for="until">Until</label>
                  <?php require 'config/peripherals/date_select/empty_date_select_2.config.php'; ?>
                </div>
                <div class="input-group">
                  <label for="edutitle">Program</label>
                  <input type="text" name="program" placeholder="Electrical Engineering">
                </div>
                <div class="input-group">
                  <label for="company">Institution</label>
                  <input type="text" name="company" placeholder="LTS Technical School">
                </div>
              </div>
              <textarea name="edudesc" rows="2" placeholder="Write your program description here..."></textarea>
              <div class="button-container">
                <button type="submit" class="Add" name="addEducation">Add</button>
              </div>
            </form>
          <?php } ?>
        </div>

        <!-- Technical Skills Tab -->
        <input class="check" type="checkbox" id="collapse-head5">
        <label for="collapse-head5">Technical Skills</label>
        <div class="collapse-text" id="field5">
            <p class="error-education-tab"></p>
            <?php if (isset($userID) && !empty($data['techskills'])) { ?>
              <form name="skills" action="config/technical.skills.config.php" method="post">
                <?php foreach ($data['techskills'] as $skill): ?>
                  <?php if (isset($skill['techtitle'])): ?>
                    <div class="input-group">
                      <label for="technical">Hard Skills</label>
                      <input type="text" name="technical" placeholder="Office 365" value="<?= htmlspecialchars($skill['techtitle']); ?>">
                    </div>
                  <?php endif; ?>
                  <?php if (isset($skill['language'])): ?>
                    <div class="input-group">
                      <label for="language">Languages</label>
                      <input type="text" name="language" placeholder="Maghrebi Arabic" value="<?= htmlspecialchars($skill['language']); ?>">
                    </div>
                  <?php endif; ?>
                  <?php if (isset($skill['interest'])): ?>
                    <div class="input-group">
                      <label for="interest">Interests</label>
                      <input type="text" name="interest" placeholder="Photography" value="<?= htmlspecialchars($skill['interest']); ?>">
                    </div>
                  <?php endif; ?>
                  <input type="hidden" name="techID" value="<?= $skill['techID'] ?? ''; ?>"> 
                  <input type="hidden" name="langID" value="<?= $skill['langID'] ?? ''; ?>">  
                  <input type="hidden" name="interestID" value="<?= $skill['interestID'] ?? ''; ?>"> 
                <?php endforeach; ?>
                <div class="button-container"> 
                  <button type="submit" class="Save" name="saveSkill">Save</button> 
                  <button type="submit" class="Trash" name="trashSkill">Trash</button>     
                </div>
              </form>
              <!-- Dynamically produce an empty form as well -->
              <form name="skills" action="config/technical.skills.config.php" method="post">
                <div class="input-container">
                  <div class="input-group">
                    <label for="technical">Hard Skills</label>
                    <input type="text" name="technical" placeholder="Office 365">
                  </div>
                  <div class="input-group">
                    <label for="language">Languages</label>
                    <input type="text" name="language" placeholder="Maghrebi Arabic">
                  </div>
                  <div class="input-group">
                    <label for="interest">Interests</label>
                    <input type="text" name="interest" placeholder="Photography">
                  </div>
                </div>
                <div class="button-container"> 
                  <button type="submit" class="Add" name="addSkill">Add</button>      
                </div>
              </form>
            <?php } else { ?>
              <form name="skills" action="config/technical.skills.config.php" method="post">
                <div class="input-container">
                  <div class="input-group">
                    <label for="technical">Hard Skills</label>
                    <input type="text" name="technical" placeholder="Office 365">
                  </div>
                  <div class="input-group">
                    <label for="language">Languages</label>
                    <input type="text" name="language" placeholder="Maghrebi Arabic">
                  </div>
                  <div class="input-group">
                    <label for="interest">Interests</label>
                    <input type="text" name="interest" placeholder="Photography">
                  </div>
                </div>
                <div class="button-container"> 
                  <button type="submit" class="Add" name="addSkill">Add</button>      
                </div>
              </form>
            <?php } ?>
        </div>

        <!-- Motivation Tab -->
        <input class="check" type="checkbox" id="collapse-head6">
        <label for="collapse-head6">Motivation</label>       
        <div class="collapse-text last" id="field6">
          <form name="motivation" action="config/motivation.config.php" method="post"> 
            <p class="error-motivation-tab"></p>        
            <label for="letter">Letter</label>
            <?php if (isset($userID) && !empty($data['motivation'])) { ?>
              <textarea name="letter" rows="4" placeholder="Write your summary"><?= htmlspecialchars($data['motivation'][0]['letter']); ?></textarea>
              <input type="hidden" name="motID" value="<?= $data['motivation'][0]['motID'] ?? ''; ?>"> 
              <div class="button-container"> 
                <button type="submit" class="Save" name="saveMotivation">Save</button>
                <button type="submit" class="Trash" name="trashMotivation">Trash</button> 
              </div> 
            <?php } else { ?>
              <textarea name="letter" rows="4" placeholder="Write your summary"></textarea>
              <div class="button-container"> 
                <button type="submit" class="Save" name="saveMotivation">Save</button> 
              </div> 
            <?php } ?> 
          </form>
        </div>
      <?php endif; ?>
      </div>

      <!-- Create New Resume Window -->
      <div class="window" id="window">
        <div class="window-title">
          <div class="title">Your New Resume</div>
          <button data-window-close class="close-button">&#215;</button>
        </div>
        <form class="window-body" action="config/createresume.config.php" method="post">
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
        <form class="window-body" action="config/delete.resume.config.php" method="post">
          <p class="error-select"></p>
          <p>Do you really want to delete your resume?</p>
          <label for="selectCv">Select a resume to remove</label>
          <select name="selectCv">
            <option value="">(None selected)</option><!-- the value="" is needed for javascript -->
            <?php if (!empty($resumeData)) { ?>
            <?php foreach ($resumeData as $resume): ?>
              <option><?php echo htmlspecialchars($resume['resumetitle']); ?></option>
            <?php endforeach; ?> <?php } ?>
          </select>
          <button class="Del" type="submit" name="delResume">Delete</button>
        </form>
      </div>

      <!-- Download Resume Window -->
      <div class="window" id="window3">
        <div class="window-title">
          <div class="title">Download Resume</div>
          <button data-window-close class="close-button">&#215;</button>
        </div>
        <div class="window-body">
          <p>Which Template would you like?</p>
          <div id="PDF">
            <form action="config/download.config.php" target="_blank" method="post">
              <button type="submit" class="alt" name="default">Default</button>
            </form>
            <form action="config/download2.config.php" target="_blank" method="post">
              <button type="submit" name="business">Business</button>
            </form>
          </div>
        </div>
      </div>

      <!-- When any Window opens, darken the background -->
      <div id="overlay"></div>
    </main>
  </body>
</html>