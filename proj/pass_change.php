<HTML>
<HEAD>
	<title>BLAH</title>
</HEAD>
<BODY>
<p>
<?php 	
	session_start();
	include ('./inc/PHPconnectionDB.php');
	if (isset($_POST['PassChange'])) {
			$oldPass = $_POST['oldPass'];
			$newPass1 = $_POST['newPass1'];
			$newPass2 = $_POST['newPass2'];

			if ($newPass1 != $newPass2) {
				$_SESSION['pass_change_err'] = True;
				$_SESSION['pass_err_msg'] = "Passwords do not match!";
				header( 'Location: ./account_settings.php' );
				exit(1);
			}
			
			$conn = connect();
			if (!$conn) {
   				$e = oci_error();
   				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    			} 
				
			$sql = "SELECT user_name FROM users WHERE password = '" . $oldPass . 
			    "' AND person_id = " . $_SESSION['user_id']; 

			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);

			/*
			 * Check if the user has entered the correct login info
			 * if not deny them. 
			 */
			if (!($row = oci_fetch_array($stid, OCI_ASSOC))) {
				$_SESSION['pass_change_err'] = True;
				$_SESSION['pass_err_msg'] = "Invalid Old Password!";
				header( 'Location: ./account_settings.php' );
				exit(1);
			} 
			$sql = "UPDATE users SET password='" . $newPass1 . "' " . 
			    "WHERE person_id = " . $_SESSION['user_id'];
			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
			
			if (!$res) {
				$_SESSION['pass_change_err'] = True;
				$_SESSION['pass_err_msg'] = "Failed to update password.";
			} else {
				$_SESSION['pass_change_err'] = False;
				$_SESSION['password'] = $newPass1;
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
