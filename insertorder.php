<?php
include_once "includes/db.inc.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
 $item = trim(stripslashes($_POST['item']));
   $request = mysql_query("SELECT * FROM food WHERE item = '$item'") or die(mysql_error());
   $s = mysql_fetch_array($request);
   	echo $s['price'];
   
 }  
?>