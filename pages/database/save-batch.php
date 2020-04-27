<?php 
	
	require_once('main_db.php');
	session_start();

	$enter_by = $_SESSION['user_id'];

	$batch_code = $_REQUEST['batch_code'];
	$batch_name = $_REQUEST['batch_name'];
	$remark = $_REQUEST['remark'];
	$startingDate = $_REQUEST['startingDate'];
	$active = $_REQUEST['active'];

	$result_array = array();
	$message = "";

	if((!empty($batch_code) || $batch_code != null)){

		$tutor_validat_query = "SELECT id FROM Batch WHERE name = '$batch_name' OR code = '$batch_code'";

		$tutor_validate_result = mysqli_query($con, $tutor_validat_query);
		$tutor_row_count = mysqli_num_rows($tutor_validate_result);

		if($tutor_row_count > 0){
			$message = "exist";
		} else {
			
			$main_tutor_query = "INSERT INTO batch (code,name,start_date,remarks,entered_by,status)
			VALUES ('$batch_code','$batch_name','$startingDate','$remark','$enter_by','$active')";

			$query_execute = mysqli_query($con, $main_tutor_query);
		
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
