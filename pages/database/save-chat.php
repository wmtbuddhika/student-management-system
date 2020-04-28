<?php 
	
	require_once('main_db.php');
	session_start();

	$enteredBy = $_SESSION['user_id'];

	$chatId = $_REQUEST['chat_id'];
	if ($chatId == null) {
        $allocationId = $_REQUEST['allocation_id'];
    }
	$chatMessage = $_REQUEST['message'];

	$result_array = array();
	$message = "";

	if((!empty($chatMessage) || $chatMessage != null)){

	    if ($chatId != null) {
            $query = "UPDATE message SET message = '$chatMessage' WHERE id = $chatId";
        } else {
            $query = "INSERT INTO message (message,user_id,allocation_id,status) VALUES ('$chatMessage','$enteredBy','$allocationId',1)";
        }

        $query_execute = mysqli_query($con, $query);

        if($query_execute){
            $message = "success";
        } else {
            $message = "error";
        }

	} else {
		$message = "empty";
	}

	mysqli_close($con);

	$result_array['message'] = $message;
	echo (json_encode($result_array));
