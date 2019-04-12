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
<style>
table {
    border-collapse: collapse;
    width: 100%;
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
		<h2 class="title"><font face= "Brush Script MT" size = 13px>The Scheduler</font></h2>
		<div id="sidebar" align = "left">
				<p><b>Enter the username of the doctor and matched pair, and time to schedule them.</b></p><br>
				<fieldset> 
					<p><b>Key:</b><p> 
					<p>Patient Type:<p>
					<p>1 <span>&#8594;</span> Donor<p> 
					<p>2 <span>&#8594;</span> Recipient<p><br>
				</fieldset> 
				<fieldset>
					<form action = "scheduler.php" method = "post"> 
					Doctor Username: <input type="text" name="doctor"> <br> <br> 
					Donor Username: <input type="text" name="donor"> <br> <br> 
					Recipient Username: <input type="text" name="recipient"> <br> <br> 
					Day: <input type="date" name="day"> <br> <br> 
					Time: <input type="time" name="surgeoryTime"> <br> <br>
					<input type="submit" name = "schedulebutton" value = "Match"> <br> <br> 
					
			</div>
		<div id="main-wrap">
			<div id="content-wrap" align="left" style = "overflow-x:auto;">
			<?php
			error_reporting (0); 
			require("connect.php"); 
			if(isset($_POST['schedulebutton']))
			{
				$doctorUser = mysqli_real_escape_string($connection, $_POST['doctor']); 
				$donorUser = mysqli_real_escape_string($connection, $_POST['donor']); 
				$recipientUser = mysqli_real_escape_string($connection, $_POST['recipient']); 
				$day = $_POST['day']; 
				$time = $_POST['surgeoryTime']; 
				
				if($doctorUser && $day && $time && $donorUser && $recipientUser)
				{
					do {
						$randscheduleID = rand(0, 99999); 
						$scheduleQuery = mysqli_query($connection, "SELECT scheduleID 
																	FROM scheduler
																	WHERE scheduleID = '$randscheduleID'"); 
						$numberOfRows = mysqli_num_rows($scheduleQuery); 
						}while ($numberOfRows == 1); 
					
					
					$validateQuery = mysqli_query($connection, "SELECT patientinfo.userID AS 'Recipient User', organs.date_matched AS 'Recipient time', organs.typeOfOrgan AS 'Recipient organ' FROM patientinfo, organs, useraccount WHERE '$recipientUser' = useraccount.userName AND useraccount.userID = organs.userID AND patientinfo.userID = organs.userID AND patientinfo.available = 2 AND patientinfo.patientType = 2"); 
					
					$recipientRow = mysqli_fetch_array($validateQuery); 
					$recipientUser = $recipientRow['Recipient User']; 
					$recipientTime = $recipientRow['Recipient time']; 
					$recipientOrgan = $recipientRow['Recipient organ']; 
					
					$validateQuery2 = mysqli_query($connection, "SELECT patientinfo.userID AS 'Donor User', organs.date_matched AS 'Donor time', organs.typeOfOrgan AS 'Donor organ' FROM patientinfo, organs, useraccount WHERE '$donorUser' = useraccount.userName AND useraccount.userID = organs.donorID AND patientinfo.userID = organs.donorID AND patientinfo.available = 2 AND patientinfo.patientType = 1");
					
					$donorRow = mysqli_fetch_array($validateQuery2); 
					$donorUser = $donorRow['Donor User']; 
					$donorTime = $donorRow['Donor time']; 
					$donorOrgan = $donorRow['Donor organ']; 
					
					$validateQuery3 = mysqli_query($connection, "SELECT doctorUserID, accountinfo.title AS 'Doctor organ' FROM accountinfo, useraccount WHERE useraccount.userID = accountinfo.userID AND '$doctorUser' = useraccount.userName"); 
					$doctorRow = mysqli_fetch_array($validateQuery3); 
					$doctorID = $doctorRow['doctorUserID']; 
					$doctorOrgan = $doctorRow['Doctor organ'];
					$date2 = "2016-04-27";
					//validate that they were the ones matched 
					if($recipientTime == $donorTime && $donorOrgan == $recipientOrgan && $doctorOrgan == $recipientOrgan)
					{
						if(strtotime($day) > strtotime($date2))
						{
							$insert = mysqli_query($connection, "INSERT INTO scheduler VALUES ('$randscheduleID', '$recipientUser', '$donorUser', '$recipientOrgan', '$day', '$time', '$doctorID')"); 
							echo "<b>Scheduling complete!</b>";
							$connection->close(); 
							header("refresh:3; url = scheduler.php");
						}
						else
						{
							echo "<b>Error in scheduling. Check the date.</b>";		
							$connection->close(); 
							header("refresh:3; url = scheduler.php");
						}
					}
					else
					{
						echo "<b>The patients or doctor are not compatiable.</b><br>"; 
						$connection->close(); 
						header("refresh:3; url = scheduler.php");
					}
				}
				else
				{
					echo "<b>Not all fields were entered in.</b>"; 
					$connection->close(); 
					header("refresh:3; url = scheduler.php");
				}
			}
			else
			{
				echo "<b>Current Schedule</b><br><br>"; 
				echo "<table>"; 
				$scheduledQuery = mysqli_query($connection, "SELECT scheduleID, accountinfo.firstName AS 'Doctor First Name', accountinfo.lastName AS 'Doctor Last Name', us1.userName AS 'Donor', us2.userName AS 'Recipient', scheduler.organ AS 'Organ', scheduler.surgery_date AS 'Day', scheduler.surgery_time AS 'Time' FROM scheduler, accountinfo, useraccount AS us1, useraccount AS us2 WHERE scheduler.doctorUserID = accountinfo.doctorUserID AND us1.userID = scheduler.donorID AND us2.userID = scheduler.recipientID"); 
				
				echo "<tr> <th>Schedule ID</th>  <th>First Name</th>  <th>Last Name</th> <th>Donor</th> <th>Recipient</th> <th>Organ</th> <th>Day</th> <th>Time</th> </tr>";
				while($scheduledRow = mysqli_fetch_array($scheduledQuery))
				{
					echo "<tr><td>" . $scheduledRow['scheduleID'] . "</td> <td>" . $scheduledRow['Doctor First Name'] . "</td> <td>" . $scheduledRow['Doctor Last Name'] . "</td> <td>" . $scheduledRow['Donor'] . "</td> <td>" . $scheduledRow['Recipient'] . "</td> <td>" . $scheduledRow['Organ'] . "</td> <td>" . $scheduledRow['Day'] . "</td> <td>" . $scheduledRow['Time'] . "</td><tr>";
				}
				echo "</table><br><br>"; 
				
				
				echo "<b>Current Matched Patients</b>"; 
				$query = mysqli_query($connection, "SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.title AS 'Organ', patientinfo.bloodType AS 'Blood Type', patientinfo.patientType AS 'Patient Type', organs.date_matched AS 'Date Matched'   
												FROM useraccount, patientinfo, organs
												WHERE useraccount.userID = patientinfo.userID AND patientinfo.userID = organs.userID AND patientinfo.available = 2
												UNION
												SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.title AS 'Organ', patientinfo.bloodType AS 'Blood Type', patientinfo.patientType AS 'Patient Type', organs.date_matched AS 'Date Matched'
												FROM useraccount, patientinfo, organs
												WHERE useraccount.userID = patientinfo.userID AND patientinfo.userID = organs.donorID AND patientinfo.available = 2
												ORDER BY 7"); 									
				
			echo "<table>"; 
			echo "<tr> <th>Username</th>  <th>First Name</th>  <th>Last Name</th>  <th>Organ</th> <th>Blood Type</th> <th>Patient Type</th> <th>Date Matched</th> </tr>"; 
			while($row = mysqli_fetch_array($query))
						{   //Creates a loop to loop through results
							echo "<tr><td>" . $row['Username'] . "</td> <td>" . $row['First Name'] . "</td> <td>" . $row['Last Name'] . "</td> <td>" . $row['Organ'] . "</td> <td>" .$row['Blood Type'] . "</td> <td>" . $row['Patient Type'] .  "</td> <td>" . $row['Date Matched'] . "</td><tr>";  
						}
			echo "</table><br><br>";
			
			echo "<b>Doctors</b>"; 
			$query2 = mysqli_query($connection, "SELECT useraccount.userName AS 'Username', accountinfo.firstName AS 'First Name', accountinfo.lastName AS 'Last Name', accountinfo.title AS 'Specialty', accountinfo.phoneNumber AS 'Phone Number', accountinfo.email AS 'Email' FROM accountinfo, useraccount WHERE useraccount.userID = accountinfo.userID AND accountinfo.userType = 1 ORDER BY 3 ASC"); 
			
			echo "<table>"; 
			echo "<tr> <th>Username</th>  <th>First Name</th>  <th>Last Name</th>  <th>Specialty</th> <th>Phone Number</th> <th>Email</th> </tr>";
			while($row2 = mysqli_fetch_array($query2))
			{   //Creates a loop to loop through results
				echo "<tr><td>" . $row2['Username'] . "</td> <td>" . $row2['First Name'] . "</td> <td>" . $row2['Last Name'] . "</td> <td>" . $row2['Specialty'] . "</td> <td>" .$row2['Phone Number'] . "</td> <td>" . $row2['Email'] . "</td><tr>";  
			}
			echo "</table><br><br>";
				$connection->close(); 
			}
			?>
			</div>
	</div>
	</div>
</body>
</html>
