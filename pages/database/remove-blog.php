<?php 
	
	require_once('main_db.php');
	session_start();

	$blogId = $_REQUEST['blog_id'];
	$message = "";

    if ($blogId != null) {
        $query = "UPDATE blog SET status = 0 WHERE id = $blogId";
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
