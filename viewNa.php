<?php

	require_once './include/protect.php';
	include_once './include/settings.php';

	$title = "View N/A Area";
	$view = true;

?>

<!DOCTYPE html>

<html>

	<head>

		<?php include_once './include/head.php'; ?>

		<style>

			.buttonHolder
			{
				margin-top: 20px;
			}

			.del
			{
				width: 100%;
			}

			#naTable
			{
				margin: 0 auto;
				margin-bottom: 20px;
				border-collapse: collapse;
				border: 1px solid #000;
				width: 70%;
				color: #fff;
			}

			#naTable, #naTable th, #naTable td
			{
				text-align: center;
			}

			#naTable th
			{
				height: 50px;
				font-weight: bolder;
				border-bottom: 1px solid #000;
				background-color: #465044;
			}

			#naTable td
			{
				height: 30px;
				border-bottom: 1px solid #000;
			}

			#naTable tr:nth-child(even)
			{
				background: #50444c;
			}

			#naTable tr:hover
			{
				background-color: #e6e6e6;
				color: #000;
			}

			#naTable tr:first-child:hover
			{
				background-color: #465044;
				color: #fff;
			}

		</style>

		<!-- Jquery -->
		<script>

			$().ready(function () {

				$("#fortnight").click(function () {getNa("fortnight");});
				$("#month").click(function () {getNa("month");});
				$("#year").click(function () {getNa("year");});

			});

		</script>

		<!-- Functions -->
		<script>

			function getNa (pov) {

				$("#pov").val(pov);

				$.get("./php/getDay.php", {view: pov})
					.done(function (data) {
						$("#holder").html(data);
					})
					.fail(function (jqXHR, textStatus, errorThrown) {
						alert("something broke..." + textStatus);
					});

			}

		</script>

	</head>

	<body>

		<main>

			<?php include_once './include/navi.php'; ?>

			<div class="buttonHolder">

				<input type="hidden" id="pov" value="" />
				<button id="fortnight">Fortnight</button>
				<button id="month">Month</button>
				<button id="year">Year</button>

			</div>

			<div id="holder">



			</div>

		</main>

		<?php include_once './include/foot.php'; ?>

	</body>

</html>