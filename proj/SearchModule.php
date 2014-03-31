<?php 
/**
* Executes a serach dependant on userClass.
*/
function searchDB($keywords, $start, $end, $order, $userID, $userClass){

	include('./inc/PHPconnectionDB.php');
	include('./inc/RetrieveImgIds.php');
	include('./inc/DisplayImg.php');
	$kFlag = true;
	$dFlag = true;
	//Check if we have any keywords
	if(empty($keywords)){
		$kFlag=false;
	}
	//Check if we have a valid date range
	if(!is_numeric($start) || !is_numeric($end)){
		$dFlag = false;
	}
	//Setup the right search	
	$sql = setupSearch($kFlag, $dFlag, $keywords, $start, $end);
	
	//Attach user class restrictions
	switch($userClass){
		case "d":
			$sql.= ' AND r.doctor_id = '.$userID;
			break;
		case "p":
			$sql.= ' AND r.patient_id = '.$userID;
			break;
		case "r":
			$sql.= ' AND r.radiologist_id = '.$userID;
			break;		
	}
	if($sql != 'none'){
		//Setup the sort orSELECT r.record_id, p.full_name, d.full_name as doctor_name, r.full_name as radiologist_name, r.test_type, r.prescribing_date, r.test_date, r.diagnosis, r.description FROM radiology_record r, persons p, persons d, persons f WHERE r.patient_id = p.person_id AND r.doctor_id = d.person_id AND r.radiologist_id = f.person_id AND( (contains(p.first_name, 'bi', 1) > 0) OR (contains(p.last_name, 'bi', 2) > 0) OR (contains(r.diagnosis, 'bi', 3) > 0) OR (contains(r.description, 'bi',4 ) > 0)) AND (r.test_date BETWEEN TO_DATE('01072010', 'MMDDYYYY') AND TO_DATE('06032014', 'MMDDYYYY')) AND r.patient_id = 12der
		$sql.= setupOrder($order, $kFlag);
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
function setupOrder($order, $kFlag){
	
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
		d.full_name as doctor_name, f.full_name as radiologist_name, r.test_type, r.prescribing_date,
		r.test_date, r.diagnosis, r.description
		FROM radiology_record r, persons p, persons d, persons f
		WHERE r.patient_id = p.person_id AND r.doctor_id = d.person_id
		AND r.radiologist_id = f.person_id' ;
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
		$recordID = $row['RECORD_ID'];
		foreach($row as $item){
			echo '<td>';
			echo $item;
			echo '</td>';
		}
		echo '</tr>';
		
		$imageIDs = retrieveImgIds($recordID);
		echo "<tr><th>Images</th>";
		for ($i = 0; $i < count($imageIDs) ;$i++) {
			echo '<td><a href="ImageViewer.php?id=' . $imageIDs[$i] . '">';
			displayImg($imageIDs[$i], "thumbnail");	
			echo "</a></td>";
		}
		echo "</tr>";
	}
	echo '</table>';
}
?> 
