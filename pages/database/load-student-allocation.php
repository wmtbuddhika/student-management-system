<?php header('Content-Type: application/json');

require_once('main_db.php');

$allocationId = $_REQUEST['allocation_id'];
$comments = array();

if((!empty($allocationId) && $allocationId != NULL)) {

    $query = "SELECT ag.code, a.id allocation_id, ag.id, GROUP_CONCAT(a.student_id) student_ids , GROUP_CONCAT(u.name) students 
                FROM allocation a, allocation_group ag, user u WHERE a.student_id = u.id AND a.allocation_group_id = ag.id 
                AND a.id = $allocationId";
    $execute = mysqli_query($con, $query);
    while($comment = mysqli_fetch_assoc($execute)){
        array_push($comments, $comment);
    }
}

mysqli_close($con);
$response['allocation'] = $comments;
echo json_encode($response);
