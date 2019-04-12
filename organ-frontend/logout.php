<?php 
session_start(); 
error_reporting (E_ALL ^ E_NOTICE);
$userID = $_SESSION['userID'];  
$username = $_SESSION['username']; 
$databaseTitle = $_SESSION['title']; 
$databaseUserType = $_SESSION['userType']; 
$datebasePatientFlag = $_SESSION['patientFlag'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Logout Page</title>
  <meta http-equiv= "Content-Type" content = "text/html; charset=utf-8" />
  <link rel = "stylesheet" type = "text/css" href = "style.css"/>
</head>
<body>
<p>&nbsp;</p>
	<div class = "priority" align = "center">
		<?php
		
		if($username)
		{
			unset($_SESSION["username"]);
			unset($_SESSION["userID"]);
			unset($_SESSION['title']); 
			unset($_SESSION['userType']);
			unset($_SESSION['patientFlag']);
			session_destroy(); 
			echo "You have been logged out successfully!"; 
			header("refresh:2; url = login.php");
		}
		
		else 
			echo "You are not logged in."; 
			header("refresh:3; url = login.php");
		?>
	</div>
</body>