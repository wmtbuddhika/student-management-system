<?php 
	
	require_once('main_db.php');
	session_start();

	$enter_by = $_SESSION['user_id'];
	
	$allocationId = $_REQUEST['allocation_id'];
	$students = $_REQUEST['students'];

	$result_array = array();
	$message = "";

	if((!empty($allocationId) || $allocationId != null) || (!empty($students) || $students != null)){

	    foreach ($students as $student) {
            $query = "INSERT INTO allocation (allocation_group_id,student_id,status) VALUES ($allocationId,'$student',1)";
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