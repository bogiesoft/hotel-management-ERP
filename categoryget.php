<?php

include_once("includes/db.inc.php");
$a = "SELECT * FROM master_food_categories"or die(mysql_error());
$a = mysql_query($a);
$items = array();
$i = 0;
while($b = mysql_fetch_object($a)){
      $items[$i] = $b->category;
      $i++;
}

?>