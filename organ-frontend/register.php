<?php 
error_reporting (E_ALL ^ E_NOTICE); 
?>
<!DOCTYPE html>
<head> 
	<meta http-equiv= "Content-Type" content = "text/html; charset=utf-8" />
	<link rel = "stylesheet" type = "text/css" href = "style.css"/>
</head>
<body>
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
	<h2 class="title"><font face= "Brush Script MT" size = 13px>Donor and Recipient Registration</font></h2>
	<p><p> <b> Make sure all fields are filled before submitting. </b> <p> 
	<font color="red">Forms with * are required</font></p>
		<form action = "register.php" method = "post">
			<fieldset>
				<legend><b>Step 1: Are you interested in organ donation or receiving a needed organ?</b></legend>
				<input type="radio" name="patient" value="1" checked> Donor<br> 
				<input type="radio" name="patient" value="2"> Recipient<br>
				<legend><b>What organ do you need or wish to donate?</b></legend>
				<input type="radio" name="organ" value="heart" checked> Heart<br>
				<input type="radio" name="organ" value="lung"> Lung<br>
				<input type="radio" name="organ" value="liver"> Liver<br>
				<input type="radio" name="organ" value="kidney"> Kidney<br>
			</fieldset> 
			<p>&nbsp;</p>
			<fieldset>
				<legend><b>Step 2: Personal Information</b></legend>
				*First Name: <input type="text" name="firstname"> <br> <br> 
				*Last Name: <input type="text" name="lastname"> <br> <br> 
				<legend><b>*Date of Birth</b></legend>
				<select name="month">
				<legend><b>Month</b></legend>
					<option value="01">January</option>
					<option value="02">February</option>
					<option value="03">March</option>
					<option value="04">April</option>
					<option value="05">May</option>
					<option value="06">June</option>
					<option value="07">July</option>
					<option value="08">August</option>
					<option value="09">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select> <br> <br>
				<select name="day">
				<legend><b>Day</b></legend>
					<option value="1">01</option>
					<option value="2">02</option>
					<option value="3">03</option>
					<option value="4">04</option>
					<option value="5">05</option>
					<option value="6">06</option>
					<option value="7">07</option>
					<option value="8">08</option>
					<option value="9">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
				</select> <br> <br>
				<select name="year"> 
				<legend><b>Year</b></legend>
				<option value="2001">2001</option>
				<option value="2000">2000</option>
				<option value="1999">1999</option>
				<option value="1998">1998</option>
				<option value="1997">1997</option>
				<option value="1996">1996</option>
				<option value="1995">1995</option>
				<option value="1994">1994</option>
				<option value="1993">1993</option>
				<option value="1992">1992</option>
				<option value="1991">1991</option>
				<option value="1990">1990</option>
				<option value="1989">1989</option>
				<option value="1988">1988</option>
				<option value="1987">1987</option>
				<option value="1986">1986</option>
				<option value="1985">1985</option>
				<option value="1984">1984</option>
				<option value="1983">1983</option>
				<option value="1982">1982</option>
				<option value="1981">1981</option>
				<option value="1980">1980</option>
				<option value="1979">1979</option>
				<option value="1978">1978</option>
				<option value="1977">1977</option>
				<option value="1976">1976</option>
				<option value="1975">1975</option>
				<option value="1974">1974</option>
				<option value="1973">1973</option>
				<option value="1972">1972</option>
				<option value="1971">1971</option>
				<option value="1970">1970</option>
				<option value="1969">1969</option>
				<option value="1988">1968</option>
				<option value="1967">1967</option>
				<option value="1966">1966</option>
				<option value="1965">1965</option>
				<option value="1964">1964</option>
				<option value="1963">1963</option>
				<option value="1962">1962</option>
				<option value="1961">1961</option>
				<option value="1960">1960</option>
				<option value="1959">1959</option>
				<option value="1958">1958</option>
				<option value="1957">1957</option>
				<option value="1956">1956</option>
				<option value="1955">1955</option>
				<option value="1954">1954</option>
				<option value="1953">1953</option>
				<option value="1952">1952</option>
				<option value="1951">1951</option>
				<option value="1950">1950</option>
				<option value="1949">1949</option>
				<option value="1948">1948</option>
				<option value="1947">1947</option>
				<option value="1946">1946</option>
				<option value="1945">1945</option>
				<option value="1944">1944</option>
				<option value="1943">1943</option>
				<option value="1942">1942</option>
				<option value="1941">1941</option>
				<option value="1940">1940</option>
				<option value="1939">1939</option>
				<option value="1938">1938</option>
				<option value="1937">1937</option>
				<option value="1936">1936</option>
				</select> <br> <br> 
				*Driver's License Number: <input type="number" maxlength="13" name="driversLicense"> <br><br>
				How would you describe your current health? (1 being the best, 3 being below average)<select name="condition">
					<option value="1">Great</option>
					<option value="2">Average</option>
					<option value="3">Below Average</option>
				</select> <br><br>
				<legend><b>Height(EX: 5 feet, 11 inches)</b></legend> 
				<p>*Height(feet):</p>
				<select name="feet">
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
				</select> <br>
				<p>*Inches:</p>
				<select name="inches">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
				</select> <br><br> 
				*Weight(lbs): <input type="number" name="weight" min = 50 max = 600> <br> <br> 
				<legend>*Blood Type</legend>
				<select name="blood">
					<option value="A+">A+</option>
					<option value="A-">A-</option>
					<option value="B+">B+</option>
					<option value="B-">B-</option>
					<option value="AB+">AB+</option>
					<option value="AB-">AB-</option>
					<option value="O+">O+</option>
					<option value="O-">O-</option>
				</select>
				<br> <br> 
				<br>
				*Address 1: <input type="text" name="address1"> <br> <br> 
				Address 2: <input type="text" name="address2"> <br> <br> 
				Address 3: <input type="text" name="address3"> <br> <br>
				<p>*State:</p>
				<select name="state">
					<option value="1">Andra Pradesh</option>
					<option value="2">Arunanchal Pradesh</option>
					<option value="3">Assam</option>
					<option value="4">Bihar</option>
					<option value="5">Chhattisgarh</option>
					<option value="6">Goa</option>
					<option value="7">Gujarat</option>
					<option value="8">Haryana</option>
					<option value="9">Himachal Pradesh</option>
					<option value="10">Jammu and Kashmir</option>
					<option value="11">Jharkhand</option>
					<option value="12">Karnataka</option>
					<option value="13">Kerala</option>
					<option value="14">Madya Pradesh</option>
					<option value="15">Maharashtra</option>
					<option value="16">Manipur</option>
					<option value="17">Meghalaya</option>
					<option value="18">Mizoram</option>
					<option value="19">Nagaland</option>
					<option value="20">Odisha</option>
					<option value="21">Punjab</option>
					<option value="22">Rajasthan</option>
					<option value="23">Sikkim</option>
					<option value="24">Tamil Nadu</option>
					<option value="25">Telangana</option>
					<option value="26">Tripura</option>
					<option value="27">Uttar Pradesh</option>
					<option value="28">Uttarakhand</option>
					<option value="29">West Bengal</option>
				</select>
				<br>
				<br>
				*City: <input type="text" name="city"> <br> <br>
				*Zip Code: <input type="text" name="zip"> <br>
			</fieldset> 
			<fieldset>
				<legend><b>*Step 3: Account Information</b></legend>
				*Email Address: <input type="text" name="email"> <br><br>
				*Phone Number: <input type="number" name="phone" pattern=".{10,}" maxlength="10"> <br><br>
				*Username (7 characters min, 15 characters max): <input type="text" pattern=".{7,}" name="username" maxlength="15"> <br><br>
				*Password (7 characters min, 15 characters max): <input type="password" name="pass" pattern=".{7,}" maxlength="15"> <br><br>
				*Verify Password: <input type="password" name="verifypassword" maxlength="15"> <br><br>
			</fieldset>
			<fieldset>
				<legend><b>*Step 4: Power of Attorney</b></legend>
				<p> If for some reason you were not able to make a decision towards donating or undergoing surgeory, you may have an emergency contact to make the decision for you. If you would like to give someone this right, check yes and fill out their information below, if not, check no. <p>
				<input type="radio" name="poa" value="yes" checked> Yes<br> 
				<input type="radio" name="poa" value="no"> No<br>
				*First Name: <input type="text" name="poafirstname"> <br> <br> 
				*Last Name: <input type="text" name="poalastname"> <br> <br> 
				Email Address: <input type="text" name="poaemail"> <br><br>
				Phone Number: <input type="number" name="poaphone" pattern=".{10,}" maxlength="10"> <br><br>
			</fieldset>
			<input type="submit" name = "submitbutton" value = "Submit">
		</form> 
		<?php
		
			if($_POST['submitbutton'])
			{	
				require("connect.php"); 
				
				$patientinfo_patienttype = intval($_POST['patient']);
				$patientinfo_organ = $_POST['organ']; 
				$patientinfo_firstname = mysqli_real_escape_string($connection, $_POST['firstname']); 
				$patientinfo_lastname = mysqli_real_escape_string($connection, $_POST['lastname']);  
				if($patientinfo_patienttype && $patientinfo_organ && $patientinfo_firstname && $patientinfo_lastname)
				{
					$patientinfo_month = $_POST['month']; 
					$patientinfo_day = $_POST['day']; 
					$patientinfo_year = $_POST['year']; 
					$patientinfo_dob = "{$patientinfo_year}-{$patientinfo_month}-{$patientinfo_day}"; 
						
					$patientinfo_address = mysqli_real_escape_string($connection, $_POST['address1']); 
					$patientinfo_address2 = mysqli_real_escape_string($connection, $_POST['address2']); 
					$patientinfo_address3 = mysqli_real_escape_string($connection, $_POST['address3']); 
					$patientinfo_driverslicense = mysqli_real_escape_string($connection, $_POST['driversLicense']);
					$patientinfo_driverslicense = intval($patientinfo_driverslicense); 			
						
						if($patientinfo_address && $patientinfo_driverslicense && checkdate($patientinfo_month, $patientinfo_day, $patientinfo_year))
						{
							$patientinfo_feet = intval($_POST['feet']); 
							$patientinfo_inches = intval($_POST['inches']); 
							$patientinfo_weight = intval($_POST['weight']); 
							$patientinfo_bloodtype = $_POST['blood'];
							echo $patientinfo_feet . " ". $patientinfo_inches . " " . $patientinfo_weight;
							
							if($patientinfo_feet && $patientinfo_inches >= -1 && $patientinfo_weight)
							{
								$patientinfo_height = 2.54*(12*$patientinfo_feet + $patientinfo_inches); #centimeters
								$patientinfo_state = intval($_POST['state']); 
								$patientinfo_city = mysqli_real_escape_string($connection, $_POST['city']); 
								$patientinfo_zip = mysqli_real_escape_string($connection, $_POST['zip']); 
								$patientinfo_email = mysqli_real_escape_string($connection, $_POST['email']); 
								$patientinfo_phone = mysqli_real_escape_string($connection, $_POST['phone']);
								$patientinfo_phone = intval($patientinfo_phone);
								$useraccount_username = mysqli_real_escape_string($connection, $_POST['username']); 
								$useraccount_password1 = mysqli_real_escape_string($connection, $_POST['pass']); 
								$useraccount_password2 = mysqli_real_escape_string($connection, $_POST['verifypassword']); 
								
								$numberOfRows = 0; 
								$query = mysqli_query($connection, "SELECT * 
												  FROM useraccount
												  WHERE userName = '$useraccount_username'"); 
								$numberOfRows = mysqli_num_rows($query);
								if($numberOfRows == 0)
								{
									//return a an ID for the user, if the ID is already used, pick another 
									do {
									$randomAddressID = rand(0, 99999); 
									$query = mysqli_query($connection, "SELECT addressID 
																		FROM address
																		WHERE addressID = '$randomAddressID'"); 
									$numberOfRows = mysqli_num_rows($query); 
									}while ($numberOfRows == 1); 
										
									if($useraccount_password1 === $useraccount_password2) //if password is the same 
									{ 
										$patientinfo_address2 = !empty($patientinfo_address2) ? "'$patientinfo_address2'" : "NULL";
										$patientinfo_address3 = !empty($patientinfo_address3) ? "'$patientinfo_address3'" : "NULL";
										$queryInsert = mysqli_query($connection, "INSERT INTO address(addressID, adress1, adress2, adress3, city, zip_code, stateID) VALUES('$randomAddressID', '$patientinfo_address', '$patientinfo_address2', '$patientinfo_address3', '$patientinfo_city', '$patientinfo_zip', '$patientinfo_state')");
										if($queryInsert)
										{
											$randomNumber = rand(1000, 9999); 
											$randomNumber = (string)$randomNumber;
											$useraccount_userID = $useraccount_username; 
											$useraccount_userID .= $randomNumber; 
											$queryInsert2 = mysqli_query($connection, "INSERT INTO useraccount(userName, passwrd, pateintFlag, userID, active) VALUES ('$useraccount_username', '$useraccount_password1', 1, '$useraccount_userID', 1)");
											if($queryInsert2) 
											{
													$patientinfo_decisionMaker = $_POST['poa']; 
													$patientinfo_condition = intval($_POST['condition']); 
													if($patientinfo_decisionMaker === "yes")
													{
														$patientinfo_poafirstname =  mysqli_real_escape_string($connection,$_POST['poafirstname']); 
														$patientinfo_poalastname =  mysqli_real_escape_string($connection,$_POST['poalastname']); 
														$patientinfo_poaemail =  mysqli_real_escape_string($connection, $_POST['poaemail']); 
														$patientinfo_poaphone = $_POST['poaphone']; 
														if($patientinfo_organ === "heart")
														{
															$queryInsert3 = mysqli_query($connection,"INSERT INTO patientinfo (userID, addressID, patientType, firstName, lastName, title, phoneNumber, email, driversLicense, decisionMakerFlag, liverFlag, heartFlag, kidneyFlag, lungFlag, available, bloodType, height, weight, dob, doctorUserID, patientCond, active) VALUES ('$useraccount_userID', '$randomAddressID', '$patientinfo_patienttype', '$patientinfo_firstname', '$patientinfo_lastname', 'heart', '$patientinfo_phone', '$patientinfo_email', '$patientinfo_driverslicense', 1, 0, 1, 0, 0, 1, '$patientinfo_bloodtype', '$patientinfo_height', '$patientinfo_weight', '$patientinfo_dob', '1997yuna123KDTLW', '$patientinfo_condition', 1)")or die (mysqli_error($connection));
														}
														else if($patientinfo_organ === "liver")
														{
															$queryInsert3 = mysqli_query($connection, "INSERT INTO patientinfo (userID, addressID, patientType, firstName, lastName, title, phoneNumber, email, driversLicense, decisionMakerFlag, liverFlag, heartFlag, kidneyFlag, lungFlag, available, bloodType, height, weight, dob, doctorUserID, patientCond, active) VALUES ('$useraccount_userID', '$randomAddressID', '$patientinfo_patienttype', '$patientinfo_firstname', '$patientinfo_lastname', 'liver', '$patientinfo_phone', '$patientinfo_email', '$patientinfo_driverslicense', TRUE, TRUE, FALSE, FALSE, FALSE, TRUE, '$patientinfo_bloodtype', '$patientinfo_height', '$patientinfo_weight', '$patientinfo_dob', '6128bren984MNXbW' , '$patientinfo_condition', 1)");
														}
														else if($patientinfo_organ === "lung")
														{
															$queryInsert3 = mysqli_query($connection, "INSERT INTO patientinfo (userID, addressID, patientType, firstName, lastName, title, phoneNumber, email, driversLicense, decisionMakerFlag, liverFlag, heartFlag, kidneyFlag, lungFlag, available, bloodType, height, weight, dob, doctorUserID, patientCond, active) VALUES ('$useraccount_userID', '$randomAddressID', '$patientinfo_patienttype', '$patientinfo_firstname', '$patientinfo_lastname', 'lung', '$patientinfo_phone', '$patientinfo_email', '$patientinfo_driverslicense', TRUE, FALSE, FALSE, FALSE, TRUE, TRUE,'$patientinfo_bloodtype', '$patientinfo_height', '$patientinfo_weight', '$patientinfo_dob', '1493aerith84uXEfr', '$patientinfo_condition', 1)"); 
														}
														else
														{
															$queryInsert3 = mysqli_query($connection, "INSERT INTO patientinfo (userID, addressID, patientType, firstName, lastName, title, phoneNumber, email, driversLicense, decisionMakerFlag, liverFlag, heartFlag, kidneyFlag, lungFlag, available, bloodType, height, weight, dob, doctorUserID, patientCond, active) VALUES ('$useraccount_userID', '$randomAddressID', '$patientinfo_patienttype', '$patientinfo_firstname', '$patientinfo_lastname', 'kidney', '$patientinfo_phone', '$patientinfo_email', '$patientinfo_driverslicense', TRUE, FALSE, FALSE, TRUE, FALSE, TRUE, '$patientinfo_bloodtype', '$patientinfo_height', '$patientinfo_weight', '$patientinfo_dob', '9477ranko123aMmeN', '$patientinfo_condition', 1)"); 
														}
													
														if($queryInsert3)
														{
															do{
															$patientinfo_poaID = rand(0, 9999); 
															$query = mysqli_query($connection, "SELECT poaID 
																		FROM powerofattorney
																		WHERE powerofattorney.poaID = '$patientinfo_poaID'"); 
															$numberOfRows = mysqli_num_rows($query); 
															}while ($numberOfRows == 1);
															
															$queryInsert4 = mysqli_query($connection, "INSERT INTO powerofattorney(poaID, userID, firstName, lastName, phoneNumber, email) VALUES ('$patientinfo_poaID', '$useraccount_userID', '$patientinfo_poafirstname', '$patientinfo_poalastname', '$patientinfo_poaphone', '$patientinfo_poaemail')"); 
															
															if($queryInsert4)
															{
																require 'PHPMailerAutoload.php';
																$mail = new PHPMailer;

																//$mail->SMTPDebug = 3;                               // Enable verbose debug output

																$mail->isSMTP();                                      // Set mailer to use SMTP
																$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
																$mail->SMTPAuth = true;                               // Enable SMTP authentication
																$mail->Username = 'donationorgan417@gmail.com';                 // SMTP username
																$mail->Password = 'organ123$';                           // SMTP password
																$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
																$mail->Port = 587;                                    // TCP port to connect to

																$mail->setFrom('donationorgan417@gmail.com', "Organ Donation");
																$mail->addAddress($patientinfo_email, $patientinfo_firstname);   // Add a recipient
																$mail->isHTML(true);                                  // Set email format to HTML

																$mail->Subject = "Organ Donation Registration";
																$mail->Body    = "Dear {$patientinfo_firstname}, your registration is complete! You can now login at our site. Your username: {$useraccount_username} and your password is {$useraccount_password1} Thank you for choosing Organ Donation!";

																if(!$mail->send()) {
																	echo 'Message could not be sent.';
																	echo 'Mailer Error: ' . $mail->ErrorInfo;
																} else {
																	echo '<b> An email has been sent with your information. </b>';
																	$connection->close();   																
																} 
															}
															else
															{
																echo "Could not add power of attorney info"; 
																$connection->close;
															}
														}
														else
														{
															echo "Patient info not inserted";
															$connection->close; 
														}
													}
													else
													{
														if($patientinfo_organ === "heart")
														{
															$queryInsert3 = mysqli_query($connection, "INSERT INTO patientinfo (userID, addressID, patientType, firstName, lastName, title, phoneNumber, email, driversLicense, decisionMakerFlag, liverFlag, heartFlag, kidneyFlag, lungFlag, available, bloodType, height, weight, dob, doctorUserID, patientCond, active) VALUES ('$useraccount_userID', '$randomAddressID', '$patientinfo_patienttype', '$patientinfo_firstname', '$patientinfo_lastname', 'heart', '$patientinfo_phone', '$patientinfo_email', '$patientinfo_driverslicense', FALSE, FALSE, TRUE, FALSE, FALSE, TRUE, '$patientinfo_bloodtype', '$patientinfo_height', '$patientinfo_weight', '$patientinfo_dob', '1997yuna123KDTLW' , '$patientinfo_condition', 1)"); 
														}
															
														else if($patientinfo_organ === "liver")
														{
															$queryInsert3 = mysqli_query($connection, "INSERT INTO patientinfo (userID, addressID, patientType, firstName, lastName, title, phoneNumber, email, driversLicense, decisionMakerFlag, liverFlag, heartFlag, kidneyFlag, lungFlag, available, bloodType, height, weight, dob, doctorUserID, patientCond, active) VALUES ('$useraccount_userID', '$randomAddressID', '$patientinfo_patienttype', '$patientinfo_firstname', '$patientinfo_lastname', 'liver', '$patientinfo_phone', '$patientinfo_email', '$patientinfo_driverslicense', FALSE, TRUE, FALSE, FALSE, FALSE, TRUE, '$patientinfo_bloodtype', '$patientinfo_height', '$patientinfo_weight', '$patientinfo_dob', '6128bren984MNXbW' , '$patientinfo_condition', 1)");
														}
															
														else if($patientinfo_organ === "lung")
														{
																$queryInsert3 = mysqli_query($connection, "INSERT INTO patientinfo (userID, addressID, patientType, firstName, lastName, title, phoneNumber, email, driversLicense, decisionMakerFlag, liverFlag, heartFlag, kidneyFlag, lungFlag, available, bloodType, height, weight, dob, doctorUserID, patientCond, active) VALUES ('$useraccount_userID', '$randomAddressID', '$patientinfo_patienttype', '$patientinfo_firstname', '$patientinfo_lastname', 'lung', '$patientinfo_phone', '$patientinfo_email', '$patientinfo_driverslicense', FALSE, FALSE, FALSE, FALSE, TRUE, TRUE,'$patientinfo_bloodtype', '$patientinfo_height', '$patientinfo_weight', '$patientinfo_dob', '1493aerith84uXEfr', '$patientinfo_condition', 1)"); 
														}
															
														else
														{
															$queryInsert3 = mysqli_query($connection, "INSERT INTO patientinfo (userID, addressID, patientType, firstName, lastName, title, phoneNumber, email, driversLicense, decisionMakerFlag, liverFlag, heartFlag, kidneyFlag, lungFlag, available, bloodType, height, weight, dob, doctorUserID, patientCond, active) VALUES ('$useraccount_userID', '$randomAddressID', '$patientinfo_patienttype', '$patientinfo_firstname', '$patientinfo_lastname', 'kidney', '$patientinfo_phone', '$patientinfo_email', '$patientinfo_driverslicense', FALSE, FALSE, FALSE, TRUE, FALSE, TRUE, '$patientinfo_bloodtype', '$patientinfo_height', '$patientinfo_weight', '$patientinfo_dob', '9477ranko123aMmeN', '$patientinfo_condition', 1)"); 
														}
														
														if($queryInsert3)
														{
															require 'PHPMailerAutoload.php';
															$mail = new PHPMailer;

															//$mail->SMTPDebug = 3;                               // Enable verbose debug output

															$mail->isSMTP();                                      // Set mailer to use SMTP
															$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
															$mail->SMTPAuth = true;                               // Enable SMTP authentication
															$mail->Username = 'donationorgan417@gmail.com';                 // SMTP username
															// SMTP password goes here
															$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
															$mail->Port = 587;                                    // TCP port to connect to

															$mail->setFrom('donationorgan417@gmail.com', "Organ Donation");
															$mail->addAddress($patientinfo_email, $patientinfo_firstname);   // Add a recipient
															$mail->isHTML(true);                                  // Set email format to HTML

															$mail->Subject = "Organ Donation Registration";
															$mail->Body    = "Dear {$patientinfo_firstname}, your registration is complete! You can now login at our site. Your username: {$useraccount_username} and your password is {$useraccount_password1} Thank you for choosing Organ Donation!";

															if(!$mail->send()) 
															{
																echo 'Message could not be sent.';
																echo 'Mailer Error: ' . $mail->ErrorInfo;
															} 
															else 
															{
																echo '<b> An email has been sent with your information. </b>';
																$connection->close(); 
															} 
														}
														else
														{
															echo "Could not add patient info"; 
															$connection->close;
														}
													}
													
												
											}
											else "Error: record not account info not recorded."; 
										}
										else
											echo "Error: record not recorded correctly.";
										
									}
									else
									{
										echo "Password entries are not matching.";
										$connection->close; 
									}
									
								}
								else
								{
									echo "This username is already being used. Try a different username.";
									$connection->close; 
								}
							}
							else 
								echo "<b>Error 1.</b>"; 
						}
						else 
							echo "<b>Error 2.</b>"; 
					 
					
				}
				else
					"<b>Error 3.</b>"; 
			}
		?>
	</div>
</body>
</html>
