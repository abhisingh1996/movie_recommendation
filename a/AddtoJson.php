<?php
	extract($_GET);
	if($method=="POST"){
			$data=array('username'=>$username,'Prodname'=>$prodname,'Bid'=>$initialbid,"Expires"=>$Expires,"Category"=>$prodCat,'image'=>$imgname);
	//username=abhishek&prodname=xyz&initialbid=100&Expires=10000&prodCat=Smart&imgname=img.jpg
			$datatosend=http_build_query($data);
			
			$header=array("Content-type:application/x-www-form-urlencoded");
			
			$req=array(
				'http'=>array(
					'method'=>'POST','header'=>$header,'content'=>$datatosend
				)
			);
			$context=stream_context_create($req);
			
			// $res=file_get_contents("http://127.0.0.1:80/6thSem/FrontEnd/WS/Add/name/$name/maxbid/$maxbid/Expires/$Expires/prodCat/$prodCat",false,$context);
			$res=file_get_contents("http://127.0.0.1:80/movie_recommendation/a/WS/Add",false,$context);
			
			echo $res;
		
	}
	
?>