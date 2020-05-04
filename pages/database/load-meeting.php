<?php

require_once('main_db.php');
session_start();

$enteredBy = $_SESSION['user_id'];

$meetingId = $_REQUEST['meeting_id'];

$meetings = array();

if((!empty($meetingId) || $meetingId != null)){

    $query = "SELECT m.id meeting_id,a.id,a.code,m.title,m.schedule_date,m.schedule_time,m.comment,m.status FROM meeting m,allocation_group a WHERE m.allocation_id = a.id
                AND m.id = ($meetingId)";

    $query_execute = mysqli_query($con, $query);

    while($meeting = mysqli_fetch_assoc($query_execute)){
        array_push($meetings, $meeting);
    }
}
mysqli_close($con);

$response['meetings'] = $meetings;
echo (json_encode($response));
