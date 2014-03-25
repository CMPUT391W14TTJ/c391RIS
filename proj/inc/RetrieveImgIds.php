<?php
	include('./PHPconnectionDB.php');
	include('./DisplayImg.php');

	function retrieveImgIds($recordID) {
		$con = connect();
		if (!$con) {
   			$e = oci_error();
   			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		$sql = 'SELECT image_id FROM pacs_images WHERE record_id = ' . $recordID;				

		$stmt = oci_parse($con, $sql);
		oci_execute($stmt);
		
		$imageIDs = array();
		while ($arr = oci_fetch_array($stmt, OCI_ASSOC)) {
			$imageIDs[] = $arr['IMAGE_ID'];
			//displayImg($arr['IMAGE_ID']);
		}
		oci_close($con);
		return $imageIDs;
	}
?>
	
