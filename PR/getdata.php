<?php
	$file = fopen("data.txt", "r");
	
	$line = fget($file);
	
	echo trim($line);
?>