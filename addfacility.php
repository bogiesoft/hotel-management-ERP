<?php

if ($_SERVER['REQUEST_METHOD']=='POST') {
	$status =1;
	$facility ='';
	$description ='';
 include_once("includes/db.inc.php");
  if(isset($_POST['facility'])&&isset($_POST['status'])&&isset($_POST['description'])){
       if($_POST['status']!=="yes"){
        $status=0;
      }
     $facility = $_POST['facility'];
     $description = $_POST['description'];

  }
  $a = mysql_query("INSERT INTO master_room_facilities(facility,is_active,Description)VALUES('$facility','$status','$description')")or die(mysql_error());
	
}

?>