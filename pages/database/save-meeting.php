<?php 
	
	require_once('main_db.php');
	session_start();

	echo $enter_by = $_SESSION['user_id'];

	$groupId = $_REQUEST['group'];
	$meeting_id = $_REQUEST['meeting_id'];
	$meeting_topic = $_REQUEST['meeting_topic'];
	$dom = $_REQUEST['dom'];
	$tom = $_REQUEST['tom'];
	$meeting_message = $_REQUEST['meeting_message'];
	$status = $_REQUEST['status'];

	if(!empty($enter_by) || $enter_by != NULL){

        if($meeting_id > 0){
            $query = "UPDATE meeting SET schedule_date = '$dom',schedule_time = '$tom',comment = '$meeting_message',allocation_id = '$groupId',
                        title = '$meeting_topic',status = '$status',entered_by = '$enter_by' WHERE id = $meeting_id";
            $query_execute = mysqli_query($con, $query);
        } else {
            $query = "INSERT INTO meeting (schedule_date,schedule_time,comment,allocation_id,title,status,entered_by)
			VALUES ('$dom','$tom','$meeting_message','$groupId','$meeting_topic','$status','$enter_by')";

            $query_execute = mysqli_query($con, $query);

            if($query_execute){
                $message = "success";
            } else {
                $message = "error";
            }
        }

    } else {
        $message = "empty";
    }

mysqli_close($con);

$result_array['message'] = $message;
echo (json_encode($result_array));