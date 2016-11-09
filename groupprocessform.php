<?php

include_once"includes/db.inc.php";
include_once("config.inc.php");
include_once("session.php");
include_once"functions/functions.php";
############# INSERT RECORDS HERE



if( $_POST['reserv'] == "Group Reserve" or $_POST['checkin']=="Group Check-In" ) {
//echo $_POST['reserv']." ".$_POST['checkin']."\n";

$countval = $_POST['count'];
//echo $countval;
if($countval>0){
$indate = json_decode($_POST['indate']);
$outdate = json_decode($_POST['outdate']);
$room_no = json_decode($_POST['room_no']);
$room_type = json_decode($_POST['room_type']);


for($g=0;$g<$countval;$g++){  //// FOR LOOP START
		
$date=date("Y-M-d"); 
$checkindate =  $indate[$g];
$time = strtotime($checkindate);
$check_in_date = date("Y-m-d H:i:s", $time);
$checkoutdate =  $outdate[$g];
$time1 = strtotime($checkoutdate);
$check_out_date = date("Y-m-d H:i:s", $time1);
//echo $room_no[$g]."\n";
if($_POST['reserv'] == "Group Reserve"){  $status = "reserved";}
if($_POST['checkin'] == "Group Check-In"){  $status = "check-in";}

$insertArr = array(
		
			"booking_id"	      	 =>  putData( $_POST['bookingid'] ),
			"initials"	     		 =>  putData( $_POST['initials'] ),
			"name"	      			 =>  putData( $_POST['fullname'] ),
			"address"	     		 =>  putData( $_POST['address'] ),
			"state"	     			 =>  putData( $_POST['state'] ),
			"city"	     			 =>  putData( $_POST['city'] ),
			"zip_code"	    		 =>  putData( $_POST['zip_code'] ),
			"country"	    		 =>  putData( $_POST['country'] ),
			"room_no"	     		 =>  putData( $room_no[$g] ),
            "room_type"              =>  putData( $room_type[$g] ),
			"check_in_date"	     	 =>  putData( $check_in_date ),
			"check_out_date"	     =>  putData( $check_out_date ),
			"adult_default"	     	 =>  putData( $_POST['adult_default'] ),
			"child_default"	     	 =>  putData( $_POST['child_default'] ),
			"email"	     	 		 =>  putData( $_POST['email'] ),
			"phone"	     	 		 =>  putData( $_POST['phone'] ),
			"mobile"	     		 =>  putData( $_POST['mobile'] ),
			"fax"	     			 =>  putData( $_POST['fax'] ),
			"identity"	     		 =>  putData( $_POST['identity'] ),
			"identity_no"	     	 =>  putData( $_POST['identity_no'] ),
			"nationality"	     	 =>  putData( $_POST['nationality'] ),
			"gender"	     		 =>  putData( $_POST['gender'] ),
			"vip_status"	     	 =>  putData( $_POST['vip_status'] ),
			"pay_mode"	     	 	 =>  putData( $_POST['pay_mode'] ),
			"company"	     		 =>  putData( $_POST['company'] ),
			"mode_arrival"	     	 =>  putData( $_POST['mode_arrival'] ),
			"source"	     		 =>  putData( $_POST['source'] ),
			"status"	     		 =>  $status		

			);
			
	        $last_insert_id = insertData($insertArr, RESERV);
			

   } /// end for loop

 }
}
//print_r($insertArr);	

?>
