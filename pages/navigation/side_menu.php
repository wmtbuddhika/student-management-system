<?php 
    $id = $_SESSION['stud_id'];

    if($id == 1) {
        require_once('pages/navigation/side_menu-admin.php');
    } elseif ($id == 2) {
        require_once('pages/navigation/side_menu-student.php');
    } elseif ($id == 3) {
        require_once('pages/navigation/side_menu-tutor.php');
    }