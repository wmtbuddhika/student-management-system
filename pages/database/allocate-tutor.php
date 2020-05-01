<?php 
	
	require_once('main_db.php');
	session_start();

	$enter_by = $_SESSION['user_id'];
	
	$tutor = $_REQUEST['tutor'];
	$module = $_REQUEST['module'];
	$batch = $_REQUEST['batch'];
	$code = $_REQUEST['code'];
	
	$result_array = array();
	$message = "";

	if((!empty($tutor) || $tutor != null)){

        $main_tutor_query = "INSERT INTO allocation_group (entered_by,status,code)
                VALUES ('$enter_by',1,'$code')";
		$query_execute = mysqli_query($con, $main_tutor_query);
        $allocationId = mysqli_insert_id($con);

        $main_tutor_query = "INSERT INTO allocation (id,tutor_id,batch_id,module_id,status)
                VALUES ($allocationId,'$tutor','$batch','$module',1)";
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