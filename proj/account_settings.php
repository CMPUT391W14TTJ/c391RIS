<HTML>
<head>
	<title>Account Settings - Radiology Information System</title>
</head>
<body>
<div id="container">
	<?php 
		include('./inc/getInfo.php'); 
		session_start();
		if(!isset($_SESSION['user']->username) || $_SESSION['user'] == null) {
			header('Location: ./index.html');
		}
		include('./inc/navigation.php'); 
		getUserInfo();
		getPersonalInfo();
	?>
	<article class="user_info">
		<h1>User Info</h1>
		<p>
		<?php
			echo "USERNAME: " . $_SESSION['user']->username . '<br/>';
			echo "USER_ID: " . $_SESSION['user']->user_id . '<br/>';
			echo "CLASS: " . $_SESSION['user']->user_class . '<br/>';
			echo "FIRST_NAME: " . $_SESSION['user']->first_name . '<br/>';
			echo "LAST_NAME: " . $_SESSION['user']->last_name . '<br/>';
			echo "ADDRESS: " . $_SESSION['user']->address . '<br/>';
			echo "EMAIL: " . $_SESSION['user']->email . '<br/>';
			echo "PHONE: " . $_SESSION['user']->phone . '<br/>';
		?>
		</p>
	</article>
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
			</p>
		</div>
		<div class="form">
			<h3>Update Personal info:</h3>
			<form name="personalInfoUpdate" method="post" action="personalInfoUpdate.php">
				Username: <input type="text" name="username"/><br/>
				First Name: <input type="text" name="first_name"/><br/>
				Last Name: <input type="text" name="last_name"/><br/>
				Address: <input type="text" name="address"/><br/>
				Email: <input type="text" name="email"/><br/>
				Phone: <input type="text" name="phone"/><br/>
				<input type="submit" name="PersonalInfoUpdate" value="Update Personal Info"/>
			</form>
			<p style="color:red;">
			<?php
				if (isset($_SESSION['err'])) {
					if ($_SESSION['err'] == True) {
						echo $_SESSION['err_msg'];
					}
					$_SESSION['err'] = False;
				}
			?>
			</p>
		</div>
	</article>		
</div>
</body>
</html>
