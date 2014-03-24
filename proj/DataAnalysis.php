<html>
<title> Search 391 TTJ </title>
<p>
<?php
	
	include('./inc/navigation.php');
	include('./inc/DataForm.php');
	include('DataAnalysisModule.php');
	
	//Get the variables we need
	$patient = $_POST['patient'];
	$test = $_POST['test'];
	$time = $_POST['Time_picker'];
	//Prints the data based on the form
	printData($patient, $test, $time);
	
?>
</p>
</html>
