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
	<title>Add Patient</title>
	<link rel = "stylesheet" type = "text/css" href = "style.css"/>
</head>
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
<!-- Nav end -->
	<p>&nbsp;</p> 
	<div class = "priority" align = "center">
		<h2 class="title">Edit Patient</h2>
		<p>&nbsp;</p>

		<?php
				function checkDefaultValue($val,$ret="")
		   		{
			        if($val=="" || $val=='not specified')
			        {
			            return $ret;
			        }
			        else
			        {
			            return $val;
			        }
		    	}
			$form = "<form action = './EditPatient.php' method = 'post' id='myform'>
			<table>
			<tr>
				<td>Enter Patient User ID: </td>
				<td><input type = 'text' name = 'userid' /></td>
				<td><input type = 'submit' name = 'update' value = 'Update' /></td>
			</tr>
			<table>
			</form>";
			echo $form;

			if($_POST['update'])
			{
				require("connect.php");

				$query = mysqli_query($connection, "SELECT *
					FROM patientinfo 
					WHERE '$userID' = '$patientUserID'");
				$row = mysqli_fetch_assoc($query);

				if ($numberOfRows = 1)
				{
					$patientFirstName = $row['firstName'];
					$patientLastName = $row['lastName'];
					$patientDOB = $row['dob'];
					$patientPhoneNumber = $row['phoneNumber'];
					$patientEmail = $row['email'];
					$patientUserID = $row['userID'];
					$patientWeight = $row['weight'];
					$patientHeight = $row['height'];
					$patientDL = $row['driversLicense'];
					$patientType = $row['patientType'];
					$patientBloodType = $row['bloodType'];
					$patientDoctor = $row['doctorUserID'];
					$patientLiverFlag = $row['liverFlag'];
					$patientHeartFlag = $row['heartFlag'];
					$patientKidneyFlag = $row['kindeyFlag'];
					$patientLungFlag = $row['lungFlag'];
					
					echo "$patientUserID";
					echo "$patientFirstName";
					$form2 = "<form action = 'EditPatient.php' method = 'post' >
					<table>
					<tr>
						<td>User ID: </td>
						<td><input type = 'text' name = 'userid' value ='$patientUserID' /></td>
					</tr>
					<tr>
						<td>First Name:</td>
						<td><input type = 'text' name = 'firstname'value ='$patientFirstName'/></td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td><input type = 'text' name = 'lastname' value ='$patientLastName'/></td>
					</tr>
					<tr>
						<td>Date Of Birth (MM/DD/YYYY):</td>
						<td><input type = 'text' name = 'dob' value ='$patientDOB'/></td>
					</tr>
					<tr>
						<td>Phone Number:</td>
						<td><input type = 'text' name = 'phonenumber' value ='$patientPhoneNumber'/> </td>
					</tr>
					<tr>
						<td>Email Address:</td>
						<td><input type = 'text' name = 'emailaddress' value ='$patientEmail'/></td>
					</tr>
					<tr>
						<td>Patient Height (Centimeters) </td>
						<td><input type = 'text' name = 'height' value ='$patientHeight'/></td>
					</tr>
					<tr>
						<td>Patient Weight (LBS.)</td>
						<td><input type = 'text' name ='weight' value ='$patientWeight'/></td>
					</tr>
					<tr>
						<td>Patient Drivers License Number</td>
						<td><input type = 'password' name = 'dlnumber' value= '$patientDL'/></td>
					</tr>
					<tr>
						<td>Patient Type</td>
						    <td>
							    <select name='patienttype'>
								<option value='recipient'>Recipient</option>
								<option value='donor'>Donor</option>
								</select>
							</td>
					</tr>
						<td>Blood Type:</td>
						    <td><select name='bloodtype' placeholder = '$patientBloodType'>
							<option value='A+'>A+</option>
							<option value='A-'>A-</option>
							<option value='B+'>B+</option>
							<option value='B-'>B-</option>
							<option value='AB+'>AB+</option>
							<option value='AB-'>AB-</option>
							<option value='O+'>O+</option>
							<option value='O-'>O-</option>
						</select></td>
					</tr>
					<tr>
						<td>Organ(s) Needed:</td>
						<td><form>
						if ('$patientLiverFlag == 1')
						{
							<input type='checkbox' name='organ' value='Liver' checked/>Liver<br>
						}
						else
						{
							<input type='checkbox' name='organ' value='Liver'/>Liver<br>
						}
						if ('$patientHeartFlag == 1')
						{
							<input type='checkbox' name='organ' value='Heart' checked/>Heart<br>
						}
						else
						{
							<input type='checkbox' name='organ' value='Heart'>Heart<br>
						}
						if ('$patientKidneyFlag == 1')
						{
							<input type='checkbox' name='organ' value='Kidney' checked>Kidney<br>
						}
						else
						{
							<input type='checkbox' name='organ' value='Kidney'>Kidney<br>
						}
						if ('$patientLungFlag == 1')
						{
							<input type='checkbox' name='organ' value='Lung' checked>Lung<br>
						}
						else
						{
							<input type='checkbox' name='organ' value='Lung'>Lung<br>
						}
						</form></td>
					</tr>
					<tr>
						<td>Doctor ID</td> <!-- Autofill if doctor is signed in? -->
						<td><input type = 'text' name = 'doctorid' placeholder = '$patientDoctor'/></td>
					</tr>
					<tr>
						<td align='right'><input type = 'submit' name = 'submit' value = 'Update Patient' /></td>
					</tr>
					<table>
					</form>";
					echo $form2;

				}
				else
				{
					echo "Invalid data pulled";
				}

			}
			 
			if($_POST['submit'])
			{
				$patientFirstName = $_POST['firstname'];
				$patientLastName = $_POST['lastname'];
				$patientDOB = $_POST['dob'];
				$patientPhoneNumber = $_POST['phonenumber'];
				$patientEmail = $_POST['emailaddress'];
				$patientUserID = $_POST['userid'];
				$patientWeight = $_POST['weight'];
				$patientHeight = $_POST['height'];
				$patientDL = $_POST['dlnumber'];
				$patientType = $_POST['patientT'];
				$patientBloodType = $_POST['bloodtype'];
				$patientDoctor = $_POST['doctorid'];
				$patientLiverFlag = 0;
				$patientHeartFlag = 0;
				$patientKidneyFlag = 0;
				$patientLungFlag = 0;

				require("connect.php");

				$query = mysqli_query($connection, "UPDATE patientinfo 
					SET firstName = '$patientFirstName', lastName = '$patientLastName', dob = '$patientDOB', phoneNumber = '$patientPhoneNumber', email = '$patientEmail', weight = '$patientWeight', height = '$patientHeight', driversLicense = '$patientDL', patientType = '$patientType', bloodType = '$patientBloodType', liverFlag = '$patientLiverFlag', heartFlag = '$patientHeartFlag', kidneyFlag = '$patientKidneyFlag', lungFlag = '$patientLungFlag', doctorUserID = '$patientDoctor'
					WHERE '$userID' = '$patientUserID'");

				echo "Patient Successfully Updated";
					
			}
		?>
	</div>
</body>
</html>