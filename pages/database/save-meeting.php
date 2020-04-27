<?php 
	
	require_once('main_db.php');
	session_start();

	echo $enter_by = $_SESSION['level_id'];

	$batch = $_REQUEST['batch'];
	$meeting_toppic = $_REQUEST['meeting_toppic'];
	$dom = $_REQUEST['dom'];
	$meeting_message = $_REQUEST['meeting_message'];
	$status = $_REQUEST['status'];

	if(!empty($enter_by) || $enter_by != NULL){

		

	}