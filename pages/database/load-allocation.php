<?php header('Content-Type: application/json');

require_once('main_db.php');

$allocationId = $_REQUEST['allocation_id'];
$comments = array();

if((!empty($allocationId) && $allocationId != NULL)) {

    $query = "SELECT ag.id, ag.code, ag.name, b.id batch_id, b.name batch_name, m.id module_id, m.name module_name, u.id tutor_id, u.name tutor_name, ag.status 
                FROM allocation_group ag, batch b, user u, module m WHERE ag.module_id = m.id AND ag.tutor_id = u.id AND ag.batch_id = b.id AND ag.id = $allocationId";
    $execute = mysqli_query($con, $query);
    while($comment = mysqli_fetch_assoc($execute)){
        array_push($comments, $comment);
    }
}

mysqli_close($con);
$response['allocation'] = $comments;
echo json_encode($response);
