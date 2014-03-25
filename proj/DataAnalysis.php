<html>
<title> Search 391 TTJ </title>
<p>
<?php
	include ('./classes/user.php');
	session_start();
	$userName = $_SESSION['user']->username;
	
	if(strcmp($userName,'admin') == 0){
		include('./inc/navigation.php');
		include('./inc/DataForm.php');
		include('DataAnalysisModule.php');
	
		//Get the variables we need
		$patient = $_POST['patient'];
		$test = $_POST['test'];
		$time = $_POST['Time_picker'];
		//Prints the data based on the form
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
   			printData($patient, $test, $time);
		} 
	}else{
		header( "Location: ./unauthorized.html");
	}
?>
</p>
</html>
