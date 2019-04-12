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
  <title>Reports Page</title>
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
	<div id="header"><h2 class="title" align = "center"><font face= "Brush Script MT" size = 13px>Reports</font></h2></div>
	<div id="main-wrap">
		<div id="content-wrap" style = "overflow-x:auto;">
		<p>&nbsp;</p>
		<?php
		error_reporting(0);
		require("connect.php"); 
		if($databaseUserType == 2)
		{
			$query = mysqli_query($connection, "SELECT COUNT(patientinfo.userID) AS 'Number Of Heart Patients' 
												FROM patientinfo 
												WHERE title = 'heart'"); 
			$row = mysqli_fetch_array($query); 
			
			$query2 = mysqli_query($connection, "SELECT COUNT(patientinfo.userID) AS 'Number Of Lung Patients' 
												FROM patientinfo 
												WHERE title = 'lung'");
			$row2 = mysqli_fetch_array($query2); 
			
			$query3 = mysqli_query($connection, "SELECT COUNT(patientinfo.userID) AS 'Number Of Kidney Patients' FROM patientinfo WHERE title = 'kidney'"); 
			$row3 = mysqli_fetch_array($query3); 
			
			$query4 = mysqli_query($connection, "SELECT COUNT(patientinfo.userID) AS 'Number Of Liver Patients' 
												FROM patientinfo 
												WHERE title = 'liver'"); 
			$row4 = mysqli_fetch_array($query4); 
			
			//organ count 
			echo "<b>Number of Available Patients</b>"; 
			echo "<table>"; 
			echo "<tr> <th>Heart Patients</th>  <th>Lung Patients</th>  <th>Kidney Patients</th>  <th>Liver Patients</th> </tr>"; 
			echo "<tr><td>" . $row['Number Of Heart Patients'] . "</td> <td>" . $row2['Number Of Lung Patients'] . "</td> <td>" . $row3['Number Of Kidney Patients'] . "</td> <td>" . $row4['Number Of Liver Patients'] . "</td></tr>"; 
			echo "</table><br><br>"; 
			
			$query5 = mysqli_query($connection, "SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.title AS 'Organ', patientinfo.bloodType AS 'Blood Type', patientinfo.patientType AS 'Patient Type', organs.date_matched AS 'Date Matched'   
												FROM useraccount, patientinfo, organs
												WHERE useraccount.userID = patientinfo.userID AND patientinfo.userID = organs.userID 
												UNION
												SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.title AS 'Organ', patientinfo.bloodType AS 'Blood Type', patientinfo.patientType AS 'Patient Type', organs.date_matched AS 'Date Matched'
												FROM useraccount, patientinfo, organs
												WHERE useraccount.userID = patientinfo.userID AND patientinfo.userID = organs.donorID
												ORDER BY 7"); 
			
			//bloodtype count
			$bloodQuery = mysqli_query($connection, "SELECT COUNT(patientinfo.userID) AS 'O' 
												FROM patientinfo 
												WHERE patientinfo.bloodType = 'O+' OR patientinfo.bloodType = 'O-'"); 
			$bloodrow1 = mysqli_fetch_array($bloodQuery); 
			
			$bloodQuery2 = mysqli_query($connection, "SELECT COUNT(patientinfo.userID) AS 'A' 
												FROM patientinfo 
												WHERE patientinfo.bloodType = 'A+' OR patientinfo.bloodType = 'A-'"); 
			$bloodrow2 = mysqli_fetch_array($bloodQuery2); 
			
			$bloodQuery3 = mysqli_query($connection, "SELECT COUNT(patientinfo.userID) AS 'B' 
													FROM patientinfo 
													WHERE patientinfo.bloodType = 'B+' OR patientinfo.bloodType = 'B-'"); 
			$bloodrow3 = mysqli_fetch_array($bloodQuery3); 
			
			$bloodQuery4 = mysqli_query($connection, "SELECT COUNT(patientinfo.userID) AS 'AB' 
													FROM patientinfo 
													WHERE patientinfo.bloodType = 'AB+' OR patientinfo.bloodType = 'AB-'"); 
			$bloodrow4 = mysqli_fetch_array($bloodQuery4);
			
			echo "<b>Blood Type</b>"; 
			echo "<table>"; 
			echo "<tr> <th>O</th>  <th>A</th>  <th>B</th>  <th>AB</th> </tr>";
			echo "<tr><td>" . $bloodrow1['O'] . "</td> <td>" . $bloodrow2['A'] . "</td> <td>" . $bloodrow3['B'] . "</td> <td>" . $bloodrow4['AB'] . "</td></tr>"; 
			echo "</table><br><br>"; 
			
			echo "<b>Matched Patients </b>"; 
			echo "<table>"; 
			echo "<tr> <th>Username</th>  <th>First Name</th>  <th>Last Name</th>  <th>Organ</th> <th>Blood Type</th> <th>Patient Type</th> <th>Date Matched</th> </tr>"; 
			while($row5 = mysqli_fetch_array($query5))
						{   //Creates a loop to loop through results
							echo "<tr><td>" . $row5['Username'] . "</td> <td>" . $row5['First Name'] . "</td> <td>" . $row5['Last Name'] . "</td> <td>" . $row5['Organ'] . "</td> <td>" .$row5['Blood Type'] . "</td> <td>" . $row5['Patient Type'] .  "</td> <td>" . $row5['Date Matched'] . "</td><tr>";  
						}
			echo "</table>";
		}
		else //doctor
		{
			$query = mysqli_query($connection, "SELECT COUNT(patientinfo.userID) AS 'Number of Patients'
												FROM patientinfo, accountinfo
												WHERE patientinfo.title = '$databaseTitle' AND accountinfo.userID = '$userID' AND patientinfo.doctorUserID = accountinfo.doctorUserID"); 
			$row = mysqli_fetch_array($query); 
			$numbOfPatients = $row['Number of Patients']; 
			echo "<b>Patient Count: $numbOfPatients</b><br><br>"; 
			
			if($numbOfPatients > 0)
			{
				//bloodtype count
				$bloodQuery = mysqli_query($connection, "SELECT COUNT(patientinfo.userID) AS 'O' 
													FROM patientinfo, accountinfo 
													WHERE patientinfo.title = '$databaseTitle' AND accountinfo.userID = '$userID' AND patientinfo.doctorUserID = accountinfo.doctorUserID AND patientinfo.bloodType LIKE 'O%'"); 
				$bloodrow1 = mysqli_fetch_array($bloodQuery); 
				
				$bloodQuery2 = mysqli_query($connection, "SELECT COUNT(patientinfo.userID) AS 'A' 
													FROM patientinfo, accountinfo
													WHERE patientinfo.title = '$databaseTitle' AND accountinfo.userID = '$userID' AND patientinfo.doctorUserID = accountinfo.doctorUserID AND patientinfo.bloodType LIKE 'A%'"); 
				$bloodrow2 = mysqli_fetch_array($bloodQuery2); 
				
				$bloodQuery3 = mysqli_query($connection, "SELECT COUNT(patientinfo.userID) AS 'B' 
														FROM patientinfo, accountinfo
														WHERE patientinfo.title = '$databaseTitle' AND accountinfo.userID = '$userID' AND patientinfo.doctorUserID = accountinfo.doctorUserID AND patientinfo.bloodType LIKE 'B%'"); 
				$bloodrow3 = mysqli_fetch_array($bloodQuery3); 
				
				$bloodQuery4 = mysqli_query($connection, "SELECT COUNT(patientinfo.userID) AS 'AB' 
														FROM patientinfo, accountinfo
														WHERE patientinfo.title = '$databaseTitle' AND accountinfo.userID = '$userID' AND patientinfo.doctorUserID = accountinfo.doctorUserID AND patientinfo.bloodType LIKE 'AB%'"); 
				$bloodrow4 = mysqli_fetch_array($bloodQuery4); 
				
				echo "<table>";
				echo "<b>Blood Type</b>"; 
				echo "<table>"; 
				echo "<tr> <th>O</th>  <th>A</th>  <th>B</th>  <th>AB</th> </tr>";
				echo "<tr><td>" . $bloodrow1['O'] . "</td> <td>" . $bloodrow2['A'] . "</td> <td>" . $bloodrow3['B'] . "</td> <td>" . $bloodrow4['AB'] . "</td></tr>"; 
				echo "</table><br><br>";
				
				$query5 = mysqli_query($connection, "SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.title AS 'Organ', patientinfo.bloodType AS 'Blood Type', patientinfo.patientType AS 'Patient Type'    
													FROM useraccount, patientinfo, organs, accountinfo
													WHERE useraccount.userID = patientinfo.userID AND patientinfo.userID = organs.userID AND patientinfo.title = '$databaseTitle' AND accountinfo.userID = '$userID' AND patientinfo.doctorUserID = accountinfo.doctorUserID 
													UNION
													SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.title AS 'Organ', patientinfo.bloodType AS 'Blood Type', patientinfo.patientType AS 'Patient Type'
													FROM useraccount, patientinfo, organs, accountinfo
													WHERE useraccount.userID = patientinfo.userID AND patientinfo.userID = organs.donorID AND patientinfo.title = '$databaseTitle' AND accountinfo.userID = '$userID' AND patientinfo.doctorUserID = accountinfo.doctorUserID");
				
				echo "<b>Matched Patients </b>"; 
				echo "<table>"; 
				echo "<tr> <th>Username</th>  <th>First Name</th>  <th>Last Name</th>  <th>Organ</th> <th>Blood Type</th> <th>Patient Type</th> </tr>"; 
				while($row5 = mysqli_fetch_array($query5))
						{   //Creates a loop to loop through results
							echo "<tr><td>" . $row5['Username'] . "</td> <td>" . $row5['First Name'] . "</td> <td>" . $row5['Last Name'] . "</td> <td>" . $row5['Organ'] . "</td> <td>" .$row5['Blood Type'] . "</td> <td>" . $row5['Patient Type'] . "</td><tr>" . "</td></tr>";  
						}
				echo "</table>";
			}
			$connection->close(); 
		}
		?>
		</div>
			<div id="sidebar" align = "left">
				<?php
					echo "<b>Key:</b><br>"; 
					echo "<fieldset>"; 
					echo "Patient Type:<br>";
					echo "1 <span>&#8594;</span> Donor<br>"; 
					echo "2 <span>&#8594;</span> Recipient<br><br>";
					echo "Matched Patients:<br>"; 
					echo "Every 2 rows represents a matched pair."; 
					echo "</fieldset>"; 
				?>
			</div>
		</div>
		</div>
</body>
</html>