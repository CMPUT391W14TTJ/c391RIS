<?php
	/*
	 * Check if the radiology record was filled out appropriately
	 * For now we will just check that there is a valid record_id/doctorid/etc..
	 */
	function checkRecordID() {
	}

	if (isset($_POST['uploadRecord'])) {
		if (!isset($_POST['record_id'])	
			|| empty($_POST['record_id'])
			|| $_POST['patient_id'] == 'empty'
			|| $_POST['doctor_id'] == 'empty'
			|| $_POST['radiologist_id'] == 'empty') {

			$_SESSION['err'] = True;
			$_SESSION['err_msg'] = 'Must fill in all required fields (*)';
			header('Location: ../UploadPage.php');
			exit(1);	
		} else {
			$_SESSION['err'] = False;
			header('Location: ../UploadPage.php');
			exit(1);
		}	
	} else {
		header( 'Location: ../UploadPage.php');
		exit(1);
	}	
?>
