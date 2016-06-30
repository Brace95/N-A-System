<?php

	if(!isset($_POST['metime'], $_POST['date']))
		return;

	include_once '../include/db.php';


	$sql = "DELETE FROM dayoff WHERE mid=? AND date=? LIMIT 1";

	if($stmt = $mysqli->prepare($sql)){

		$stmt->bind_param('ss', $_POST['metime'], $_POST['date']);
		$stmt->execute();

	}

?>