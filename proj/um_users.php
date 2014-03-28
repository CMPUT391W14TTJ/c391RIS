<HTML>
<head>
	<title>User Management - Radiology Information System</title>
	<?php
		include('./inc/PHPconnectionDB.php');
	?>
</head>
<body>	
	<?php
		include ('./classes/user.php');
		session_start();
		include('./inc/navigation.php');
		
		$userName = $_SESSION['user']->username;
		if(strcmp($userName,'admin') != 0){
			header( "Location: ./unauthorized.html");
		}
		
		$conn = connect();
		if (!$conn) {
			$e = oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		
		
		$querypids = "SELECT p.person_id, u.user_name FROM persons p LEFT OUTER JOIN users u ON p.person_id = u.person_id";
		$parsepids = oci_parse($conn, $querypids);
		$queryuids = "SELECT user_name FROM users";
		$parseuids = oci_parse($conn, $queryuids);
		
		oci_execute($parsepids);
		oci_execute($parseuids);
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
		<form name="insertUser" method="post" action="changeUsers.php">
			<h2> Insert a New User</h2>
			Person ID:
			<?php
				echo "<select name='iNewPersonID'><option value=''>---SELECT ID From Persons---</option>";				
				while($pid = oci_fetch_array($parsepids)) {
					echo "<option value=" . $pid['PERSON_ID'] . ">" . $pid['PERSON_ID'] . " -- " . $pid['USER_NAME'] . "</option>";
				}
				echo "</select><br/>";
			?>
			New User Name: <input type="text" name="iNewUserName"/><br/>
			Password: <input type="text" name="iNewPassword"/><br/>
			Class: <select name='iNewClass'><option value=''>---SELECT Class---</option>";				
				<option value='p'> Patient </option>
				<option value='d'> Doctor </option>
				<option value='r'> Radiologist </option>
				<option value='a'> Admin </option>
				</select><br/>
			Date Registered: <input type="date" name="iNewDateRegistered"/><br/>
			<input type="submit" name="InsertUsers" value="Insert User"/>
		</form>
		<p style="color:red;">
			<?php
				if (isset($_SESSION['umu_insERR'])) {
					if ($_SESSION['umu_insERR'] == True) {
						echo $_SESSION['umu_insERRMSG'];
					}
					$_SESSION['umu_insERR'] = False;
				}
			?>
		</p>
		<form name="updateUser" method="post" action="changeUsers.php">
			<h2> Update An Existing User</h2>
			Old Username (from Table):
			<?php
				echo "<select name='uOldUserName'><option value=''>---SELECT User Name---</option>";				
				while($uid = oci_fetch_array($parseuids)) {
					echo "<option value='" . $uid['USER_NAME'] . "'>". $uid['USER_NAME']."</option>";
				}
				echo "</select><br/>";
			?>
			New User Name: <input type="text" name="uNewUserName"/><br/>
			Password: <input type="text" name="uNewPassword"/><br/>
			Class: <select name='uNewClass'><option value=''>---SELECT Class---</option>";				
					<option value='p'> Patient </option>
					<option value='d'> Doctor </option>
					<option value='r'> Radiologist </option>
					<option value='a'> Admin </option>
					</select><br/>
			Person ID:
			<?php
				oci_execute($parsepids);
				echo "<select name='uNewPersonID'><option value=''>---SELECT ID From Persons---</option>";				
				while($pid = oci_fetch_array($parsepids)) {
					echo "<option value=" . $pid['PERSON_ID'] . ">" . $pid['PERSON_ID'] . " -- " . $pid['USER_NAME'] . "</option>";
				}
				echo "</select><br/>";
			?>
			Date Registered: <input type="date" name="uNewDateRegistered"/><br/>
			<input type="submit" name="UpdateUsers" value="Update User"/>
		</form>
		<p style="color:red;">
			<?php
				if (isset($_SESSION['umu_updERR'])) {
					if ($_SESSION['umu_updERR'] == True) {
						echo $_SESSION['umu_updERRMSG'];
					}
					$_SESSION['umu_updERR'] = False;
				}
			?>
		</p>
	<TABLE BORDER = 1>
	<TR>
	<TD>PERSON_ID</TD>
	<TD>USER_NAME</TD>
	<TD>PASSWORD</TD>
	<TD>CLASS</TD>
	<TD>DATE REGISTERED</TD>
	</TR>
	<?php
		$stid = oci_parse($conn, 'SELECT * FROM users');
		$result = oci_execute($stid);
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
