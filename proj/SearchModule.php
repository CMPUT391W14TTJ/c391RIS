<html>
<title> Search Module 391 TTJ </title>
<p>
<?php 
	include('./inc/PHPconnectionDB.php');
	include('./inc/navigation.php');
	include( './inc/SearchPicker.php');

	//Get the variables we need
	$keywords = $_POST['Keywords'];
	$keywords = str_replace(";", "&", $keywords);
	echo '<p>'.$keywords.'</p>';

	//SQL statement
	$sql = 'SELECT first_name, last_name, address, phone, MIN(test_date)
		FROM radiology_record r, persons p
		WHERE contains(r.diagnosis, \'' . $diagnosis . '\', 1) > 0 AND 
		r.patient_id = p.person_id AND (r.test_date BETWEEN
		TO_DATE(\'' . $start_month . $start_day . $start_year . '\', \'MMDDYYYY\')
		AND
		TO_DATE(\'' . $end_month . $end_day . $end_year . '\', \'MMDDYYYY\'))
		GROUP BY first_name, last_name, address, phone';
			
	echo $sql;
?> 
</p>
</html>
