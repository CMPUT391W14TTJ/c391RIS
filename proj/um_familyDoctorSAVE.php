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
		$conn = connect();
		if (!$conn) {
   		$e = oci_error();
   		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
  	}
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
	<form name="insertDocPat" method="post" action="changeFamilyDoctor.php">
		<h2> Insert New Doctor and Patient </h2>
		Doctor:
		<?php
			$sql = "SELECT DISTINCT full_name, doctor_id FROM persons, family_doctor WHERE person_id = doctor_id";
			$stid = oci_parse($conn, $sql);
			oci_execute($stid);
			echo "<select name='iDocID'><option value=''>---SELECT---</option>";				
			while($row = oci_fetch_array($stid)) {
				echo "<option value=" . $row['DOCTOR_ID'] . ">" . $row['FULL_NAME'] . "</option>";
			}
			echo "</select><br/>";
		?>
		Patient: 		
		<?php
			$sql = "SELECT DISTINCT full_name, patient_id FROM persons, family_doctor WHERE person_id = patient_id";
			$stid = oci_parse($conn, $sql);
			oci_execute($stid);
			echo "<select name='iPatID'><option value=''>---SELECT---</option>";				
			while($row = oci_fetch_array($stid)) {
				echo "<option value=" . $row['PATIENT_ID'] . ">" . $row['FULL_NAME'] . "</option>";
			}
			echo "</select><br/>";
		?>
		<input type="submit" name="iDocPat" value="Insert"/>
	</form>	<form name="insertDocPat" method="post" action="changeFamilyDoctor.php">
		<h2> Update Existing Doctor and Patient </h2>
		<h3> Old Info: </h3>
		Old Doctor:
		<?php
			$sql = "SELECT DISTINCT full_name, doctor_id FROM persons, family_doctor WHERE person_id = doctor_id";
			$stid = oci_parse($conn, $sql);
			oci_execute($stid);
			echo "<select name='uOldDocID'><option value=''>---SELECT---</option>";				
			while($row = oci_fetch_array($stid)) {
				echo "<option value=" . $row['DOCTOR_ID'] . ">" . $row['FULL_NAME'] . "</option>";
			}
			echo "</select>";
		?>
		Old Patient: 		
		<?php
			$sql = "SELECT DISTINCT full_name, patient_id FROM persons, family_doctor WHERE person_id = patient_id";
			$stid = oci_parse($conn, $sql);
			oci_execute($stid);
			echo "<select name='uOldPatID'><option value=''>---SELECT---</option>";				
			while($row = oci_fetch_array($stid)) {
				echo "<option value=" . $row['PATIENT_ID'] . ">" . $row['FULL_NAME'] . "</option>";
			}
			echo "</select><br/>";
		?>
		<h3> New Info: </h3>
		New Doctor:
		<?php
			$sql = "SELECT DISTINCT full_name, doctor_id FROM persons, family_doctor WHERE person_id = doctor_id";
			$stid = oci_parse($conn, $sql);
			oci_execute($stid);
			echo "<select name='uOldDocID'><option value=''>---SELECT---</option>";				
			while($row = oci_fetch_array($stid)) {
				echo "<option value=" . $row['DOCTOR_ID'] . ">" . $row['FULL_NAME'] . "</option>";
			}
			echo "</select>";
		?>
		New Patient: 		
		<?php
			$sql = "SELECT DISTINCT full_name, patient_id FROM persons, family_doctor WHERE person_id = patient_id";
			$stid = oci_parse($conn, $sql);
			oci_execute($stid);
			echo "<select name='uOldPatID'><option value=''>---SELECT---</option>";				
			while($row = oci_fetch_array($stid)) {
				echo "<option value=" . $row['PATIENT_ID'] . ">" . $row['FULL_NAME'] . "</option>";
			}
			echo "</select><br/>";
		?>
		<input type="submit" name="uDocPat" value="Insert"/>
	</form>
	<?php
		$sql = "SELECT d.first_name as DFN, d.last_name as DLN, fd.doctor_id as DID, p.first_name as PFN, p.last_name as PLN, fd.patient_id as PID FROM persons d, persons p, family_doctor fd WHERE d.person_id = fd.doctor_id and p.person_id = fd.patient_id";
		$stid = oci_parse($conn, $sql);
		$result = oci_execute($stid);
	?>
	<TABLE BORDER = 1>
	<TR>
	<TD colspan="3" align="center">DOCTOR</TD>
	<TD colspan="3" align = "center">PATIENT</TD>
	</TR><TR>
	<TD>ID</TD>
	<TD>FIRST NAME</TD>
	<TD>LAST NAME</TD>
	<TD>ID</TD>
	<TD>FIRST NAME</TD>
	<TD>LAST NAME</TD>
	</TR>
	<?php
		while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
			echo "<tr>";
			echo "<td>" . $row['DID'] . "</td>";
			echo "<td>" . $row['DFN'] . "</td>";
			echo "<td>" . $row['DLN'] . "</td>";
			echo "<td>" . $row['PID'] . "</td>";
			echo "<td>" . $row['PFN'] . "</td>";
			echo "<td>" . $row['PLN'] . "</td>";
			/*
			echo "<td>" . $row['ADDRESS'] . "</td>\n";
			echo "<td>" . $row['EMAIL'] . "</td>\n";
			echo "<td>" . $row['PHONE'] . "</td>\n";
			echo "</tr>\n";
			*/	
			echo "</tr>";	
		}
		echo "</table>\n";
	?>
</body>
</HTML>