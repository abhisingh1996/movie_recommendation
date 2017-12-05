<?php
	header("Content-Type:application/json");
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$data=file_get_contents("php://input");
		$data=trim($data);
		$data=explode("&",$data);
		$movieId=explode("=",$data[0]);
		$movieId=$movieId[1];
		$name=explode("=",$data[1]);
		$name=$name[1];
		$year=explode("=",$data[2]);
		$year=$year[1];
	
		$str=$movieId.",".$name.",".$year."\n";
		file_put_contents("../Code/temp.txt", $str,FILE_APPEND);
		$ret[]="success";
		$str=json_encode($ret);
		echo $str;
	}
?>