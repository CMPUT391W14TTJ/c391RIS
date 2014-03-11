<HTML>
<HEAD>
	<title>BLAH</title>
</HEAD>
<BODY>
<p>
<?php 	
	session_start();
	include ('./inc/PHPconnectionDB.php');
	if (isset($_POST['PersonalInfoUpdate'])) {
		if (empty($_POST['username'])) {
			/*
			 * going to have to check username stuff
			 */
		}
		if (empty($_POST['first_name'])) {
			$_SESSION['first_name'] = $_POST['first_name'];
		}
		if (empty($_POST['last_name'])) {
			$_SESSION['last_name'] = $_POST['last_name'];
		}
		if (empty($_POST['address'])) {
			$_SESSION['address'] = $_POST['address'];
		}
		if (empty($_POST['email'])) {
			$_SESSION['email'] = $_POST['email'];
		}
		if (empty($_POST['phone'])) {
			if (strlen($_POST['phone'])) {
				$_SESSION['err'] = True;
				$_SESSION['err_msg'] = "Phone No. must be in format XXX-XXX-XXXX";
				header( 'Location: ./account_settings.php' );
				exit(1);
			} else {
				$_SESSION['phone'] = $_POST['phone'];
			}
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
