<?php header('Content-Type: application/json');

require_once('main_db.php');

$meetingId = $_REQUEST['meeting_id'];
$minute = $_REQUEST['minute'];
$userId = $_REQUEST['user_id'];

if((!empty($meetingId) && $meetingId != NULL) && !empty($userId) && $userId != NULL) {

    $query = "INSERT INTO meeting_minute (minute, meeting_id, user_id) VALUES ('$minute', $meetingId, $userId)";
    $query_execute = mysqli_query($con, $query);
}

//Connection Close
mysqli_close($con);

$response['response'] = 'success';

echo json_encode($response);
