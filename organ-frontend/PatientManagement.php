<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
$userID = $_SESSION['userID'];
$username = $_SESSION['username'];
?>
<!DOCTYPE html>

<html>
<head>
    <title>Organ Donation</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<div id="nav">
    <div id="nav_wrapper">
        <ul>
			<li><a href="index.php"><img src = "https://townehomecare.com/wp-content/uploads/2017/04/organ-donation.jpg width = "40" height = "40" alt = "heart and hands"  /></a></li>
            <li><a href="index.php">Home</a></li>
            <li> <a href="about.php">About Us</a></li>
            <li> <a href="faq.php">FAQ</a></li>
			<li> <a href="register.php">Register</a>
				<ul>
                    <li><a href="register.php">Donor/Recipient</a></li>
					<li><a href="staffregister.php">Doctor/Staff</a></li>
                </ul>
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
    <div class="priority" align="center">
        <h2 class="title">Patient Management</h2>

        <style>
            ul
            {
                text-align: left;
            }
            table
            {
                border-collapse: collapse;
            }

            table, td, th
            {
                border: 1px solid black;
            }
        </style>

        <p>&nbsp;</p>
        <ul id = "buttons">
            <li><a href="EditPatient.php">Edit Patient</a></li>
        </ul>
        
			<?php
				$form = "<form action = './PatientManagement.php' method = 'post'>
				<table>
				<tr>
					<td>Add Patient </td>
					<td><input type = 'text' name = 'patientID' /></td>
					<td>To Doctor ID </td>
					<td><input type = 'text' name = 'doctorID' /></td>
					<td><input type = 'submit' name = 'updatePatientDoctor' value = 'updatePatient' /></td>
				</tr>
				<table>
				</form>";

					if($_POST['updatePatientDoctor'])
					{
						$patientID = $_POST['patientID'];
						$doctorID = $_POST['doctorID'];

						require("connect.php");
						$query = mysqli_query($connection, "UPDATE patientinfo SET doctorUserID = '$doctorID' WHERE userID = '$patientID'");
						echo "Patient Successfully Updated";
					}			
				
			?>
		<?php
		
		require("connect.php");
        echo "<table>";
        echo "<thread>";
            echo "<tr>";
                echo "<td><b> First Name </b></td>";
                echo "<td><b> Last Name </b></td>";
                echo "<td><b> Patient ID </b></td>";
                echo "<td><b> Patient Condition </b></td>";
                echo "<td><b> Date of Birth </b></td>";
                echo "<td><b> Height </b></td>";
                echo "<td><b> Weight </b></td>";
                echo "<td><b> Doctor ID </b></td>";
                echo "<td><b> Doctor Name </b></td>";
            echo "</tr>";

			$query = mysqli_query($connection, "SELECT firstName, lastName, userID, patientCond, dob, height, weight, doctorUserID FROM patientinfo");
			$numberOfRows = mysqli_num_rows($query);

           echo "<tr>";
                echo "<td> John </td>";
                echo "<td> Smith </td>";
                echo "<td> 1 </td>";
                echo "<td> Critical </td>";
                echo "<td> 2001-01-01 </td>";
                echo "<td> 5 </td>";
                echo "<td> 210 lbs. </td>";
                echo "<td> 0001 </td>";
                echo "<td> Bob </td>";
            echo "</tr>";

			if ($numberOfRows > 0) 
			{
				 // output data of each row
				 while($row = mysqli_fetch_assoc($query)) 
				 {
                    $query2 = mysqli_query($connection, "SELECT CONCAT('Dr.', ' ', accountinfo.lastName) FROM patientinfo, accountinfo WHERE patientinfo.doctorUserID = accountinfo.doctorUserID");
                    $row2 = mysqli_fetch_assoc($query2);
					 echo "<tr>";
						echo "<td> ". $row["firstName"]. " </td>";
						echo "<td> ". $row["lastName"]. " </td>";
						echo "<td> ". $row["userID"]. " </td>";
						echo "<td> ". $row["patientCond"]. " </td>";
						echo "<td> ". $row["dob"]. " </td>";
						echo "<td> ". $row["height"]. " </td>";
						echo "<td> ". $row["weight"]. " </td>";
						echo "<td> ". $row["doctorUserID"]. " </td>";
                        echo "<td align = 'center'> ". $row2["lastName"]. "</td>";
					echo "</tr>";
				 }
			}

			else
			{
				echo "0 results";
			}

	?>
        </thread>
        <tbody>
            <?php

            ?>
        </tbody>
        </table>

    </div>
</body>
</html>