<?php

	var_dump($_POST);

	include_once '../include/db.php';

	/* Make sure all needed post data is there. */
	if(!isset($_POST['metime_id'], $_POST['firstname'], $_POST['surname'], $_POST['date'], $_POST['periodEnd']))
		header("Location: ../?err=1");

	/* Assign all post data local variables. */
	$metime = $_POST['metime_id'];
	$firstname = $_POST['firstname'];
	$surname = $_POST['surname'];
	$reason = "";
	$time = time();

	if(isset($_POST['reason']))
		$reason = $_POST['reason'];

	$date = $_POST['date'];
	$periodEnd = $_POST['periodEnd'];

	/* Check if personal record exists */
	if($stmt = $mysqli->prepare("SELECT firstname, surname FROM crew WHERE metime = ? LIMIT 1")){

		$stmt->bind_param('s', $metime);
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($db_firstname, $db_surname);
		$stmt->fetch();

		if($db_firstname != $firstname || $db_surname != $surname)
			header("Location: ../?err=1");

	}


	/* TODO: Check periodEnd date for tamper */
	/*$endOfWeek = strtotime('Sunday 11:59.59 + 2 weeks', time());
	error_log("End of week: " . date("d/m/Y h:i.s", $endOfWeek));
	error_log("End of week linux: " . $endOfWeek );
	error_log("From javascript: " . date("d/m/Y h:i.s"), $periodEnd);*/

	/* TODO: Check each date to be greater than the periodEnd date to insure no tamper */

	/* Load days off into tables */
	if($stmt = $mysqli->prepare("INSERT INTO submit (date, reason) VALUES (?, ?)")){

		$stmt->bind_param('ss', $time, $reason);
		$stmt->execute();

		$id = $stmt->insert_id;

	} else {echo "Something broke in entering submit details";return;}

	if($stmt = $mysqli->prepare("INSERT INTO dayoff VALUES (?, ?, ?, FALSE)")){

		for ($i = 0; $i < sizeof($date); $i++) {

			$stmt->bind_param('sss', $metime, $id, $date[$i]);
			$stmt->execute();

		}

		header('Location: ../?err=2');

	} else {echo "Something broke in entering items.";return;}

?>