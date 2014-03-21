<?php
function printData(){
	include('./inc/PHPconnectionDB.php');
	
	//$sql = 'SELECT * from facts';
	//$sql = 'SELECT full_name, test_type, EXTRACT(YEAR from test_date), SUM(num_images) from facts GROUP BY full_name, test_type, EXTRACT(YEAR from test_date)';
	//$sql = 'SELECT full_name, test_type, to_char(test_date, \'MON\'), SUM(num_images) from facts GROUP BY full_name, test_type, to_char(test_date, \'MON\')';
	
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
	drawTable($stid);
	oci_close($conn);
}

function drawTable($stid){
	echo '<table border="1" style="width:100%">
		<tr>
		<th>Patient name</th>
		<th>Test Type</th>
		<th>Test Date</th>
		<th>Num Images</th>
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
}
?>
