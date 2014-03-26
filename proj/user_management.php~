<HTML>
<head>
	<title>User Management - Radiology Information System</title>
</head>
<body>	
	<?php
		include ('./classes/user.php');
		include('./inc/navigation.php');
		
		$userName = $_SESSION['user']->username;
		if(strcmp($userName,'admin') != 0){
			header( "Location: ./unauthorized.html");
		}
	?>
	<h1>Select A Table To Edit Here</h1>
	<!--Do an assert here to ensure that the person logged in is an Admin -->
	<article class="navigation">
		<nav>
			<li><a href="./um_users.php" title="um_Users">Users</a/></li>
			<li><a href="./um_persons.php" title="um_Persons">Persons</a/></li>
			<li><a href="./um_familyDoctor.php" title="um_familyDoctor">Family Doctor</a/></li>
		</nav>
	</article>
</body>
</HTML>
