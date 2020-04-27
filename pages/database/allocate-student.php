<?php 
	
	require_once('main_db.php');
	session_start();

	$enter_by = $_SESSION['user_id'];
	
	$code = $_REQUEST['code'];
	$batch = $_REQUEST['batch'];
	$tutor = $_REQUEST['tutor'];
	$student = $_REQUEST['student'];
	
	$result_array = array();
	$message = "";

	if((!empty($batch) || $batch != null) || (!empty($tutor) || $tutor != null)){

		$main_tutor_query = "INSERT INTO allocation (student_id,tutor_id,batch_id,entered_by,status,code)
                VALUES ('$student','$tutor','$batch','$enter_by',1,$code)";

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