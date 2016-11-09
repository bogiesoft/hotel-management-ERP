<?php
include_once"includes/db.inc.php";
$query = "SELECT * FROM master_suppliers";
$result = mysql_query($query);
while($obj = mysql_fetch_object($result)){
	echo "<option>".$obj->supplier."</option>";
}
?>