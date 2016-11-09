<?php
function formdate($year,$month,$day,$date){
     		$date = $year."-".$month."-".$day." 00:00:00";
            return $date;
}
if($_SERVER['REQUEST_METHOD']=='POST'){
	    $roomarray='';
	    $date1 = '';
	    $date2 = '';
	    $day = '';
	    $year = '';
	    $month = '';
	    $temparray = array();
	    if(isset($_POST['roomarray']))$roomarray = $_POST['roomarray'];
	    if(isset($_POST['day']))$day = $_POST['day'];
	    if(isset($_POST['year']))$year = $_POST['year'];
	    if(isset($_POST['month']))$month = $_POST['month'];
        $month++;
        $roomarray  =  json_decode($roomarray);
		include_once("includes/db.inc.php");
		$date1 = formdate($year,$month,$day,$date1);
        $date2 = formdate($year,$month,$day+1,$date2);

                //echo $date1."\n".$date2."\n";
        for($k=0;$k<count($roomarray);$k++){
           $query = "SELECT * FROM reservation WHERE room_no='$roomarray[$k]' AND check_in_date BETWEEN '$date1' AND '$date2'";
           $result = mysql_query($query)or die(mysql_error());
           $result = mysql_fetch_object($result);
           if(empty($result->room_no)){
           	  unset($roomarray[$k]);   
           }
		 }
		
		 $roomarray = array_values($roomarray);
		$resultarray = array();

		for($k=0;$k<count($roomarray);$k++){
			$query = "SELECT * FROM reservation WHERE room_no='$roomarray[$k]' AND check_in_date BETWEEN '$date1' AND '$date2' ORDER BY room_no ASC";
			$result = mysql_query($query)or die(mysql_error());
			 $j = 0;
			$column = array("room_no","name","check_in_date","check_out_date");
			while($obj = mysql_fetch_object($result)){
			 for($j=0;$j<count($column);$j++){	
				$temparray[$j] = $obj->$column[$j];
			  }
			  $resultarray[$k] = $temparray;
			}
          }
        
         $resultarray = json_encode($resultarray);
		 echo $resultarray;
		 
}

?>