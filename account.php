<?php // Dhr. Allen Pieter
  // Start a session for displaying all user data.
  session_start(); 

  // Include the PHP file that retrieves the data
  include 'config/viewdata.config.php';

  // Create an instance of ViewData
  $viewData = new ViewData();
  $data = $viewData->viewUserInfo();
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
      <h5>Account Settings</h5>
      <ul>
        <li><a href="client.php"><i class='bx bxs-file'></i>Resume Builder</a></li>
        <li><a><i class='bx bxs-crown'></i>Premium</a></li>
        <li><a><i class='bx bxs-videos'></i>Tutorial</a></li>
        <li class="on"><i class='bx bxs-cog'></i>Account Settings</li>
      </ul>
      <?php 
        if (isset($_SESSION['success'])) {
          echo '<div class="success-message">' . $_SESSION['success'] . '</div>';
          unset($_SESSION['success']); // Clear the error message in the session
        }
        if (isset($_SESSION['error'])) {
          echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
          unset($_SESSION['error']); // Clear the error message in the session
        } else {
          // Access the user and contact data from the array
          $user = $data['user'];
          $contact = $data['contact'];
        }
      ?>
      <button class="Del" data-window-target="#window">Delete Account</button>
    </section>

    <!-- (Mobile) Resume Side Panel -->
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

      <!-- Account Settings -->
      <div class="collapse">

        <!-- Account Info Fields -->
        <input class="check" type="checkbox" id="collapse-head1">
        <label for="collapse-head1">Account Info</label>       
        <div class="collapse-text" id="field1">
          <p>You can easily edit your Information by clicking on your credentials</p>
          <form name="account" action="config/update.config.php" method="post">
            <div class="left">
              <label for="username">Username</label>
              <input type="text" name="username" placeholder="Username" value="<?=$user['username'];?>">
            </div>
            <div class="left">
              <label for="pwd">Password</label>
              <input type="password" name="pwd" placeholder="*Password Protected">
            </div>
            <div class="left">
              <label for="email">Email</label>
              <input type="text" name="email" placeholder="Email Address" value="<?=$user['email'];?>">
            </div>
            <div class="left">
              <label for="pwd">Repeat Password</label>
              <input type="password" name="pwdR" placeholder="Password">
            </div>
            <div class="left">   
              <button type="submit" name="saveAccount">Save Changes</button>       
            </div>
          </form>
          <button class="alt" onclick="ClearAccFields();">Clear</button>
        </div>
     

        <!-- Address Info Fields -->
        <input class="check" type="checkbox" id="collapse-head2">
        <label for="collapse-head2">Address Book</label>
        <div class="collapse-text" id="field2">
          <p>You can easily clear your credentials by clicking our Clear button</p>
          <form name="address" action="config/update.config.php" method="post">
            <div class="left">
              <label for="streetname">Address</label>
              <input type="text" name="streetname" placeholder="Streetname" value="<?=$contact['streetname'];?>">  
            </div>
            <div class="left"> 
              <label for="postalcode">Zip code</label>
              <input type="text" name="postalcode" placeholder="Postalcode" value="<?=$contact['postalcode'];?>">             
            </div> 
            <div class="left"> 
              <label for="city">City</label>
              <input type="text" name="city" placeholder="City" value="<?=$contact['city'];?>">          
            </div> 
            <div class="left"> 
              <label for="nationality">Nationality</label>
              <input type="text" name="nationality" placeholder="Country or Nationality" value="<?=$contact['nationality'];?>">    
            </div>
            <div class="left">   
              <button type="submit" name="saveBook">Save Changes</button>       
            </div> 
          </form>
          <button class="alt" onclick="ClearAddrFields();">Clear</button>
        </div>

        <!-- Personal Info Fields -->
        <input class="check" type="checkbox" id="collapse-head3">
        <label for="collapse-head3">Personal Info</label>
        <div class="collapse-text" id="field3">
          <p>You can even use our App on your mobile device, how convenient is that?</p>
          <form name="personal" action="config/update.config.php" method="post">
            <div class="left">
              <label for="firstname">First name</label>
              <input type="text" name="firstname" placeholder="Firstname" value="<?=$contact['firstname'];?>">
            </div>
            <div class="left">
              <label for="lastname">Last name</label>
              <input type="text" name="lastname" placeholder="Lasttname" value="<?=$contact['lastname'];?>">
            </div>
            <div class="left">
              <label for="phone">Mobile Number</label>
              <input type="text" name="phone" placeholder="Mobile Number" value="<?=$contact['phone'];?>"> 
            </div>
            <div class="left"> 
              <label for="birth">Date of Birth</label>
              <input type="text" name="birth" placeholder="Example: 1956-06-18" value="<?=$contact['birth'];?>">           
            </div>
            <div class="left">   
              <button type="submit" name="savePersonal">Save Changes</button>       
            </div> 
          </form>
          <button class="alt" onclick="ClearPersFields();">Clear</button>
        </div>
      </div> 

      <!-- Delete My Account Window -->
      <div class="window" id="window">
        <div class="window-title">
          <div class="title">We hate to see you leave...</div>
          <button data-window-close class="close-button">&#215;</button>
        </div>
        <form class="window-body" name="popup" action="config/Void.config.php" method="post">
          <p class="error-message">Warning: These changes cannot be undone!<br> Any information will be removed from our servers</p>
          <p class="error-uid"></p>
          <p class="error-pwd"></p>
          <label>Do you really want to delete your account?</label>   
          <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">  
          <input type="hidden" name="username" value="<?= $_SESSION['user_name']; ?>" id="user" autocomplete="off">   
          <label for="pwd"></label>
          <input type="password" name="pwd" id="pass" placeholder="Confirm your password for the last time">
          <button type="submit" class="Del" name="delete">Delete Account</button>
        </form>
      </div>

      <!-- When any Window opens, darken the background -->
      <div id="overlay"></div>
    </main>
  </body>
</html>