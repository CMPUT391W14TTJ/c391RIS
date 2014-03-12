<html>
<head>
	<?php 
		include('./inc/PHPconnectionDB.php'); 
		include('./inc/user.php');
	?> 
	<title>Login Module - Radiology Information System</title>
	<!-- This is a work in progress I still need to 
		Implement many features. 
		- Let user swap their usernames and passwords -->
</head>
<body>
	<?php session_start(); ?>
	<h1>Welcome to The Radiology Information System</h1>
	<p>
	<?php	
		echo "HI";
		// first check if the post was set
		if (isset($_POST['validate'])) {
			$_SESSION['user'] = new User;
			$_SESSION['user']->setUserInfo($_POST['username'], $_POST['pw']); 
			// will get rid of this once I have user class working properly
			//$_SESSION['username'] = $_POST['username'];
			//$_SESSION['password'] = $_POST["pw"];

			$conn = connect();
			if (!$conn) {
   				$e = oci_error();
   				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    			} 
				
			$sql = "SELECT person_id, class FROM users WHERE user_name = '" . 
			    $_SESSION['user']->username . "' AND password = '" . 
			    $_SESSION['user']->password . "'";

			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
			/*
			 * Check if the user has entered the correct login info
			 * if not deny them. 
			 */
			if (($row = oci_fetch_array($stid, OCI_ASSOC))) {
				$_SESSION['user']->setUserID($row['PERSON_ID']);
				$_SESSION['user']->setUserClass($row['CLASS']);
				//will remove this once I have user class working
				//$_SESSION["user_class"] = $row["CLASS"];
				//$_SESSION["user_id"] = $row["PERSON_ID"];
				
				$_SESSION["login"] = True;
				header( "Location: ./home.php" );
			} else {
				header( "Location: ./bad_login.html" );
			}
		} else {
			header( "Location: ./index.html" );
		}
	
	?>
	</p>
</body>
</html>
