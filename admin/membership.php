<?php
##########################################################
#####     CREATED BY   : Gautam Kumar	   			######
#####	  CREATION DATE: 24 June, 2014				######
#####     CODE BRIEFING: listing membership			######
#####												######
#####     COMPANY	   : ideliversolutions.   	    ######
#####												######
##########################################################
include_once("session.php");
include_once("../config.inc.php");
include_once("../functions/functions.php");
include_once("../includes/db.inc.php");
print_r($_SESSION);
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
    <td><?php  include_once("includes/header.php"); ?>
    
    <div class="wrap_menu">
        <?php include("includes/menu_top.php");?>
    </div></td>
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
		  //echo $_GET['module'];
		  
		  if( $_GET['module'] == "country_add")
		      include_once("masters/master_country_add.php");
		  else if( $_GET['module'] == "master_identity")
		      include_once("masters/master_identity.php");		  
		  else if($_GET['module'] == "master_room_type" )
	          include_once("masters/master_room_type.php");
		   else if($_GET['module'] == "identity_edit" )
	          include_once("masters/master_identity_edit.php");	  
		  else if($_GET['module']=="country_edit" && preg_match("/^([0-9]+)$/", $_GET['id'], $id) )
	          include_once("masters/master_country_edit.php");
		  else if($_GET['module']=="room_type_edit")
	          include_once("masters/master_room_type_edit.php");
		  else if($_GET['module']=="master_pay_mode")
	          include_once("masters/master_pay_mode.php");	  
		  else if($_GET['module']=="payment_mode_edit")
	          include_once("masters/master_pay_mode_edit.php");	
		  else if($_GET['module']=="master_room_add")
	          include_once("masters/master_room_add.php");
		  else if($_GET['module']=="room_edit")
	          include_once("masters/master_room_edit.php");	  
		  else if($_GET['module']=="master_room_listing")
	          include_once("masters/master_room_listing.php");
		  else if($_GET['module']=="master_room_facilities")
	          include_once("masters/master_room_facility.php");	  
		  else if($_GET['module']=="room_facility_edit")
	          include_once("masters/master_room_facility_edit.php");
			  
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
