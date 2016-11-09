<?php
include_once"includes/db.inc.php";
$arr = array();
$column = array();
$details = array();
$obj = '';
if(isset($_POST['details'])){
	$arr = json_decode($_POST['details']);
}

$a = mysql_query("SELECT * FROM reservation")or die(mysql_error());
$i=0;

while($i<mysql_num_fields($a)){
   $meta  = mysql_fetch_field($a);
   $column[$i] = $meta->name;
   $i++;
}
  //echo json_encode($column);

$queryarray = array("room_no","name","check_in_date","check_out_date","status");

$query = "SELECT * FROM reservation WHERE ";

for($i = 0;$i<count($queryarray);$i++){
	if($i!=count($queryarray)-1)$query.=" ".$queryarray[$i]."= '$arr[$i]' AND";
	else $query.=" ".$queryarray[$i]."='$arr[$i]'";
}
//echo $query;

$result =  mysql_query($query)or die(mysql_error());

    $obj = mysql_fetch_object($result);
	
	for($i=0;$i<count($column);$i++){
	  $details[$column[$i]] = $obj->$column[$i];
	}

echo json_encode($details);

?>