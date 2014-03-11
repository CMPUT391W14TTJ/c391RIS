<HTML>
<head>
	<title>Homepage - Radiology Information System</title>
	<?php session_start(); ?>
</head>
<body>
	<?php include('./inc/navigation.php'); ?>
	<article class="user_info">
		<h1>User Info</h1>
		<p>
		<?php
			echo "USERNAME: " . $_SESSION['username'] . '<br/>';
			echo "PASSWORD: " . $_SESSION['password'] . '<br/>';
			echo "USER_ID: " . $_SESSION['user_id'] . '<br/>';
			echo "CLASS: " . $_SESSION['user_class'] . '<br/>';
		?>
		</p>
	</article>
</body>
</html>
