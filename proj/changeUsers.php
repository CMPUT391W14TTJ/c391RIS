<HTML>
<HEAD>
	<title>UM Change Users </title>
</HEAD>
<BODY>

<?php
	print_r($_POST);
	echo "<li><a href=\"./user_management.php\" title=\"User Management\">User Management</a></li>";
	include('./inc/PHPconnectionDB.php');
	session_start();
	
	$conn = connect();
	if (!$conn) {
		$e = oci_error();
   	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   
	function validateInsert() {
		if(empty($_POST['iNewPersonID'])) {
			$_SESSION['umu_insERR'] = TRUE;
			$_SESSION['umu_insERRMSG'] .= "Person ID cannot be empty! <br/>";	
		}
		if(!(empty($_POST['iNewUserName']))) {
			if(strlen($_POST['iNewUserName'])>24) {
				$_SESSION['umu_insERR'] = TRUE;
				$_SESSION['umu_insERRMSG'] .= "User Name must be less than 24 characters! <br/>";
			} 
		}else {
			$_SESSION['umu_insERR'] = TRUE;
			$_SESSION['umu_insERRMSG'] .= "User Name cannot be empty! <br/>";	
		}
		if(!(empty($_POST['iNewPassword']))) {
			if(strlen($_POST['iNewPassword'])>24) {
				$_SESSION['umu_insERR'] = TRUE;
				$_SESSION['umu_insERRMSG'] .= "Password must be less than 24 characters! <br/>";
			}
		} else {
			$_SESSION['umu_insERR'] = TRUE;
			$_SESSION['umu_insERRMSG'] .= "Password cannot be empty! <br/>";
		}
		if(empty($_POST['iNewClass'])) {
			$_SESSION['umu_insERR'] = TRUE;
			$_SESSION['umu_insERRMSG'] .= "Class cannot be empty! <br/>";
		}	
		if(empty($_POST['iNewDateRegistered'])) {
			$_SESSION['umu_insERR'] = TRUE;
			$_SESSION['umu_insERRMSG'] .= "Date Registered cannot be empty! <br/>";	
		}
	}
	
	function validateUpdate() {
		if(empty($_POST['uOldUserName'])) {
			$_SESSION['umu_updERR'] = TRUE;
			$_SESSION['umu_updERRMSG'] .= "Old User Name cannot be empty! <br/>";	
		}
		if(!(empty($_POST['uNewUserName']))) {
			if(strlen($_POST['uNewUserName'])>24) {
				$_SESSION['umu_updERR'] = TRUE;
				$_SESSION['umu_updERRMSG'] .= "User Name must be less than 24 characters! <br/>";
			} 
		}
		if(!(empty($_POST['uNewPassword']))) {
			if(strlen($_POST['uNewPassword'])>24) {
				$_SESSION['umu_updERR'] = TRUE;
				$_SESSION['umu_updERRMSG'] .= "Password must be less than 24 characters! <br/>";
			}
		}		
	}	
	
   /*
   * INSERT FORM
   */
   
	if (isset($_POST['InsertUsers'])) {	
		$_SESSION['umu_insERR'] = FALSE;
		$_SESSION['umu_insERRMSG'] = "";
		
		validateInsert();	
		if ($_SESSION['umu_insERR'] == FALSE) {
			$sql = "INSERT INTO users(user_name, password, class, person_id, date_registered)" .
	   		" VALUES ('" . $_POST['iNewUserName'] . "'," .
	   		"'" . $_POST['iNewPassword'] . "'," .
	   		"'" . $_POST['iNewClass'] . "'," .
	   		$_POST['iNewPersonID'] . "," .
	   		"'" . $_POST['iNewDateRegistered'] . "')";
	   	$stid = oci_parse($conn, $sql);
	   	$res = oci_execute($stid);
	   	if (!$res) {
				$e = oci_error($stid);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				echo "it broke";
			}
   	}
   }
   /*
   * UPDATING FORM
   */
   if (isset($_POST['UpdateUsers'])) {
   	
   	$_SESSION['umu_updERR'] = FALSE;
		$_SESSION['umu_updERRMSG'] = "";

		validateUpdate();   	
		if ($_SESSION['umu_updERR'] == FALSE) {   	
	   	$sql = "UPDATE users SET ";
			if(!(empty($_POST['uNewUserName']))) {
				$sql .= "user_name ='" . $_POST['uNewUserName'] . "', ";
			}
			if(!(empty($_POST['uNewPassword']))) {
				$sql .= "password ='" . $_POST['uNewPassword'] . "', ";
			}			
			if(!(empty($_POST['uNewClass']))) {
				$sql .= "class = '" . $_POST['uNewClass'] . "', ";
			}
			if($_POST['uNewPersonID'] != '') {
				$sql .= "person_id = " . $_POST['uNewPersonID'] . ", ";
			}
			if(!(empty($_POST['uNewDateRegistered']))) {
				$sql .= "date_registered = '" . $_POST['uNewDateRegistered'] . "', ";
			}
			
			$sql = substr($sql, 0, -2);
			$sql .= " WHERE user_name='" . $_POST['uOldUserName'] . "'";
			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
			if (!($res)) {
				$e = oci_error($stid);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				echo "it broke";
			}
   	}	
   }
	header( 'Location: ./um_users.php' );

?>

</BODY>
</HTML>