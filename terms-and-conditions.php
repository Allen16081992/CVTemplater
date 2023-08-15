<!-- Dhr. Allen Pieter -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Templater - Registration</title>
    <!-- Favicon -->
    <?php include_once 'config/peripherals/favicon.config.php';?>
    <!-- Boxicons - Only used for Hamburger Icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Styling Sheets -->
    <link rel="stylesheet" href="css/templater.css">
    <!-- Javascript -->
    <?php require_once 'config/peripherals/javascript_load.config.php'; ?>
    <script defer src="javascript/form.rotate.js"></script>
  </head>
  <body>
    <header id="nav-signup">
      <img class="logo" src="img/CV-headed-eagle.png" alt="Brand Signature">
      <i class='bx bx-menu' id="menu-icon"></i>
      <nav>
        <a href="index.php">Home</a>
        <a class="current">Terms</a>
      </nav>
    </header>
    <main class="container">
      <div class="terms" id="slide-window">
        <div class="window-title">
          <h4>Terms & Conditions</h4>
        </div>
        <div class="window-terms">
          <p>This page contains the terms and conditions on which we make available the service (CV Templater) and (MyResume) to you.</p>
          <p>Please read the following paragraphs carefully before you start using the service.</p><br>
          <strong>User Consent</strong>
          <p>By using our webApp and Service, you are consenting to the collection, processing and storing of any personal information you have provided us with.</p><br>
          <strong>User Accounts</strong>
          <p>In order to use the Service, you must first create a MyResume user account on our webApp by following the signup steps.</p>
          <p>To access and view content, you must have internet access and be at least 14 years of age. 
             If you are under 14 years (or not old enough to give your legal consent to use our service at your location), 
             you must first have obtained the consent of your parents or legal guardian to sign up for an Account and use the Service.</p><br>
          <strong>Personal Information</strong>
          <p>We require your full name, nationality, date of birth, phone number, street, zip code, city and your email address.
             We collect, hold and process this information to enable our Service to you.</p>
          <p>Your information will be collected and stored until you decide to delete your Account, in which case, everything you have provided us with so far will be erased from our servers. This includes all details related to your account, personal information and any resume you may have created so far.</p><br>
          <strong>Data Processing</strong>
          <p>Your information will be processed when you sign up, login and update your resume or account settings, in which case, the data will be subjected to our validation and sanitization systems before being safely stored on our servers.</p>
          <p>We do NOT share your information to any third-party services and will never share any data to others. This is because our webApp lacks any third-party services, API's or Cookie-related technologies.</p>
          <p>We do NOT use any Cookie-related technologies.<br>We do NOT use any third-party services.</p><br>
          <strong>Data Deletion</strong>
          <p>If you decide to terminate your Account, you may do so by logging in and heading over to the Account Settings tab. Here you will find an option to delete your account, including any details you had provided us with so far. By using the red button and entering your password, your information will be erased from our servers.</p>
        </div>
      </div>
    </main>
  </body>
</html>