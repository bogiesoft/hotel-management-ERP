<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

	 include_once("includes/db.inc.php");
	
       $column = $_POST['column'];
       $id = $_POST['id'];
       $value = $_POST['value'];
       $b = $_POST['b'];
  
     include_once"hashmap.php";
   $query = "UPDATE ".$table_name[$b]." SET ".$column."='$value' WHERE id='$id'";
	 $a = mysql_query($query)or die(mysql_error());

}
?>