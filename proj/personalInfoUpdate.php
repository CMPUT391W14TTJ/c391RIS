<HTML>
<HEAD>
	<title>BLAH</title>
</HEAD>
<BODY>
<p>
<?php 	
	session_start();
	include ('./inc/PHPconnectionDB.php');
	
	function checkUserName($username) {
		if ((strlen($username)) > 24) {
			$_SESSION['err'] = True;
			$_SESSION['err_msg'] = "Username must be less than equal to 24 characters!";
			header( 'Location: ./account_settings.php' );
			exit(1);
		}

		/*
		 * connect to the db
 		 */
		$conn = connect();
		if (!$conn) {
   			$e = oci_error();
   			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    		}
		$sql = "SELECT * FROM users WHERE user_name = '" . $username . "'";

		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);
		if ($row = oci_fetch_array($stid, OCI_ASSOC)) {
			$_SESSION['err'] = True;
			$_SESSION['err_msg'] = "Username already exists!";
			header( 'Location: ./account_settings.php' );
			exit(1);
		} else {
			$sql = "UPDATE users SET user_name = '" . $username .
			    "' WHERE person_id = " . $_SESSION['user_id'];
			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
			if (!$res) {
				$_SESSION['err'] = True;
				$_SESSION['err_msg'] = "Failed to update user name";
				header( 'Location: ./account_settings.php' );
				exit(1);
			} else {
				$_SESSION['err'] = False;
			}
		}
		return;
	}	
	if (isset($_POST['PersonalInfoUpdate'])) {
		if (!(empty($_POST['username']))) {
			/*
			 * going to have to check username stuff
			 */
			checkUserName($_POST['username']);
			$_SESSION['username'] = $_POST['username'];
		}
		if (!(empty($_POST['first_name']))) {
			if ((strlen($_POST['first_name'])) > 24) {
				$_SESSION['err'] = True;
				$_SESSION['err_msg'] = "First name must be less than 25 characters";
			} else {
				$_SESSION['first_name'] = $_POST['first_name'];
			}
		}
		if (!(empty($_POST['last_name']))) {
			if ((strlen($_POST['last_name'])) > 24) {
				$_SESSION['err'] = True;
				$_SESSION['err_msg'] = "Last name must be less than 25 characters";
			} else {
				$_SESSION['last_name'] = $_POST['last_name'];
			}
		}
		if (!(empty($_POST['address']))) {
			if ((strlen($_POST['address'])) > 24) {
				$_SESSION['err'] = True;
				$_SESSION['err_msg'] = "Address must be less than 25 characters";
			} else {
				$_SESSION['address'] = $_POST['address'];
			}
		}
		if (!(empty($_POST['email']))) {
			if ((strlen($_POST['email'])) > 24) {
				$_SESSION['err'] = True;
				$_SESSION['err_msg'] = "Email must be less than 25 characters";
			} else {
				$_SESSION['email'] = $_POST['email'];
			}
		}
		if (!(empty($_POST['phone']))) {
			if (strlen($_POST['phone'])>24) {
				$_SESSION['err'] = True;
				$_SESSION['err_msg'] = "Phone No. must be in format XXX-XXX-XXXX";
			} else {
				$_SESSION['phone'] = $_POST['phone'];
			}
		}
		
		if ($_SESSION['err'] == True) {
			header( 'Location: ./account_settings.php' );
			exit(1);
		}
		
		/*
		 * connect to the db
 		 */
		$conn = connect();
		if (!$conn) {
   			$e = oci_error();
   			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    		} 
				
		$sql = "UPDATE persons SET first_name='" . $_SESSION['first_name'] . 
		    "', last_name = '" .  $_SESSION['last_name'] . 
		    "', address = '" . $_SESSION['address'] . 
		    "', email = '" . $_SESSION['email'] .
		    "', phone = '" . $_SESSION['phone'] . 
		    "' WHERE person_id = " . $_SESSION['user_id'];

		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);
			
		if (!$res) {
			$_SESSION['err'] = True;
			$_SESSION['err_msg'] = "Failed to update personal info.";
		} else {
			$_SESSION['err'] = False;
		}

		header( 'Location: ./account_settings.php' );
		exit(1);
	} else {
		header( "Location: ./index.html" );
	}
?>
</p>
</BODY>
</HTML>
