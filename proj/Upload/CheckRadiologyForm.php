<html>
<head>
	<title>title</title>
</head>
<body>
<?php
	/*
	 * Check if the radiology record was filled out appropriately
	 * For now we will just check that there is a valid record_id/doctorid/etc..
	 */
	error_reporting(E_ALL);
	ini_set('error_reporting', E_ALL);
	session_start();
	include( '../inc/PHPconnectionDB.php' );

	function checkRecordID($recordID) {
		$conn = connect();
		if (!$conn) {
   			$e = oci_error();
   			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   		} 
			
		$sql = "SELECT record_id FROM radiology_record WHERE record_id = " . $recordID;
		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);
		if (($row = oci_fetch_array($stid, OCI_ASSOC))) {
			$_SESSION['err'] = True;
			$_SESSION['err_msg'] = "record_id already exists in the system! Please choose a unique ID.";
			header('Location: ../UploadPage.php');
			exit(1);
		}
		oci_close();
	}

	function buildTestDateQuery() {
		$testMonth = sprintf("%02s", $_POST['test_month']);
		$testDay = sprintf("%02s", $_POST['test_day']);
		$testYear = sprintf("%02s", $_POST['test_year']);

		$sql = 'INSERT INTO radiology_record (record_id, patient_id, doctor_id, radiologist_id' .
			', test_type, diagnosis, description, prescribing_date, test_date) VALUES (' . 
			$_POST['record_id'] . ' ,' . $_POST['patient_id'] . ',' . $_POST['doctor_id'] . 
			' ,' . $_POST['radiologist_id'] . ', \'' . $_POST['test_type'] . '\' ' . ',\''. 
			$_POST['diagnosis'] . '\', ' . '\'' . $_POST['description'] . '\', TO_DATE(\'' . $testYear .
			$testMonth . $testDay . '\', \'YYYYMMDD\'))';	
		return $sql;
	}

	function buildPrescribeDateQuery() {
		$prscMonth = sprintf("%02s", $_POST['prescribe_month']);
		$prscDay = sprintf("%02s", $_POST['prescribe_day']);
		$prscYear = sprintf("%02s", $_POST['prescribe_year']);

		$sql = 'INSERT INTO radiology_record (record_id, patient_id, doctor_id, radiologist_id' .
			', test_type, diagnosis, description, prescribing_date, test_date) VALUES (' . 
			$_POST['record_id'] . ' ,' . $_POST['patient_id'] . ',' . $_POST['doctor_id'] . 
			' ,' . $_POST['radiologist_id'] . ', \'' . $_POST['test_type'] . '\' ' . ',\''. 
			$_POST['diagnosis'] . '\', ' . '\'' . $_POST['description'] . '\', TO_DATE(\'' . 
			$prscYear . $prscMonth . $prscDay .'\', \'YYYYMMDD\'))';
		return $sql;
	}
	
	function buildFullDateQuery() {
		$prscMonth = sprintf("%02s", $_POST['prescribe_month']);
		$prscDay = sprintf("%02s", $_POST['prescribe_day']);
		$prscYear = sprintf("%02s", $_POST['prescribe_year']);

		$testMonth = sprintf("%02s", $_POST['test_month']);
		$testDay = sprintf("%02s", $_POST['test_day']);
		$testYear = sprintf("%02s", $_POST['test_year']);

		$sql = 'INSERT INTO radiology_record (record_id, patient_id, doctor_id, radiologist_id' .
			', test_type, diagnosis, description, prescribing_date, test_date) VALUES (' . 
			$_POST['record_id'] . ' ,' . $_POST['patient_id'] . ',' . $_POST['doctor_id'] . 
			' ,' . $_POST['radiologist_id'] . ', \'' . $_POST['test_type'] . '\' ' . ',\''. 
			$_POST['diagnosis'] . '\', ' . '\'' . $_POST['description'] . '\', TO_DATE(\'' . 
			$prscYear . $prscMonth . $prscDay .'\', \'YYYYMMDD\'), TO_DATE(\'' . $testYear .
			$testMonth . $testDay . '\', \'YYYYMMDD\'))';	
		return $sql;
	}

	function buildNoDateQuery() {
		$sql = "INSERT INTO radiology_record (record_id, patient_id, doctor_id, radiologist_id" .
			", test_type, diagnosis, description) VALUES (" . $_POST['record_id'] . " ," . 
			$_POST['patient_id'] . "," . $_POST['doctor_id'] . " ," . $_POST['radiologist_id'] . 
			", '" . $_POST['test_type'] . "' " . ",'". $_POST['diagnosis'] . "', " . "'" . 
			$_POST['description'] . "')";	
		return $sql;		
	}

	/*
	 * Inserts a record if dates are not present
	 */
	function insertRadiologyRecord($sql) {
		$conn = connect();
		if (!$conn) {
   			$e = oci_error();
   			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   		} 

		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);
		if (!$res) {
			$_SESSION['err'] = True;
			$_SESSION['err_msg'] = "Failed to insert record.";
			header('Location: ../UploadPage.php');
			exit(1);
		}
	}

	function checkPrscDate() {

		if ($_POST['prescribe_month'] == 'NULL'
			|| $_POST['prescribe_day'] == 'NULL'
			|| $_POST['prescribe_year'] == 'NULL') {
			
			return False;
		}	
		return True;
	}

	function checkTestDate() {
		if ($_POST['test_month'] == 'NULL'
			|| $_POST['test_year'] == 'NULL'
			|| $_POST['test_day'] == 'NULL') {
			
			return False;		
		}
		return True;
	}

	if (isset($_POST['uploadRecord'])) {
		if (!isset($_POST['record_id'])	
			|| empty($_POST['record_id'])
			|| $_POST['patient_id'] == 'empty'
			|| $_POST['doctor_id'] == 'empty'
			|| $_POST['radiologist_id'] == 'empty') {

			$_SESSION['err'] = True;
			$_SESSION['err_msg'] = 'Must fill in all required fields (*)';
			header('Location: ../UploadPage.php');
			exit(1);	
		} else {
			checkRecordID($_POST['record_id']);
			
			$testFlag = checkTestDate();
			$prscFlag = checkPrscDate();	
			
			if ($testFlag && $prscFlag) {
				$sql = buildFullDateQuery();
			} else if ($testFlag && !$prscFlag) {
				$sql = buildTestDateQuery();
			} else if (!$testFlag && $prscFlag) {
				$sql = buildPrescribeDateQuery();
			} else {
				$sql = buildNoDateQuery();
			}

			insertRadiologyRecord($sql);	

			$_SESSION['err'] = False;
			header('Location: ../UploadPage.php');
			exit(1);
		
		}	
	} else {
		header( 'Location: ../UploadPage.php');
		exit(1);
	}	
?>
</body>
</html>
