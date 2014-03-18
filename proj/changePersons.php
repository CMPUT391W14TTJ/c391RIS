<HTML>
<HEAD>
	<title>UM Change Users </title>
</HEAD>
<BODY>
<?php
	session_start();
	include('./inc/PHPconnectionDB.php');
	$conn = connect();
	if (!$conn) {
   		$e = oci_error();
   		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
  	}
	if (isset($_POST['ChangeUsers'])) {
		$sql = "SELECT * FROM Persons WHERE PERSON_ID=" . $_POST['oldPersonID'];
		$stid = oci_parse($conn, $sql);
		$res = oci_execute($stid);
		
		if ($row = oci_fetch_array($stid, OCI_ASSOC)) {
			$firstname = $row['FIRST_NAME'];
			$newlastname = $row['LAST_NAME'];
			$newaddress = $row['ADDRESS']
			$newemail = $row['EMAIL'];
			$newphone = $row['PHONE'];
		}
		if(!(empty($_POST['newFirstName']))) {
			$newfirstname = $_POST['newFirstName'];
		}
		if(!(empty($_POST['newLastName']))) {
			$newlastname = $_POST['newLastName'];
		}
		if(!(empty($_POST['newAddress']))) {
			$newaddress = $_POST['newAddress'];
		}
		if(!(empty($_POST['newEmail']))) {
			$newEmail = $_POST['newEmail'];
		}
		if(!(empty($_POST['newPhone']))) {
			$newphone = $_POST['newPhone'];
		}
			
		$sql = "UPDATE persons SET first_name='$newfirstname', last_name='$newlastname', address='$newaddress', email='$newemail', phone='$newphone' WHERE person_id=" . $_POST['oldPersonID'];
			
		$stid = ($conn, $sql);
		$res = oci_execute($stid);			

	}
	header( "Location: ./um_persons.php");
?>
</BODY>
</HTML>
