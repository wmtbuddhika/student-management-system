<?php 
	
	require_once('main_db.php');
	session_start();

	$enter_by = $_SESSION['user_id'];

	$tutor_code = $_REQUEST['tutor_code'];
	$full_name = $_REQUEST['full_name'];
	$calling_name = $_REQUEST['calling_name'];
	$nic = $_REQUEST['nic_name'];
	$dob = $_REQUEST['dob'];
	$nationality = $_REQUEST['nationality'];
	$marital_status = $_REQUEST['marital_status'];
	$gender = $_REQUEST['gender'];
	$active = $_REQUEST['active'];
	$address = $_REQUEST['address'];
	$mobile_no = $_REQUEST['mobile_no'];
	$email = $_REQUEST['email'];
	$land_number = $_REQUEST['land_number'];
	$office_number = $_REQUEST['office_number'];

	$user_name = $_REQUEST['user_name'];
	$password = $_REQUEST['password'];

	$result_array = array();
	$message = "";

	if((!empty($tutor_code) || $tutor_code != null)){

		$tutor_validat_query = "SELECT u.id FROM user u, login l, role r WHERE u.id = l.user_id AND l.id = r.login_id AND r.permission_id = 2 AND (u.code = '$tutor_code' OR l.user_name = '$user_name')";
		$tutor_validate_result = mysqli_query($con, $tutor_validat_query);
		$tutor_row_count = mysqli_num_rows($tutor_validate_result);

		if($tutor_row_count > 0){
			$message = "exist";
		} else {
			$main_tutor_query = "INSERT INTO user (code,name,calling_name,nic_no,date_of_birth,nationality,marital_status,gender,status,address,mobile_no,email,land_no,office_no,enter_by)
			VALUES ('$tutor_code','$full_name','$calling_name','$nic','$dob','$nationality','$marital_status','$gender','$active','$address','$mobile_no','$email','$land_number','$office_number','$enter_by')";

			$query_execute = mysqli_query($con, $main_tutor_query);
			$userId = mysqli_insert_id($con);

			if($query_execute){
				if((!empty($user_name) || $user_name != NULL) && (!empty($password) || $password != NULL)){
                    $login = "INSERT INTO login (user_name,password,user_id) VALUES ('$user_name','$password','$userId')";
                    $loginExecute = mysqli_query($con, $login);
                    $loginId = mysqli_insert_id($con);

                    $role = "INSERT INTO role (login_id,permission_id) VALUES ('$loginId',2)";
                    $loginExecute = mysqli_query($con, $role);
				}
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
	echo json_encode($result_array);