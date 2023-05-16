<?php 
  session_start(); 
 
  //$data = $this->connect()->prepare('SELECT resumeID FROM resume WHERE resumetitle = ?;');
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
      <h4>Resume Builder</h4>
      <button class="New" data-window-target="#window">New Resume</button>
      <button data-window-target="#window2">Delete Resume</button>
      <?php
        $pdo =  new PDO("mysql:host=localhost;dbname=curriculumdb;charset=utf8mb4", "root", "");
        $sql = "SELECT resumetitle FROM resume";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
          echo "<a>".$row["resumetitle"]."</a>";
        }
        $pdo = null;     
      ?>     
      <ul>
        <li class="on"><i class='bx bxs-file'></i>Resume Builder</li>
        <li><a><i class='bx bxs-crown'></i>Premium</a></li>
        <li><a><i class='bx bxs-videos'></i>Tutorial</a></li>
        <li><a href="account.php"><i class='bx bxs-cog'></i>Account Settings</a></li>
      </ul>
    </section>
    <!-- Mobile Resume Panel -->
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
      <div class="window" id="window">
        <div class="window-title">
          <div class="title">Your new resume</div>
          <button data-window-close class="close-button">&#215;</button>
        </div>
        <form class="window-body" action="config/login.config.php" method="post">
          <label for="cv-name">Let's give it a name</label>
          <input type="text" name="cv-name" placeholder="Name your new resume...">
          <button type="submit" name="creResume">Save Resume</button>
        </form>
      </div>

      <div class="window" id="window2">
        <div class="window-title">
          <div class="title">Do you really want to delete one?</div>
          <button data-window-delclose class="close-button">&#215;</button>
        </div>
        <form class="window-body" action="config/uniCRUD.config.php" method="post">
          <label for="cv-name">Select a resume to remove</label>
          <select name="cv-name">
            <option>...</option>
            <option>....</option>
            <option>.....</option>
            <option>......</option>
            <?php foreach($data as $option) { ?>
              <option><?php echo $option; ?></option>
            <?php } ?>
          </select>
          <button class="Del" type="submit" name="delResume">Delete</button>
        </form>
      </div>
      
      <div id="overlay"></div>
    </main>
  </body>
</html>