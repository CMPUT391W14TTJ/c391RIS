<?php
function connect(){
	$conn = oci_connect('twendlan', 'cmput391ttj');
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	return $conn;
}
?>
