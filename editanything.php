<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
 include_once("includes/db.inc.php");

   $b = $_POST['b'];
   $insertarray = $_POST['insertarray'];
   $insertarray = json_decode($insertarray);
  
   include_once"hashmap.php";
$a = mysql_query("SELECT * FROM ".$table_name[$b])or die(mysql_error());
$i=0;


while($i<mysql_num_fields($a)){
   $meta  = mysql_fetch_field($a);
   $column[$i] = $meta->name;
   $i++;
}
$insertarray[0]++;
 $id = $insertarray[0];
    $query = "DELETE FROM ".$table_name[$b]." WHERE id = ".$id;
   mysql_query($query)or die(mysql_error());   
    $query = "INSERT INTO ".$table_name[$b]."(";
    
    for($i=0;$i<count($column);$i++){
      if($i!=count($column)-1)
      $query.=$column[$i].",";
       else{
      $query.=$column[$i].")";
       }
    }
    $query.="VALUES(";

    for($i=0;$i<count($insertarray);$i++){
      
      if($i!=count($insertarray)-1)
      $query.="'".$insertarray[$i]."',";
       else{
      $query.="'".$insertarray[$i]."')";
       }

    }
     
     echo $query;
     $a = mysql_query($query)or die(mysql_error());

     
   
   /* $query = "UPDATE".$table_name[$b]."SET ";
    
    for($i=0;$i<count($column);$i++){
      if($i!=count($column)-1)
      $query.=$column[$i]."='".$insertarray[$i]."',";
       else{
      $query.=$column[$i]."='".$insertarray[$i]."'";
       }
    }
    $query.="WHERE id =".$insertarray[0];
    $a = mysql_query($query)or die(mysql_error());*/
 } 
?>