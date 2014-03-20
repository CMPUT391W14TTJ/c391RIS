<html>
<head>
	<title>Uploading Image</title>
</head>
<body>
<?php
session_start();
include('../inc/PHPconnectionDB.php');

function generateImageID() {
	$id = rand(0, 1000);
	$conn = connect();
	if (!$conn) {
   		$e = oci_error();
   		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   	} 
			
	$sql = "SELECT image_id FROM pacs_images WHERE image_id = " . $id;
	$stid = oci_parse($conn, $sql);
	$res = oci_execute($stid);
	if (($row = oci_fetch_array($stid, OCI_ASSOC))) {
		oci_close();
		generateImageID();
	} else {
		oci_close();
		return $id;
	}
}

function createThumbnail() {
	$thumbnail = resizeImage($_FILES['file']['tmp_name'], 100, 100);
	return $thumbnail;
}

function createLargeSize() {
}

function resizeImage($file, $w, $h, $crop=FALSE) {
	list($width, $height) = getimagesize($file);
	$r = $width / $height;
	if ($crop) {
		if ($width > $height) {
			$width = ceil($width - ($width*abs($r-$w/$h)));
		} else {
			$height = ceil($height - ($height * abs($r-$w/$h)));
		}
		$newwidth = $w;
		$newheight = $h;
	} else {
		if ($w/$h > $r) {
			$newwidth = $h*$r;
			$newheight = $h;
		} else {
			$newheight = $w/$r;
			$newwidth = $w;
		}
	}
	/*
	 * will need to test for file type here
	 */
	$src = imagecreatefromjpeg($file);
	$dst = imagecreatetruecolor($newwidth, $newheight);
	imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	
	return $dst;
}

function buildQuery() {
	$imageID = generateImageID();
	$thumbnail = createThumbnail();

	$conn = connect();
	if (!$conn) {
   		$e = oci_error();
   		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   	}
	
	$lob = oci_new_descriptor($conn, OCI_D_LOB);
	$lob1 = oci_new_descriptor($conn, OCI_D_LOB);
	$stmt = oci_parse($conn, 'insert into pacs_images (record_id, image_id, regular_size) '
		. 'values(:recordid, :imageid, empty_blob()) returning regular_size into :blobdata');
	oci_bind_by_name($stmt, ':recordid', $_POST['record_id']);
	oci_bind_by_name($stmt, ':imageid', $imageID);
	oci_bind_by_name($stmt, ':blobdata', $lob, -1, OCI_B_BLOB);
	oci_execute($stmt, OCI_DEFAULT);
	if ($lob->savefile($_FILES['file']['tmp_name'])) {
		oci_commit($conn);
		$_SESSION['img_suc'] = True;
		$_SESSION['suc_msg'] = "Image uploaded";
	} else {
		$_SESSION['img_err'] = True;
		$_SESSION['err_msg'] = "Failed to add image";
	}

	$lob->free(); 
	
	oci_close();
	
	header('Location: ../UploadPage.php');
	exit(1);
	
}

$allowedExts = array("gif", "jpeg", "jpg", "png", "txt");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& ($_FILES["file"]["size"] < 20000)
	&& in_array($extension, $allowedExts)) {
	
	if ($_FILES["file"]["error"] > 0) {
		echo "Error: " . $_FILES["file"]["error"] . "<br/>";
	} else {
		buildQuery();
	}	
}
?>
</body>
</html>
