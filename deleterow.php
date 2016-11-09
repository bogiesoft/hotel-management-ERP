<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

	 include_once("includes/db.inc.php");
	
       $id = $_POST['id'];
       $b = $_POST['b'];
  
   include_once"hashmap.php";
  

   $query = "DELETE FROM ".$table_name[$b]." WHERE id = ".$id;
	 $a = mysql_query($query)or die(mysql_error());
   $setid = "UPDATE ".$table_name[$b]." SET id = id-1 WHERE id>".$id;
	 $b = mysql_query($setid)or die(mysql_error());  

}
?>