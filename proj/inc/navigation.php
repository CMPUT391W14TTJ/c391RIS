<article class="navigation">
	<nav>
	    <li><a href="./home.php" title="Home">Home</a></li>
	    <li><a href="./account_settings.php" title="Account Settings">Account Settings</a></li>
	    <li><a href="./user_management.php" title="User Management">User Management</a></li>
	    <li><a href="./ReportGenerator.php" title="Report Generator">Report Generator</a></li>
	    <li><a href="./UploadPage.php" title="Uploading Module">Upload</a></li>
	    <li><a href="./Search.php" title="Search Module">Search</a></li>
	    <?php
	    	include ('./classes/user.php');
		session_start();
		$userName = $_SESSION['user']->username;
		if(strcmp($userName,'admin') == 0){
	    		echo "<li><a href=\"./DataAnalysis.php\" title=\"Data Analysis\">Data Analysis</a></li>";
	    	}
	    ?>
	    <li><a href="./logout.php" title="Logout">Logout</a></li>
	</nav>
<article>
