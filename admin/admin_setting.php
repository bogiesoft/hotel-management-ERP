<?php
##########################################################
#####     CREATED BY   : ANKUR AGARWAL	   			######
#####	  CREATION DATE: 17 Aug, 2006				######
#####     CODE BRIEFING: admin login setting		######
#####												######
#####     COMPANY	   : Divya Infosoft Pvt. Ltd.	######
#####												######
##########################################################
include_once("session.php");
include_once("../config.inc.php");
include_once("../functions/functions.php");
include_once("../includes/db.inc.php");
?>
<html>
<head><title><?php include_once("includes/admintitle.php");?>: Administrative Section</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
<script language="javascript" src="../javascript/validation.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td><?php  include_once("includes/header.php"); ?></td>
  </tr>
  <tr>
    <td valign="top">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-border">
        <tr>
          <td valign="top"><?php  include_once("includes/menu.php"); ?></td>
		  <td width="85%" valign="top" align="center" style="padding-top:40px">
		  <table width="90%" height="150" border="0" cellpadding="0" cellspacing="0">
          <tr>
          <td align="center"><?php 
		  if( $_GET['module'] == "login" )
				include_once("admin_setting/login.php");
	        
		  else
		      redirect("home.php");
		  ?></td>
          </tr>
         </table>
		 </td>
        </tr>
      </table>
</td>
  </tr>

  </table>
  <tr>
    <td><?php  include_once("includes/footer.php"); ?></td>
  </tr>

</body>
</html>
