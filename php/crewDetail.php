<?php

	if(!isset($_GET['id']))
		return;

	require_once '../include/db.php';

	$id = $_GET['id'];

	/* Check if personal record exists */
	if($stmt = $mysqli->prepare("SELECT firstname, surname FROM crew WHERE metime = ? LIMIT 1")){

		$stmt->bind_param('s', $id);
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($db_firstname, $db_surname);
		$stmt->fetch();

		echo $db_firstname . "," . $db_surname;
		
	}



?>