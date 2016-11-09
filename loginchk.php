<?php
session_start();
include_once("includes/db.inc.php");
include_once("config.inc.php");
include_once("functions/functions.php");

$username =  $_GET['q'];
$password =  $_GET['p'];
$remember =  $_GET['remember'];

if( $username != "" and $password != "" ) {
	$msg = "";
	
	######### LOGIN VALIDATION ###############
	$qry = "select * from users where username='".putData( $username )."' and password='".putData( $password )."'" ;
     $qry1=mysql_query($qry);
	 $qry_num = mysql_num_rows($qry1);
	if( $qry_num > 0 ) {
		$data = mysql_fetch_array($qry1);
		
		$_SESSION['user']['uid'] = $data['id'];
		$_SESSION['user']['uname'] = $data['username'];
		if($remember==1) {
		$year = time() + 31536000;
		setcookie('remember_me', $data['username'], $year);
		}elseif($remember==0) {
	  if(isset($_COOKIE['remember_me'])) {
		$past = time() - 100;
		setcookie('remember_me', 'gone', $past);
			}
		}
		
	echo $msg=1;
	}else{
	
	echo $msg = 2;
	}
}
?>