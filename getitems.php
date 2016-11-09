<?php
include_once "includes/db.inc.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
 $c = $_POST['category'];
 $a = mysql_query("SELECT * FROM food WHERE category = '$c'");
 while($row = mysql_fetch_object($a)){
	echo $row->item.",".$row->price.",";
 }
}
?>