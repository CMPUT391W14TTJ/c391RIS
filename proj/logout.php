<?php
	session_unset();
	session_destroy();
	header( 'Location: ./index.html' );
	exit(1);
?>
