<?php
include_once"includes/db.inc.php";
$code = '';
$available = 0;
$gotout = 0;
$unit = '';
if(isset($_POST['code'])) $code = $_POST['code']; 

//this is to sum up all the entered quantities :)
$query = "SELECT * FROM stockin WHERE code = '".$code."' AND status='entered'";
$result = mysql_query($query)or die(mysql_error());
 while($r = mysql_fetch_object($result)){
 	$string = $r->quantity;
    $num =  extractnum($string)[0];
    $unit = str_replace($num, '', $string);
    $available+=$num;
 }

//this is sum up all the gotout quantities

$query = "SELECT * FROM stockin WHERE code = '".$code."' AND status='gotout'";
$result = mysql_query($query)or die(mysql_error());
 while($r = mysql_fetch_object($result)){;
    $string = $r->quantity;
    $num =  extractnum($string)[0];
    $unit = str_replace($num, '', $string);
    $gotout+=$num;
 }


$query = "SELECT * FROM stockin WHERE code = '".$code."' AND status='entered'";
$result = mysql_query($query)or die(mysql_error());
$result = mysql_fetch_array($result);
$array = array($result['code'],$result['item'],$result['price'],($available-$gotout).$unit);


 echo json_encode($array);


function extractnum($str){
	preg_match_all('/([\d]+)/',$str,$match);
	return $match[0];
}
?>