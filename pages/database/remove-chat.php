<?php 
	
	require_once('main_db.php');
	session_start();

	$chatId = $_REQUEST['chat_id'];
	$message = "";

    if ($chatId != null) {
        $query = "UPDATE message SET status = 0 WHERE id = $chatId";
    }

    $query_execute = mysqli_query($con, $query);

    if($query_execute){
        $message = "success";
    } else {
        $message = "error";
    }

	mysqli_close($con);

	$result_array['message'] = $message;
	echo (json_encode($result_array));
