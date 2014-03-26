<article class="navigation">
	<nav>
	<?php
	    	include ('../classes/user.php');
		session_start();
		$userName = $_SESSION['user']->username;
		$user_class = $_SESSION['user']->user_class;
		
	    	echo "<li><a href=\"./home.php\" title=\"Home\">Home</a></li>";
	    	echo "<li><a href=\"./account_settings.php\" title=\"Account Settings\">Account Settings</a></li>";
	    	
	    	if(strcmp($userName,'admin') == 0){
	    		echo "<li><a href=\"./user_management.php\" title=\"User Management\">User Management</a></li>";
	    		echo "<li><a href=\"./ReportGenerator.php\" title=\"Report Generator\">Report Generator</a></li>";
	    	}
	    	if(strcmp($userName,'admin') == 0 || strcmp($user_class,'r') == 0){
	    	echo "<li><a href=\"./UploadPage.php\" title=\"Uploading Module\">Upload</a></li>";
	    	}
	    	
	    	echo "<li><a href=\"./Search.php\" title=\"Search Module\">Search</a></li>";


		if(strcmp($userName,'admin') == 0){
	    		echo "<li><a href=\"./DataAnalysis.php\" title=\"Data Analysis\">Data Analysis</a></li>";
	    	}
	    	echo "<li><a href=\"./logout.php\" title=\"Logout\">Logout</a></li>";
	?>
	</nav>
<article>
