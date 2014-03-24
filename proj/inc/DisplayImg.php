<?php
	/**
	 * displayImg: 
	 * parameters - imageID: id of the image you are trying to access
	 *		imageType: thumbnail, regular_size, or large_size
	 * returns the image in img tags.
	 */
	function displayImg($imageID, $imageType) {
		$con = connect();
		if (!$con) {
   			$e = oci_error();
   			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		$query = "SELECT " . $imageType . " FROM pacs_images WHERE image_id = ". $imageID;
		$stmt = oci_parse($con, $query);
		oci_execute($stmt);
		if ($arr = oci_fetch_array($stmt, OCI_ASSOC)) {	
			$result = $arr['THUMBNAIL']->load();
			$imgSize = getImageSize($result);

			echo '<a href="ImageViewer.php?id=' . $imageID . '"><img src="data:image/jpeg;base64,'.
      			base64_encode($result).
      			'" width="'. $imgSize[0] . '" height="'. $imgSize[1] . 
				'"></a>';
		} else {
			echo "didn't work";
		}
		oci_close($conn);
	}
?>
