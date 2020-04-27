<?php 
	
	require_once('main_db.php');
	session_start();

	$enteredBy = $_SESSION['user_id'];

	$blogData = $_REQUEST['blog_data'];
	$blogTitle = $_REQUEST['blog_title'];
    $allocationId = $_REQUEST['allocation_id'];

	$result_array = array();
	$message = "";

	if((!empty($blogData) || $blogData != null)){

		$query = "SELECT id FROM blog WHERE title = '$blogTitle' AND status = 1 AND allocation_id = $allocationId";

		$result = mysqli_query($con, $query);
		$rows = mysqli_num_rows($result);

		if($rows > 0){
			$message = "exist";
		} else {
			
			$query = "INSERT INTO blog (title,content,allocation_id,entered_by,status)
			VALUES ('$blogTitle','$blogData','$allocationId','$enteredBy',1)";

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
