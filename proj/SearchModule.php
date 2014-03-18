
<?php 
	
function searchDataAdmin($keywords, $start, $end){

	include('./inc/PHPconnectionDB.php');
	$kFlag = true;
	$dFlag = true;
	
	if(empty($keywords)){
		$kFlag=false;
	}
	
	if(!is_numeric($start)){
		echo '<p>'.$start. '</p>';
		$dFlag = false;
	}
	if(!is_numeric($end)){
		echo '<p>'.$end. '</p>';
		$dFlag = false;
	}	
	if($kFlag && $dFlag){
		echo '<p> Date and keyword </p>';
		$sql = select(). keywords($keywords). dates($start, $end);
	}else if($kFlag){
		echo '<p> Keyword </p>';
		$sql = select(). keywords($keywords);
	}else if($dFlag){
		echo '<p> Dates </p>';
		$sql = select(). dates($start, $end);
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
	return 'SELECT r.record_id, p.full_name, 
		d.full_name as doctor_name, r.full_name as radiologist_name, r.test_type, r.prescribing_date,
		r.test_date, r.diagnosis, r.description
		FROM radiology_record r, persons p, persons d, persons r
		WHERE r.patient_id = p.person_id AND r.doctor_id = d.person_id
		AND r.radiologist_id = r.person_id' ;
}

function keywords($keywords){
	echo '<p>'.$keywords.'</p>';
	$tok = strtok($keywords, " ");
	$array = array();

	while ($tok !== false) {
		array_push($array, $tok);
    		$tok = strtok(" \n\t");
	}
	$string = "";

	for($i=0; $i<count($array); $i++){
		$string = $string . ' AND(';
		$string = $string . ' (contains(p.first_name, \'' . $array[$i]. '\', '.$i.'1'. ') > 0)';
		$string = $string . ' OR (contains(p.last_name, \'' . $array[$i].'\', '.$i.'2'. ') > 0)';
		$string = $string . ' OR (contains(r.diagnosis, \'' . $array[$i]. '\', '.$i.'3'. ') > 0)';
		$string = $string . ' OR (contains(r.description, \'' . $array[$i]. '\','.$i.'4'. ' ) > 0)';
		$string = $string . ')';
	}
	return $string;
}

function dates($start, $end){
	$string = ' AND (r.test_date BETWEEN
			TO_DATE(\'' . $start . '\', \'MMDDYYYY\')
			AND
			TO_DATE(\'' . $end . '\', \'MMDDYYYY\'))';
	return $string;
}
?> 

