<HTML>
<head>
	<title>Homepage - Radiology Information System</title>
	<?php session_start(); ?>
</head>
<body>
	<article class="navigation">
		<nav>
		    <li><a href="http://consort.cs.ualberta.ca/account_settings.php" title="Account Settings">Account Settings</a></li>
		    <li><a href="http://consort.cs.ualberta.ca/user_management.php" title="User Management">User Management</a></li>
		    <li><a href="http://consort.cs.ualberta.ca/report_generator.php" title="Report Generator">Report Generator</a></li>
		    <li><a href="http://consort.cs.ualberta.ca/upload.php" title="Uploading Module">Upload</a></li>
		    <li><a href="http://consort.cs.ualberta.ca/search.php" title="Search Module">Search</a></li>
		    <li><a href="http://consort.cs.ualberta.ca/data_analysis.php" title="Data Analysis">Data Analysis</a></li>
		</nav>
	<article>
	<article class="user_info">
		<h1>User Info</h1>
		<p>
		<?php
			echo "USERNAME: " . $_SESSION['username'] . '</br>';
			echo "PASSWORD: " . $_SESSION['password'] . '</br>';
			echo "CLASS: " . $_SESSION['user_class'] . '</br>';
		?>
		</p>
	</article>
</body>
</html>
