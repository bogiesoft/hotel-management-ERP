<?php
include_once "includes/db.inc.php";
$date1 = '';
$date2 = '';
if(isset($_POST['date'])) $date1 = $_POST['date'];
$statusarr = array("reserved","check-in","block");
$resultarr = array();
$date2 = explode(' ',$date1);
$date2 = $date2[0];
$date2 = explode('-',$date2);
$date2 = $date2[0]."-".$date2[1]."-".($date2[2]+1)." 00:00:00";

	for($i=0;$i<count($statusarr);$i++){

		$query = "SELECT * FROM reservation WHERE status ='$statusarr[$i]' AND check_in_date >= '$date1' AND check_in_date <=  '$date2'";
		$result = mysql_query($query) or die(mysql_error());
		$resultarr[$statusarr[$i]] = 0;
		while($res = mysql_fetch_object($result)){
			 $resultarr[$statusarr[$i]]++;
		}
		
	}
	echo json_encode($resultarr);

?>