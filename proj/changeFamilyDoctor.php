<HTML>
<HEAD>
	<title>UM Change Family Doctor </title>
</HEAD>
<BODY>
<?php
	include('./inc/PHPconnectionDB.php');
	session_start();
	
	$conn = connect();
	if (!$conn) {
		$e = oci_error();
   	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
	function validateinsert() {
		if(empty($_POST['iDocID'])) {
			$_SESSION['umd_insERR'] = TRUE;
			$_SESSION['umd_insERRMSG'] = "Both fields are required! <br/>";	
		}
		if(empty($_POST['iPatID'])) {
			$_SESSION['umd_insERR'] = TRUE;
			$_SESSION['umd_insERRMSG'] = "Both fields are required! <br/>";	
		}
	}
	
	function validateupdate() {
		if(empty($_POST['uOldDocID'])) {
			$_SESSION['umd_updERR'] = TRUE;
			$_SESSION['umd_updERRMSG'] = "All four fields are required! <br/>";	
		}
		if(empty($_POST['uOldPatID'])) {
			$_SESSION['umd_updERR'] = TRUE;
			$_SESSION['umd_updERRMSG'] = "All four fields are required! <br/>";	
		}
		if(empty($_POST['uNewDocID'])) {
			$_SESSION['umd_updERR'] = TRUE;
			$_SESSION['umd_updERRMSG'] = "All four fields are required! <br/>";	
		}
		if(empty($_POST['uNewPatID'])) {
			$_SESSION['umd_updERR'] = TRUE;
			$_SESSION['umd_updERRMSG'] = "All four fields are required! <br/>";	
		}		
	}
	if (isset($_POST['iDocPat'])) {	
		$_SESSION['umd_insERR'] = FALSE;
		$_SESSION['umd_insERRMSG'] = "";
		
		validateinsert();
		if($_SESSION['umd_insERR'] == FALSE) {
			$sql = "INSERT INTO family_doctor(doctor_id, patient_id) VALUES(" . $_POST['iDocID'] . "," . $_POST['iPatID'] . ")";
			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
	   	if (!$res) {
				$e = oci_error($stid);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				echo "it broke";
			}
		}
		header( 'Location: ./um_familyDoctor.php' );
	}
	if (isset($_POST['uDocPat'])) {	
		$_SESSION['umd_updERR'] = FALSE;
		$_SESSION['umd_updERRMSG'] = "";
		
		validateinsert();
		if($_SESSION['umd_updERR'] == FALSE) {
			$sql = "UPDATE family_doctor SET (doctor_id =" .
				$_POST['uNewDocID'] . ", patient_id =" . $_POST['uNewPatID'] .
				" WHERE doctor_id =" . $_POST['uOldDocID'] . "," . $_POST['uOldPatID'];
			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
	   	if (!$res) {
				$e = oci_error($stid);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				echo "it broke";
			}
		}
		header( 'Location: ./um_familyDoctor.php' );
	}
?>
</BODY>
</HTML>
