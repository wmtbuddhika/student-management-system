<?php 
	
	require_once('main_db.php');
	session_start();

	$enter_by = $_SESSION['user_id'];
	
	$allocationId = $_REQUEST['allocation_id'];
	$students = $_REQUEST['students'];
	$editAllocationId = $_REQUEST['edit'];

	$result_array = array();
	$message = "";

	 if((!empty($allocationId) || $allocationId != null) || (!empty($students) || $students != null)){

	    foreach ($students as $student) {
            if ($editAllocationId) {
                $query = "UPDATE allocation SET allocation_group_id = $allocationId, student_id = $student, status = 1 WHERE id = $editAllocationId";
                $query_execute = mysqli_query($con, $query);

                if ($query_execute) {
                    $message = "success";
                } else {
                    $message = "error";
                }
            } else {
                $query = "SELECT id FROM allocation WHERE allocation_group_id = $allocationId AND student_id = '$student' AND status = 1";

                $tutor_validate_result = mysqli_query($con, $query);
                $count = mysqli_num_rows($tutor_validate_result);

                if ($count == 0) {
                    $query = "INSERT INTO allocation (allocation_group_id,student_id,status) VALUES ($allocationId,'$student',1)";
                    $query_execute = mysqli_query($con, $query);

                    if ($query_execute) {
                        $message = "success";
                    } else {
                        $message = "error";
                    }
                } else {
                    $message = "success";
                }
            }
        }

	} else {
		$message = "empty";
	}

	mysqli_close($con);

	$result_array['message'] = $message;
	echo (json_encode($result_array));