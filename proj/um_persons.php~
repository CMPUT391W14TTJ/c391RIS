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
	<form name="changepersons" method="post" action="changePersons.php">
		<h2> Enter the old information </h2>
		Person ID: <input type="text" name="oldPersonID"/><br/>
		<h2> Enter new user's information </h2>
		First Name: <input type="text" name="newFirstName"/><br/>
		Last Name: <input type="text" name="newLastName"/><br/>
		Address: <input type="text" name="newAddress"/><br/>
		Email: <input type="text" name="newEmail"/><br/>
		Phone: <input type="text" name="newPhone"/><br/>
		<input type="submit" name="ChangePersons" value="Commit Changes"/>
	</form>
	<p style="color:red;">
		<?php
			if (isset($_SESSION['ump_ERR'])) {
				if ($_SESSION['ump_ERR'] == True) {
					echo $_SESSION['ump_ERRMSG'];
				}
				$_SESSION['ump_ERR'] = False;
			}
		?>
	</p>
	<?php	
		$conn = connect();
		if (!$conn) {
			$e = oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		$stid = oci_parse($conn, 'SELECT * FROM Persons');
		$result = oci_execute($stid);
	?>
	<TABLE BORDER = 1>
	<TR>
	<TD>PERSON_ID</TD>
	<TD>FIRST_NAME</TD>
	<TD>LAST_NAME</TD>
	<TD>ADDRESS</TD>
	<TD>EMAIL</TD>
	<TD>PHONE</TD>
	</TR>
	<?php
		while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
			echo "<tr>\n";
			echo "<td>" . $row['PERSON_ID'] . "</td>\n";
			echo "<td>" . $row['FIRST_NAME'] . "</td>\n";
			echo "<td>" . $row['LAST_NAME'] . "</td>\n";
			echo "<td>" . $row['ADDRESS'] . "</td>\n";
			echo "<td>" . $row['EMAIL'] . "</td>\n";
			echo "<td>" . $row['PHONE'] . "</td>\n";
			echo "</tr>\n";
		}
		echo "</table>\n";
	oci_free_statement($stid);
	oci_close();	
?>
	
</body>
</HTML>
