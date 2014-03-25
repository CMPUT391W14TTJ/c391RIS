<HTML>
<head>
	<title>User Management - Radiology Information System</title>
	<?php
		include('./inc/PHPconnectionDB.php');
	?>
</head>
<body>	
	<?php
		include('./inc/navigation.php');
		session_start();
		
		
	?>
	<h1>Select A Different Table To Edit Here</h1>
	<!--Do an assert here to ensure that the person logged in is an Admin -->
	<article class="navigation">
		<nav>
			<li><a href="./um_users.php" title="um_Users">Users</a/></li>
			<li><a href="./um_persons.php" title="um_Persons">Persons</a/></li>
			<li><a href="./um_familyDoctor.php" title="um_familyDoctor">Family Doctor</a/></li>
		</nav>
	</article>
		<form name="changeusers" method="post" action="changeUsers.php">
			<h2> Enter The User ID</h2>
			Person ID: <input type="text" name="oldPersonID"/><br/>
			<h2> Enter new user's information </h2>
			New User Name: <input type="text" name="newUserName"/><br/>
			Password: <input type="text" name="newPassword"/><br/>
			Class: <input type="text" name="newClass"/><br/>
			Date Registered: <input type="date" name="newDateRegistered"/><br/>
			<input type="submit" name="ChangeUsers" value="Commit Changes"/>
		</form>
		<p style="color:red;">
			<?php
				if (isset($_SESSION['umu_ERR'])) {
					if ($_SESSION['umu_ERR'] == True) {
						echo $_SESSION['umu_ERRMSG'];
					}
					$_SESSION['umu_ERR'] = False;
				}
			?>
		</p>
		<?php	
		$conn = connect();
		if (!$conn) {
			$e = oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		$stid = oci_parse($conn, 'SELECT * FROM users');
		$result = oci_execute($stid);
	?>
	<TABLE BORDER = 1>
	<TR>
	<TD>PERSON_ID</TD>
	<TD>USER_NAME</TD>
	<TD>PASSWORD</TD>
	<TD>CLASS</TD>
	<TD>DATE REGISTERED</TD>
	</TR>
	<?php
		while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
			echo "<tr>\n";
			echo "<td>" . $row['PERSON_ID'] . "</td>\n";
			echo "<td>" . $row['USER_NAME'] . "</td>\n";
			echo "<td>" . $row['PASSWORD'] . "</td>\n";
			echo "<td>" . $row['CLASS'] . "</td>\n";
			echo "<td>" . $row['DATE_REGISTERED'] . "</td>\n";
			echo "</tr>\n";
		}
		echo "</table>\n";
	oci_free_statement($stid);
	oci_close();	
?>
</body>
</HTML>