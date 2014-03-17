
<?php 
	
function searchDataAdmin($keywords, $start, $end){

	include('./inc/PHPconnectionDB.php');
	$kFlag = true;
	$dFlag = true;
	
	if(empty($keywords)){
		$kFlag=false;
	}
	if(!strpos($start, 'NULL') || !strpos($end, 'NULL')){
		$dFlag = false;
	}
	
	if($kFlag && $dFlag){
		$sql = select(). keywords($keywords). date($start, $end);
	}else if($kFlag){
		$sql = select(). keywords($keywords);
	}else if($dFlag){
		$sql = select(). date($start, $end);
	}else{
		$sql = select();
	}		
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
		<th>Record ID</th>
		<th>Patient name</th>
		<th>Doctor Name</th>
		<th>Radiologist Name</th>
		<th>Test Type</th>
		<th>Perscribing Date</th>
		<th>Test Date</th>
		<th>Diagnosis</th>
		<th>Description</th>
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

function select(){
	return 'SELECT r.record_id, p.first_name || \' \' || p.last_name as patient_name, 
		d.first_name || \' \' || d.last_name as doctor_name, r.first_name ||
		\' \' || r.last_name as radiologist_name, r.test_type, r.prescribing_date,
		r.test_date, r.diagnosis, r.description
		FROM radiology_record r, persons p, persons d, persons r
		WHERE r.patient_id = p.person_id AND r.doctor_id = d.person_id
		AND r.radiologist_id = r.person_id' ;
}

function keywords($keywords){
	return ' contains(p.first_name, \'' . $keywords . '\', 1) > 0
		OR contains(p.last_name, \'' . $keywords . '\', 1) > 0
		OR contains(diagnosis, \'' . $keywords . '\', 1) > 0
		OR contains(description, \'' . $keywords . '\', 1) > 0';
}
?> 

