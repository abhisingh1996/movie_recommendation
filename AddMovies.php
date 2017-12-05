<?php
	extract($_GET);
	if($method=="POST"){
			$data=array('movieID'=>$movieID,'name'=>$name,"year"=>$year);
	
			$datatosend=http_build_query($data);
			
			$header=array("Content-type:application/x-www-form-urlencoded");
			
			$req=array(
				'http'=>array(
					'method'=>'POST','header'=>$header,'content'=>$datatosend
				)
			);
			$context=stream_context_create($req);
			
			
			$res=file_get_contents("http://127.0.0.1:80/movie_recommendation/WS/Add",false,$context);
			
			echo $res;
		
	}
	
?>