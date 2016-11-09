<?php
#### THESE HELPS TO MANAGE THE ADDSLASHES AND STRIPSLASHES
#### IF YOU USE PHP FUNCTIONS IT IS DEPENDENT ON SERVER CONFIGURATION.
#### SO IT SHOULD BE AVOID.

############# USED TO REDIRECT TO ANOTHER PAGES
function redirect($page) {
		if(!headers_sent())
			header("location:$page");
		else
			echo "<script>window.location.href='$page'</script>";
}
########## USE WHEN PUTTING DATA INTO DATABASE
function putData( $inputValue ) {
	if( get_magic_quotes_gpc() ) {
		return trim($inputValue);  
	} else {
		return addslashes( trim($inputValue) );  
	}
}

###### USED IN CASE OF PASSING THE VALUES TO PAYMENT GATEAY AS HIDDEN VALUES	
function getData( $outputValue ) {
	if( get_magic_quotes_gpc() ) 
		return htmlentities( stripslashes(trim($outputValue)) );  
	
	return htmlentities( trim($outputValue) );  
}

function useHTMLEntities( $vl ) {
		return htmlentities( trim($vl) );  
}


##### WE NEED TO REMOVE THE SLASHES
function removeSlashesFrom( $inputValue ) {
	if( get_magic_quotes_gpc() ) {
		return stripslashes( trim($inputValue) );  
	} else {
		return trim($inputValue);  
	}
}

###### THIS TELLS THAT THE VALUE IS VALID INTEGRE TYPE
function isValidInteger( $str ) {
	if(preg_match("/^([0-9]+)$/",$str,$reg) ) { ####  BE VALID INTEGER
		return true;
	} else {
		return false;
	}
} # END OF FUNCTION

########### USED TO FIRE THE INSERT QUERY
function insertData($arr, $tableName) {
	$mysql_db = new DB();
	$query = "";		

	if(! is_array($arr) ) {
		die("ERROR: Invalid Operation.");
	}
	foreach($arr as $key => $value ) {
	  $query .= "$key='$value',";   		
	}
	$query = " insert into $tableName set ".substr($query,0,-1);
	$mysql_db->query($query);
	return $mysql_db->insertID(); ######## RETURNS LAST INSERTED ID
} # END OF FUNCTION




########### USED TO FIRE THE UPDATE QUERY
function updateData($arr, $tableName, $whereClause) {
	$mysql_db = new DB();
	$query = "";		

	if(! is_array($arr) ) {
		die("ERROR: Invalid Operation.");
	}
	foreach($arr as $key => $value ) {
	   $query .= "$key='$value',";   		
	}
	if( $whereClause == "" ) {
		die("ERROR: Invalid Operation in where clause.");
	}

	$whereClause = " where ".$whereClause;
	$query = " update $tableName set ".substr($query,0,-1).$whereClause;
	$mysql_db->query($query);
} # END OF FUNCTION



######### FUNCTION USED TO KNOW WHETHER RECORD EXISTS OR NOT
function matchExists($tableName, $whereClause) {
	$mysql_db = new DB();
	
	if( $tableName == "" || $whereClause == "") {
		die("ERROR: Invalid Operation.");
	}
	$query = "select count(*) as cnt from $tableName where ".$whereClause;		
	$mysql_db->query($query);
	$data = $mysql_db->fetchArray();
	if( $data['cnt']>0 ) {
		return true;
	} else {
		return false;
	}
} ### END OF FUNCTION

######### CREATE THE SINGLE SELECTED DROP DOWN BOX
function createComboBox($arr, $name, $sltValue, $extraInfo="") {
	if(! is_array($arr) ) {
		die("ERROR: Incorect Information");
	}
	
	$data = "<select name='$name' $extraInfo>";
	foreach( $arr as $key => $value ) {
		$sel = "";
		if( $key == $sltValue )
			$sel = " selected ";
		$data .= "<option value='$key' $sel>$value</option>";
	}
	return $data .= "</select>";
} ########### END OF FUNCTION


######### CREATE THE MULTIPLE SELECTED DROP DOWN BOX(LIST BOX)
function createListBox($arr, $name, $sltValueArr, $extraInfo="") {
	
	if(! is_array($arr) ) {
		die("ERROR: Incorect Information");
	}
	if(! is_array($sltValueArr) ) {
		die("ERROR: Incorect Information");
	}
	
	$data = "<select name='$name' $extraInfo>";
	foreach( $arr as $key => $value ) {
		$sel = "";
		if( in_array($key, $sltValue) )
			$sel = " selected ";
		$data .= "<option value='$key' $sel>$value</option>";
	}
	return $data .= "</select>";
} ############ END OF FUNCTION

######## THIS FUNCTION HELPS TO KNOW THAT URL IS ACCESSIBLE OR NOT ######################

function urlExists($url) {
	$urlParts = parse_url($url);  
	$host = $urlParts['host']; 
	$fsocket_timeout = 10; 
	$port = (isset($urlParts['port'])) ? $urlParts['port'] : 80;  

	if( !$fp = @fsockopen( $host, $port, $errno, $errstr, $fsocket_timeout ))
	return false; // url not available
	else 
	return true; // yes url exists
} # END OF FUNCTION


function randomval(){
	$valrand = rand(1000,999999);	
 	 $qsel = "select booking_id from ".RESERV." where booking_id='$valrand' ";
	$qsel2=mysql_query($qsel);
	if(mysql_num_rows($qsel2)>0){
		randomval();
	}else{
		return $valrand;
	}
}
?>