<?php 	
	include ('./classes/user.php');
	session_start();
	include ('./inc/PHPconnectionDB.php');
	if (isset($_POST['PassChange'])) {
			$oldPass = $_POST['oldPass'];
			$newPass1 = $_POST['newPass1'];
			$newPass2 = $_POST['newPass2'];

			/*
	 		 * check if the new passwords match
			 * Also checks if the password length is greater than 24
			 */
			if ($newPass1 != $newPass2) {
				$_SESSION['pass_change_err'] = True;
				$_SESSION['pass_err_msg'] = "Passwords do not match!";
				header( 'Location: ./account_settings.php' );
				exit(1);
			} else if (strlen($newPass1) > 24) {
				$_SESSION['pass_change_err'] = True;
				$_SESSION['pass_err_msg'] = "Password must be under 24 characters!";
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
				
			$sql = "SELECT user_name FROM users WHERE password = '" . $oldPass . 
			    "' AND person_id = " . $_SESSION['user']->user_id; 

			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);

			/*
			 * check if the old password is the current password
			 */
			if (!($row = oci_fetch_array($stid, OCI_ASSOC))) {
				$_SESSION['pass_change_err'] = True;
				$_SESSION['pass_err_msg'] = "Invalid Old Password!";
				oci_close();
				header( 'Location: ./account_settings.php' );
				exit(1);
			} 

			$sql = "UPDATE users SET password='" . $newPass1 . "' " . 
			    "WHERE person_id = " . $_SESSION['user']->user_id;
			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
			
			/*
			 * update the user with a new password
			 */
			if (!$res) {
				$_SESSION['pass_change_err'] = True;
				$_SESSION['pass_err_msg'] = "Failed to update password.";
			} else {
				$_SESSION['pass_change_err'] = False;
				$_SESSION['user']->setPassword($newPass1);
				//will delete this once I get user class working
				//$_SESSION['password'] = $newPass1;
			}
			oci_close();
			header( 'Location: ./account_settings.php' );
			exit(1);
			
	} else {
			header( "Location: ./index.html" );
	}
?>
