
<?php
		
function generateReport($diagnosis, $start_month, $start_day, $start_year, $end_month, $end_day, $end_year){	

	include('./inc/PHPconnectionDB.php');	
	//SQL statement
	$sql = 'SELECT first_name, last_name, address, phone, MIN(test_date), diagnosis
		FROM radiology_record r, persons p
		WHERE contains(r.diagnosis, \'' . $diagnosis . '\', 1) > 0 AND 
		r.patient_id = p.person_id AND (r.test_date BETWEEN
		TO_DATE(\'' . $start_month . $start_day . $start_year . '\', \'MMDDYYYY\')
		AND
		TO_DATE(\'' . $end_month . $end_day . $end_year . '\', \'MMDDYYYY\'))
		GROUP BY first_name, last_name, address, phone, diagnosis';
		
	//echo $sql;

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
	<th>Diagnosis</th>
	</tr>';
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
}
?>

