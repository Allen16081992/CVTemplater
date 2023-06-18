<?php // Dhr. Allen Pieter
    // Start a session for handling data and error messages.
    require_once 'config/peripherals/session_start.config.php'; 

    // Only load the page when signed in.
    require_once 'config/peripherals/redirect.config.php';

    // Include PHP files to retrieve data
    require_once 'config/ViewResumes.config.php';
    require_once 'config/FetchResumeTables.config.php';

    // Include PHP files to retrieve data
    require_once 'config/ViewAccount.config.php';

    // Access the user and contact data from the array
    $user = $data['user'];
    $contact = $data['contact'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CV Templater - Preview</title>
<!-- Favicon -->
<?php include 'config/peripherals/favicon.config.php';?>
<!-- Styling Sheets -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Javascript -->
</head>
<style>
    *{ box-sizing: border-box; }
    body{
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background-color: #ddd;
        align-items: center;
        justify-content: center;
    }
    .container{
        display: flex;
        width: 100%;
        height: 100%;
        padding: 20px 20px;
    }
    .box{
        flex: 20%;
        display: table;
        align-items: center;
        text-align: center;
        font-size: 20px;
        background-color: #0d1425;
        color: #fff;
        padding: 30px 30px;
        border-radius: 20px;
    }
    .box img{
        border-radius: 50%;
        border: 2px solid #fff;
        height: 250px;
        width: 250px;
    }
    .box ul{
        margin-top: 30px;
        font-size: 30px;
        text-align: center;
    }
    .box ul li{
        list-style: none;
        margin-top: 50px;
        font-weight: 100;
    }
    .box ul li i{
        cursor: pointer;
        margin: 10px;
        font-size: 40px;
    }
    .box ul li i:hover{ opacity: 0.6; }
    .About{
        margin-left: 20px;
        flex: 60%;
        display: table;
        padding: 30px 30px;
        font-size: 20px;
        background-color: #fff;
        border-radius: 20px;
    }
    .About h1{
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 50px;
        font-weight: 500;
    }
    .About ul li{ list-style: none; }
    .About ul{ margin-top: 20px; }
    button { margin:5px; cursor:pointer; border: 2px solid blue; background:transparent; padding:24px; transition: background-color 0.2s ease; color:white; border-radius:5px; font-weight:bold; width:100%; }
    button:hover { background:blue; }
    .download:hover { background:grey; }
    @media screen and (max-width: 1068px) {
        .container{ display: table; }
        .box{ width: 100%; }
        .About{
            width: 100%;
            margin: 0;
            margin-top: 20px;
        }
        .About h1{ text-align: center; }
    }
</style>
<body>
    <div class="container">
        <div class="box">
            <?php if (isset($userID) && !empty($data['profile'])) { ?>
            <?php foreach ($data['profile'] as $profile): ?>
            <?php if (!empty($profile['fileName'])) { ?>
                <img src="img/avatars/<?= $profile['fileName']; ?>" alt="">
            <?php } else { ?><img src="img/av-placehold.png" alt=""><?php } ?>
            <?php endforeach; ?>
            <?php } else { ?>
                <img src="img/av-placehold.png" alt="">
            <?php } ?>
            <ul>
                <?php if (!empty($resumeID)) { ?>
                <li><?= isset($contact['firstname']) ? $contact['firstname'] : '';?> <?= isset($contact['lastname']) ? $contact['lastname'] : '';?></li>
                <li><?php $contact['birth']; $dateObj = new DateTime($contact['birth']); $currentDate = new DateTime(); $ageInt = $dateObj->diff($currentDate); $age = $ageInt->y; echo "Age ".$age; ?></li>
                <li><?php if (!empty($data['experience'])) { foreach ($data['experience'] as $experience): echo $experience['worktitle']; endforeach; ?></li>
                <?php } else { ?><li>Hardware Analist</li><?php } ?>
                <?php } else { ?>
                <li>Ezra Al Haq Awress</li>
                <li>24 Years</li>
                <?php } ?>               
                <li><i style="font-size:24px" class="fa"></i>
                    <i style="font-size:24px" class="fa"></i>
                    <i style="font-size:24px" class="fa"></i>
                </li>
            </ul>
            <button class="download" onclick="window.location.href = 'config/preview.config.php'">Download PDF</button>
            <button class="default" onclick="window.location.href = 'client.php'">Return</button>
        </div>
        <div class="About">
            <ul>
                <h1><?= isset($_SESSION['resumetitle']) ? $_SESSION['resumetitle'] : '' ?></h1>
            </ul>
            <ul>
                <h3>Work</h3>
                <li>Analist</li>
            </ul>
            <ul>
                <h3>Gender</h3>
                <li>Female</li>
            </ul>
            <ul>
                <h3>Country</h3>
                <li>The Netherlands</li>
            </ul>
            <ul>
                <h3>More Info</h3>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its
                    layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using
                    'Content here, content here', making it look like readable English. Many desktop publishing packages and web page
                    editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites
                    still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose
                    (injected humour and the like).</p>
            </ul>
            <ul>
                <h3>Contact</h3>
                <li>ezra_el26@yahoo.ru</li>
            </ul>
        </div>
    </div>
</body>
</html>