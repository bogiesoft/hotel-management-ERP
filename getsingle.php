<?php
include_once"includes/db.inc.php";
include_once"functions/functions.php";
include_once"config.inc.php";
session_start();
$user = $_SESSION['user']['uname'];
if(isset($_POST['itemdetails'])){
	$itemarray = array();
	$itemarray = json_decode($_POST['itemdetails']);
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
	echo $last_insert_id;
}
?>