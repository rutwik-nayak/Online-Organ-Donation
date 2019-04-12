<?php 
error_reporting (E_ALL ^ E_NOTICE); 
session_start(); 
$userID = $_SESSION['userID'];  
$username = $_SESSION['username']; 
$databaseTitle = $_SESSION['title']; 
$databaseUserType = $_SESSION['userType']; 
$datebasePatientFlag = $_SESSION['patientFlag']; 
?>
<!DOCTYPE html>
<html>
<head> 
	<title>Organ Donation</title>
	<link rel = "stylesheet" type = "text/css" href = "style.css"/>
</head>
<body>
<div id="nav">
    <div id="nav_wrapper">
        <ul>
			<li><a href="index.php"><img src = "https://townehomecare.com/wp-content/uploads/2017/04/organ-donation.jpg" width = "40" height = "40" alt = "heart and hands"  /></a></li>
            <li><a href="index.php">Home</a></li>
            <li> <a href="about.php">About Us</a></li>
            <li> <a href="faq.php">FAQ</a></li>
			<?php 
			if(!$userID)
			{
			echo "<li> <a href='register.php'>Register</a>"; 
				echo "<ul>"; 
					echo "<li><a href='register.php'>Donor/Recipient</a></li>"; 
					echo "<li><a href='staffregister.php'>Doctor/Staff</a></li>"; 
                echo "</ul>"; 
			}
			?>
            <li> <a href="profile.php">Account</a>
                <ul>
				<?php
					if(!$username)
						echo "<li><a href='login.php'>Login</a></li>"; 
					else
						echo "<li><a href ='profile.php'>{$username}'s Profile</a></li>";
					?>
				<?php
					if($userID && $databaseUserType != "0") 
					{ echo "<li><a href='reports.php'>Reports</a></li>"; 
					}
					if($userID && ($databaseUserType == "1"))
					{
						echo "<li><a href='matching.php'>Matching</a></li>";
					}
					?>
					<?php
					if($userID && ($databaseUserType == "2"))
					{?>
					<li><a href="scheduler.php">Scheduler</a></li>
					<?php
					}
					?>
					<?php
					if($userID)
					{ ?>
						<li><a href='POA_Management.php'>Power Of Attorney Management</a></li>
						<li><a href='logout.php'>Logout</a></li> 
					<?php }
					?>
                </ul>
            </li>
			<?php
				if($userID)
				{
					echo "<li> <a href='profile.php'>Hello, {$username}</a>"; 
				}
			?>
        </ul>
    </div>
    <!-- Nav wrapper end -->
</div>
<!-- Nav end -->
<p>&nbsp;</p>
	<div class = "priority" align = "center">
		<h2 class="title"><font face= "Brush Script MT" size = 13px>Deactivate Account</font></h2>
		<p>&nbsp;</p>
		<p><b>To deactivate your account, enter in your email and password in the specified fields. WARNING: This action is binding! Are you sure you want to deactivate your account?</b></p>
		
		<form action = "deactivate.php" method = "post">
		<fieldset>
			Email: <input type="text" name="email"> <br> <br> 
			Username: <input type="text" name="username"> <br> <br> 
			Password: <input type="password" name="pass"> <br> <br> 
			<input type="submit" name = "submitdeactivate" value = "Submit">
		</fieldset>
		
		<?php 
		require("connect.php"); 
		
		if($_POST['submitdeactivate'])
		{
			$email = mysqli_real_escape_string($connection, $_POST['email']); 
			$patient_username = mysqli_real_escape_string($connection, $_POST['username']); 
			$patient_password = mysqli_real_escape_string($connection, $_POST['pass']); 
			
			if($email && $patient_username && $patient_password && $databaseUserType == "0")
			{
				$query = mysqli_query($connection, "SELECT userName, passwrd, pateintFlag, useraccount.userID 
														  FROM useraccount, patientinfo
														  WHERE useraccount.userName = '$patient_username'
														  AND useraccount.passwrd = '$patient_password'
														  AND patientinfo.email = '$email'
														  AND useraccount.userID = patientinfo.userID"); 
				$numberOfRows = mysqli_num_rows($query);
				if($numberOfRows == 1)
				{
					$updateQuery = mysqli_query($connection, "UPDATE useraccount SET active = 0 WHERE userName = '$patient_username' AND passwrd = '$patient_password'");
					unset($_SESSION["username"]);
					unset($_SESSION["userID"]);
					unset($_SESSION['title']); 
					unset($_SESSION['userType']);
					unset($_SESSION['patientFlag']);
					session_destroy(); 
					echo "<b>You're account has been deactivated. Thank You for using St. Teresa's Organ Donation Center!</b>"; 
					header("refresh:3; url = index.php");
				}
				else
				{
					echo "Error occurred, please try again."; 
					header("refresh:2;url=deactivate.php");
					$connection->close(); 
				}
			}
			else if($email && $patient_username && $patient_password && $databaseUserType == "1" || $databaseUserType == "2")
			{
				$query = mysqli_query($connection, "SELECT userName, passwrd, email 
														  FROM useraccount, accountinfo
														  WHERE userName = '$patient_username'
														  AND passwrd = '$patient_password'
														  AND email = '$email'
														  AND useraccount.userID = accountinfo.userID"); 
				$numberOfRows = mysqli_num_rows($query);
				if($numberOfRows == 1)
				{
					$updateQuery = mysqli_query($connection, "UPDATE useraccount SET active = 0 WHERE userName = '$patient_username' AND passwrd = '$patient_password'");
					unset($_SESSION["username"]);
					unset($_SESSION["userID"]);
					unset($_SESSION['title']); 
					unset($_SESSION['userType']);
					unset($_SESSION['patientFlag']);
					session_destroy(); 
					echo "You're account has been deactivated. Thank You for using St. Teresa's Organ Donation Center!"; 
					header("refresh:2; url = index.php");
				}
				else
				{
					echo "Error occurred"; 
					header("refresh:2;url=deactivate.php");
					$connection->close();  
				}
			}
			else
			{
				echo "Please enter in all fields."; 
				header("refresh:2;url=deactivate.php");
				$connection->close(); 
			}
		}

		?>
		
		
	</div>
</body>
</html>