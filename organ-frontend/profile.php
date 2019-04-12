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
  <title>Profile Page</title>
  <link rel = "stylesheet" type = "text/css" href = "style.css"/>
</head>
<body>
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
<style>
table {
    border-collapse: collapse;
    width: 90%;
	height: 90:
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #E6211E;
    color: white;
}
</style>
	<p>&nbsp;</p> 
	<div class = "priority" align = "center">
	<div id="header"><h2 class="title" align = "center"><font face= "Brush Script MT" size = 13px>Profile</font></h2></div>
	<div id="main-wrap">
		<div id="content-wrap" style = "overflow-x:auto;">
		<p>&nbsp;</p>
		<?php
		error_reporting (0); 
			if($datebasePatientFlag == 1)
			{
				require("connect.php");
				$query = mysqli_query($connection, "SELECT DISTINCT patientinfo.firstName, patientinfo.lastName, patientinfo.phoneNumber, patientinfo.email, patientinfo.title AS 'Organ', patientinfo.bloodType, patientinfo.height, patientinfo.weight FROM patientinfo, accountinfo WHERE '$userID' = patientinfo.userID ORDER BY 1 ASC"); 
				echo "<b>Profile Information</b>"; 
				echo "<table>"; // start a table tag in the HTML
				echo "<tr> <th>First Name</th> <th>Last Name</th> <th>Phone Number</th> <th>Email</th> <th>Organ</th> <th>Blood Type</th> <th>Height</th> <th>Weight</th> <tr> "; 
				while($row = mysqli_fetch_array($query))
				{   //Creates a loop to loop through results
					echo "<tr><td>" . $row['firstName'] . "</td> <td>" . $row['lastName'] . "</td> <td>" .$row['phoneNumber'] . "</td> <td>" . $row['email'] . "</td> <td>" .$row['Organ'] . "</td> <td>" . $row['bloodType'] . "</td> <td>" . $row['height'] . "</td> <td>" . $row['weight'] . "</td></tr>";  //$row['index'] the index here is a field name
				}
				echo "</table><br><br>"; 
				echo "<b>Doctor Information</b>"; 
				
				$query2 = mysqli_query($connection, "SELECT accountinfo.firstName AS 'First Name', accountinfo.lastName AS 'Last Name', accountinfo.phoneNumber AS 'Phone Number', accountinfo.email AS 'Email' FROM accountinfo, patientinfo WHERE '$userID' = patientinfo.userID AND patientinfo.doctorUserID = accountinfo.doctorUserID"); 
				
				echo "<table>"; 
				echo "<tr> <th>First Name</th> <th>Last Name</th> <th>Phone Number</th> <th>Email</th>"; 
				while($row2 = mysqli_fetch_array($query2))
				{   //Creates a loop to loop through results
					echo "<tr><td>" . $row2['First Name'] . "</td> <td>" . $row2['Last Name'] . "</td> <td>" .$row2['Phone Number'] . "</td> <td>" . $row2['Email'] . "</td></tr>";  //$row['index'] the index here is a field name
				}
				echo "</table><br><br>"; //Close the table in HTML 
				
				
				$query3 = mysqli_query($connection, "SELECT available FROM patientinfo WHERE '$userID' = userID"); 
				$row3 = mysqli_fetch_array($query3); 
				$status = $row3['available']; 
				if($status == 1)
				{
					echo "<b>We are in the process of finding a match for you. We appreciate your patience.</b>"; 
				}
				else if($status == 2) 
				{
					echo "<b>Congratulations, you have been matched! Your doctor will notify you for further directions soon.</b>"; 
				}
				else
				{
					echo "<b>Your surgery has been scheduled</b><br>"; 
					$appointmentQuery1 = mysqli_query($connection, "SELECT patientType FROM patientinfo WHERE userID = '$userID'"); 
					$patientrow = mysqli_fetch_array($appointmentQuery1); 
					if($patientrow == 1)
					{
						$appointmentQuery = mysqli_query($connection, "SELECT accountinfo.firstName AS 'Doctor First Name', accountinfo.lastName AS 'Doctor Last Name', accountinfo.phoneNumber AS 'Phone Number', accountinfo.email AS 'Email', scheduler.surgery_date AS 'Day', scheduler.surgery_time AS 'Time' FROM scheduler, accountinfo, patientinfo WHERE scheduler.doctorUserID = accountinfo.doctorUserID AND patientinfo.userID = '$userID' AND patientinfo.userID = scheduler.donorID"); 
						echo "<table>"; 
						echo "<tr> <th>Doctor First Name</th> <th>Doctor Last Name</th> <th>Phone Number</th> <th>Email</th> <th>Surgery Date</th> <th>Time</th>"; 
						while($appointmentRow = mysqli_fetch_array($appointmentQuery))
						{   //Creates a loop to loop through results
							echo "<tr><td>" . $appointmentRow['Doctor First Name'] . "</td> <td>" . $appointmentRow['Doctor Last Name'] . "</td> <td>" . $appointmentRow['Phone Number'] . "</td> <td>" . $appointmentRow['Email'] . "</td> <td>" . $appointmentRow['Day'] . "</td> <td>" . $appointmentRow['Time'] . "</td></tr>";  //$row['index'] the index here is a field name
						}
						echo "</table><br><br>"; //Close the table in HTML 
					}
					else
					{
						$appointmentQuery = mysqli_query($connection, "SELECT accountinfo.firstName AS 'Doctor First Name', accountinfo.lastName AS 'Doctor Last Name', accountinfo.phoneNumber AS 'Phone Number', accountinfo.email AS 'Email', scheduler.surgery_date AS 'Day', scheduler.surgery_time AS 'Time' FROM scheduler, accountinfo, patientinfo WHERE scheduler.doctorUserID = accountinfo.doctorUserID AND patientinfo.userID = '$userID' AND patientinfo.userID = scheduler.recipientID"); 
						echo "<table>"; 
						echo "<tr> <th>Doctor First Name</th> <th>Doctor Last Name</th> <th>Phone Number</th> <th>Email</th> <th>Surgery Date</th> <th>Time</th>"; 
						while($appointmentRow = mysqli_fetch_array($appointmentQuery))
						{   //Creates a loop to loop through results
							echo "<tr><td>" . $appointmentRow['Doctor First Name'] . "</td> <td>" . $appointmentRow['Doctor Last Name'] . "</td> <td>" . $appointmentRow['Phone Number'] . "</td> <td>" . $appointmentRow['Email'] . "</td> <td>" . $appointmentRow['Day'] . "</td> <td>" . $appointmentRow['Time'] . "</td></tr>";  //$row['index'] the index here is a field name
						}
						echo "</table><br><br>"; //Close the table in HTML 
					}
				}
			}
			else
			{
				require("connect.php");
				$query2 = mysqli_query($connection, "SELECT accountinfo.firstName, accountinfo.lastName, accountinfo.phoneNumber, accountinfo.email FROM accountinfo WHERE '$userID' = userID ORDER BY 1 ASC"); 
				echo "<table>"; // start a table tag in the HTML
				echo "<tr> <th>First Name</th> <th>Last Name</th> <th>Phone Number</th> <th>Email</th> <tr>"; 
				while($row2 = mysqli_fetch_array($query2))
				{   //Creates a loop to loop through results
					echo "<tr><td>" . $row2['firstName'] . "</td> <td>" . $row2['lastName'] . "</td> <td>" .$row2['phoneNumber'] . "</td> <td>" . $row2['email'] . "</td></tr>";  
				}
				echo "</table><br><br>"; //Close the table in HTML 
				
				if($databaseUserType == "1")
				{
					echo "<b>Donor Patients</b>"; 
					$query3 = mysqli_query($connection, "SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.email AS 'Email', patientinfo.bloodType AS 'Blood Type', patientinfo.title AS 'Organ' FROM patientinfo, useraccount, accountinfo WHERE patientinfo.userID = useraccount.userID AND useraccount.active = 1 AND patientinfo.available = '1' AND patientinfo.title = '$databaseTitle' AND patientinfo.patientType = '1' AND accountinfo.userID = '$userID' AND patientinfo.doctorUserID = accountinfo.doctorUserID ORDER BY 2"); 
				
					echo "<table>"; // start a table tag in the HTML
					echo "<tr> <th>Username</th> <th>First Name</th> <th>Last Name</th> <th>Email</th> <th>Blood Type</th> <th>Organ</th> <tr> "; 
					while($row3 = mysqli_fetch_array($query3))
					{   //Creates a loop to loop through results
						echo "<tr><td>" . $row3['Username'] . "</td> <td>" . $row3['First Name'] . "</td> <td>" . $row3['Last Name'] . "</td> <td>" . $row3['Email'] . "</td> <td>" .$row3['Blood Type'] . "</td> <td>" . $row3['Organ'] . "</td></tr>";  //$row['index'] the index here is a field name
					}
					echo "</table><br><br>"; //Close the table in HTML 
					
					echo "<b>Recipient Patients</b>"; 
					$query3 = mysqli_query($connection, "SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.email AS 'Email', patientinfo.bloodType AS 'Blood Type', patientinfo.title AS 'Organ' FROM patientinfo, useraccount, accountinfo WHERE patientinfo.userID = useraccount.userID AND useraccount.active = 1 AND patientinfo.available = '1' AND patientinfo.title = '$databaseTitle' AND patientinfo.patientType = '2' AND accountinfo.userID = '$userID' AND patientinfo.doctorUserID = accountinfo.doctorUserID ORDER BY 2"); 
				
					echo "<table>"; // start a table tag in the HTML
					echo "<tr> <th>Username</th> <th>First Name</th> <th>Last Name</th> <th>Email</th> <th>Blood Type</th> <th>Organ</th> <tr> "; 
					while($row3 = mysqli_fetch_array($query3))
					{   //Creates a loop to loop through results
						echo "<tr><td>" . $row3['Username'] . "</td> <td>" . $row3['First Name'] . "</td> <td>" . $row3['Last Name'] . "</td> <td>" . $row3['Email'] . "</td> <td>" .$row3['Blood Type'] . "</td> <td>" . $row3['Organ'] . "</td></tr>";  //$row['index'] the index here is a field name
					}
					echo "</table><br><br>"; //Close the table in HTML 
					
					echo "<b>Scheduled Surgeries</b><br>"; 
					echo "<table>"; 
					echo"<tr> <th>Donor</th> <th>Recipient</th> <th>Day</th> <th>Time</th> <tr> ";
					$surgeryQuery = mysqli_query($connection, "SELECT CONCAT(pa1.firstName, ' ', pa1.lastName) AS 'Donor', CONCAT(pa2.firstName, ' ', pa2.lastName) AS 'Recipient', scheduler.surgery_date AS 'Day', scheduler.surgery_time AS 'Time' FROM scheduler, accountinfo, patientinfo pa1, patientinfo pa2 WHERE scheduler.doctorUserID = accountinfo.doctorUserID AND accountinfo.userID = '$userID' AND pa1.userID = scheduler.donorID AND pa2.userID = scheduler.recipientID"); 
					while($surgeryRow = mysqli_fetch_array($surgeryQuery))
					{   //Creates a loop to loop through results
						echo "<tr><td>" . $surgeryRow['Donor'] . "</td> <td>" . $surgeryRow['Recipient'] . "</td> <td>" . $surgeryRow['Day'] . "</td> <td>" . $surgeryRow['Time'] . "</td></tr>";  //$row['index'] the index here is a field name
					}
					echo "</table><br><br>"; //Close the table in HTML 
				}
				else //managers
				{
					echo "<b>Donor Patients</b>"; 
					$query3 = mysqli_query($connection, "SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.email AS 'Email', patientinfo.bloodType AS 'Blood Type', patientinfo.title AS 'Organ' FROM patientinfo, useraccount WHERE patientinfo.userID = useraccount.userID AND useraccount.active = 1 AND patientinfo.available = '1' AND patientinfo.patientType = '1' ORDER BY 2"); 
				
					echo "<table>"; // start a table tag in the HTML
					echo "<tr> <th>Username</th> <th>First Name</th> <th>Last Name</th> <th>Email</th> <th>Blood Type</th> <th>Organ</th> <tr> "; 
					while($row3 = mysqli_fetch_array($query3))
					{   //Creates a loop to loop through results
						echo "<tr><td>" . $row3['Username'] . "</td> <td>" . $row3['First Name'] . "</td> <td>" . $row3['Last Name'] . "</td> <td>" . $row3['Email'] . "</td> <td>" .$row3['Blood Type'] . "</td> <td>" . $row3['Organ'] . "</td></tr>";  //$row['index'] the index here is a field name
					}
					echo "</table><br><br>"; //Close the table in HTML 
					
					echo "<b>Recipient Patient Waitlist</b>"; 
					$query3 = mysqli_query($connection, "SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.email AS 'Email', patientinfo.bloodType AS 'Blood Type', patientinfo.title AS 'Organ', waitlistScore AS 'Wait List Score' FROM patientinfo, useraccount, waitlist WHERE patientinfo.userID = useraccount.userID AND useraccount.active = 1 AND patientinfo.available = '1' AND patientinfo.patientType = '2' AND waitlist.userID = useraccount.userID AND waitlist.userID = patientinfo.userID AND waitlistScore ORDER BY 2"); 
				
					echo "<table>"; // start a table tag in the HTML
					echo "<tr> <th>Username</th> <th>First Name</th> <th>Last Name</th> <th>Email</th> <th>Blood Type</th> <th>Organ</th> <th>Score</th><tr> "; 
					while($row3 = mysqli_fetch_array($query3))
					{   //Creates a loop to loop through results
						echo "<tr><td>" . $row3['Username'] . "</td> <td>" . $row3['First Name'] . "</td> <td>" . $row3['Last Name'] . "</td> <td>" . $row3['Email'] . "</td> <td>" .$row3['Blood Type'] . "</td> <td>" . $row3['Organ'] . "</td> <td>" . $row3['Wait List Score'] . "</td></tr>";  //$row['index'] the index here is a field name
					}
					echo "</table><br><br>"; //Close the table in HTML 
				}
			}
			$connection->close(); 
		?>
		</div>
			<div id="sidebar" align = "left">
				<?php
					echo "<b>Welcome, {$username}</b><br>"; 
					echo "<fieldset>"; 
					echo "<a href = 'http://localhost:8080/POA_Management.php'> Power of Attorney Management </a><br>";
					echo "<a href = 'http://localhost:8080/changepassword.php'> Change Password </a><br>"; 
					echo "<a href = 'http://localhost:8080/deactivate.php'> Deactivate Acount </a><br>";
					echo "</fieldset>"; 
				?>
			</div>
		</div>
		</div>
</body>
</html>