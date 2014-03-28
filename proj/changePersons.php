<HTML>
<HEAD>
	<title>UM Change Users </title>
</HEAD>
<BODY>
<?php
	function validateform() {		
		if(!(empty($_POST['newFirstName']))) {
			if(strlen($_POST['newFirstName'])>24) {
				$_SESSION['ump_ERR'] = TRUE;
				$_SESSION['ump_ERRMSG'] .= "First name must be less than 24 characters! <br/>";
			}
		}elseif (empty($_POST['oldPersonID'])) {
			$_SESSION['ump_ERR'] = TRUE;
			$_SESSION['ump_ERRMSG'] .= "First name cannot be empty! <br/>";
		}
		if(!(empty($_POST['newLastName']))) {
			if(strlen($_POST['newLastName'])>24) {
				$_SESSION['ump_ERR'] = TRUE;
				$_SESSION['ump_ERRMSG'] .= "Last name must be less than 24 characters! <br/>";
			}
		}	elseif (empty($_POST['oldPersonID'])) {
			$_SESSION['ump_ERR'] = TRUE;
			$_SESSION['ump_ERRMSG'] .= "Last name cannot be empty! <br/>";
		}		
		if(!(empty($_POST['newAddress']))) {
			if(strlen($_POST['newAddress'])>128) {
				$_SESSION['ump_ERR'] = TRUE;
				$_SESSION['ump_ERRMSG'] .= "Address must be less than 128 characters! <br/>";
			}
		} elseif (empty($_POST['oldPersonID'])) {
			$_SESSION['ump_ERR'] = TRUE;
			$_SESSION['ump_ERRMSG'] .= "Address cannot be empty! <br/>";
		}
		if(!(empty($_POST['newEmail']))) {
			if(strlen($_POST['newEmail'])>128) {
				$_SESSION['ump_ERR'] = TRUE;
				$_SESSION['ump_ERRMSG'] .= "Email must be less than 128 characters! <br/>";
			}
		} elseif (empty($_POST['oldPersonID'])) {
			$_SESSION['ump_ERR'] = TRUE;
			$_SESSION['ump_ERRMSG'] .= "Email cannot be empty! <br/>";
		}
		if(!(empty($_POST['newPhone']))) {
			if(strlen($_POST['newPhone'])>10) {
				$_SESSION['ump_ERR'] = TRUE;
				$_SESSION['ump_ERRMSG'] .= "Phone must be less than 10 characters! <br/>";
			}
		} elseif (empty($_POST['oldPersonID'])) {
			$_SESSION['ump_ERR'] = TRUE;
			$_SESSION['ump_ERRMSG'] .= "Phone number cannot be empty! <br/>";
		}
	}


	session_start();
	include('./inc/PHPconnectionDB.php');
	$conn = connect();
	if (!$conn) {
   		$e = oci_error();
   		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
  	}
	if (isset($_POST['ChangePersons'])) {
		if(!(empty($_POST['oldPersonID']))) {			
/*
 * generate the sql query for update based on given information
 */		
 			$_SESSION['ump_ERR'] = FALSE;
 			$_SESSION['ump_ERRMSG'] = "";
		
			validateform();
			
			if($_SESSION['ump_ERR'] == FALSE) {
				$sql = "UPDATE persons SET "	;
				if(!(empty($_POST['newFirstName']))) {
					$sql .= "first_name ='" . $_POST['newFirstName'] . "', ";
				}
				if(!(empty($_POST['newLastName']))) {
					$sql .= "last_name ='" . $_POST['newLastName'] . "', ";
				}			
				if(!(empty($_POST['newAddress']))) {
					$sql .= "address = '" . $_POST['newAddress'] . "', ";
				}
				if(!(empty($_POST['newEmail']))) {
					$sql .= "email = '" . $_POST['newEmail'] . "', ";
				}
				if(!(empty($_POST['newPhone']))) {
					$sql .= "phone = '" . $_POST['newPhone'] . "', ";
				}
				
				$sql = substr($sql, 0, -2);
				$sql .= " WHERE person_id=" . $_POST['oldPersonID'];
				$stid = oci_parse($conn, $sql);
				$res = oci_execute($stid);
				if (!($res)) {
					$e = oci_error($stid);
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				}
			}
			header( 'Location: ./um_persons.php' );
		} else {	
 			$_SESSION['ump_ERR'] = FALSE;
 			$_SESSION['ump_ERRMSG'] = "";
				
			validateform();
			if($_SESSION['ump_ERR'] == FALSE) {
				$sqlid = "SELECT max(person_id) as MID FROM persons";
				$parseid = oci_parse($conn, $sqlid);
				oci_execute($parseid);	
				oci_fetch($parseid);
				$maxid = oci_result($parseid, 'MID');
				$nextid = $maxid + 1;
				
				$sql = "INSERT into persons(person_id, first_name, last_name, address, email, phone)" .
					"VALUES (" . $nextid .
					",'" . $_POST['newFirstName'] .
					"','" . $_POST['newLastName'] .
					"','" . $_POST['newAddress'] .
					"','" . $_POST['newEmail'] .
					"','" . $_POST['newPhone'] . "')";
				$stid = oci_parse($conn, $sql);
				$res = oci_execute($stid);
				if (!$res) {
					$e = oci_error($stid);
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				}
	    	}
	    	header( 'Location: ./um_persons.php' );
		}	
	}
?>
</BODY>
</HTML>