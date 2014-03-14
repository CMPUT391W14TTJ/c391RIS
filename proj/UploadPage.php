<html>
<head>
	<title>Upload Record - Radiology Information System</title>
</head>
<body>
	<?php 
		error_reporting(E_ALL);
		ini_set('error_reporting', E_ALL);
		include( './inc/Date.php' );
		include( './inc/PHPconnectionDB.php' );
		include( './Upload/DisplayIDs.php' );
	 ?>
	<article class="acc_settings">
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
					echo date_picker('prescribe_date');
				?>
				Test Date:
				<?php
					echo date_picker('test_date');
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
</body>
</html>
