<html>
<title> Search 391 TTJ </title>
<p>
<?php
	
	include('./inc/navigation.php');
	include('./inc/DataPicker.php');
	include('DataAnalysisModule.php');
	
	//Get the variables we need
	$patient = $_POST['patient'];
	$test = $_POST['test'];
	$time = $_POST['Time_picker'];
	/*
	echo '<b>'.$patient.'</b>';
	echo '<b>'.$test.'</b>';
	echo '<b>'.$time.'</b>';
	*/
	printData($patient, $test, $time);
	
?>
</p>
</html>
