<?php 

include_once("includes/db.inc.php");
include_once"hashmap.php";
$date1 = '';
$date2 = '';
if(isset($_POST['date1'])) $date1 = $_POST['date1'];
if(isset($_POST['date2'])) $date2 = $_POST['date2'];

$date1 = processdate($date1);
$date2 = processdate($date2);

    //echo $date1." ".$date2;

$a = mysql_query("SELECT * FROM ".$table_name[$b])or die(mysql_error());
$entered = array();
$gotout = array();
$i=0;

while($i < mysql_num_fields($a)){
   $meta  = mysql_fetch_field($a);
   $column[$i] = $meta->name;
   $i++;
}

$i = 0;
$a = mysql_query("SELECT * FROM ".$table_name[$b]." WHERE time >='".$date1."' AND time<='".$date2."' AND status ='entered'")or die(mysql_error());

while($object = mysql_fetch_object($a)){
	if($i<mysql_num_rows($a)){
	  $entered[$i] = array();
	  for($j=0;$j<count($column);$j++){
         $entered[$i][] = $object->$column[$j]; 	
       }
     $i++;
    }
}


$i = 0;
$a = mysql_query("SELECT * FROM ".$table_name[$b]." WHERE time >='".$date1."' AND time<='".$date2."' AND status ='gotout'")or die(mysql_error());
while($object = mysql_fetch_object($a)){
  if($i<mysql_num_rows($a)){
    $gotout[$i] = array();
    for($j=0;$j<count($column);$j++){
         $gotout[$i][] = $object->$column[$j];   
       }
     $i++;
    }
}

 $c = array($entered,$gotout,$column);
 $c = json_encode($c);
 echo $c;


 function processdate($str){
  $superarr = explode(' ',$str);
  $arr = $superarr[0];
  $arr = explode('-', $arr);
  $timearr = $superarr[1];
  $d = $arr[0]."-".($arr[1]+1)."-".$arr[2]." ".$timearr;
  return $d;
 }
?>