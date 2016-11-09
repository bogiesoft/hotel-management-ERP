<?php 

include_once("includes/db.inc.php");
include_once"hashmap.php";
$a = mysql_query("SELECT * FROM ".$table_name[$b])or die(mysql_error());
$facilities = array();
$i=0;

while($i<mysql_num_fields($a)){
   $meta  = mysql_fetch_field($a);
   $column[$i] = $meta->name;
   $i++;
}
$i = 0;

while($object = mysql_fetch_object($a)){
	if($i<mysql_num_rows($a)){
	  $facilities[$i] = array();
	  for($j=0;$j<count($column);$j++){
         $facilities[$i][] = $object->$column[$j]; 	
       }
     $i++;
    }
}

$i = 0;

 $c = array($facilities,$column);
 $c = json_encode($c);
 echo $c;
?>