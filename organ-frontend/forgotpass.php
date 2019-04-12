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
		<form action = "forgotpass.php" method = "post">
			<fieldset>
				<legend><b>Please enter your Username and Email Address</b></legend>
				<br>
				Username: <input type="text" name="username"> <br> <br>
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
		require 'PHPMailerAutoload.php';
		if($_POST['submitbutton'])
		{
			$user = $_POST['username']; 
			$email = $_POST['email']; 
			
			if($user) //user is filled in 
			{
				if($email) // if email was filled in and has address sign
				{
					require("connect.php"); 
					
					$query = mysqli_query($connection, "SELECT userName, email, firstName, lastName, passwrd
												  FROM useraccount, patientinfo
												  WHERE useraccount.userID = patientinfo.userID AND '$user' = useraccount.userName");
												   
					$numberOfRows = mysqli_num_rows($query); //check if the result is NULL
					if($numberOfRows == 1)
					{
						$row = mysqli_fetch_assoc($query);
						$databaseUserName = $row['userName'];
						$databaseEmail = $row['email']; 
						$databasefirstName = $row['firstName']; 
						$databaselastName = $row['lastName']; 
						$databasepassword =$row['passwrd']; 
						
						$subject = "Organ Donation Password Recovery"; 
						$message = "Dear customer, your current password is: {$databasepassword}. Thank you for you using Organ Donation.";

						$mail = new PHPMailer;

						//$mail->SMTPDebug = 3;                               // Enable verbose debug output

						$mail->isSMTP();                                      // Set mailer to use SMTP
						$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
						$mail->SMTPAuth = true;                               // Enable SMTP authentication
						$mail->Username = 'donationorgan417@gmail.com';                 // SMTP username
						// SMTP password goes here
						$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
						$mail->Port = 587;                                    // TCP port to connect to

						$mail->setFrom('donationorgan417@gmail.com', "Organ Donation Support");
						$mail->addAddress($databaseEmail, $databasefirstName);     // Add a recipient
						$mail->isHTML(true);                                  // Set email format to HTML

						$mail->Subject = $subject;
						$mail->Body    = $message;

						if(!$mail->send()) {
							echo 'Message could not be sent.';
							echo 'Mailer Error: ' . $mail->ErrorInfo;
						} else {
							echo '<b> An email has been sent with your information. </b>';
						} 
					}
					else
					{
						echo "Error: username or email address is not valid."; 
						$connection->close(); 
					}
				}
				else 
				{
					echo "Please enter your valid email"; 
					$connection->close();
				}
			}
			
			else 
				echo "Please enter your username"; 
		}
		?>
	</div>
</body>
</html>
