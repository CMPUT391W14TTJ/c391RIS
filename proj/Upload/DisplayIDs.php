<?php
	//include ( '../inc/PHPconnectionDB.php' );
	function displayPatients() {
		$conn = connect();
		if (!$conn) {
   			$e = oci_error();
   			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   		} 
			
		$sql = "SELECT p.person_id, p.first_name, p.last_name FROM persons p, users u WHERE " . 
		    "u.class = 'p' AND u.person_id = p.person_id"; 

		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);
		while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
			echo "<option value='" . $row['PERSON_ID'] .  "'>" .
			    $row['FIRST_NAME'] . " " . $row['LAST_NAME'] . "</option>";	
		} 
		oci_close();
	}

	function displayDoctors() {
		$conn = connect();
		if (!$conn) {
   			$e = oci_error();
   			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   		} 
			
		$sql = "SELECT p.person_id, p.first_name, p.last_name FROM persons p, users u WHERE " . 
		    "u.class = 'd' AND u.person_id = p.person_id"; 

		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);
		while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
			echo "<option value='" . $row['PERSON_ID'] .  "'>" .
			    $row['FIRST_NAME'] . " " . $row['LAST_NAME'] . "</option>";	
		} 
		oci_close();
	}

	function displayRadiologists() {
		$conn = connect();
		if (!$conn) {
   			$e = oci_error();
   			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   		} 
			
		$sql = "SELECT p.person_id, p.first_name, p.last_name FROM persons p, users u WHERE " . 
		    "u.class = 'r' AND u.person_id = p.person_id"; 

		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);
		while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
			echo "<option value='" . $row['PERSON_ID'] .  "'>" .
			    $row['FIRST_NAME'] . " " . $row['LAST_NAME'] . "</option>";	
		} 
		oci_close();
	}
?>
