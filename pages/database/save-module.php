<?php 
	
	require_once('main_db.php');
	session_start();

	$enter_by = $_SESSION['user_id'];

	$module_code = $_REQUEST['module_code'];
	$module_name = $_REQUEST['module_name'];
	$remark = $_REQUEST['remark'];
	$active = $_REQUEST['active'];

	$result_array = array();
	$message = "";

	if((!empty($module_code) || $module_code != null)){

		$tutor_validat_query = "SELECT id FROM module WHERE name = '$module_name' AND code = '$module_code' AND status = 1";

		$tutor_validate_result = mysqli_query($con, $tutor_validat_query);
		if ($tutor_validate_result) {
            $tutor_row_count = mysqli_num_rows($tutor_validate_result);
        } else {
            $tutor_row_count = 0;
        }

		if($tutor_row_count > 0){
			$message = "exist";
		} else {
			
			$main_tutor_query = "INSERT INTO module (code,name,remarks,status,entered_by)
			VALUES ('$module_code','$module_name','$remark','$active','$enter_by')";

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
