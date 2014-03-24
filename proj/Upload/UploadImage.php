<html>
<head>
	<title>Uploading Image</title>
</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
session_start();
include('../inc/PHPconnectionDB.php');
include('./smart_resize_image.function.php');


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
	$resizedThumbnail = '/tmp/newthumbnail.jpg';
	unlink($resizedFile);

	smart_resize_image($_FILES['file']['tmp_name'], 100, 100, false, $resizedThumbnail, false, false, 100);
	
	return $resizedThumbnail;
}

function createLargeSize() {
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
	$stmt = oci_parse($conn, 'insert into pacs_images (record_id, image_id, thumbnail, regular_size) '
		. 'values(:recordid, :imageid, empty_blob(), empty_blob()) returning thumbnail, regular_size into :thumbdata, :blobdata');
	oci_bind_by_name($stmt, ':recordid', $_POST['record_id']);
	oci_bind_by_name($stmt, ':imageid', $imageID);
	oci_bind_by_name($stmt, ':blobdata', $lob, -1, OCI_B_BLOB);
	oci_bind_by_name($stmt, ':thumbdata', $lob1, -1, OCI_B_BLOB);
	oci_execute($stmt, OCI_DEFAULT);
	if ($lob->savefile($_FILES['file']['tmp_name']) && $lob1->savefile($thumbnail)) {
		oci_commit($conn);
		$_SESSION['img_suc'] = True;
		$_SESSION['suc_msg'] = "Image uploaded";
	} else {
		$_SESSION['img_err'] = True;
		$_SESSION['err_msg'] = "Failed to add image";
	}

	$lob->free(); 
	$lob1->free();
	
	oci_close();
	
	header('Location: ../UploadPage.php');
	exit(1);
}

$allowedExts = array("gif", "jpeg", "jpg", "png", "txt");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if (!isset($_FILES['file']['name'])) {
	$_SESSION['img_err'] = True;
	$_SESSION['err_msg'] = "Invalid file chosen.";
	header('Location: ../UploadPage.php');
	exit(1);
}

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
} else {
	$_SESSION['img_err'] = True;
	$_SESSION['err_msg'] = "File must be of format: gif, jpeg, jpg, pjpeg, " .
		"x-png, or png";
	header('Location: ../UploadPage.php');
	exit(1);
}
?>
</body>
</html>
