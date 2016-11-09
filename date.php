<script type="text/javascript" src='jquery.js'></script>
<script type="text/javascript">
	$(document).ready(function(){
        var d = new Date();
        var timestamp = d.getTime();
var date = new Date(timestamp);

var year = date.getFullYear();
var month = date.getMonth() + 1;
var day = date.getDate();
var hours = date.getHours();
var minutes = date.getMinutes();
var seconds = date.getSeconds();
        document.getElementById('date').innerHTML = "<span>"+year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds+"</span>";		
	});
</script>
<div id='date'></div>
<?php

$timezone = 'Asia/Calcutta';

$date = new DateTime(null, new DateTimeZone($timezone));
$date =  $date->format('Y-m-d H:i:s');
echo $date;

?>