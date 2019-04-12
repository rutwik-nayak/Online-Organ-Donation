<!DOCTYPE html>
<html>
<title>Organ Management</title>
<link rel="stylesheet" type="text/css" href="style.css" />
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
            <li> <a href="login.php">Account</a>
                <ul>
				<?php
					if(!$username)
						echo "<li><a href='login.php'>Login</a></li>"; 
					else
						echo "<li><a href ='profile.php'>{$username}'s Profile</a></li>";
					?>
				<?php
					if($userID && $userType != "0") 
					{ echo "
						<li><a href='PatientManagement.php'>Patient Management</a></li> 
						<li><a href='EditPatient.php'>Edit Patient</a></li> 
						<li><a href='AddPatient.php'>Add Patient</a></li>";
					}
					?>
					<?php
					if($userID && ($userType == "2"))
					{?>
					<li><a href="organmanager.php">Organ Management</a></li>
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
<p>&nbsp;</p>
	<div class = "priority" align = "center">
	<h2 class="title"><font face= "Brush Script MT" size = 13px>Organ Management System</font></h2> 
<table style='width:35%' align = 'left' bgcolor='white'>
	<tr>
		<td>
			<form method = 'post' action = 'filter.php'>
				<select name = 'filter' default = 'all'>
					<option value = 'all'>all</option>
					<option value = 'heart'>heart</option>
					<option value = 'kidney'>kidney</option>
					<option value = 'liver'>liver</option>
					<option value = 'lung'>lung</option>
				</select>
				<input type='submit' name='runFilter' value = 'filter'>
			</form>
		</td>
		
		<td>
			<form  method = 'post' action = 'add.php'>
				<input type = 'submit' name='add' name ='add' value = 'add'>
			</form>
		</td>
		
		<td>
			<form method = 'post' action = 'remove.php'>
				<input type = 'submit' name='remove' name ='remove' value = 'remove'>
			</form>
		</td>
		
		<td>
			<form method = 'post' action = 'accept.php'>
				<input type = 'submit' name='accept' name ='accept' value = 'accept'>
			</form>
		</td>
		
		<td>
			<form method = 'post' action = 'deny.php'>
				<input type = 'submit' name='deny' name ='deny' value = 'deny'>
			</form>
		</td>
	</tr>
</table>
<br><br><br>
<table style='width: 1050px' border = '1px solid black' align = 'left' bgcolor='white'>
	<tr>
		<th>Select</th>
		<th>Organ Type</th>
		<th>Donor ID</th>
		<th>Recipient ID</th>
		<th>Blood Type</th>
		<th>Weight</th>
		<th>Start</th>
		<th>Expiration</th>
		<th>Status</th>
	</tr>
	<?php
	
	//connnect to mySQL
	$mySQL = mysqli_connect('127.0.0.1', 'root', 'password', 'organdonation');
	if(!$mySQL)
	{
		echo "ERROR: Cannot connect to mySQL database.";
		exit;
	}
	
	//select the organ donor database in mySQL
	$organDonorDB = mysqli_select_db($mySQL, "organdonation");
	if(!$organDonorDB)
	{
		echo "ERROR: Cannot connect to Organ Donor Database";
		exit;
	}
	
	//display all available data for organs
	$query = "SELECT userID, recipientID, typeOfOrgan, bloodType, weight, expirationTime, availableTime, status
			  FROM organs";
	
	$result = mysqli_query($mySQL, $query);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			echo
				"
					<tr>
						<td align='center' style='width:100px'><input type='checkbox' name = '" . $row["typeOfOrgan"] . "-" . $row["userID"] . "'></td>
						<td align='center' style='width:100px'>" . $row["typeOfOrgan"] ."</td>
						<td align='center' style='width:100px'>" . $row["userID"] ."</td>
						<td align='center' style='width:100px'>" . $row["recipientID"] ."</td>
						<td align='center' style='width:100px'>" . $row["bloodType"] ."</td>
						<td align='center' style='width:100px'>" . $row["weight"] ."</td>
						<td align='center' style='width:150px'>" . $row["availableTime"] ."</td>
						<td align='center' style='width:150px'>" . $row["expirationTime"] ."</td>
						<td align='center' style='width:150px'>" . $row["status"] . "</td>
					</tr>
				";
		}
		echo "</table><br>";
		
		exit;
	}
	else
	{
		echo "</table><br><br>";
		echo "No available records.";
		exit;
	}
	?>
</div>
</body>
</html>