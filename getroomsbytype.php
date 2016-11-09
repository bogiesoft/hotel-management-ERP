<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
        include_once("includes/db.inc.php");

        $resultarray = array();
		$roomtypes = array();
		$roomarray = array();
		$temparray = array();
		$i = 0;
		$query = "SELECT * FROM master_room_type WHERE is_active=1";
		$result = mysql_query($query)or die(mysql_error());
		while($obj = mysql_fetch_object($result)){
			$roomtypes[$i] = $obj->room_type;
			$i++;
		}
		$resultarray[0] = $roomtypes;
		for($i = 0;$i<count($roomtypes);$i++){
		    $type = $roomtypes[$i];			
			$query = "SELECT * FROM master_rooms WHERE room_type='$type'AND is_active = 1  ORDER BY room_no ASC";
			$result = mysql_query($query);
			
			$j = 0;
			
			while($obj = mysql_fetch_object($result)){
				$temparray[$j] = $obj->room_no;
				$j++;
			}
			$roomarray[count($roomarray)] = $temparray;
			$temparray = array();
           
	    }
		$resultarray[1] = $roomarray;
		echo json_encode($resultarray);
}
?>