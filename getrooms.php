<?php
 include_once("includes/db.inc.php");
 echo "<option>hello </option>";
 $a = mysql_query("SELECT room_no FROM master_rooms WHERE is_active = 1");
 if(mysql_num_rows($a)>0){
 	while($b = mysql_fetch_object($a)){
 		echo "<option>".$b->room_no."</option>";
 	}
 }

?>