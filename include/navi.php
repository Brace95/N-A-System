<nav>

	<ul>


		<?php if($view) : ?>
			<li><a class="active" href="./viewNa.php">View N/A</a></li>
		<?php else : ?>
			<li><a href="./viewNa.php">View N/A</a></li>
		<?php endif ?>


		<?php if($new) : ?>
			<li><a class="active" href="./newCrew.php">Add Crew</a></li>
		<?php else : ?>
			<li><a href="./newCrew.php">Add Crew</a></li>
		<?php endif ?>


		<?php if($export) : ?>
			<li><a class="active" href="./export.php">Export</a></li>
		<?php else : ?>
			<li><a href="./export.php">Export</a></li>
		<?php endif ?>


		<li style="float: right;"><a href="./php/logout.php">Log out</a></li>
		<li style="float: right;"><a href="#"><?php echo $_SESSION['username'];?></a></li>

	</ul>

</nav>