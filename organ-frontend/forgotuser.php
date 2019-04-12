<?php 
error_reporting (E_ALL ^ E_NOTICE); 
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
		<form action = "forgotuser.php" method = "post">
			<fieldset>
				<legend><b>Please enter your Username</b></legend>
				<br>
				Email Address: <input type="text" name="email"> <br>
				<p>&nbsp;</p>
				<input type="submit" name = "submitbutton" value = "Submit">
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
			</fieldset>
		</form> 
		
		<?php
		
		require('PHPMailerAutoload.php'); 
		
		if($_POST['submitbutton'])
		{
			$email = $_POST['email']; 
			
			if($email) //email was filled in 
			{
				require("connect.php"); 
					
				$query = mysqli_query($connection, "SELECT userName, email, firstName
												  FROM useraccount, patientinfo
												  WHERE useraccount.userID = patientinfo.userID");
				
				$numberOfRows = mysqli_num_rows($query); //check if the result is NULL
				
				if($numberOfRows == 1)
				{
					$row = mysqli_fetch_assoc($query);
					$databaseUserName = $row['userName'];
					$databaseEmail = $row['email']; 
					$databasefirstName = $row['firstName'];
					
					$subject = "Organ Donation Username Recovery"; 
					$message = "Dear {$databasefirstName}, your current username is: {$databaseUserName} <br> Thank you for you using Organ Donation.";
	
					$mail = new PHPMailer;
					$mail->isSMTP();                                      // Set mailer to use SMTP
					$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = 'donationorgan417@gmail.com';                 // SMTP username
					// SMTP password goes here
					$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
					$mail->Port = 587;                                    // TCP port to connect to

					$mail->setFrom('donationorgan417@gmail.com', "St. Teresa's Support");
					$mail->addAddress($databaseEmail, $databasefirstName);     // Add a recipient
					$mail->isHTML(true);                                  // Set email format to HTML

					$mail->Subject = $subject;
					$mail->Body    = $message;

					if(!$mail->send())
					{
						echo 'Message could not be sent.';
						echo 'Mailer Error: ' . $mail->ErrorInfo;
						$connection->close();
					} 
					else 
					{
						echo '<b> An email has been sent with your information. </b>';
						$connection->close();
					} 	
					
				}
				else 
				{
					echo "<b>Error: Email Address is not valid.</b>"; 
					$connection->close();
				}
			}
			else
				echo "<b> Please enter your email address"; 
			
		}
		?>
		
		</div>
</body>
</html>
