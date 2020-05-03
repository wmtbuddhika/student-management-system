<?php 

	require_once('main_db.php');

	$id = $_REQUEST['tutor_id'];

	$result_array = array();
	$result = false;
	$messege = "";
	$debug = "";

	$select_query = "SELECT
		U.id AS ID,
		U. CODE AS `CODE`,
		U. NAME AS `NAME`,
		U.gender AS GENDER,
		U.date_of_birth AS DOB,
		U.nic_no AS NIC,
		U.mobile_no AS MOBILE,
		U.email AS EMAIL,
		U.address AS ADDRESS,
		U.`status` AS `STATUS`,
		U.created_date AS CDATE,
		U.updated_date AS UDATE,
		U.nationality AS NATIONALITY,
		U.marital_status AS MARITIAL,
		U.land_no AS LAND_NUM,
		U.office_no AS OFFICE_NUM,
		U.enter_by AS ENTER_BY,
		U.calling_name AS CALLING_NAME,
		login.user_name AS USER_NAME,
		login. PASSWORD AS `PASSWORD`,
		role. NAME AS ROLE_NAME,
		role.login_id AS LOGIN_ID,
		role.permission_id AS PERMISSION_ID
	FROM
		user AS U
	LEFT JOIN login ON U.id = login.user_id
	LEFT JOIN role ON login.user_id = role.login_id
	WHERE
		U.id = '$id'";

	$select_execute = mysqli_query($con, $select_query);

	$tutor_data = mysqli_fetch_assoc($select_execute);
	$debug = $select_query;

	if($select_execute){
		$result = true;
		$messege = "success";

		$result_array['data'] = $tutor_data;
	} else {
		$result = false;
		$messege = "error";
	}

	$result_array['result'] = $result;
	$result_array['messege'] = $messege;

	echo json_encode($result_array);

 ?>