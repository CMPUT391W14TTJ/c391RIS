<html>
<head>
	<Title>IMAGE VIEWER</title>
</head>
<body>
	<?php 	include('./inc/PHPconnectionDB.php');
		include('./inc/DisplayImg.php'); 
	?>
	<h2>Image</h2>
	
	<p><?php  
		displayImg($_GET['id'], "regular_size"); ?></p>
	
</body>
</html>
