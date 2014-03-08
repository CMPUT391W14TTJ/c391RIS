<html>
<head>
	<?php include('./PHPconnectionDB.php'); ?> 
	<title>Login Module - CMPUT 391 TTJ</title>
	<!-- This is a work in progress I still need to 
		Implement many features. 
		- connect to the DB (view slides)
		- create session
		- Let user swap their usernames and passwords -->
</head>
<body>
	<?php session_start(); ?>
	<h1>Welcome to The Radiology Information System</h1>
	<p>
	<?php 
		// first check if the post was set
		if (isset($_POST['validate'])) {
			$_SESSION['username'] = $_POST['username'];
			echo 'USERNAME: ' . $_SESSION['username'] . '\n';
			//$_SESSSION['password'] = $_POST['password'];

			//HERE I SHOULD connect to the oracle db to check username/password
			$conn = connect();
			if (!$conn) {
   				$e = oci_error();
   				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    			} 
				
			/*$sql = "SELECT * FROM users WHERE user_name = '" . 
			    $_SESSION['username'] . "';";*/

			$sql = "SELECT * FROM users;";
			echo 'SQL Statement: ' . $sql;	

			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
			/*
			 * Check if the user has entered the correct login info
			 * if not deny them. 
			 * NOTE: I'm not sure if this is exactly how you check but
			 * I will confirm as soon as I am able to test :)
			 */
			$count = 0;
			while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
				$count = $count + 1;
				echo $count;
				echo '<br/>';
			}
		/*	if (!$res) {
				echo "INVALID login information";  
			} else {
				echo 'Thank you for logging in, ' . $_SESSION['username'] . ".";
			}
		*/
		}
	
	?>
	</p>
</body>
</html>
