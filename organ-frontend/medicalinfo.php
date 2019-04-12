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
        <?php            
            if($username && $userID) //if the user is already logged in 
            {
                $l = "<li> <a href='showaccountinfo.php'>Account Info</a>
                <ul>
                    <li> <a href='showaccountinfo.php'>Show Account Info</a> 
                    <li> <a href='editaccountinfo.php'>Edit/Add Account Info</a> 
                </ul>
                </li>
                <li> <a href='medicalinfo.php'>Medical Info</a></li>";
                echo $l;
            }
        ?>  
            <li> <a href="about.php">About Us</a></li>
            <li> <a href="faq.php">FAQ</a></li>
            <li> <a href="login.php">Account</a>
                <ul>
                    <li><a href="login.php">Profile</a></li>
					<li><a href="login.php">Report</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Nav wrapper end -->
</div>
	<p>&nbsp;</p> 
	<div class = "priority" align = "center">
		<h2 class="title">Medical Information</h2>
		<p>&nbsp;</p>
		<p>Medical  Information Page</p>
		<p>&nbsp;</p>
	</div>
</body>
</html>