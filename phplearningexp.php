<?php
function extractnum($str){
	preg_match_all('/([\d]+)/',$str,$match);
	return $match[0];

}
$string = '7Kg';
$num =  extractnum($string)[0];
$unit = str_replace($num, '', $string);
echo $num.$unit;
?>