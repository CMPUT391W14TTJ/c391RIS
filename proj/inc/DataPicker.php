<div class="form">
	<h2>Please Enter Your Data Analysis Criteria</h2>
	<form name="report" method="post" action="./DataAnalysis.php">
		<p>
		<input type="checkbox" name="vehicle" value="Bike">Patient name<br>
		<input type="checkbox" name="vehicle" value="Car">Test Type<br>
		<?php
			include('./inc/Time.php');
		?>
		Time Periode:
		<?php
			echo time_picker('Time_');
		?>
		</p>
		<input type="submit" name="validate" value="Find"/>
	</form>
</div>
<hr width="100%"> 
