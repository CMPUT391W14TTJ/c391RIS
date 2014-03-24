<?php
function printData($patient, $test, $time){
	include('./inc/PHPconnectionDB.php');
	//Build the query
	$sql = 'SELECT ';
	$sql.= setupSelect($patient, $test, $time);
	$sql.= 'from FACTS';
	$sql.= setupGroup($patient, $test, $time);

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
	drawTable($patient, $test, $time, $stid);
	oci_close($conn);

}
/**
* Sets up the select portion of the query
*/
function setupSelect($patient, $test, $time){

	$string = '';

	if(!empty($patient)){
		$string .= ' full_name,';
	}
	
	if(!empty($test)){
		$string .= ' test_type,';
	}
	
	switch($time){
		case 'Week':
			$string .= ' to_char(test_date, \'IW\'),';
			break;
		case   'Month':
			$string .= ' to_char(test_date, \'MON\'),';
			break;
		case 'Year':
			$string .= ' EXTRACT(YEAR from test_date),';
			break;
		case 'Total':
			$string .= '';
			break;	
	}
	
	$string.= ' SUM(num_images) ';
	
	return $string;
}

/**
* Sets up the group by portion of the query
*/
function setupGroup($patient, $test, $time){
	$string = '';
	//Indicates if we have a previous entry so we know we need a
	// ',' preceeding outselfs.
	$prevFlag = false;
	
	if(empty($patient) && empty($test) && ($time == 'Total')){
		//No group by needed
		return $string;
	}
	
	$string.=' GROUP BY ';

	if(!empty($patient)){
		$string .= ' full_name';
		$prevFlag = true;
	}
	
	if(!empty($test)){
		if($prevFlag){
			$string.=',';
		}
		$string .= ' test_type';
		$prevFlag = true;
	}
	
	switch($time){
		case 'Week':
			if($prevFlag){
				$string.=',';
			}
			$string .= ' to_char(test_date, \'IW\')';
			break;
		case   'Month':
			if($prevFlag){
				$string.=',';
			}
			$string .= ' to_char(test_date, \'MON\')';
			break;
		case 'Year':
			if($prevFlag){
				$string.=',';
			}
			$string .= ' EXTRACT(YEAR from test_date)';
			break;
		case 'Total':
			$string .= '';
			break;	
	}
	
	return $string;
}

/**
* Draws the table and the results out to the screen
*/
function drawTable($patient, $test, $time,$stid){
	echo '<table border="1"> <tr>';

	if(!empty($patient)){
		//patient header
		echo '<th>Patient name</th>';
	}
	if(!empty($test)){
		//Test type header
		echo '<th>Test Type</th>';
	}
	//Lable the proper time header
	switch($time){
		case 'Week':
			echo '<th>Week</th>';
			break;
		case   'Month':
			echo '<th>Month</th>';
			break;
		case 'Year':
			echo '<th>Year</th>';
			break;
		case 'Total':
			break;	
	}
	//Num Images always exists
	echo 	'<th>Num Images</th> </tr>';
	//Output the data
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
}
?>
