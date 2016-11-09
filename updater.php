<?php

include_once("includes/db.inc.php");

if($_SERVER['REQUEST_METHOD']=='POST'){
	$sequence = $priority = '';
	if(isset($_POST['sequence'])){
		$sequence = $_POST['sequence'];
	$a = explode(',',$sequence);
	for($i=0;$i<count($a);$i++){
		$c = explode('.',$a[$i]);
	$b = mysql_query("UPDATE master_rooms SET house_keeping_status ='$c[1]' WHERE room_no = '$c[0]' ");
       }

   }

   if(isset($_POST['priority'])){
        	$priority = $_POST['priority'];
        	$a = explode(',',$priority);
	for($i=0;$i<count($a);$i++){
		$c = explode('.',$a[$i]);
	    $b = mysql_query("UPDATE master_rooms SET priority ='$c[1]' WHERE room_no = '$c[0]' ");
       }
   	
   }


    if(isset($_POST['keeper'])){
        	$priority = $_POST['keeper'];
        	$a = explode(',',$priority);
	for($i=0;$i<count($a);$i++){
		$c = explode('.',$a[$i]);
	    $b = mysql_query("UPDATE house_keeping SET name ='$c[1]' WHERE room_no = '$c[0]' ");
       }
   	
   }

}
?>