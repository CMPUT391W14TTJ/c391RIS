<HTML>
<head>
	<title>Homepage - Radiology Information System</title>
	<?php 
		include('./classes/user.php');
		session_start(); 
		if(!isset($_SESSION['user']->username) || $_SESSION['user'] == null) {
			header('Location: ./index.html');
		}
	?>
</head>
<body>
	<?php include('./inc/navigation.php'); ?>
	<article class="user_info">
		<h1>User Info</h1>
		<p>
		<?php
			echo "USERNAME: " . $_SESSION['user']->username . '<br/>';
			echo "USER_ID: " . $_SESSION['user']->user_id . '<br/>';
			echo "CLASS: " . $_SESSION['user']->user_class . '<br/>';
		?>
		</p>
	</article>
</body>
</html>
