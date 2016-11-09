<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$currentpath = '';
	$rewritepath = '';
	$currentpath = $_POST['currentpath'];
	$rewritepath = $_POST['rewritepath'];
	if(!isset($_POST['key']))$rewritepath = 'images/roomimages/'.$rewritepath;
	
	 file_put_contents($rewritepath, file_get_contents($currentpath));
	//if($rewritepath!='images/room.png')unlink($currentpath); 
}
?>