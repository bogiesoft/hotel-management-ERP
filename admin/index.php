<?php
##########################################################
#####     CREATED BY   : Gautam Kumar				######
#####	  CREATION DATE: 24 June, 2014				######
#####     CODE BRIEFING: Admin Login Page			######
#####												######
#####     COMPANY	   : Ideliversolutions. 		######
#####												######
##########################################################

session_start();
include_once("../config.inc.php");
include_once("../functions/functions.php");
include_once("../includes/db.inc.php");


if( $_POST['login'] == "Submit" ) {
	$errMsg = "";
	
	######### LOGIN VALIDATION ###############
	$qry = "select * from ".ADMIN. " where username='".putData( $_POST['username'] )."' and password='".putData( $_POST['password'] )."'" ;
    $db->query( $qry );
	if( $db->numRows() > 0 ) {
		$data = $db->fetchArray();
		
		$_SESSION['admin_user']['id'] = $data['id'];
		$_SESSION['admin_user']['name'] = $data['username'];
		redirect("home.php"); #### PRESENT IN functions.inc.php
	}
	
	$errMsg = "<span class='message'>Invalid login. Try again!</span>";
}

?>
<html>
<head><title><?php include_once("includes/admintitle.php");?>: Administrative Section</title>
<link href="css/style_login.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<div id="head-div">&nbsp;</div>
<div id="menu_header" style="margin-top:70px;">
<h1 style="color:#000 !important;" align="center">Admin Login</h1>
</div>
<div id="content2">
<div align="center">

<?php if(isset($_SESSION['MSG']) && $_SESSION['MSG']!="") { echo '<div class="alert">'.$_SESSION['MSG'].'</div>';} ?>

<span id="status" class="custom-error"></span>
<form name="frmlogin" action="" method="post">
<span style="color:#CC0000;"><strong><?php echo $errMsg; ?></strong></span>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" style="margin-top:25px;">
  <tr>
    <th align="left"> <span style="font-size:12px;">Username</span></th>
  </tr>
  <tr>
    <td width="221"><input name="username" id="username" placeholder="Email..." type="text" size="20" maxlength="50"  class="inputtext" style="width:240px; height:24px;" required /></td>
  </tr>

  <tr>
    <th align="left"><span style="font-size:12px;">Password</span></th>
  </tr>
  <tr>
    <td><input name="password" type="password" id="password" style="width:240px; height:24px;" placeholder="Password" size="20" maxlength="50" class="inputtext" required /></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">

	
	<input type="submit" name="login" value="Submit" class="button_exampless"  style="padding: 5px 30px; cursor:pointer;" />
    &nbsp;<input type="reset" name="reset" value="Reset" class="button_exampless" style="padding: 5px 30px; cursor:pointer;">
	</td>
  </tr>
</table>
</form>


</div>
</div>
        
       
     </td>
  </tr>
</table>
<br />
<br /><br /><br /><br /><br /><br /><br /><br /><br />
<div id="foot-div" style="margin-top:4px;"><?php  include_once("includes/footer.php"); ?></div>

</body>
</html>
