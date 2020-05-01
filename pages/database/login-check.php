<?php header('Content-Type: application/json');
	
	//DB Connection initiate in Here
	require_once('main_db.php');

	//catch all data from login foarm
	$user_name = $_REQUEST['user-email'];
	$password = $_REQUEST['password'];

	//Create sending event data
	$message = "";

	//Check weher catching data empty or null
	if((!empty($user_name) && $user_name != NULL) || (!empty($password) && $password != NULL)){
		
		//login check query
		$main_query = "SELECT u.id, r.permission_id user_type, u.name user_name, 
                        (SELECT GROUP_CONCAT(ag.id) FROM allocation_group ag LEFT JOIN allocation a ON ag.id = a.allocation_group_id 
                        WHERE IF(r.permission_id = 2,ag.tutor_id = u.id,a.student_id = u.id)) allocation_id
                        FROM login l, user u, role r WHERE u.id = l.user_id AND l.id = r.login_id
                        AND l.user_name = '$user_name' AND l.password = '$password' AND u.status = 1";

		//login check query execute
		$query_execute = mysqli_query($con, $main_query);

		//get row count of data from login query
		$row_count = mysqli_num_rows($query_execute);

		//result data initiate
		$result = mysqli_fetch_array($query_execute);


		if($row_count > 0){
			session_start();

			$_SESSION['user_id'] = $result['id'];
			$_SESSION['allocation_id'] = $result['allocation_id'];
			$_SESSION['user_type'] = $result['user_type'];
			$_SESSION['user_name'] = $result['user_name'];

			session_write_close();

			$message = "success";
		} else {
			$message = "error";
		}

	} else{
		$message = "empty";
	}

	//Connection Close
	mysqli_close($con);

	$response['result'] = $message;

	echo json_encode($response);
 ?>