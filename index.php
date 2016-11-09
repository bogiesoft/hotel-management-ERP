<?php
if (isset($_COOKIE["remember_me"]))
  $cookval =  $_COOKIE["remember_me"];
else
  $cookval="";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include_once("includes/admintitle.php");?></title>
<link href="css/zice.style.css" rel="stylesheet" type="text/css" />
<link href="css/icon.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="components/tipsy/tipsy.css" media="all"/>

<style type="text/css">
html {
	background-image: none;
}
#versionBar {
  
	background-color:#212121;
	position:fixed;
	width:100%;
	height:35px;
	bottom:0;
	left:0;
	text-align:center;
	line-height:35px;
}
.copyright{
	text-align:center; font-size:10px; color:#CCC;
}
.copyright a{
	color:#A31F1A; text-decoration:none
}    
</style>
</head>

<body>
<div id="alertMessage" class="error"></div>
<div id="successLogin"></div>
<div class="text_success"><img src="images/loadder/loader_green.gif"  alt="ziceAdmin" /><span>Please wait</span></div>

<div id="login" >
  <div class="ribbon"></div>
  <div class="inner">
  <div  class="logo" ><img src="images/logo/logo_login.png" alt="ziceAdmin" /></div>
  <div class="userbox"></div>
  <div class="formLogin">
   <form name="formLogin"  id="formLogin" action="#">
          <div class="tip">
          <input name="username" type="text"  id="username_id"  title="Username"  value="<?php echo $cookval; ?>"  />
          </div>
          <div class="tip">
          <input name="password" type="password" id="password"   title="Password"  />
          </div>
          <div style="padding:20px 0px 0px 0px ;">
            <div style="float:left; padding:0px 0px 2px 0px ;">
           <input type="checkbox" id="on_off" name="remember" class="on_off_checkbox"  value="1"  <?php if(isset($_COOKIE['remember_me'])) {
		echo 'checked="checked"';
	}else {
		echo '';
	}
	?>  />
              <span class="f_help">Remember me</span>
              </div>
          <div style="float:right;padding:2px 0px ;">
              <div> 
                <ul class="uibutton-group">
                   <li><a class="uibutton normal" href="#"  id="but_login" >Login</a></li>
				   <li><a class="uibutton  normal" href="#" id="forgetpass">forpassword</a></li>
               </ul>
              </div>
            </div>
</div>

    </form>
  </div>
</div>
  <div class="clear"></div>
  <div class="shadow"></div>
</div>

<!--Login div-->
<div class="clear"></div>
<?php include_once("includes/footer.php");?>
<!-- Link JScript-->

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="components/effect/jquery-jrumble.js"></script>
<script type="text/javascript" src="components/ui/jquery.ui.min.js"></script>     
<script type="text/javascript" src="components/tipsy/jquery.tipsy.js"></script>
<script type="text/javascript" src="components/checkboxes/iphone.check.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</body>
</html>