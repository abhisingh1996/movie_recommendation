<?php
	extract($_GET);
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT");
	$file = fopen("chat1.txt","w");
	fputs($file,$message);
	fclose($file);
?>