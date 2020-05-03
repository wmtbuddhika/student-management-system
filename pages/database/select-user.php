<?php 
	
	require_once('main_db.php');
	$user_id = $_REQUEST['term'];

	$result_array = array();

	$user_select_query = "SELECT
		`user`.id,
		`user`.`code`,
		`user`.`name`,
		`user`.nic_no
	FROM
		`user`
	WHERE
		`user`.`code` LIKE '%$user_id%'
	OR `user`.`name` LIKE '%$user_id%'
	ORDER BY
		`user`.id ASC,
		`user`.`name` ASC";

	$user_execute = mysqli_query($con, $user_select_query);

	$count = 0;

	while($user = mysqli_fetch_array($user_execute)){
		$name = $user['code']." - ".$user['name'];

		$result_array[$count] = array('user' => $user['id'], 'user_code' => $user['code'], 'name' => $name);

		$count++;

	}

	mysqli_close($con);
	$result_array['debug'] = $user_select_query;

	echo json_encode($result_array);

 ?>