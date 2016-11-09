

<?php
include_once"includes/db.inc.php";
$query = "SELECT * FROM master_suppliers";
$result = mysql_query($query);
while($obj = mysql_fetch_object($result)){
	echo "<option>".$obj->supplier."</option>";
}
/*include_once"includes/db.inc.php";
$arr = array();
$date = '2014-12-08 00:00:00';
$query = "SELECT * FROM reservation WHERE check_in_date > '$date'";
$result = mysql_query($query);
while($obj = mysql_fetch_object($result)){
	 echo $obj->check_in_date."<br>";
}
*/
/*  $array = array("Reservation"=>1,"Dashboard"=>1,"AdminPanel"=>0,"RoomOperations"=>1);
  $arr = json_encode($array);
  include_once"includes/db.inc.php";
  $a = mysql_query("UPDATE user_levels SET rights = '$arr' WHERE privilege='frontdesk'")or die(mysql_error());
  /*$b = mysql_query("SELECT * FROM "."user_levels"." WHERE privilege = 'front desk'")or die(mysql_error());
  $c = mysql_fetch_object($b);
  $c =  json_decode($c->rights);
  echo $c->AdminPanel;*/
 ?>