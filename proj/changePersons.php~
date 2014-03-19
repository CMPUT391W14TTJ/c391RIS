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
	if (isset($_POST['ChangePersons'])) {
		if(!(empty($_POST['oldPersonID']))) {			
			
			$sql = "UPDATE persons SET "	;	
			
			if(!(empty($_POST['newFirstName']))) {
				$sql .= "first_name ='" . $_POST['newFirstName'] . "', ";
			}
			if(!(empty($_POST['newLastName']))) {
				$sql .= "last_name ='" . $_POST['newLastName'] . "', ";
			}			
			if(!(empty($_POST['newAddress']))) {
				$sql .= "address = '" . $_POST['newAddress'] . "', ";
			}
			if(!(empty($_POST['newEmail']))) {
				$sql .= "email = '" . $_POST['newEmail'] . "', ";
			}
			if(!(empty($_POST['newPhone']))) {
				$sql .= "phone = '" . $_POST['newPhone'] . "', ";
			}
			
			$sql = substr($sql, 0, -2);
			$sql .= " WHERE person_id=" . $_POST['oldPersonID'];
			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
			if (!($res)) {
				$e = oci_error($stid);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
				header( 'Location: ./um_persons.php' );
		} else {	

			$sqlid = "SELECT max(person_id) as MID FROM persons";
			$parseid = oci_parse($conn, $sqlid);
			oci_execute($parseid);	
			oci_fetch($parseid);
			$maxid = oci_result($parseid, 'MID');
			$nextid = $maxid + 1;
			
			$sql = "INSERT into persons(person_id, first_name, last_name, address, email, phone)" .
				"VALUES (" . $nextid .
				",'" . $_POST['newFirstName'] .
				"','" . $_POST['newLastName'] .
				"','" . $_POST['newAddress'] .
				"','" . $_POST['newEmail'] .
				"','" . $_POST['newPhone'] . "')";
			$stid = oci_parse($conn, $sql);
			$res = oci_execute($stid);
			if (!$res) {
				$e = oci_error($stid);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
		 	header( 'Location: ./um_persons.php' );
	    }
	}

/*
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


	<form name="changepersons" method="post" action="changePersons.php">
		<h2> Enter the old information </h2>
		Person ID: <input type="text" name="oldPersonID"/><br/>
		<h2> Enter new user's information </h2>
		First Name: <input type="text" name="newFirstName"/>
		Last Name: <input type="text" name="newLastName"/><br/>
		Address: <input type="text" name="newAddress"/>
		Email: <input type="text" name="newEmail"/>
		Phone: <input type="text" name="newPhone"/><br/>
		<input type="submit" name="ChangePersons" value="Commit Changes"/>
*/	
			

/*
	   } else {	
			$stid2 = oci_parse($conn, 'SELECT max(person_id) from persons');
			$res = oci_execute($stid2);
			if (!$res) {
				$e = oci_error($stid);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
						
			if ($row = oci_fetch_array($stid, OCI_ASSOC)) {
				$nextpid = 1 + row['person_id'];
			}
			$sql = "INSERT into persons(person_id, first_name, last_name, address, email, phone)" .
				"Values('" $nextpid .
				"','" $_POST['newFirstName'] .
				"','" $_POST['newLastName'] .
				"','" $_POST['newAddress'] .
				"','" $_POST['newEmail'] .
				"','" $_POST['newPhone'] . "')";
			$stid2 = oci_parse($conn, $sql);
			$res = oci_execute($stid2);
			if (!$res) {
				$e = oci_error($stid);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
		 	header( 'Location: ./um_persons.php' );
	    }
		echo '<FORM action = "um_persons.php" Method = "post"></br>';
		echo 'Go back to management home page: <input type = "submit" name = "submit" value = "back"/></br>'
*/
?>
</BODY>
</HTML>
