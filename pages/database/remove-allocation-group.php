<?php 
	
	require_once('main_db.php');
	session_start();

	$enter_by = $_SESSION['user_id'];

	$allocationId = $_REQUEST['allocation_id'];

	$result_array = array();
	$message = "";

	if((!empty($allocationId) || $allocationId != null)){

		$query = "UPDATE allocation_group SET status = 0 WHERE id = $allocationId";
        $query_execute = mysqli_query($con, $query);

        $query = "UPDATE allocation SET status = 0 WHERE allocation_group_id = $allocationId";
        $query_execute = mysqli_query($con, $query);
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
