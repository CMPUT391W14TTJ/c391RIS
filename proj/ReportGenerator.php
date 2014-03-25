<html>
<title>Report Generating Module - CMPUT 391 TTJ</title>
<p>
<?php
	
	include('./inc/navigation.php');
	include('./inc/ReportForm.php');
	include('ReportGeneratingModule.php');
	
	session_start();
	
	//Get the variables we need
	$diagnosis = $_POST['diagnosis'];
	$start_month = sprintf("%02s", $_POST['Start_month']);
	$start_day = sprintf("%02s", $_POST['Start_day']);
	$start_year = $_POST['Start_year'];
	$end_month = sprintf("%02s", $_POST['End_month']);
	$end_day = sprintf("%02s", $_POST['End_day'] + 1);
	$end_year = $_POST['End_year'];
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
   		generateReport($diagnosis, $start_month, $start_day, 
   		$start_year, $end_month, $end_day, $end_year);
	} 
		
	
?>
</p>
</html>

