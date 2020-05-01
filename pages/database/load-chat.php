<?php

require_once('main_db.php');
session_start();

$enteredBy = $_SESSION['user_id'];
$userType = $_SESSION['user_type'];

$allocationId = $_REQUEST['allocation_id'];

$messages = array();

if((!empty($allocationId) || $allocationId != null)){

    $query = "SELECT m.id,m.message,m.created_date,m.user_id,u.name FROM message m,allocation_group ag,user u WHERE m.allocation_id = ag.id
              AND u.id = m.user_id AND m.status = 1 AND ag.status = 1 AND ag.id IN ($allocationId) ";

    if ($userType == 3) {
        $query = $query . "AND (SELECT COUNT(a.id) FROM allocation a WHERE a.student_id = $enteredBy AND a.status = 1 AND a.allocation_group_id = ag.id) > 0";
    }

    $query_execute = mysqli_query($con, $query);

    while($comment = mysqli_fetch_assoc($query_execute)){
        array_push($messages, $comment);
    }
}
mysqli_close($con);

$response['messages'] = $messages;
echo (json_encode($response));
