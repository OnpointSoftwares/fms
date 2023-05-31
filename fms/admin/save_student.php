<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['save'])){
		$date = $_POST['date'];
		$department = $_POST['department'];
		$subject = $_POST['subject'];
		$fowarded_to = $_POST['forwarded_to'];
		$action_taken_by = $_POST['action_taken_by']."".$_POST['section'];
		$password = md5($_POST['password']);
		
		mysqli_query($conn, "INSERT INTO `logs` VALUES('', '$date', '$department', '$subject', '$forwarded_to', '$action_taken_by', '$password')") or die(mysqli_error());
		
		header('location: logs.php');
	}
?>