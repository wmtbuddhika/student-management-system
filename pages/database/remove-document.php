<?php 
	
	require_once('main_db.php');
	session_start();

	$documentId = $_REQUEST['document_id'];
	$message = "";

    if ($documentId != null) {
        $query = "UPDATE document SET status = 0 WHERE id = $documentId";
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
