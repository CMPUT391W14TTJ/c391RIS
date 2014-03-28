<html>
<head>
	<title>Upload Record - Radiology Information System</title>
</head>
<body>
	<?php 
		error_reporting(E_ALL);
		ini_set('error_reporting', E_ALL);
		include ('./classes/user.php');
		session_start();
		include( './inc/navigation.php' );
		include( './inc/Date.php' );
		include( './inc/PHPconnectionDB.php' );
		include( './Upload/DisplayIDs.php' );
		
		$userName = $_SESSION['user']->username;
		$user_class = $_SESSION['user']->user_class;
	
		if(strcmp($userName,'admin') != 0 && strcmp($user_class,'r') != 0){
			header( "Location: ./unauthorized.html");
		}
	 ?>
	<article class="upload_record">
		<h2>Upload Radiology Record:</h2>
		<div class="form">
			<h3>Enter Record Information:</h3>
			<form name="RadiologyRecord" method="post" action="./Upload/CheckRadiologyForm.php">
				Record ID: <input type="text" name="record_id"/><span style="color: #FF0000;">*</span><br/>
				Patient ID: <select name="patient_id">
						<option value="empty">empty</option>
						<?php displayPatients(); ?>
					    </select><span style="color: #FF0000;">*</span>&nbsp;&nbsp;&nbsp;  
				Doctor ID: <select name="doctor_id">
						<option value="empty">empty</option>
						<?php displayDoctors(); ?>
					    </select><span style="color: #FF0000;">*</span>&nbsp;&nbsp;&nbsp; 
				Radiologist ID: <select name="radiologist_id">
						<option value="empty">empty</option>
						<?php displayRadiologists(); ?>
					    </select><span style="color: #FF0000;">*</span><br/>
				Test Type: <input type="text" name="test_type"/><br/>
				<!-- will put date here --!>
				Prescribing Date:
				<?php
					echo date_picker('prescribe_');
				?>
				Test Date:
				<?php
					echo date_picker('test_');
				?><br/>
				Diagnosis: <p><textarea name="diagnosis" cols="40" rows="5"></textarea></p>
				Description: <p><textarea name="description" cols="40" rows="5"></textarea></p>
				<input type="submit" name="uploadRecord" value="Upload Record"/>
			</form>
			<p style="color:red;">
			<?php
				if (isset($_SESSION['err'])) {
					if ($_SESSION['err'] == True) {
						echo $_SESSION['err_msg'];
					}
					$_SESSION['err'] = False;
				}
			?>
			</p>
			<?php 
			?>
		</div>
	</article>
	<article class="upload_image">
		<h2>Upload Image To Radiology Record:</h2>
		<div class="form">
			<form method="post" enctype="multipart/form-data" action="./Upload/UploadImage.php">
			Record ID: <select name="record_id">
						<option value="empty">empty</option>
						<?php displayRecords(); ?>
					</select><span style="color: #FF0000;">*</span><br/>
			<label for="file">Filename:</label>
			<input type="file" name="file" id="file"><span style="color: #FF0000;">*</span><br/>
			<input type="submit" name="uploadImage" value="Upload Image">
			</form>
		</div>
	</article>	
	<p style="color:red;">
	<?php
		if (isset($_SESSION['img_err'])) {
			if ($_SESSION['img_err'] == True) {
				echo $_SESSION['err_msg'];
			}
			$_SESSION['img_err'] = False;
		}
	?>
	</p>
	<p style="color:green;">
	<?php
		if (isset($_SESSION['img_suc'])) {
			if ($_SESSION['img_suc'] == True) {
				echo $_SESSION['suc_msg'];
			}
			$_SESSION['img_suc'] = False;
		}
	?>	
	</p>
</body>
</html>
