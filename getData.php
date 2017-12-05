<?php

	$file=fopen("books.txt","r");	
	$line=fgets($file);
	echo trim($line);
?>