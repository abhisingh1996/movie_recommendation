<?php
	header("Content-type:application/json");
	extract($_GET);
	$data = array('error' => 'Not found!');
	if(isset($isbn))
	{
		$file = fopen("mov.txt", "r");
		while(!feof($file))
		{
			$line = trim(fgets($file));
			$info = explode(";", $line);
			if($info[0] == $isbn)
			{
				$data = array('isbn' => $info[0], 'MOVIE' => $info[1], 'DATE' => $info[2]);
				break;
			}
		}
		fclose($file);
	}
	echo json_encode($data);
?>