
<?php 
/**
* Executes a serach with no restrictions. For people with admin access ONLY
* please ensure you have the right credentials before calling this serach.
* TODO: Have this search double check your session variables to double check
* security.
*/
function searchDataAdmin($keywords, $start, $end, $order){

	include('./inc/PHPconnectionDB.php');
	$kFlag = true;
	$dFlag = true;
	
	if(empty($keywords)){
		$kFlag=false;
	}
	
	if(!is_numeric($start) || !is_numeric($end)){
		$dFlag = false;
	}
	//Setup the right search	
	$sql = setupSearch($kFlag, $dFlag, $keywords, $start, $end);
	
	$sql.= setupOrder($order);
	
	if($sql != 'none'){
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
	drawTable($stid);
	oci_close($conn);
	}
}
function searchDataDoctor($keywords, $start, $end, $order, $userID){

	include('./inc/PHPconnectionDB.php');
	$kFlag = true;
	$dFlag = true;
	
	if(empty($keywords)){
		$kFlag=false;
	}
	
	if(!is_numeric($start) || !is_numeric($end)){
		$dFlag = false;
	}
	//Setup the right search	
	$sql = setupSearch($kFlag, $dFlag, $keywords, $start, $end);
	
	$sql.= ' AND r.doctor_id = '.$userID;
	
	$sql.= setupOrder($order);
	
	if($sql != 'none'){
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
	drawTable($stid);
	oci_close($conn);
	}
}
function searchDataPatient($keywords, $start, $end, $order, $userID){

	include('./inc/PHPconnectionDB.php');
	$kFlag = true;
	$dFlag = true;
	
	if(empty($keywords)){
		$kFlag=false;
	}
	
	if(!is_numeric($start) || !is_numeric($end)){
		$dFlag = false;
	}
	//Setup the right search	
	$sql = setupSearch($kFlag, $dFlag, $keywords, $start, $end);
	
	$sql.= ' AND r.patient_id = '.$userID;
	
	$sql.= setupOrder($order);
	
	if($sql != 'none'){
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
	drawTable($stid);
	oci_close($conn);
	}
}
function searchDataRadiologist($keywords, $start, $end, $order, $userID){

	include('./inc/PHPconnectionDB.php');
	$kFlag = true;
	$dFlag = true;
	
	if(empty($keywords)){
		$kFlag=false;
	}
	
	if(!is_numeric($start) || !is_numeric($end)){
		$dFlag = false;
	}
	//Setup the right search	
	$sql = setupSearch($kFlag, $dFlag, $keywords, $start, $end);
	
	$sql.= ' AND r.radiologist_id = '.$userID;
	
	$sql.= setupOrder($order);
	
	if($sql != 'none'){
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
	drawTable($stid);
	oci_close($conn);
	}
}
/**
* Sets up the search query based on user input
*/
function setupSearch($kFlag, $dFlag, $keywords, $start, $end){
	$sql = "";
	if($kFlag && $dFlag){
		//echo '<p> Date and keyword </p>';
		$sql = select().keywords($keywords). dates($start, $end);
	}else if($kFlag){
		//echo '<p> Keyword </p>';
		$sql = select().keywords($keywords);
	}else if($dFlag){
		//echo '<p> Dates </p>';
		$sql = select(). dates($start, $end);
	}else{
		//$sql = select();
		$sql = 'none';
	}
	
	return $sql;
}

/**
* Applies the correct order to the rows
*/
function setupOrder($order){

	if($order == 'Date ASC'){
		return dateAscending();
	}else if($order == 'Date DESC'){
		return dateDescending();
	}else if(!$kFlag){
		return dateDescending();
	}else{
		return rank();
	}
}
/**
* Builds the basic select statement we need for the search
*/
function select(){
	return 'SELECT r.record_id, p.full_name, 
		d.full_name as doctor_name, r.full_name as radiologist_name, r.test_type, r.prescribing_date,
		r.test_date, r.diagnosis, r.description
		FROM radiology_record r, persons p, persons d, persons r
		WHERE r.patient_id = p.person_id AND r.doctor_id = d.person_id
		AND r.radiologist_id = r.person_id' ;
}
/**
* Adds filtering of results by keywords(must be comma seperated)
*/
function keywords($keywords){
	$string = "";
	$string .=  ' AND(';
	$string .=  ' (contains(p.first_name, \'' . $keywords. '\', '.'1'. ') > 0)';
	$string .=  ' OR (contains(p.last_name, \'' . $keywords.'\', '.'2'. ') > 0)';
	$string .=  ' OR (contains(r.diagnosis, \'' . $keywords. '\', '.'3'. ') > 0)';
	$string .=  ' OR (contains(r.description, \'' . $keywords. '\','.'4'. ' ) > 0)';
	$string .=  ')';
	return $string;
}
/**
* Adds filtering of results by date range
*/
function dates($start, $end){
	$string = ' AND (r.test_date BETWEEN
			TO_DATE(\'' . $start . '\', \'MMDDYYYY\')
			AND
			TO_DATE(\'' . $end . '\', \'MMDDYYYY\'))';
	return $string;
}
/**
* Adds ordering of rows by ascending date
*/
function dateAscending(){
	$string = ' ORDER BY r.test_date ASC';
	return $string;
}
/**
* Adds ordering of rows by decending date
*/
function dateDescending(){
	$string = ' ORDER BY r.test_date DESC';
	return $string;
}
/**
* Adds the rank function to the query if we are using keywords
*/
function rank(){
	$string = ' ORDER BY (RANK() OVER (ORDER BY(6*(SCORE(1)+SCORE(2)) + 3*SCORE(3) + SCORE(4)))) DESC';
	return $string;
}

/**
* Draws the result table in HTML format
*/
function drawTable($stid){
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
}
?> 

