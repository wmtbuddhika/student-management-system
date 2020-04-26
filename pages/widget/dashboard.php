<?php
$userType = $_SESSION['user_type'];

    if($userType == 1) {
        require_once('pages/widget/admin.php');
    } else {
        require_once('pages/widget/student.php');
    }
