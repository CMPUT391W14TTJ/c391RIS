<html>
<head>
	<title>Upload Record - Radiology Information System</title>
</head>
<body>
	<?php include( './inc/Date.php' ); ?>
	<article class="acc_settings">
		<h2>Upload Radiology Record:</h2>
		<div class="form">
			<h3>Enter Record Information:</h3>
			<form name="pass_change" method="post" action="">
				Record ID: <input type="text" name="record_id"/><br/>
				Patient ID: <select name="patient_id">
						<option value="empty">empty</option>
					    </select>&nbsp;&nbsp;&nbsp;  
				Doctor ID: <select name="doctor_id">
						<option value="empty">empty</option>
					    </select>&nbsp;&nbsp;&nbsp; 
				Radiologist ID: <select name="radiologist_id">
						<option value="empty">empty</option>
					    </select><br/>
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
				<input type="submit" name="uploadrecord" value="Upload Record"/>
			</form>
			<p style="color:red;">
			<?php
				/*
				if (isset($_SESSION['pass_change_err'])) {
					if ($_SESSION['pass_change_err'] == True) {
						echo $_SESSION['pass_err_msg'];
					}
					$_SESSION['pass_change_err'] = False;
				}
				*/
			?>
			</p>
		</div>
	</article>
</body>
</html>
