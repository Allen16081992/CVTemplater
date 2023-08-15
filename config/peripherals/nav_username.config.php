<?php // Dhr. Allen Pieter
    if(isset($_SESSION['user_id'])) {
        echo '<a class="current">'.htmlspecialchars($_SESSION['user_name']).'</a>';
    } else { echo '<a class="current">MyID</a>'; }