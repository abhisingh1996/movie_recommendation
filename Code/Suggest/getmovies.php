<?php
	//This script will be fired when "onkeyup" event occurs on the
	// client side. The movie is sent as parameter
	
	extract($_GET);
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT");
	
	$file = fopen("Movies.txt", "r");
	
	//Data to send
	$ret = array();
	
	// Loop thru the file. One line at a time.
	// See if there is a match of the $movie with the initial part
	// of that line. If yes, add that line to our return data set
	// And continue forward
	while($line = fgets($file))
	{
		//Trim off the trailing spaces
		$lin = trim($line);
		
		//Now compare
		
		if(strncasecmp($lin, $movie,strlen($movie)) == 0)
		{
			//Add the $lin to our return set
			//Use the "auto-increment" feature on the index
			$ret[] = $lin;
		}
	}
	
	echo json_encode($ret);

?>