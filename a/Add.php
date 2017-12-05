<?php
	header("Content-Type:application/json");
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$data=file_get_contents("php://input");
		$data=trim($data);
		$data=explode("&",$data);
		$username=explode("=",$data[0]);
		$username=$username[1];
		$prodname=explode("=",$data[1]);
		$prodname=$prodname[1];
		$Bid=explode("=",$data[2]);
		$Bid=$Bid[1];
		$Expires=explode("=",$data[3]);
		$Expires=$Expires[1];
		$Category=explode("=", $data[4]);
		$Category=$Category[1];
		$image=explode("=", $data[5]);
		$image=$image[1];
		
		$json = file_get_contents('../details.json');
		$obj = json_decode($json,true);
		$arr=array(
				"ProductName"=>$prodname,
				"Bid"=>$Bid,
				"Expires"=>$Expires,
				"Category"=>$Category,
				"image"=>$image
				);
		if(isset($obj[$username]))
			array_push($obj[$username], $arr);
		else{
			$obj[$username]=array();
			array_push($obj[$username], $arr);
		}
		$obj=json_encode($obj);
		file_put_contents("../details.json", $obj);

		$json_a=file_get_contents("../UserLog.json");
		$json_a=json_decode($json_a,true);
		$arr=array(
				"ProductName"=>$prodname,
				"Bid"=>$Bid,
				"Expires"=>$Expires,
				"Category"=>$Category,
				"image"=>$image,
				"Status"=>"Pending",
				"PurchasedBy"=>""
				);
		if(isset($json_a[$username]))
			array_push($json_a[$username],$arr);
		else{
			$json_a[$username]=array();
			array_push($json_a[$username],$arr);
		}
		$json_a=json_encode($json_a);
		file_put_contents("../UserLog.json",$json_a);

		#put this addition into InfoPage.txt so that the users could get to know new item is added

		// $file=fopen("../InfoPage.txt","rw");
		// // $tot=filesize("InfoPage.txt");
		// // $data=fread($file,$tot);
		// $fd=fseek($file,filesize("../InfoPage.txt"));
		$str="\nusername=$username,prodname=$prodname";
		// fwrite($file, $str);

		$file=file_put_contents("../InfoPage.txt",$str,FILE_APPEND | LOCK_EX);

		$ret[]="success";
		$str=json_encode($ret);
		echo $str;
	}
?>