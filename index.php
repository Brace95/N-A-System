<?php

	$title = "Home";

	include_once './include/settings.php';
	include_once './include/db.php';
	include_once './include/function.php';

	sec_session_start();

	if(login_check($mysqli) == true)
		header('Location: ./viewNa.php');

?>

<!DOCTYPE html>

<html>

	<head>

		<?php include_once './include/head.php'; ?>

		<style>

			#crew_area, #manager_area
			{
				position: relative;
				display: inline-block;

				padding: 0;
				margin: 0;
				margin-top: 1%;

				min-height: 100%;
				height: 100%;

				min-width: 49%;
				width: 49%;
			}

			#crew_area
			{
				margin-left: 1%;
				float: none;
			}

			#username{margin-top: 20px;}
			#submit{margin-bottom: 20px;}
			.logo{height: 1em; padding-right: 1em;}

			form input, form button, form textarea
			{
				display: block;

				margin: 0 auto;
				padding: 20px;
				width: 300px;
			}

			form button
			{
				height: 62px;
				border: none;
				background-color: rgba(255, 140, 0, 1);
				color: rgba(0, 0, 0, 1);
			}

			#dayoff button:first-child
			{
				border-right: 1px #000 solid;
				border-radius: 10px 0 0 10px;
			}

			#dayoff button:last-child
			{
				border-right: 1px #000 solid;
				border-radius: 0 10px 10px 0;
			}

			#login button
			{
				border-radius: 0 0 10px 10px;

			}

			button
			{
				display: inline-block;
				margin: 10px;
				padding: 10px;
				width: 250px;
			}

			input, textarea
			{
				border: none;
				text-align: center;
				border-bottom: 1px gray solid;
			}

			input:first-child
			{
				border-radius: 10px 10px 0 0;
				-moz-border-radius: 10px 10px 0 0;
				-webkit-border-radius: 10px 10px 0 0;
			}

			input:nth-last-child(1)
			{
				margin-bottom: 10px;
				border-bottom: none;

				border-radius: 0 0 10px 10px;
				-moz-border-radius: 0 0 10px 10px;
				-webkit-border-radius: 0 0 10px 10px;
			}

			.flex
			{
				display: flex;
				width: 340px;
				margin: auto;

			}

			.flex-child
			{
				flex: 1;
			}

			.error
			{
				border: 1px red solid;
			}

		</style>

		<!-- Jquery -->
		<script>

			$().ready(function () {

				/* Setup graphical side */
				$("#manager_area").hide();
				$("#crew_area").hide();

				/* Handle the area buttons */
				$("#manager_button").click(function () {
					managerArea()
				});

				$("#crew_button").click(function () {
					crewArea()
				});

				/* If any errors have occurred */
				if("<?php echo $_GET['err']; ?>" == "0" || "<?php echo $_GET['err']; ?>" == "3")
					managerArea();
				else if("<?php echo $_GET['err']; ?>" == "1")
					crewArea();



				/* TODO: Enter details from database given the id */
				$("#metime_id").change(function () {

					$.get("./php/crewDetail.php", {id: $("#metime_id").val()})
						.done(function (data) {

							var broken = data.split(",");

							$("#firstname").val(broken[0]);
							$("#surname").val(broken[1]);

						});

				});

			});

		</script>

		<!-- Functions -->
		<script>

			/*
				formHash(form, password):
					Hash the <password> in the given <form> with a sha512 hash,
					Insert a hidden input to store the hashed password.
					Submit the given form.
			*/
			function formHash(form, password){
				var p = document.createElement("input");
				form.appendChild(p);

				p.name = "password";
				p.type = "hidden";
				p.value = hex_sha512(password.value);

				password.value = "";
				$("#p").removeAttr("required");

				form.submit();
			}

			/*
				managerArea():
					Hides the crew area.
					Shows the manager area.
			*/
			function managerArea(){
				$("#manager_button").hide();
				$("#crew_area").hide();

				$("#manager_area").show();
				$("#crew_button").show();
			}

			/*
				crewArea():
					Hides the manager area.
					Shows the crew area.
			*/
			function crewArea(){
				$("#crew_button").hide();
				$("#manager_area").hide();

				$("#crew_area").show();
				$("#manager_button").show();
			}

			/*
				addAnother():
					Clone the N/A date field.
					Clear the value of the cloned input field.
					Append it to the form.
			*/
			function addAnother(){
				var n = $(".date:first").clone();
				$("#dayoff #holder").append(n);
				$(n).val("");
				$(n).removeAttr("required");	
			}

			/*
				fixDate(enter):
					Converts the <enter> date to a javascript Date object.
					Returns the date in Linux Millisecond time.
			*/
			function fixDate(enter) {

				var re = /[\/\-\. ]/;
				var date_array = enter.split(re);

				var d = new Date
					(
						parseInt(date_array[2]),
						parseInt(date_array[1]) -1,
						parseInt(date_array[0]),
						0,
						0,
						0,
						0
					);

				return (d.getTime());
			}

			/*
				dayOffSubmit():
					Check each entered date 
			*/
			function dayOffSubmit() {

				var pass = true;
				var today = new Date();

				/* Get end of current week */
				if(today.getDay() == 0)
					var latest = new Date();
				else
					var latest = new Date(today.setDate((today.getDate() - today.getDay() + 1) + 6));
				
				console.log("lastest before 2 weeks: " + latest)
				latest.setHours(23);
				latest.setMinutes(59);
				latest.setSeconds(59);
				latest.setMilliseconds(0);

				/* Set it to equal to end of 2 weeks */
				latest.setDate(latest.getDate() + 14);

				/* Check all the dates to ensure they are less than 2 weeks */
				$(".date").each(function () {

					if($(this).val() == "")
						return true;

					var entered = new Date(fixDate($(this).val()));

					console.log(
						"\nEntered: " + entered + " Entered.getTime(): " + entered.getTime() + 
						"\nlatest: " + latest + " latest.getTime(): " + latest.getTime());

					if(entered.getTime() < latest.getTime()){
						$(this).val("N/A must be > 2 weeks in advance");
						pass = false;
					}

				});

				/* Load dates as linux time for storage */
				if(pass) {
					$(".date").each(function () {

						$(this).removeAttr("pattern");
						if($(this).val() == "")
							return true;

						$(this).val(fixDate($(this).val())/1000);

					});
				}

				/* Sneaky periodEnd input */
				var e = document.createElement("input");
				$("#dayoff #holder").append(e);

				e.name = "periodEnd";
				e.type = "hidden";
				e.value = (latest.getTime()/1000);

			}

		</script>

	</head>

	<body>

		<main>

			<div id="crew_area">

				<h1><img class="logo" src="http://uxrepo.com/static/icon-sets/linecons/svg/calendar.svg" alt="" />N/A Request</h1>

				<form id="dayoff" method="post" action="./php/request.php">

					<div id="holder">
						<input type="text" name="metime_id" pattern="\d{3,}" placeholder="Metime ID" id="metime_id" required />
						<input type="text" name="firstname" placeholder="Firstname" id="firstname" readonly required />
						<input type="text" name="surname" placeholder="Surname" id="surname" readonly required />
						<textarea name="reason" id="reason" placeholder="Reason (Optional)" ></textarea>
						<input type="text" name="date[]" pattern="^(0?[1-9]|[12][0-9]|3[01])[\- \/\.](0?[1-9]|1[012])[\- \/\.](19|20)\d\d$" placeholder="N/A date (DD/MM/YYYY)" class="date" required />
					</div>

					<div class="flex">
						<button class="flex-child" type="button" id="more" onclick="addAnother();">Another Day</button>
						<button class="flex-child" type="submit" id="submit" onclick="dayOffSubmit();">Request off</button>
					</div>

				</form>

			</div>

			<div id="manager_area">

				<h1><img class="logo" src="http://image005.flaticon.com/26/svg/26/26053.svg" alt="" />Manager Login</h1>

				<form method="post" action="./php/login.php" id="login">

					<input type="text" name="username" id="username" placeholder="Username" required />
					<input type="password" id="p" placeholder="Password" required />
					<div class="flex">
						<button type="submit" class="flex-child" id="submit" onclick="formHash(this.form, this.form.p);">Login</button>
					</div>

				</form>

			</div>

			<div id="error">

				<?php if ($_GET['err'] == "0") : ?>

					<h2>Login Failed: Please try logging in again.</h2>

				<?php elseif ($_GET['err'] == "1") : ?>

					<h2>N/A Request Failed: Please try again.</h2>

				<?php elseif ($_GET['err'] == "2") : ?>

					<h2>N/A dates Accepted.</h2>
					
				<?php elseif ($_GET['err'] == "3") : ?>

					<h2>Please Login first</h2>

				<?php endif; ?>

			</div>

			<div>

				<button id="crew_button">Crew</button>
				<button id="manager_button">Managers</button>

			</div>

		</main>

		<?php include_once './include/foot.php'; ?>

	</body>

</html>