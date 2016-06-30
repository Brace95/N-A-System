<!DOCTYPE html>

<html>

	<head>

		<style>

			html, body
			{
				margin: 0;
				padding: 0;
				height: 100%;

				background-color: #272125;
				color: #fff;

				text-align: center;
			}

		</style>

	</head>

	<body>

		<div>

			<h1>Session:</h1>

			<?php var_dump($_SESSION)?>

		</div>

		<div>

			<h1>Post:</h1>

			<?php var_dump($_POST)?>

		</div>


		<div>

			<h1>Get:</h1>

			<?php var_dump($_GET)?>

		</div>

		<div>

			<h1>PHP Test area</h1>

		</div>

	</body>

</html>