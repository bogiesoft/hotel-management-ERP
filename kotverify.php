<?php
include_once"includes/db.inc.php";
$bid = '';
if(isset($_POST['id'])) $bid = $_POST['id'];
$query =  "SELECT * FROM reservation WHERE booking_id =".$bid;
$result = mysql_query($query) or die("No reservation found with the given id , please manually verify in the record ");
$array = mysql_fetch_array($result);
 echo $array['room_no']; 
?>