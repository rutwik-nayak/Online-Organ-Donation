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
		<h2 class="title"><font face= "Brush Script MT" size = 13px>FAQ</font></h2>
		<p>&nbsp;</p>
		<p><strong>Can anyone donate?</strong></p>
		<p>Anyone between the age of 15 and 80 inclusive, can donate organs. Just fill out the required information under our register tab. If you are older or younger than our required age range, then we can refer you to another agency that can help you.<p>
		<p><strong>Can I register as a recipient if I need an organ?</strong></p>
		<p>Yes, we assist both individuals who want to donate and individuals who need an organ.<p>
		<p><strong>Which organs can I donate?</strong></p>
		<p>You can donate a heart, liver, lung, or kidney. We do not handle tissue donations.</p>
		<p><strong>Do I need to be a citizen of the India to donate?</strong></p>
		<p>Although some other organizations allow non-citizens to donate, we only allow Indian citizens to donate.</p>
		<p><strong>How long will it take to recieve my needed organ.</strong></p>
		<p>This depends on if the organ you need is readily available and where you are located. Many factors effect how long the wait may be for an organ.</p>
		<p><strong>Can I see the waitlist?</strong></p>
		<p>Unfortunately, we do not let our patients view the waitlist as this information is confidential. However, we will assist you with acquiring your needed organ as fast as we can.<p>
		<p><strong>If I or a family member is unconscious, and I need someone to make a decision for me on donating organs, what should I do?  </strong></p>
		<p>While you sign up for donating organs, you can choose to select a family member, spouse, or trusted individual to make that decision for you.</p>
		<p><strong>Do you have any religous affiliation?</strong></p>
		<p>Yes, we are a catholic organization. However, we accept patients of all racial, ethnic, and relgious backgrounds and make it our mission to help all who seek help.<p>
		<p>&nbsp;</p>
	</div>
</body>
</html>