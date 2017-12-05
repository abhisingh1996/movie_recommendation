<?php

	$file=fopen("mov.txt","r");	
	$line=fgets($file);
	echo trim($line);
?>