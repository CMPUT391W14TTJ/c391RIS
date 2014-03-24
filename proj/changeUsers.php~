<HTML>
<HEAD>
	<title>UM Change Users </title>
</HEAD>
<BODY>
<?php
	function validateinsert() {
					if(!(empty($_POST['iNewUserName']))) {
				if(strlen($_POST['iNewUserName'])>24) {
					$_SESSION['umu_insERR'] = TRUE;
					$_SESSION['umu_insERRMSG'] .= "First name must be less than 24 characters \n";
				}
			}
			if(!(empty($_POST['iNewPassword']))) {
				if(strlen($_POST['iNewPassword'])>24) {
					$_SESSION['umu_insERR'] = TRUE;
					$_SESSION['umu_insERRMSG'] .= "Last name must be less than 24 characters \n";
				}
			}			
			if(!(empty($_POST['iNewClass']))) {
				if(strlen($_POST['iNewClass'])>128) {
					$_SESSION['umu_insERR'] = TRUE;
					$_SESSION['umu_insERRMSG'] .= "Address must be less than 128 characters \n";
				}
			}
			if(!(empty($_POST['iNewDateRegistered']))) {
				if(strlen($_POST['iNewDateRegistered'])>128) {
					$_SESSION['umu_insERR'] = TRUE;
					$_SESSION['umu_insERRMSG'] .= "Email must be less than 128 characters \n";
				}
			}
	}
		function validateinsert() {
					if(!(empty($_POST['uNewUserName']))) {
				if(strlen($_POST['uNewUserName'])>24) {
					$_SESSION['umu_updERR'] = TRUE;
					$_SESSION['umu_updERRMSG'] .= "First name must be less than 24 characters \n";
				}
			}
			if(!(empty($_POST['uNewPassword']))) {
				if(strlen($_POST['unewPassword'])>24) {
					$_SESSION['umu_updERR'] = TRUE;
					$_SESSION['umu_updERRMSG'] .= "Last name must be less than 24 characters \n";
				}
			}			
			if(!(empty($_POST['uNewClass']))) {
				if(strlen($_POST['uNewClass'])>128) {
					$_SESSION['umu_updERR'] = TRUE;
					$_SESSION['umu_updERRMSG'] .= "Address must be less than 128 characters \n";
				}
			}
			if(!(empty($_POST['uNewDateRegistered']))) {
				if(strlen($_POST['uNewDateRegistered'])>128) {
					$_SESSION['umu_updERR'] = TRUE;
					$_SESSION['umu_updERRMSG'] .= "Email must be less than 128 characters \n";
				}
			}
	}


	session_start();
	include('./inc/PHPconnectionDB.php');
	$conn = connect();
	if (!$conn) {
		$e = oci_error();
   	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	$_SESSION['umu_insERR'] = FALSE;
   $_SESSION['umu_insERRMSG'] = "";
   if(isset($_POST['InsertUsers')) {
   	validateinsert();
   	if($_SESSION['umu_insERR' == FALSE) {
   		$sql = "INSERT INTO users('user_name', 'password', 'class', 'person_id', 'date_registered')" .
   			"VALUES ('" . $_POST['iNewUserName'] . "'" .
   			$_POST['iNewPassword'] . "'" .
   			"'" . $_POST['iNewClass'] . "'" .
   			$_POST['insertUserSelect'] .
   			"'" . $_POST['iNewDateRegistered'] . "')";
			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
			if (!$res) {
			$e = oci_error($stid);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
	   }
	   header( 'Location: ./um_users.php' );
	 } else {
	 	if(isset($_POST['UpdateUsers'])) {		
			validateupdate();
			$_SESSION['umu_updERR'] = FALSE;
   		$_SESSION['umu_updERRMSG'] = "";
   		
			if($_SESSION['umu_updERR'] == FALSE) {
				$sql = "UPDATE users SET "	;
				if(!(empty($_POST['uNewUserName']))) {
					$sql .= "user_name ='" . $_POST['uNewUserName'] . "', ";
				}
				if(!(empty($_POST['uNewPassword']))) {
					$sql .= "password ='" . $_POST['uNewPassword'] . "', ";
				}			
				if(!(empty($_POST['uNewClass']))) {
					$sql .= "class = '" . $_POST['uNewClass'] . "', ";
				}
				if($_POST['updatePersonIDSelect'] != "---SELECT New ID---") {
					$sql .= "person_id = '" . $_POST['updatePersonIDSelect'] . "', ";
				}
				if(!(empty($_POST['uNewDateRegistered']))) {
					$sql .= "date_registered = '" . $_POST['uNewDateRegistered'] . "', ";
				}
				
				$sql = substr($sql, 0, -2);
				$sql .= " WHERE user_name=" . $_POST['updateUserSelect'];
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
</BODY>
</HTML>