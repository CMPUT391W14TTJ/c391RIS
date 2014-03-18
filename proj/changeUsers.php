<HTML>
<HEAD>
	<title>UM Change Users </title>
</HEAD>
<BODY>
<?php
	session_start();
	include('./inc/PHPconnectionDB.php');
	include('./classes/user.php');
	$conn = connect();
	if (!$conn) {
   		$e = oci_error();
   		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
  	}

	if (isset($_POST['ChangeUsers'])) { 	
						

	}
	header( "Location: ./um_user.php");
	oci_free_statement($stid);
	oci_close($conn);
	
	?>
</BODY>
</HTML>
