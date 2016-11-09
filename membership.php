<?php
include_once("includes/db.inc.php");
include_once("config.inc.php");
include_once("session.php");
include_once("functions/functions.php");



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include_once("includes/admintitle.php");?></title>


<link rel="shortcut icon" type="image/png" href="images/preview_16x16.png" />

<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/icon.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style-menu.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="css/exp.css">
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popup_script.js"></script>
</head>

<body>
<?php include_once("includes/header.php");?>
        <div id='loading'><img src="images/logo.png" style='margin-top:20%;width:25px;height:25px;'><br><span style='margin-botton:4%;'>IDeliver</span></div>

<div id="content">
                <div class="inner">
					
                    <div class="clear"></div>
                    
                            <div class="column_right" style='float:left;width:84%;'>

						<?php
		  
		  if( $_GET['module'] == "dashboard")
		      include_once("dashboard.php");
		  else if($_GET['module'] == "new_reservation")
	          include_once("reservation.php");		  
		  else if($_GET['module'] == "reservation_list")
	          include_once("reservation_list.php");	
		  else if($_GET['module']=="groupreservation")
	          include_once("group_reservation.php");
		  else if($_GET['module']=="viewreservation")
	          include_once("view_reservation.php");
		  else if($_GET['module']=="house_keeping")
	          include_once("house_keeping.php");
          else if($_GET['module']=="kot")
	          include_once("kot.php");
         else if($_GET['module']=="admin"&&$g->AdminPanel==1)
	          include_once("admin.php");
	     else if($_GET['module']=="inventory"&&$g->AdminPanel==1)
	          include_once("inventory.php");
         else if($_GET['module']=="bills")
	          include_once("displaybill.php");
	     else if($_GET['module']=="stockin")
	          include_once("stockin.php");
	     else if($_GET['module']=="roomreports")
	          include_once("roomreports.php");
	     else if($_GET['module']=="stockout")
	          include_once("stockout.php");        
         else if($_GET['module']=="stockdisplay")
	          include_once("stockdisplay.php");        
         else
              include_once("under_construction.php");
		  ?> 
		                       </div>
		                        <div id='messagepanel' style='z-index:20;width:15%;float:left;border:1px solid cyan;'>
		                           	 
		                       </div>

                      </div> <!--// End inner -->
            </div> <!--// End content --> 

<div class="clear"></div>

<?php include_once("includes/footer.php");?>
<script type="text/javascript" src='js/membership.js'></script>
</body>
</html>