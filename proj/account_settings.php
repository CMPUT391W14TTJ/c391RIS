<HTML>
<head>
	<title>Account Settings - Radiology Information System</title>
	<?php session_start(); ?>
</head>
<body>
<div id="container">
	<article class="navigation">
		<nav>
		    <li><a href="./home.php" title="Home">Home</a></li>
		    <li><a href="./account_settings.php" title="Account Settings">Account Settings</a></li>
		    <li><a href="./user_management.php" title="User Management">User Management</a></li>
		    <li><a href="./report_generator.php" title="Report Generator">Report Generator</a></li>
		    <li><a href="./upload.php" title="Uploading Module">Upload</a></li>
		    <li><a href="./search.php" title="Search Module">Search</a></li>
		    <li><a href="./data_analysis.php" title="Data Analysis">Data Analysis</a></li>
		</nav>
	</article>
	<article class="acc_settings">
		<h2>Account Settings</h2>
		<div class="form">
			<h3>Change your password:</h3>
			<form name="pass_change" method="post" action="">
				Old Password: <input type="password" name="oldPass"/><br/>
				New Password: <input type="password" name="newPass1"/><br/>
				Re-type New Password: <input type="password" name="newPass2"/><br/>
				<input type="submit" name="PassChange" value="Change Password"/>
			</form>
		</div>
	</article>		
</div>
</body>
</html>
