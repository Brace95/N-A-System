<?php

	require_once '../include/db.php';
	require_once '../include/function.php';

	sec_session_start();

	if(isset($_POST['username'], $_POST['password'])) {

		$username = $_POST['username'];
		$password = $_POST['password'];

		if(login($username, $password, $mysqli) == true)
			header('Location: ../viewNa.php');
		else
			header('Location: ../index.php?err=0');

	} else {
		echo "Invalid Request.";
	}

?>