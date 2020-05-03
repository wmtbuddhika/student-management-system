<?php 
	
	require_once('main_db.php');
	session_start();

	$enter_by = $_SESSION['user_id'];

	$allocationId = $_REQUEST['allocation_id'];
	$batch = $_REQUEST['batch'];
	$module = $_REQUEST['module'];
	$tutor = $_REQUEST['tutor'];
	$code = $_REQUEST['code'];
	$name = $_REQUEST['name'];

	$message = "";

	if ($allocationId != null) {
        if((!empty($code) || $code != null)) {
            $query = "SELECT id FROM allocation_group WHERE code = '$code' AND status = 1";

            $result = mysqli_query($con, $query);
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                $message = "exist";
            } else {
                $query = "UPDATE allocation_group SET code = '$code',name = '$name',batch_id = '$batch',module_id = '$module',tutor_id = '$tutor',entered_by = '$enter_by',status = 1
			WHERE id = $allocationId";

                $query_execute = mysqli_query($con, $query);
                if ($query_execute) {
                    $message = "success";
                } else {
                    $message = "error";
                }
            }
        }
    } else if((!empty($code) || $code != null)){

		$query = "SELECT id FROM allocation_group WHERE code = '$code' AND status = 1";

		$result = mysqli_query($con, $query);
		$count = mysqli_num_rows($result);

		if($count > 0){
			$message = "exist";
		} else {
			$query = "INSERT INTO allocation_group (code,name,batch_id,module_id,tutor_id,entered_by,status)
			VALUES ('$code','$name','$batch','$module','$tutor','$enter_by',1)";

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
