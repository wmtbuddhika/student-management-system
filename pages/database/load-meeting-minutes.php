<?php header('Content-Type: application/json');

require_once('main_db.php');

$meetingId = $_REQUEST['meeting_id'];
$comments = array();

if((!empty($meetingId) && $meetingId != NULL)) {

    $query = "SELECT m.title, IFNULL(u.name,'-') user_name, IFNULL(mm.minute,'-') minute, IFNULL(mm.created_date,'-') created_date, m.id meeting_id
                FROM meeting m LEFT JOIN meeting_minute mm ON m.id = mm.meeting_id LEFT JOIN user u 
                ON mm.user_id = u.id WHERE m.id = $meetingId";

    $execute = mysqli_query($con, $query);

    while($comment = mysqli_fetch_assoc($execute)){
        array_push($comments, $comment);
    }
}

//Connection Close
mysqli_close($con);

$response['comments'] = $comments;

echo json_encode($response);
