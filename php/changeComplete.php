<?php

	if(!isset($_POST['metime'], $_POST['date'], $_POST['checked']))
		return;

	include_once '../include/db.php';

	$complete = ($_POST['checked'] === "true");

	if($complete)
		$sql = "UPDATE dayoff set complete=1 WHERE mid=? AND date=?";
	else
		$sql = "UPDATE dayoff set complete=0 WHERE mid=? AND date=?";

	if($stmt = $mysqli->prepare($sql)){

		$stmt->bind_param('ss', $_POST['metime'], $_POST['date']);
		$stmt->execute();

	}

?>