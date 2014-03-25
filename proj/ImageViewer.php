<html>
<head>
	<Title>IMAGE VIEWER</title>
</head>
<body>
	<?php 	include('./inc/PHPconnectionDB.php');
		include('./inc/DisplayImg.php'); 
	?>
	<h2>Image</h2>
	
	<p><?php echo "image id: " . $_GET['id'] . '<br/>'; 
		displayImg($_GET['id'], "regular_size"); ?></p>
	<p><?php echo "image id: " . $_GET['id'] . '<br/>'; 
		displayImg($_GET['id'], "full_size"); ?></p>
	
</body>
</html>
