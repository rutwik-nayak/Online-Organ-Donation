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
</div>
	<p>&nbsp;</p> 
	<div class = "priority" align = "center">
		<h2 class="title">Change Password</h2>
		<p>&nbsp;</p>
<style>
table {
    border-collapse: collapse;
    width: 50%;
	height: 90:
	border-style: none; 
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
        <?php            
            if($username && $userID ) //if the user is already logged in 
            {
                $formText = "
                Change password for user id: $userID<br>  
                <form action='changepassword.php' method='post'>
                <table>
                <tr>
                    <td>New password:</td>
                    <td><input type='text' name='newpassword' value='' maxlength='40'></td><br>
                </tr>
                <tr>
                    <td>Re-enter new password:</td>
                    <td><input type='text' name='reenteredpassword' value='' maxlength='40'></td><br>
                </tr>
                <tr>
                    <td></td><td><input type='submit' name='changepasswordbutton' value='Submit'></td>
                </tr>
                </table>
                </form>
                <p>&nbsp;</p>";

                if( $_POST['changepasswordbutton'] ) {
                    //echo "changing password for userID $userID<br>";

                    $newpassword 		= $_POST['newpassword'];
                    $reenteredpassword  = $_POST['reenteredpassword'];

					if( $newpassword != $reenteredpassword) {
						echo "Passwords don't match! <br> Please try again.";
						header("refresh:3; url = changepassword.php");

					} else {
	                    require("connect.php"); 
	                    $query = mysqli_query($connection, "SELECT * 
	                                          FROM useraccount
	                                          WHERE userID = '$userID'"); 
	                    $numberOfRows = mysqli_num_rows($query);                   
	                    $databasePassword = "";
	                    $databaseUserName = "";
	                    $databasePatientFlag = "";
	 
	                     //checking if anything was returned from the query
	                    if($numberOfRows > 0)
	                    { 
	                        //echo "got one row of information .";
	                        //fetches data from query 
	                        $row = mysqli_fetch_assoc($query);
	                        $databasePassword = $row['passwrd']; 
	                        $databaseUserName = $username;
	                        $databasePatientFlag = $row['pateintFlag'];

	                        $query = mysqli_query($connection, "UPDATE   
	                                           useraccount 
	                                          SET  passwrd = '$newpassword' WHERE userID = '$userID'"); 
	                        if( $query)
	                            echo ("Changed password for userID $userID<br>");
	                        else 
	                            echo( "Could not change password for userID $userID. error = " . mysqli_error($connection) .  "<br>");
	                    } else {
	                        echo "adding new password to database<br>";
	                    }

	                }
                } else {
                    echo $formText;
                }
            } else {
            	echo "You are not yet logged in. Please log in first.";
            }
        ?>  


	</div>
</body>
</html>