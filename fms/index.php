<!DOCTYPE html>
<html lang="en">
	<head>
		<title>ca File Management System</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "stylesheet" type="text/css" href="admin/css/bootstrap.css" />
		<link rel = "stylesheet" type="text/css" href="admin/css/style.css" />
	</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
		<div class="container-fluid">
			<label class="navbar-brand"> ca File Management System</label>
		</div>
	</nav>
	<?php header("location:admin/"); ?>
	<div id = "footer">
		<label class = "footer-title">&copy; Copyright CampCodes ca File Management System <?php echo date("Y", strtotime("+8 HOURS"))?></label>
	</div>
</body>
</html>