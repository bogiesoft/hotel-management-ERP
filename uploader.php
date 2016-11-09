<?php

session_start();
include_once("includes/db.inc.php");
$a =' ';
$b=' ';

if($_SERVER['REQUEST_METHOD']=='POST'){
	$_SESSION['name'] = $_POST['name'];
    $_SESSION['message'] = $_POST['message'];
}


$a = $_SESSION['name'];
$b = $_SESSION['message'];

$d = mysql_query("SELECT message FROM remarks WHERE room_no = '$a'");
$e = mysql_num_rows($d);
if($e>0){
	mysql_query("UPDATE remarks SET message='$b' WHERE room_no ='$a'");
 
}
else{
   mysql_query("INSERT INTO remarks(room_no,message)VALUES('$a','$b')");	
}

?>