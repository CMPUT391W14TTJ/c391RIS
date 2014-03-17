<html>
<title>Report Generating Module - CMPUT 391 TTJ</title>
	<?php 	include('./inc/PHPconnectionDB.php');
	?>
	<p>
	<?php
		include('./inc/navigation.php');
		include('./inc/ReportPicker.php');
	?>
	<?php
		//Get the variables we need
		$diagnosis = $_POST['diagnosis'];
		$start_month = sprintf("%02s", $_POST['Start_month']);
		$start_day = sprintf("%02s", $_POST['Start_day']);
		$start_year = $_POST['Start_year'];
		$end_month = sprintf("%02s", $_POST['End_month']);
		$end_day = sprintf("%02s", $_POST['End_day'] + 1);
		$end_year = $_POST['End_year'];
		
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

		$conn = connect();
		if (!$conn) {
   			$e = oci_error();
   			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    		} 

		//Parse the sql
		$stid = oci_parse($conn, $sql);
		//Execute
		$res = oci_execute($stid);
		
		echo '<table border="1" style="width:100%">
		<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Address</th>
		<th>Phone Number</th>
		<th>Test Date</th>
		</tr>';oci_close ( resource $conn );

		while(($row = oci_fetch_array($stid, OCI_ASSOC))) {
			echo '<tr>';
			foreach($row as $item){
				echo '<td>';
				echo $item;
				echo '</td>';
			}
			echo '</tr>';
		}
		echo '</table>';
		oci_close($conn);
	?>
	</p>
</html>
