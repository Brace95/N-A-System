<?php

	require_once './include/db.php';
	require_once './include/function.php';

	sec_session_start();

	if(login_check($mysqli) == false)
		header('Location: ./index.php?err=3');

?>