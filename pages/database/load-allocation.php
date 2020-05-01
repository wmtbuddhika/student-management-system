<?php header('Content-Type: application/json');

require_once('main_db.php');

$allocationId = $_REQUEST['allocation_id'];
$comments = array();

if((!empty($allocationId) && $allocationId != NULL)) {

    $query = "SELECT code,name,batch_id,module_id,tutor_id,status FROM allocation_group WHERE id = $allocationId";
    $execute = mysqli_query($con, $query);
    while($comment = mysqli_fetch_assoc($execute)){
        array_push($comments, $comment);
    }
}

mysqli_close($con);
$response['allocation'] = $comments;
echo json_encode($response);
