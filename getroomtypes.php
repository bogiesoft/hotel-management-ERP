<?php
include_once("includes/db.inc.php");
$query = "SELECT * FROM master_room_type WHERE is_active=1";
$result = mysql_query($query);
$resultarray = array();
$i = 0;
while($obj = mysql_fetch_object($result)){
	$resultarray[$i] = $obj->room_type;
	$i++;
}
$resultarray = json_encode($resultarray);
echo $resultarray;

?>