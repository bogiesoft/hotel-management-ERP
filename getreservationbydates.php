<?php
function formdate($year,$month,$day,$date,$time){
     		$date = $year."-".$month."-".$day.$time;
            return $date;
}
if($_SERVER['REQUEST_METHOD']=='POST'){
	    $time = 1;
	    $roomarray='';
	    $date1 = '';
	    $date2 = '';
	    $day = '';
	    $year = '';
	    $month = '';
	    $temparray = array();
	    $superresultarray = array();
	    if(isset($_POST['roomarray']))$superroomarray = $_POST['roomarray'];
	    if(isset($_POST['day']))$day = $_POST['day'];
	    if(isset($_POST['year']))$year = $_POST['year'];
	    if(isset($_POST['month']))$month = $_POST['month'];
	    if(isset($_POST['time']))$time = $_POST['time'];
        $month++;
        $superroomarray  =  json_decode($superroomarray);
		include_once("includes/db.inc.php");
		$date1 = formdate($year,$month,$day,$date1," 00:00:00");
        $date2 = formdate($year,$month,$day+$time,$date2," 00:00:00");
          //  echo $date1."\n".$date2."\n";     

     for($l=0;$l<count($superroomarray);$l++){
         $roomarray = $superroomarray[$l];
         //echo json_encode($roomarray);
        for($k=0;$k<count($roomarray);$k++){
           $query = "SELECT * FROM reservation WHERE room_no='$roomarray[$k]' AND check_in_date >='$date1' AND check_in_date<'$date2'";
           $result = mysql_query($query)or die(mysql_error());
           $result = mysql_fetch_object($result);
           if(empty($result->room_no)){
           	  unset($roomarray[$k]);   
           }
		 }

		
		 $roomarray = array_values($roomarray);
		// echo json_encode($roomarray);
		$resultarray = array();
        $key = 0;
		for($k=0;$k<count($roomarray);$k++){
			$query = "SELECT * FROM reservation WHERE room_no='$roomarray[$k]' AND check_in_date >='$date1' AND check_in_date<'$date2' ORDER BY room_no ASC";
			$result = mysql_query($query)or die(mysql_error());
			$j = 0;
			$column = array("room_no","name","check_in_date","check_out_date","status");
			$results = mysql_num_rows($result);
			while($obj = mysql_fetch_object($result)){
			 for($j=0;$j<count($column);$j++){	
				$temparray[$j] = $obj->$column[$j];
			  }
			  //echo $results."\n";
			  $resultarray[count($resultarray)] = $temparray;
			  
			}
          }
         $resultarray = json_encode($resultarray);
         $superresultarray[$l] = $resultarray;
		}
		echo json_encode($superresultarray);
}

?>