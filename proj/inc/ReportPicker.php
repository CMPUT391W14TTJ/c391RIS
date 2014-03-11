<div class="form">
	<h2>Please Enter Your Report Criteria</h2>
	<form name="login" method="post" action="./ReportGeneratingModule.php">
		Diagnosis: <input type="text" name="diagnosis"/><br/>
		<p>
		<?php
			include('./inc/Date.php');
		?>
		From: 
		<?php
			echo date_picker('Start_');
		?>
		To: 
		<?php
			echo date_picker('End_');
		?>
		</p>
		<input type="submit" name="validate" value="Find"/>
	</form>
</div>
<hr width="100%"> 

