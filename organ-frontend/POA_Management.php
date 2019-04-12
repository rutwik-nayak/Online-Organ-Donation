<!--validate information for updating, adding, and deleting -->
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
	<div id="header"></div>
	<div id="main-wrap">
		<div id="content-wrap" style = "overflow-x:auto;">
		<h2 class="title" align = "center"><font face= "Brush Script MT" size = 13px>Power of Attorney Management</font></h2>
		<p>&nbsp;</p>
		<p><strong>To add or update your current emgency contact, type all of the fields on the left hand side with the new information. If you already have an emergency contact, you cannot add another.</strong></p>
		<?php
			require("connect.php"); 
			$showpoa = mysqli_query($connection, "SELECT DISTINCT powerofattorney.firstName, powerofattorney.lastName, powerofattorney.email, powerofattorney.phoneNumber FROM powerofattorney, patientInfo WHERE '$userID' = powerofattorney.userID AND decisionMakerFlag = '1'");  
			
			$numberOfRows = mysqli_num_rows($showpoa);
			if($numberOfRows == 1)
			{
				echo "<table>"; // start a table tag in the HTML
				echo "<tr> <th>First Name</th> <th>Last Name</th> <th>Email</th> <th>Phone Number</th><tr> "; 
				while($row = mysqli_fetch_array($showpoa))
				{   //Creates a loop to loop through results
					echo "<tr><td>" . $row['firstName'] . "</td> <td>" . $row['lastName'] . "</td> <td>" . $row['email'] . "</td> <td>" .$row['phoneNumber'] ."</td></tr>";  
				}
				echo "</table>"; //Close the table in HTML 
			}
			else
			{
				echo "You currently do not have a power of attorney. You can add a power of attorney by selecting 'Add' and filling in all required fields"; 
			}
			$connection->close(); 
		?>
		</div>
			<div id="sidebar" align = "left">
		<form action="POA_Management.php" method= "post"/>
		<fieldset>
			<input type="radio" name="poa" value="edit" checked> Edit <br> 
			<input type="radio" name="poa" value="add"> Add<br>
			<input type="radio" name="poa" value="delete"> Delete<br>
		</fieldset>
  		First name:
  		<input type="text" name="firstName" value=""maxlength="40"><br>
		  Last name:
		  <input type="text" name="lastName" value=""maxlength="40"><br>
		  Email Address:
		  <input type="text" name="Email" value= ""maxlength="40"><br>
		  Phone Number:
		  <input type="text" name="Phone" value= ""><br>
		  <br>
 		 <input type="submit" name = "submitbutton" value = "Submit">
		</form>
		
		<?php 
			if($_POST['submitbutton'])
			{
				require("connect.php");
				$poa_edit =  mysqli_real_escape_string($connection, $_POST['poa']);
				$poa_firstname = mysqli_real_escape_string($connection, $_POST['firstName']);
				$poa_lastname = mysqli_real_escape_string($connection, $_POST['lastName']);
				$poa_email = mysqli_real_escape_string($connection, $_POST['Email']);
				$poa_phone = mysqli_real_escape_string($connection, $_POST['Phone']);
				
				//validate information for updating, adding, and deleting 
				
				if($poa_firstname && $poa_lastname && $poa_email && $poa_phone)
				{ 
					if($poa_edit === "edit")
					{
						$showpoa3 = mysqli_query($connection, "SELECT DISTINCT powerofattorney.firstName, powerofattorney.lastName, powerofattorney.email, powerofattorney.phoneNumber FROM powerofattorney, patientInfo WHERE '$userID' = powerofattorney.userID AND decisionMakerFlag = '1'");  
			
						$numberOfRows3 = mysqli_num_rows($showpoa3);
						
						if($numberOfRows3 == 1)
						{
							$queryUpdate2 = mysqli_query($connection, "UPDATE patientInfo 
																	  SET decisionMakerFlag = 1
																	  WHERE userID = '$userID'");
							$queryUpdate = mysqli_query($connection, "UPDATE powerofattorney 
																	  SET firstName= '$poa_firstname', lastName = '$poa_lastname', phoneNumber = '$poa_phone' , email = '$poa_email'
																	  WHERE userID = '$userID'");
							if($queryUpdate && $queryUpdate2)
							{
								echo "<b> The Power Of Attorney Record has been successfully updated."; 
								$connection->close(); 
							}
							else
							{
								echo "Problem updating power of attorney record."; 
								$connection->close(); 
							}
						}
						else
						{
							echo "You do not have a power of attorney. To add one, select the add button and fill out all required fields, then press submit."; 
							$connection->close(); 
						}
					}
					else if ($poa_edit === "add")
					{
						$showpoa2 = mysqli_query($connection, "SELECT DISTINCT powerofattorney.firstName, powerofattorney.lastName, powerofattorney.email, powerofattorney.phoneNumber FROM powerofattorney, patientinfo WHERE patientinfo.userID = powerofattorney.userID AND '$userID' = powerofattorney.userID AND decisionMakerFlag = '1'");  
					
						$numberOfRows2 = mysqli_num_rows($showpoa2);
						
						if($numberOfRows2 == 0)
						{
							do{
								$patientinfo_poaID = rand(0, 9999); 
								$query = mysqli_query($connection, "SELECT poaID 
																	FROM powerofattorney
																	WHERE powerofattorney.poaID = '$patientinfo_poaID'"); 
								$numberOfRows = mysqli_num_rows($query); 
								}while ($numberOfRows == 1);
								
							$queryInsert = mysqli_query($connection, "INSERT INTO powerofattorney(poaID, userID, firstName, lastName, phoneNumber, email) VALUES ('$patientinfo_poaID', '$userID', '$poa_firstname', '$poa_lastname', '$poa_phone', '$poa_email')"); 
							
							if($queryInsert)
							{
								echo "<b> The Power Of Attorney Record has been successfully added. </b>"; 
								$connection->close(); 
							}
							else 
							{
								echo "Not all fields were entered in"; 
								$connection->close(); 
							}
						}
					else
						{
							$powerFetchRow = mysqli_fetch_array($showpoa2); 
							$powerUser = $powerFetchRow['userID']; 
							if($powerUser == '$userID')
							{
								$queryUpdate = mysqli_query($connection, "UPDATE powerofattorney 
																	  SET firstName= '$poa_firstname', lastName = '$poa_lastname', phoneNumber = '$poa_phone' , email = '$poa_email'
																	  WHERE userID = '$userID'");
								$queryUpdate2 = mysqli_query($connection, "UPDATE patientInfo 
																	  SET decisionMakerFlag = 1
																	  WHERE userID = '$userID'");
								echo "Power of Attorney added."; 
							}
							else
							{
								echo "<br><br>"; 
								echo "<b>You already have an emergency contact!</b>";
							}							
							$connection->close();
						}
					}
					else
					{
						$queryDelete = mysqli_query($connection, "UPDATE patientInfo 
																  SET decisionMakerFlag = 0 
																  WHERE userID = '$userID'");
						
						if($queryDelete)
						{
							echo "<b> The Power Of Attorney Record has been successfully deleted."; 
							$connection->close();
						}
						else
						{
							echo "Error occured when deleting."; 
							$connection->close();
						}
					}
				}
				else
				{
					echo "Not all fields were entered in"; 
				}
			}
		?>
		<p>&nbsp;</p>
	</div>
	</div>
	</div>
</body>
</html>