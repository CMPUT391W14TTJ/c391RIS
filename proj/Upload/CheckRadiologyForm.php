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
	}

	function insertRecordWithDate() {
	}

	function insertRecordWithoutDate() {
		$conn = connect();
		if (!$conn) {
   			$e = oci_error();
   			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   		} 
	
		$sql = "INSERT INTO radiology_record (record_id, patient_id, doctor_id, radiologist_id" .
			", test_type, diagnosis, description) VALUES (111, 17, 9, 5, 'Ultrasound'" . 
			", 'Pregnant', 'Wont make it to next week')";	
		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);
		if (!$res) {
			$_SESSION['err'] = True;
			$_SESSION['err_msg'] = "Failed to insert record.";
			header('Location: ../UploadPage.php');
			exit(1);
		}
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
			insertRecordWithoutDate();
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
