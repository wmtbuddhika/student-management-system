<?php 
	
	require_once('main_db.php');
	session_start();

	$enter_by = $_SESSION['user_id'];
	
	$tutor = $_REQUEST['tutor'];
	$module = $_REQUEST['batch'];
	$code = $_REQUEST['code'];
	
	$result_array = array();
	$message = "";

	if((!empty($batch) || $batch != null) || (!empty($tutor) || $tutor != null)){

        $main_tutor_query = "INSERT INTO allocation (tutor_id,module_id,entered_by,status,code)
                VALUES ('$tutor','$module','$enter_by',1,$code)";

		$query_execute = mysqli_query($con, $main_tutor_query);
		
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