<?php

require_once('main_db.php');
session_start();

$enteredBy = $_SESSION['user_id'];

$allocationId = $_REQUEST['allocation_id'];

$messages = array();

if((!empty($allocationId) || $allocationId != null)){

    $query = "SELECT m.id,m.message,m.created_date,m.user_id,u.name FROM message m,allocation a,user u WHERE m.allocation_id = a.id
                                            AND u.id = m.user_id AND m.status = 1 AND a.status = 1 AND a.id IN ($allocationId)";

    $query_execute = mysqli_query($con, $query);

    while($comment = mysqli_fetch_assoc($query_execute)){
        array_push($messages, $comment);
    }
}
mysqli_close($con);

$response['messages'] = $messages;
echo (json_encode($response));
