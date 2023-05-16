<?php 
  session_start(); 
  include "config/uniCRUD.config.php";
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
  </head>
  <body>
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
    <!-- Resume Panel -->
    <section class="sidebar">
      <h5>Account Settings</h5>
      <ul>
        <li><a href="client.php"><i class='bx bxs-file'></i>Resume Builder</a></li>
        <li><a><i class='bx bxs-crown'></i>Premium</a></li>
        <li><a><i class='bx bxs-videos'></i>Tutorial</a></li>
        <li class="on"><i class='bx bxs-cog'></i>Account Settings</li>
      </ul>
      <button class="Del" data-window-target="#window">Delete Account</button>
    </section>
    <!-- Mobile Resume Panel -->
    <section class="m-sidebar">
      <ul>
        <li><a href="client.php"><i class='bx bxs-file bx-md'></i></a></li>
        <li><a><i class='bx bxs-crown bx-md'></i></a></li>
        <li><a><i class='bx bxs-videos bx-md'></i></a></li>
        <li><a data-window-target="#window"><i class='bx bx-x-circle bx-md'></i></a></li>
      </ul>
    </section>
    <!-- Main Content -->
    <main class="container">
      <div class="collapse">
        <input class="check" type="checkbox" id="collapse-head1">
        <label for="collapse-head1">Account Info</label>       
        <div class="collapse-text" id="field1">
          <p>You can easily edit your Information by clicking on your credentials</p>
          <form action="">
            <div class="left">
              <label for="username">Username</label>
              <input type="text" name="username" id="1" placeholder="Username">
            </div>
            <div class="left">
              <label for="pwd">Password</label>
              <input type="password" name="pwd" id="2" placeholder="Password">
            </div>
            <div class="left">
              <label for="email">Email</label>
              <input type="text" name="email" id="3" placeholder="Email Address">
            </div>
            <div class="left">
              <label for="pwd">Repeat Password</label>
              <input type="password" name="pwdR" id="4" placeholder="Password">
            </div>
            <div class="left">   
              <button type="submit" name="submit">Save Changes</button>       
            </div>
          </form>
          <button class="alt" onclick="ClearAccFields();">Clear</button>
        </div>

        <input class="check" type="checkbox" id="collapse-head2">
        <label for="collapse-head2">Address Book</label>
        <div class="collapse-text" id="field2">
          <p>You can easily clear your credentials by clicking our Clear button</p>
          <form action="">
            <div class="left">
              <label for="streetname">Address</label>
              <input type="text" name="streetname" id="5" placeholder="Streetname">  
            </div>
            <div class="left"> 
              <label for="postalcode">Zip code</label>
              <input type="text" name="postalcode" id="6" placeholder="Postalcode">             
            </div> 
            <div class="left"> 
              <label for="city">City</label>
              <input type="text" name="city" id="7" placeholder="City">          
            </div> 
            <div class="left"> 
              <label for="nationality">Country</label>
              <input type="text" name="nationality" id="8" placeholder="Country or Nationality">    
            </div> 
            <div class="left">   
              <button type="submit" name="submit">Save Changes</button>       
            </div> 
          </form>
          <button class="alt" onclick="ClearAddrFields();">Clear</button>
        </div>

        <input class="check" type="checkbox" id="collapse-head3">
        <label for="collapse-head3">Personal Info</label>
        <div class="collapse-text" id="field3">
          <p>You can even use our App on your mobile device, how convenient is that?</p>
          <form action="">
            <div class="left">
              <label for="firstname">First name</label>
              <input type="text" name="firstname" id="9" placeholder="Firstname">
            </div>
            <div class="left">
              <label for="lastname">Last name</label>
              <input type="text" name="lastname" id="10" placeholder="Firstname">
            </div>
            <div class="left">
              <label for="phone">Mobile Number</label>
              <input type="text" name="phone" id="11" placeholder="Mobile Number"> 
            </div>
            <div class="left"> 
              <label for="birth">Date of Birth</label>
              <input type="text" name="birth" id="12" placeholder="Example: 1956-06-18">           
            </div> 
            <div class="left">   
              <button type="submit" name="submit">Save Changes</button>       
            </div> 
          </form>
          <button class="alt" onclick="ClearPersFields();">Clear</button>
        </div>
      </div>
      <!--<div class="dashboard">
        <form class="window-body" id="sheet" method="post">
          <div class="nest">
            <span>Personal Information</span>
            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" placeholder="Firstname">
            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" placeholder="Lastname">
          </div>
          <div class="nest">
            <span>Account Information</span>
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username">
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="Email Address">
          </div>
          <div class="nest">
            <label for="nationality">Nationality</label>
            <input type="text" name="nationality" placeholder="Nationality">
            <label for="birth">Date of Birth</label>
            <input type="date" name="birth" placeholder="Birthday">
          </div>
          <div class="nest">
            <label for="pwd">Password</label>
            <input type="password" name="pwd" placeholder="Password">
            <label for="pwd">Repeat your Password</label>
            <input type="password" name="pwdR" placeholder="Password">
          </div>
          <div class="nest">
            <label for="streetname">Street</label>
            <input type="text" name="streetname" placeholder="Streetname">
            <label for="city">Town / City</label>
            <input type="text" name="city" placeholder="Hometown or City">
          </div>
          <div class="nest">
            <label for="postalcode">Postalcode</label>
            <input type="text" name="postalcode" placeholder="Postalcode">
            <label for="phone">Mobile Number</label>
            <input type="text" name="phone" placeholder="Mobile Number">
          </div>
          <button type="submit" name="submit">Save Changes</button>
        </form>
      </div>-->

      <div class="window" id="window">
        <div class="window-title">
          <div class="title">We hate to see you leave...</div>
          <button data-window-close class="close-button">&#215;</button>
        </div>
        <form class="window-body" action="config/logout.config.php" method="post">
          <ul id='form-message'>Warning: These changes cannot be undone!<br>Any information will be removed from our servers</ul>
          <label for="cv-name">Do you really want to delete your account?</label>
          <input type="text" name="cv-name" placeholder="Please enter your password for confirmation" required>
          <div class="window-title">
            <button type="submit" class="close-button" type="submit" name="delete">Confirm</button>
          </div>
        </form>
      </div>
      <div id="overlay"></div>
    </main>
  </body>
</html>