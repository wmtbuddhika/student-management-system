<?php
$userType = $_SESSION['user_type'];

    if($userType == 1) {
        require_once('pages/widget/admin.php');
    } else if($userType == 2) {
        require_once('pages/widget/tutor.php');
    } else if($userType == 3) {
        require_once('pages/widget/student.php');
    }
