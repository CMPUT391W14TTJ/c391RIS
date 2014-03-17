<?php
	include('PHPconnectionDB.php');
	include('./classes/user.php');
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
				
		$sql = "SELECT * FROM users WHERE person_id = " . $_SESSION['user']->user_id;
		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);

		/*
		 * check if the old password is the current password
		 */
		if (($row = oci_fetch_array($stid, OCI_ASSOC))) {
			$_SESSION['user']->setUserInfo($row['USER_NAME'], $row['PASSWORD']);
			//will get rid of this once I have user class working
			//$_SESSION['username'] = $row['USER_NAME'];
			//$_SESSION['password'] = $row['PASSWORD'];
		} 
		oci_close();
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
				
		$sql = "SELECT * FROM persons WHERE person_id = " . $_SESSION['user']->user_id;
		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);

		/*
		 * check if the old password is the current password
		 */
		if (($row = oci_fetch_array($stid, OCI_ASSOC))) {
			$_SESSION['user']->setPersonalInfo($row['FIRST_NAME'], $row['LAST_NAME'],
			    $row['ADDRESS'], $row['EMAIL'], $row['PHONE']);
			// will remove this when I get user class working
			//$_SESSION['first_name'] = $row['FIRST_NAME'];
			//$_SESSION['last_name'] = $row['LAST_NAME'];
			//$_SESSION['address'] = $row['ADDRESS'];
			//$_SESSION['email'] = $row['EMAIL'];
			//$_SESSION['phone'] = $row['PHONE'];
		}
		oci_close();
		return;
	}
?>
