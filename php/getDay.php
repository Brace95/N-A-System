<?php

	require_once '../include/db.php';

	if(!isset($_GET['view']))
		return;

	/* Setup varaibles */
	$view = $_GET['view'];

	if($view == "fortnight"){

		$start = strtotime("Monday + 1 week");
		$end = strtotime("Sunday + 3 weeks");

	} else if($view == "month"){

		$start = strtotime(date("m/01/Y"));
		$end = strtotime(date("m/t/Y"));

	} else if($view == "year"){

		$start = strtotime(date("01/m/Y"));
		$end = strtotime(date("12/t/Y"));

	} else if($view == "everything") {

		$start = strtotime("1/1/2000");
		$end = strtotime("1/1/2100");

	}

	$print_start = date('d/m/Y', $start);
	$print_end = date('d/m/Y', $end);

?>


<?php if($view == "fortnight") : ?>

	<h2>Period: <?php echo "$print_start - $print_end";?></h2>
	
<?php elseif ($view == "month") : ?>

	<h2>Period: <?php echo date("m/Y", $start);?></h2>

<?php elseif($view == "year"): ?>
	
	<h2>Period: <?php echo date("Y", $start);?></h2>

<?php elseif($view == "year"): ?>
	
	<h2>Period: Everything</h2>

<?php endif; ?>

<div style="margin-bottom: 50px;">

	<button id="back">&lt;-------</button>
	<button id="back">-------&gt;</button>

</div>

<table id="naTable">

	<script>

		$().ready(function () {

			$(":checkbox").change(function () {

				var val = $(this).val();
				var exploded = val.split("~");
				var metime = exploded[0];
				var date = exploded[1];
				var checked = $(this).prop("checked");

				$.post("./php/changeComplete.php", {metime: metime, date: date, checked: checked});

			});

			$(".del").click(function () {

				if(!confirm("Are you sure you want to delete this entry?"))
					return;

				var val = $(this).val();
				var exploded = val.split("~");
				var metime = exploded[0];
				var date = exploded[1];

				$.post("./php/deleteNa.php", {metime: metime, date: date})
					.done(function () {

						switch($("#pov").val()){

							case "fortnight":
								$("#fortnight").trigger( "click" );
								break;
							case "month":
								$("#month").trigger( "click" );
								break;
							case "year":
								$("#year").trigger( "click" );
								break;
							default:
								console.log("Error in updating view after delete");
								break;

						}

				});

			});

		});

	</script>

	<tr>

		<th>Crew Details</th>
		<th>N/A Request</th>
		<th>Completed</th>
		<th>Delete</th>

	</tr>

<?php

	$sql = "SELECT dayoff.mid, crew.firstname, crew.surname, dayoff.date, dayoff.complete FROM dayoff JOIN crew ON dayoff.mid=crew.metime WHERE dayoff.date BETWEEN $start AND $end ORDER BY mid DESC, date ASC";

	error_log($sql);

	if($stmt = $mysqli->prepare($sql)){
	
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($metime, $firstname, $surname, $date_off, $complete);

		while($stmt->fetch()){

			echo "<tr>";

			echo "<td>" . $metime . ", " . $firstname . " " . $surname . "</td>";

			echo "<td>" . date("d/m/Y", $date_off) . "</td>";

			if($complete == 0)
				echo "<td><input type='checkbox' value='$metime~$date_off' class='complete' /></td>";
			else
				echo "<td><input type='checkbox' value='$metime~$date_off' class='complete' checked /></td>";

			echo "<td><button class='del' value='$metime~$date_off'>Delete</button></td>";

		}

	}
	

?>

</table>