<HTML>
<HEAD>
	<title>UM Change Users </title>
</HEAD>
<BODY>
<?php
	function validateid($con, $id) {
		$sqlid = "SELECT person_id as MID FROM persons";
		$parseid = oci_parse($con, $sqlid);
		oci_execute($parseid);
		$allpids = oci_fetch_all($parseid);
		if(!(in_array($id, $allpids))) {
			$_SESSION['umu_ERR'] = TRUE;
			$_SESSION['umu_ERRMSG'] .= "Person ID does not exist in Persons\n";
		}
	}

	function validateform($con) {
			if(!(empty($_POST['oldPersonID']))) {
				$sqlid = "SELECT max(person_id) as MID FROM users";
				$parseid = oci_parse($con, $sqlid);
				oci_execute($parseid);	
				oci_fetch($parseid);
				$maxid = oci_result($parseid, 'MID');
				if($_POST['oldPersonID']>$maxid) {
					$_SESSION['umu_ERR'] = TRUE;
					$_SESSION['umu_ERRMSG'] .= "You entered an invalid Person ID \n";
				}
			}
			if(!(empty($_POST['newUserName']))) {
				if(strlen($_POST['newUserName'])>24) {
					$_SESSION['umu_ERR'] = TRUE;
					$_SESSION['umu_ERRMSG'] .= "First name must be less than 24 characters \n";
				}
			}
			if(!(empty($_POST['newPassword']))) {
				if(strlen($_POST['newPassword'])>24) {
					$_SESSION['umu_ERR'] = TRUE;
					$_SESSION['umu_ERRMSG'] .= "Last name must be less than 24 characters \n";
				}
			}			
			if(!(empty($_POST['newClass']))) {
				if(strlen($_POST['newClass'])>128) {
					$_SESSION['umu_ERR'] = TRUE;
					$_SESSION['umu_ERRMSG'] .= "Address must be less than 128 characters \n";
				}
			}
			if(!(empty($_POST['newDateRegistered']))) {
				if(strlen($_POST['newDateRegistered'])>128) {
					$_SESSION['umu_ERR'] = TRUE;
					$_SESSION['umu_ERRMSG'] .= "Email must be less than 128 characters \n";
				}
			}
	}

	session_start();
	include('./inc/PHPconnectionDB.php');
	$conn = connect();
	if (!$conn) {
   		$e = oci_error();
   		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
  	}
	if (isset($_POST['ChangeUsers'])) {
		if(!(empty($_POST['oldPersonID']))) {			
/*
 * generate the sql query for update based on given information
 */		
 			$_SESSION['umu_ERR'] = FALSE;
 			$_SESSION['umu_ERRMSG'] = "";
		
			validateform($conn);
			
			if($_SESSION['umu_ERR'] == FALSE) {
				$sql = "UPDATE users SET "	;
				if(!(empty($_POST['newUserName']))) {
					$sql .= "user_name ='" . $_POST['newUserName'] . "', ";
				}
				if(!(empty($_POST['newPassword']))) {
					$sql .= "password ='" . $_POST['newPassword'] . "', ";
				}			
				if(!(empty($_POST['newClass']))) {
					$sql .= "class = '" . $_POST['newClass'] . "', ";
				}
				if(!(empty($_POST['newDateRegistered']))) {
					$sql .= "date_registered = '" . $_POST['newDateRegistered'] . "', ";
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
			header( 'Location: ./um_users.php' );
		} else {	
 			$_SESSION['umu_ERR'] = FALSE;
 			$_SESSION['umu_ERRMSG'] = "";
			
			$sqlid = "SELECT max(person_id) as MID FROM users";
			$parseid = oci_parse($conn, $sqlid);
			oci_execute($parseid);	
			oci_fetch($parseid);
			$maxid = oci_result($parseid, 'MID');
			$nextid = $maxid + 1;				
				
			validateform($conn);
			validateid($conn, $nextid);
			if($_SESSION['umu_ERR'] == FALSE) {
				$sql = "INSERT into users(person_id, user_name, password, class, date_registered)" .
					"VALUES (" . $nextid .
					",'" . $_POST['newUserName'] .
					"','" . $_POST['newPassword'] .
					"','" . $_POST['newClass'] .
					"','" . $_POST['newDateRegistered'] . "')";
				$stid = oci_parse($conn, $sql);
				$res = oci_execute($stid);
				if (!$res) {
					$e = oci_error($stid);
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				}
	    	}
	    	header( 'Location: ./um_users.php' );
		}	
	}
?>
</BODY>
</HTML>