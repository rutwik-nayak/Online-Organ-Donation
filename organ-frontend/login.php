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
<head> 
	<meta http-equiv= "Content-Type" content = "text/html; charset=utf-8" />
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
		<h2 class="title"><font face= "Brush Script MT" size = 13px>Login</font></h2>
		<p>&nbsp;</p>
			<?php
			
			if($username && $userID) //if the user is already logged in 
			{
				echo "You're already logged in as <b>$username</b>"; 
			}
					
			else
			{
				$form  = "<form action = './login.php' method = 'post'>
				<table>
				<tr>
					<td>Username:</td>
					<td><input type = 'text' name = 'user' /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type = 'password' name = 'password' /></td>
				</tr>
				<tr>
					<td><input type = 'submit' class='fancybutton' name = 'loginbutton' value = 'Login' /></td>
					<br>
				</tr>
				<table>
				</form>"; 
				
				if($_POST['loginbutton'])
				{
					$user = $_POST['user'];
					$password = $_POST['password']; 
				
					if($user) //if user typed in field
					{
						//check if password field was entered
						if($password)
						{
							require("connect.php"); 
							
							//added encryption for extra secruity 
							//$password = md5(md5 ("hfd9skla".$password."kALjdha53")); 
							
							
							
							$query = mysqli_query($connection, "SELECT userName, passwrd, pateintFlag, userID 
												  FROM useraccount
												  WHERE userName = '$user'
												  AND passwrd = '$password'
												  AND active = 1"); 
							$numberOfRows = mysqli_num_rows($query); 
							
							//checking if anything was returned from the query
							if($numberOfRows === 1)
							{ 
								//fetches data from query 
								$row = mysqli_fetch_assoc($query);
								$databaseUserName = $row['userName']; 
								$databasePass = $row['passwrd']; 
								$datebasePatientFlag = $row['pateintFlag']; 
								$databaseUserID = $row['userID'];
								
								if($datebasePatientFlag === "0") 
								{
								    $query2 = mysqli_query($connection, "SELECT accountinfo.userType, accountinfo.title FROM accountinfo, useraccount WHERE useraccount.passwrd = '$databasePass' AND '$databaseUserName' = useraccount.userName AND useraccount.userID = accountinfo.userID");
									
										$numberOfRows2 = mysqli_num_rows($query2);
										if($numberOfRows2 == 1)
										{
											$row2 = mysqli_fetch_assoc($query2);
											$databaseTitle = $row2['title']; 
											$databaseUserType = $row2['userType']; 
											//set session information
											$_SESSION['username'] = $databaseUserName; 
											$_SESSION['userID'] = $databaseUserID;
											$_SESSION['title'] = $databaseTitle; 
											$_SESSION['userType'] = $databaseUserType; 
											$_SESSION['patientFlag'] = $datebasePatientFlag;   
											$connection->close(); 
											header('Location: http://localhost:8080/index.php'); 
										}
										else
										{
											echo "Error retrieving information"; 
											$connection->close(); 
											header("refresh:2;url=login.php");
										}
								}
								else if($datebasePatientFlag === "1")
								{
									$_SESSION['title'] = 0; 
									$_SESSION['userType'] = 0; 
									$_SESSION['username'] = $databaseUserName; 
									$_SESSION['userID'] = $databaseUserID;
									$_SESSION['patientFlag'] = $datebasePatientFlag; 
									$connection->close(); 
									echo "Welcome to St. Teresa's Organ Donation <b>{$username}</b>!";
									header('Location: http://localhost:8080/index.php'); 
								}
								else
								{ 
									echo "Error with password entry. Please try again."; 
									$connection->close(); 
									header("refresh:2;url=login.php");
								}
									
							}
							else
							{
								echo "Username/password combination is invalid."; 
								$connection->close(); 
								header("refresh:2;url=login.php");
							}
						} 
					}
					else 
						echo "You must enter the username."; 
				}
				else 
					echo $form;
			}				
			//mysqli_close($connection); // Closing Connection
			?>
			
		<style type="text/css">
				.fancybutton
				{
					background: #25A6E1;
					background: -moz-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
					background: -webkit-gradient(linear,left top,left bottom,color-stop(0%,#25A6E1),color-stop(100%,#188BC0));
					background: -webkit-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
					background: -o-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
					background: -ms-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
					background: linear-gradient(top,#25A6E1 0%,#188BC0 100%);
					filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#25A6E1',endColorstr='#188BC0',GradientType=0);
					padding:8px 13px;
					color:#fff;
					font-family:'Helvetica Neue',sans-serif;
					font-size:17px;
					border-radius:4px;
					-moz-border-radius:4px;
					-webkit-border-radius:4px;
					border:1px solid #1A87B9
				}                
				</style>
		<br>
		<a href="forgotuser.php">Forgot Username? </a>
		<br>
		<a href="forgotpass.php">Forgot Password? </a>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	</div>
</body>
</html>