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
			<li> <a href="register.php">Register</a>
				<ul>
                    <li><a href="register.php">Donor/Recipient</a></li>
					<li><a href="staffregister.php">Doctor/Staff</a></li>
                </ul>
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
	<h2 class="title"><font face= "Brush Script MT" size = 13px>Upload Medical License</font></h2>
		<fieldset> 
			<legend><b>Step 2: Verification</b></legend>
			<p> <b>To verify that you are a doctor or medical staff member, please upload a picture of your medical license. If the document lacks your license number, isssue date, or expiration date, your application will be denied. </b>
			<input type="file" name="fileToUpload" id="fileToUpload">
		</fieldset>
	</div>
</body>
</html>