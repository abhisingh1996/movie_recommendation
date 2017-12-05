<?php require('common.php');
//get current counter
$data['current'] = (int)$db->check_changes();
//set initial value of update to false
$data['update'] = false;
//check if it's ajax call with POST containing current (for user) counter;
//and check if that counter is diffrent from the one in database
if(isset($_POST) && !empty($_POST['counter']) && (int)$_POST['counter']!=$data['current']){
	//the counters are diffrent so get new message list
	$data['news'] = '<h1>!!! NEW UPDATE !!!</h1>';
	$data['news'] .= $db->get_news();
	$data['update'] = true;
}
//just echo as JSON
echo json_encode($data);
/* End of file checker.php */
