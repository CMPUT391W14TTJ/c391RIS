<html>
<head>
	<title>Login Module - CMPUT 391 TTJ</title>
	<!-- This is a work in progress I still need to 
		Implement many features. 
		- connect to the DB (view slides)
		- create session
		- Let user swap their usernames and passwords -->
</head>
	<body>
		<h1>Welcome to The Radiology Information System</h1>
		<?php 
			// first check if the post was set
			if (isset($_POST['validate'])) {
				$userName = $_POST['username'];
				$password = $_POST['password'];
			
				echo 'Thank you for logging in, ' . $userName . ".";
			}
		?>
	</body>
</html>