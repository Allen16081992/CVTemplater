<!-- Dhr. Allen Pieter -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Templater - Registration</title>
    <!-- Favicon -->
    <?php include 'config/peripherals/favicon.config.php';?>
    <!-- Boxicons - Only used for Hamburger Icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Styling Sheets -->
    <link rel="stylesheet" href="css/templater.css">
    <!-- Javascript -->
    <script defer src="javascript/messages.js"></script>
    <script defer src="javascript/form.rotate.js"></script>
  </head>
  <body>
    <header id="nav-signup">
      <img class="logo" src="img/CV-headed-eagle.png" alt="Brand Signature">
      <i class='bx bx-menu' id="menu-icon"></i>
      <nav>
        <a href="index.php">Home</a>
        <a class="current">Signup</a>
      </nav>
    </header>
    <main class="container">
      <div class="window" id="slide-window">
        <div class="window-title">
          <h4>Registration</h4>
          <button class="close-button alt" onclick="location.href='index.php';">Login</button>
        </div>
        <form class="window-body" id="rotateForm" action="config/signup.config.php" method="post" autocomplete="off">
          <div style="text-align:center;margin-top:40px; cursor:default;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
          </div>
          <div class="tab">
            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" placeholder="Firstname">
            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" placeholder="Lastname">
            <span>Already have an account? <a href="index.php">Login</a></span>
          </div>
          <div class="tab">
            <label for="nationality">Nationality</label>
            <input type="text" name="nationality" placeholder="Nationality">
            <label for="birthday">Date of Birth</label>
            <!--<input type="date" name="birth" placeholder="Birthday">-->
            <select name="day" id="birthday">
                <option selected>--</option>
                <?php
                    for ($day = 1; $day <= 31; $day++) {
                        echo '<option value="'.$day.'">'.$day.'</option>';
                    }
                ?>
            </select>
            <select name="month" id="birthday">
                <option selected>-</option>
                <?php
                    for ($month = 1; $month <= 12; $month++) {
                        echo '<option value="'.$month.'">'.$month.'</option>';
                    }
                ?>
            </select>
            <select name="year" id="year-select">
              <option selected>----</option>
              <?php
                $currentYear = date('Y');
                $targetYear = 1908;
                for ($year = $currentYear - 15; $year >= $targetYear; $year--) {
                    echo '<option value="'.$year.'">'.$year.'</option>';
                }
              ?>
            </select>
          </div>
          <div class="tab">
            <label for="phone">Mobile Number</label>
            <input type="text" name="phone" placeholder="Mobile Number">
            <label for="streetname">Streetname</label>
            <input type="text" name="streetname" placeholder="Streetname">
          </div>
          <div class="tab">
            <label for="postalcode">Postalcode</label>
            <input type="text" name="postalcode" placeholder="Postalcode">
            <label for="city">City</label>
            <input type="text" name="city" placeholder="City">
          </div>
          <div class="tab">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username">
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="Email Address">
          </div>
          <div class="tab">
            <label for="pwd">Password</label>
            <input type="password" name="pwd" placeholder="Password">
            <label for="pwd">Repeat your Password</label>
            <input type="password" name="pwdR" placeholder="Password">
            <label for="terms"></label>
            <span><input type="checkbox" title="terms" name="terms" id="terms" required> I agree to the <a href="#" target="_blank">terms</a> & conditions</span>
          </div>
          <div class="rotator">
            <button type="submit" id="prevBtn" onclick="nextPrev(-1)">Back</button>
            <button type="submit" id="nextBtn" onclick="nextPrev(1)">Next</button>
          </div>
        </form>
      </div>
    </main>
  </body>
</html>