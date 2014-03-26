<article class="HelpNavigation">
	<nav>
	<?php
	    	include ('./classes/user.php');
		session_start();
		$userName = $_SESSION['user']->username;
		$user_class = $_SESSION['user']->user_class;
		
			
	    	echo "<li><a href=\"./home.php\" title=\"Home\">Home</a></li>";
	    	if(strcmp($userName,'admin') == 0){
	    		echo "<li><a href=\"./Help/Help_Install.html\" title=\"Installation\">Installation</a></li>";
	    	}
	    	
	    	echo "<li><a href=\"./Help/Help_account_settings.html\" title=\"Account Settings\">Account Settings</a></li>";
	    	
	    	if(strcmp($userName,'admin') == 0){
	    		echo "<li><a href=\"./Help/Help_user_management.html\" title=\"User Management\">User Management</a></li>";
	    		echo "<li><a href=\"./Help/Help_ReportGenerator.html\" title=\"Report Generator\">Report Generator</a></li>";
	    	}
	    	if(strcmp($userName,'admin') == 0 || strcmp($user_class,'r') == 0){
	    	echo "<li><a href=\"./Help/Help_Upload.html\" title=\"Uploading\">Upload</a></li>";
	    	}
	    	
	    	echo "<li><a href=\"./Help/Help_Search.html\" title=\"Search Module\">Search</a></li>";


		if(strcmp($userName,'admin') == 0){
	    		echo "<li><a href=\"./Help/Help_DataAnalysis.html\" title=\"Data Analysis\">Data Analysis</a></li>";
	    	}    	
	?>
	</nav>
<article>
