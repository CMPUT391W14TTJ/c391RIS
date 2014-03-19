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

function buildQuery() {
	$imageID = generateImageID();
	$conn = connect();
	if (!$conn) {
   		$e = oci_error();
   		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   	}
	

		
	$imageData = file_get_contents($_FILES["file"]["tmp_name"]);
	//echo var_dump($imageData);
	$encoded_image = base64_encode($imageData);
	//echo "ENCODED IMAGE: " . $encoded_image; 
		
	$sql = "INSERT INTO pacs_images (record_id, image_id, regular_size) VALUES (" . 
		$_POST['record_id'] . ', ' . $imageID . ', \'' . addslashes($imageData) . '\')';
	$stid = oci_parse($conn, $sql);
	$res = oci_execute($stid);

	if (!$res) {
		$err = oci_error($stid);
		//print_r($err);
		echo htmlentities($err['message']);
		echo "error";
		//echo $sql;
		$_SESSION['err'] = True;
		$_SESSION['err_msg'] = "Failed to add image";
	} else {
		echo "worked";
	} 
	echo $sql;
	oci_close();
	
	//header('Location: ../UploadPage.php');
	//exit(1);
	
}

/*$allowedExts = array("gif", "jpeg", "jpg", "png", "txt");
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
*/	
	if ($_FILES["file"]["error"] > 0) {
		echo "Error: " . $_FILES["file"]["error"] . "<br/>";
	} else {
		echo 'Uploaded: ' . $_FILES['file']['name'] . '<br/>';
		echo 'Size: ' . $_FILES['file']['size'] . '<br/>';
		echo 'Type: ' . $_FILES['file']['type'] . '<br/>';
		echo 'Temporary Storage: ' . $_FILES['file']['tmp_name'] . '<br/>';
		//$image = addslashes(file_get_contents($_FILES['file']['tmp_name']));
		buildQuery();
		//echo "FILEGETCONTENT: " . file_get_contents($_FILES['file']['tmp_name']);
	}	
//}
?>
</body>
</html>
