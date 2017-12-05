<?php require('common.php');
if($_POST && !empty($_POST['title'])){
	$result = $db->add_news(strip_tags($_POST['title']));
}?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>updated list</title>
</head>
<style>

body {
    background-color: yellow;
}
</style>
<body>
	
	<p>Open <a href="index.php">list of movie</a> in new window, add new movie with this form and look at that list. <p>
	<?php if(isset($result)){
		if($result==TRUE){
			echo '<p>Success</p>';
		}else{
			echo '<p>Error</p>';
		}
	}else{?>
		<form method="post" action="#">
			<input type="text" name="title" size="50" />
			<input type="submit" value="Add moviename" />
		</form>
	<?php }?>
</body>
</html>

