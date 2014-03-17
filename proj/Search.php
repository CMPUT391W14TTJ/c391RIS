<html>
<title> Search 391 TTJ </title>
<p>
<?php
	
	include('./inc/navigation.php');
	include('./inc/SearchPicker.php');
	include('SearchModule.php');
	
	//Get the variables we need
	$keywords = $_POST['Keywords'];
	$replaces = array(" ", ";");
	$keywords = str_replace($replaces, "&", $keywords);
	//Get the variables we need
	$start_month = sprintf("%02s", $_POST['Start_month']);
	$start_day = sprintf("%02s", $_POST['Start_day']);
	$start_year = $_POST['Start_year'];
	$end_month = sprintf("%02s", $_POST['End_month']);
	$end_day = sprintf("%02s", $_POST['End_day'] + 1);
	$end_year = $_POST['End_year'];
	
	searchDataAdmin($keywords, $start_month . $start_day . $start_year, $end_month . $end_day . $end_year );
	
?>
</p>
</html>
