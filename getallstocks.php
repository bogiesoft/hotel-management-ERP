<?php
include_once"includes/db.inc.php";
include_once"functions/functions.php";
include_once"config.inc.php";
session_start();
$user = $_SESSION['user']['uname'];
if(isset($_POST['masteritemdetails'])){
	$masteritemarray = array();
	$itemarray = array();
	$masteritemarray = json_decode($_POST['masteritemdetails']);
	//echo json_encode($masteritemarray);
	for($k = 0 ;$k<count($masteritemarray);$k++){
	 $itemarray = $masteritemarray[$k];
	 $insertarray = array(
		"code" => putData($itemarray[0]),
		"item" => putData($itemarray[1]),
		"price"=> putData($itemarray[2]),
		"supplier"=> putData(" "),
		"quantity"=> putData($itemarray[3]),
		"time"=>putData($itemarray[4]),
		"status"=>putData('gotout'),
		"user"=>putData($user)
		);
	 $last_insert_id = insertData($insertarray,STOCKIN);
	}
	//echo json_encode($insertarray);
	//
	echo $last_insert_id;
}
?>