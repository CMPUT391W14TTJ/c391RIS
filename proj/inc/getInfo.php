<?php
	include('PHPconnectionDB.php');
	session_start();

	function getUserInfo() {
		/*
		 * connect to the db
 		 */
		$conn = connect();
		if (!$conn) {
   			$e = oci_error();
   			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    		} 
				
		$sql = "SELECT * FROM users WHERE person_id = " . $_SESSION['user_id'];
		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);

		/*
		 * check if the old password is the current password
		 */
		if (($row = oci_fetch_array($stid, OCI_ASSOC))) {
			$_SESSION['username'] = $row['USER_NAME'];
			$_SESSION['password'] = $row['PASSWORD'];
		}
		return;
	}

	function getPersonalInfo() {
		/*
		 * connect to the db
 		 */
		$conn = connect();
		if (!$conn) {
   			$e = oci_error();
   			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    		} 
				
		$sql = "SELECT * FROM persons WHERE person_id = " . $_SESSION['user_id'];
		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);

		/*
		 * check if the old password is the current password
		 */
		if (($row = oci_fetch_array($stid, OCI_ASSOC))) {
			$_SESSION['first_name'] = $row['FIRST_NAME'];
			$_SESSION['last_name'] = $row['LAST_NAME'];
			$_SESSION['address'] = $row['ADDRESS'];
			$_SESSION['email'] = $row['EMAIL'];
			$_SESSION['phone'] = $row['PHONE'];
		}
		return;
	}
?>
