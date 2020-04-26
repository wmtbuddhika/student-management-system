<?php header('Content-Type: application/json');
	
	//DB Connection initiate in Here
	require_once('main_db.php');

	//catch all data from login foarm
	$user_name = $_REQUEST['user-email'];
	$password = $_REQUEST['password'];

	//Create sending event data
	$message = "";

	//Check weher catching data empty or null
	if((!empty($user_email) && $user_email != NULL) || (!empty($password) && $password != NULL)){
		
		//login check query
		$main_query = "SELECT
			main_access.id,
			main_access.user_type,
			main_access.user_name,
			main_access.`password`,
			main_access.satatus,
			main_access.dateTime
		FROM
			`main_access`
		WHERE
			main_access.user_name = '$user_name'
		AND main_access.`password` = '$password'
		AND main_access.satatus = '1'";

		//login check query execute
		$query_execute = mysqli_query($con, $main_query);

		//get row count of data from login query
		$row_count = mysqli_num_rows($query_execute);

		//result data initiate
		$result = mysqli_fetch_array($query_execute);


		if($row_count > 0){
			session_start();

			$_SESSION['user_id'] = $result['id'];
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