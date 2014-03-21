<?php
	function work() {
		echo "work";
	}
	function displayImg() {
		$conn = connect();
		if (!$conn) {
   			$e = oci_error();
   			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		$query = "SELECT thumbnail FROM pacs_images WHERE record_id = 5";
		$stmt = oci_parse($conn, $query);
		oci_execute($stmt);
		if ($arr = oci_fetch_array($stmt, OCI_ASSOC)) {	
			$result = $arr['THUMBNAIL']->load();
			//echo base64_encode($result);
			echo "<dt><strong>Technician Image:</strong></dt><dd>" . 
    	 			'<img src="data:image/jpeg;base64,'.
      			base64_encode($result).
      			'" width="244" height="207">' . "</dd>";
		} else {
			echo "didn't work";
		}
		oci_close($conn);
	}
?>
