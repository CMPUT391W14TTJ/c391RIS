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
	?>
	<h1>Select A Different Table To Edit Here</h1>
	<article class="navigation">
		<nav>
			<li><a href="./um_user.php" title="um_Users">Users</a/></li>
			<li><a href="./um_persons.php" title="um_Persons">Persons</a/></li>
			<li><a href="./um_familyDoctor.php" title="um_familyDoctor">Family Doctor</a/></li>
		</nav>
	</article>
	<?php	
		session_start();
		$conn = connect();
		if (!$conn) {
			$e = oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		$stid = oci_parse($conn, 'SELECT * FROM Users');
		$result = oci_execute($stid);
	?>
	<TABLE BORDER = 1>
		<TR>
		<TD>USERNAME</TD>
		<TD>PASSWORD</TD>
		<TD>CLASS</TD>
		<TD>PERSON ID</TD>
		<TD>DATE REGISTERED</TD>
		</TR>
		<?php
		while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
			echo "<tr>\n";
			echo "<td>" . $row['USER_NAME'] . "</td>\n";
			echo "<td>" . $row['PASSWORD'] . "</td>\n";
			echo "<td>" . $row['CLASS'] . "</td>\n";
			echo "<td>" . $row['PERSON_ID'] . "</td>\n";
			echo "<td>" . $row['DATE_REGISTERED'] . "</td>\n";
			echo "</tr>\n";
		}
		echo "</table>\n";
		?>
		<form name="changeusers" method="post" action="changeUsers.php">
			<h2> User from table to update </h2>
			Old Username: <input type="text" name="oldUsername"/><br/>
			<h2> Enter new information for user </h2>
			New Username: <input type="text" name="newUsername"/><br/>
			New Password: <input type="text" name="newPassword"/><br/>
			New Class: <input type="text" name="newClass"/><br/>
			New Person ID: <input type="number" name="newPersonID"/><br/>
			New Date Registered: <input type="date" name="newDateRegistered"/><br/>
			<input type="submit" name="ChangeUsers" value="Commit Changes"/>
		</form>
</body>
</HTML>