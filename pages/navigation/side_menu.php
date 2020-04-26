<?php 
    $userType = $_SESSION['user_type'];

    if($userType == 1) {
        require_once('pages/navigation/side_menu-admin.php');
    } elseif ($userType == 2) {
        require_once('pages/navigation/side_menu-student.php');
    } elseif ($userType == 3) {
        require_once('pages/navigation/side_menu-tutor.php');
    }