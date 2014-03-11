<HTML>
<head>
	<title>Account Settings - Radiology Information System</title>
	<?php session_start(); ?>
</head>
<body>
<div id="container">
	<?php include('./inc/navigation.php'); ?>
	<article class="acc_settings">
		<h2>Account Settings</h2>
		<div class="form">
			<h3>Change your password:</h3>
			<form name="pass_change" method="post" action="pass_change.php">
				Old Password: <input type="password" name="oldPass"/><br/>
				New Password: <input type="password" name="newPass1"/><br/>
				Re-type New Password: <input type="password" name="newPass2"/><br/>
				<input type="submit" name="PassChange" value="Change Password"/>
			</form>
			<p style="color:red;">
			<?php
				if (isset($_SESSION['pass_change_err'])) {
					if ($_SESSION['pass_change_err'] == True) {
						echo $_SESSION['pass_err_msg'];
					}
					$_SESSION['pass_change_err'] = False;
				}
			?>
		</div>
	</article>		
</div>
</body>
</html>
