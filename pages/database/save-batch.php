<?php 
	
	require_once('main_db.php');
	session_start();

	$enter_by = $_SESSION['user_id'];

	$batch_code = $_REQUEST['batch_code'];
	$batch_name = $_REQUEST['batch_name'];
	$remark = $_REQUEST['remark'];
	$startingDate = $_REQUEST['startingDate'];
	$active = $_REQUEST['active'];

	$m_operation = $_REQUEST['m_operation'];
	$batch_u_id = $_REQUEST['batch_id_'];

	$result_array = array();
	$message = "";

	if($m_operation == 'INSERT'){

		if((!empty($batch_code) || $batch_code != null)){

			$tutor_validat_query = "SELECT id FROM batch WHERE name = '$batch_name' OR code = '$batch_code' AND status = 1";

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

	} else if($m_operation == 'UPDATE'){

		$modul_update_query = "UPDATE `batch`
		SET `name` = '$batch_name',
		 `status` = '1',
		 `updated_date` = NOW(),
		 `code` = '$batch_code',
		 `start_date` = '$startingDate',
		 `remarks` = '$remark',
		 `entered_by` = '1'
		WHERE
			(`id` = '$batch_u_id')";

		$update_execute = mysqli_query($con, $modul_update_query);

		if($update_execute){
			$message = "UPDATED";
		} else {
			$message = "NOT UPDATED";
		}
	} else if($m_operation == 'DELETE'){
        $delete_id = $_REQUEST['delete_id'];

		$query = "UPDATE batch SET status = 0 WHERE id = '$delete_id'";

		$update_execute = mysqli_query($con, $query);

		if($update_execute){
			$message = "DELETED";
		} else {
			$message = "NOT DELETED";
		}
	}

	mysqli_close($con);

	$result_array['message'] = $message;
	echo (json_encode($result_array));
