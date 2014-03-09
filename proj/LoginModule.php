<html>
<head>
	<?php include('./inc/PHPconnectionDB.php'); ?> 
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
		//ob_start();
		// first check if the post was set
		if (isset($_POST['validate'])) {
			$_SESSION['username'] = $_POST['username'];
			echo 'USERNAME: ' . $_SESSION['username'] . "<br/>";
			$_SESSION['password'] = $_POST["pw"];
			echo 'PASSWORD: ' . $_SESSION["password"] . "<br/>";
			//HERE I SHOULD connect to the oracle db to check username/password
			$conn = connect();
			if (!$conn) {
   				$e = oci_error();
   				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    			} 
				
			$sql = "SELECT Class FROM users WHERE user_name = '" . 
			    $_SESSION['username'] . "' AND password = '" . 
			    $_SESSION['password'] . "'";

			echo 'SQL Statement: ' . $sql . '<br/>';	

			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
			/*
			 * Check if the user has entered the correct login info
			 * if not deny them. 
			 */
			if (($row = oci_fetch_array($stid, OCI_ASSOC))) {
				foreach($row as $r) {
					$_SESSION["user_class"] = $r["CLASS"];
				}
				echo "USER_CLASS: " . $_SESSION["user_class"] . "<br/>";
				echo "Thank you for logging in, " .
				    $_SESSION['username'] . "<br/>";
				
			} else {
				echo "Invalid login information<br/>";
				echo "Redirecting now...";
				flush();
				//sleep(5);
				header( "Location: http://consort.cs.ualberta.ca/~twendlan/c391RIS/proj/index.html" );
			}
		}
	
	?>
	</p>
</body>
</html>
