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
	<div id="header"><h2 class="title" align = "center"><font face= "Brush Script MT" size = 13px>Matching</font></h2></div>
	<div id="main-wrap">
	<div id="sidebar">
	<form action = "matching.php" method = "post">
		<fieldset>
	<legend><b>Sort By</b></legend>
	<input type="radio" name="sort" value="1" checked> Username<br> 
	<input type="radio" name="sort" value="2"> First Name<br> 
	<input type="radio" name="sort" value="3"> Last Name<br>
	<input type="radio" name="sort" value="4"> Email<br> 
	<input type="radio" name="sort" value="5"> Blood Type<br>
	<input type="radio" name="sort" value="6"> Organ<br>
	<input type="radio" name="sort" value="7"> Score<br><br>
	
	<p><b>Order</b></p>
	<input type="radio" name="order" value="ASC"> Ascending<br>
	<input type="radio" name="order" value="DESC" checked> Descending<br> 
	<input type="submit" name = "sortbutton" value = "Sort"> <br> <br> 
	<p>&nbsp;</p>
	
	<p>Enter the username of the donor and recipient to match</p>
	<form action = "matching.php" method = "post"> 
	<legend><b>Matching</b></legend>
	Donor: <input type="text" name="donor"> <br> <br> 
	Recipient: <input type="text" name="recipient"> <br> <br> 
	<input type="submit" name = "matchbutton" value = "Match"> <br> <br> 
	</div>
		<div id="content-wrap" style = "overflow-x:auto;">
		<?php
			error_reporting (0);
			require("connect.php");
			if(isset($_POST['sortbutton']))
			{
				$sortVariable = (int)$_POST['sort'];
				$orderVariable = $_POST['order']; 
				
				if($sortVariable == 7)
				{
					echo "<b>Donors</b>"; 
					$donorQuery = mysqli_query($connection, "SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.email AS 'Email', patientinfo.bloodType AS 'Blood Type', patientinfo.title AS 'Organ' FROM patientinfo, useraccount, accountinfo WHERE patientType = 1 AND patientinfo.userID = useraccount.userID AND patientinfo.doctorUserID = accountinfo.doctorUserID AND patientinfo.available = 1 AND useraccount.active = 1 AND patientinfo.title = '$databaseTitle' AND accountinfo.userID = '$userID' ORDER BY 6 $orderVariable"); 
					
					echo "<table>"; // start a table tag in the HTML
					echo "<tr> <th>Username</th> <th>First Name</th> <th>Last Name</th> <th>Email</th> <th>Blood Type</th> <th>Organ</th> <tr> "; 
					while($donorRow = mysqli_fetch_array($donorQuery))
					{   //Creates a loop to loop through results
						echo "<tr><td>" . $donorRow['Username'] . "</td> <td>" . $donorRow['First Name'] . "</td> <td>" . $donorRow['Last Name'] . "</td> <td>" . $donorRow['Email'] . "</td> <td>" . $donorRow['Blood Type'] . "</td> <td>" . $donorRow['Organ'] . "</td></tr>";  //$row['index'] the index here is a field name
					}
					echo "</table><br><br>"; //Close the table in HTML 
				}
				else
				{
					echo "<b>Donors</b>"; 
					$donorQuery = mysqli_query($connection, "SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.email AS 'Email', patientinfo.bloodType AS 'Blood Type', patientinfo.title AS 'Organ' FROM patientinfo, useraccount, accountinfo WHERE patientType = 1 AND patientinfo.userID = useraccount.userID AND patientinfo.doctorUserID = accountinfo.doctorUserID AND patientinfo.available = 1 AND useraccount.active = 1 AND patientinfo.title = '$databaseTitle' AND accountinfo.userID = '$userID' ORDER BY $sortVariable $orderVariable"); 
					
					echo "<table>"; // start a table tag in the HTML
					echo "<tr> <th>Username</th> <th>First Name</th> <th>Last Name</th> <th>Email</th> <th>Blood Type</th> <th>Organ</th> <tr> "; 
					while($donorRow = mysqli_fetch_array($donorQuery))
					{   //Creates a loop to loop through results
						echo "<tr><td>" . $donorRow['Username'] . "</td> <td>" . $donorRow['First Name'] . "</td> <td>" . $donorRow['Last Name'] . "</td> <td>" . $donorRow['Email'] . "</td> <td>" . $donorRow['Blood Type'] . "</td> <td>" . $donorRow['Organ'] . "</td></tr>";  //$row['index'] the index here is a field name
					}
					echo "</table><br><br>"; //Close the table in HTML 
				}
				
				echo "<b>Recipient Waitlist</b>";
				$queryRecipients = mysqli_query($connection, "SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.email AS 'Email', patientinfo.bloodType AS 'Blood Type', patientinfo.title AS 'Organ', waitlist.waitlistScore AS 'Score' FROM useraccount, patientinfo, waitlist, accountinfo WHERE useraccount.active = 1 AND patientinfo.patientType = 2 AND patientinfo.available = 1 AND useraccount.userID = patientinfo.userID AND patientinfo.userID = waitlist.userID AND patientinfo.title = '$databaseTitle' AND patientinfo.doctorUserID = accountinfo.doctorUserID AND accountinfo.userID = '$userID' AND accountinfo.userID = '$userID' ORDER BY $sortVariable $orderVariable"); 
				echo "<table>"; // start a table tag in the HTML
				echo "<tr> <th>Username</th> <th>First Name</th> <th>Last Name</th> <th>Email</th> <th>Blood Type</th> <th>Organ</th> <th>Score</th> <tr> "; 
				while($recipientRow = mysqli_fetch_array($queryRecipients))
				{
					echo "<tr><td>" . $recipientRow['Username'] . "</td> <td>" . $recipientRow['First Name'] . "</td> <td>" . $recipientRow['Last Name'] . "</td> <td>" . $recipientRow['Email'] . "</td> <td>" . $recipientRow['Blood Type'] . "</td> <td>" . $recipientRow['Organ'] . "</td> <td>" . $recipientRow['Score'] . "</td></tr>";  //$row['index'] the index here is a field name
				}
				
				$connection->close(); 
			}
			else if(isset($_POST['matchbutton']))
			{
				$donorVariable = mysqli_real_escape_string($connection, $_POST['donor']); 
				$recipientVariable = mysqli_real_escape_string($connection, $_POST['recipient']); 
				
				if($donorVariable && $recipientVariable)
				{
					$checkPatient = mysqli_query($connection, "SELECT DISTINCT patientinfo.userID AS 'userID', patientinfo.title AS 'title', patientinfo.bloodType AS 'bloodType' FROM patientinfo, useraccount WHERE '$donorVariable' = useraccount.userName AND useraccount.userID = patientinfo.userID AND patientinfo.available = 1 AND patientinfo.patientType = 1 AND useraccount.active = 1"); 
					$numberOfSelectRows = mysqli_num_rows($checkPatient); 
					if($numberOfSelectRows == 1)
					{
						$row = mysqli_fetch_assoc($checkPatient);
						$donorUser = $row['userID']; 
						$donorBlood = $row['bloodType'];
						$donorOrgan = $row['title'];
						$checkrRecipientPatient = mysqli_query($connection, "SELECT DISTINCT patientinfo.userID AS 'userID', patientinfo.title AS 'title', patientinfo.bloodType AS 'bloodType' FROM patientinfo, useraccount WHERE '$recipientVariable' = useraccount.userName AND useraccount.userID = patientinfo.userID AND patientinfo.available = 1 AND patientinfo.patientType = 2 AND useraccount.active = 1"); 
						$numberOfSelectRows = mysqli_num_rows($checkrRecipientPatient); 
						if($numberOfSelectRows == 1)
						{
							$row2 = mysqli_fetch_assoc($checkrRecipientPatient);
							$recipientUser = $row2['userID']; 
							$recipientOrgan = $row2['title']; 
							$recipientBlood = $row2['bloodType']; 
							if($donorOrgan === $recipientOrgan )
							{
								$posneg = array('+', '-'); 
								$recipientBlood2 = (string)$recipientBlood; 
								$donorBlood2 = (string)$donorBlood; 
								$recipientBlood2 = str_replace($posneg, "", $recipientBlood);
								$donorBlood2 = str_replace($posneg, "", $donorBlood);

								if($recipientBlood2 == $donorBlood2 || $donorBlood2 == "O" || $recipientBlood2 == "AB")
								{
									$insertOrgan = mysqli_query($connection, "INSERT INTO organs VALUES ('$recipientUser', '$donorUser', '$recipientOrgan', '$recipientBlood', NOW())"); 
									$updatePatientinfo =  mysqli_query($connection, "UPDATE waitlist SET waitlistScore = -1 WHERE '$recipientUser' = userID"); 
									echo "<b>You've made a match. The patients will be notified by email.</b>";
									$connection->close(); 
									header("refresh:3;url=matching.php");
								}
								else
								{
									echo "<b>Incompatiable blood types</b>"; 
									$connection->close(); 
									header("refresh:2;url=matching.php");
								}
							}
							else
							{
								echo "The organs of the recipient and donor do not match."; 
								$connetion->close(); 
								header("refresh:2;url=matching.php");
							}
						}
						else
						{
							echo "Check the recipient username"; 
							$connection->close(); 
							header("refresh:2;url=matching.php");
						}
					}
					else
					{
						echo "Check the username for the donor"; 
						$connection->close(); 
						header("refresh:2;url=matching.php");
					}
				}
				else
				{
					echo "Please enter in all fields"; 
					header("refresh:2;url=matching.php");
				}
			}
			else 
			{ 
				echo "<b>Donors</b>";
				$query = mysqli_query($connection, "SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.email AS 'Email', patientinfo.bloodType AS 'Blood Type', patientinfo.title AS 'Organ' FROM patientinfo, useraccount, accountinfo WHERE patientType = 1 AND patientinfo.userID = useraccount.userID AND patientinfo.doctorUserID = accountinfo.doctorUserID AND patientinfo.available = 1 AND useraccount.active = 1 AND patientinfo.title = '$databaseTitle' AND accountinfo.userID = '$userID'"); 
				
				echo "<table>"; // start a table tag in the HTML
				echo "<tr> <th>Username</th> <th>First Name</th> <th>Last Name</th> <th>Email</th> <th>Blood Type</th> <th>Organ</th> </tr> "; 
				while($row = mysqli_fetch_array($query))
				{   //Creates a loop to loop through results
					echo "<tr><td>" . $row['Username'] . "</td> <td>" . $row['First Name'] . "</td> <td>" . $row['Last Name'] . "</td> <td>" . $row['Email'] . "</td> <td>" .$row['Blood Type'] . "</td> <td>" . $row['Organ'] . "</td></tr>";  //$row['index'] the index here is a field name
				}
				echo "</table><br><br>"; //Close the table in HTML 
				
				echo "<b>Recipient Waitlist</b>";
				$queryRecipients = mysqli_query($connection, "SELECT useraccount.userName AS 'Username', patientinfo.firstName AS 'First Name', patientinfo.lastName AS 'Last Name', patientinfo.email AS 'Email', patientinfo.bloodType AS 'Blood Type', patientinfo.title AS 'Organ', waitlist.waitlistScore AS 'Score' FROM useraccount, patientinfo, waitlist, accountinfo WHERE useraccount.active = 1 AND patientinfo.patientType = 2 AND patientinfo.available = 1 AND useraccount.userID = patientinfo.userID AND patientinfo.userID = waitlist.userID AND patientinfo.title = '$databaseTitle' AND patientinfo.doctorUserID = accountinfo.doctorUserID AND accountinfo.userID = '$userID' ORDER BY 6 ASC"); 
				echo "<table>"; // start a table tag in the HTML
				echo "<tr> <th>Username</th> <th>First Name</th> <th>Last Name</th> <th>Email</th> <th>Blood Type</th> <th>Organ</th> <th>Score</th> </tr> "; 
				while($recipientRow = mysqli_fetch_array($queryRecipients))
				{
					echo "<tr><td>" . $recipientRow['Username'] . "</td> <td>" . $recipientRow['First Name'] . "</td> <td>" . $recipientRow['Last Name'] . "</td> <td>" . $recipientRow['Email'] . "</td> <td>" . $recipientRow['Blood Type'] . "</td> <td>" . $recipientRow['Organ'] . "</td> <td>" . $recipientRow['Score'] . "</td></tr>";  //$row['index'] the index here is a field name
				}
				
				$connection->close(); 
			}
		?>
		</div>
	</div>
	</div>
</body>
</html>