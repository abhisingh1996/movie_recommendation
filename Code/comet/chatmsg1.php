<?php
	header("Content-type: text/event-stream");
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT");
	
	ob_start();
	
	$oldtime = filemtime("chat2.txt");
	
	while(true)
	{
		clearstatcache();
		$newtime = filemtime("chat2.txt");
		
		if($newtime > $oldtime)
		{
			
			$file = file("chat2.txt");
			
			$msg=$file[sizeof($file)-1];
			
			echo "event:newmsg\n";
			echo "retry:10\n";
			echo "data: $msg\n\n";
			
			ob_flush();
			flush();
		
			$oldtime = $newtime;
			fclose($file);
		}
		sleep(3);
	}
?>
