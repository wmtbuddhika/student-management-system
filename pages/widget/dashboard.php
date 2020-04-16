<?php 
    $id = $_SESSION['stud_id'];

    if($id == 1) {
        require_once('pages/widget/admin.php');
    } else {
        require_once('pages/widget/student.php');
    }
