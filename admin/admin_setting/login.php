<?php
##########################################################
#####     CREATED BY   : Nitin Kumar   			    ######
#####	  CREATION DATE: 17 Aug 2006	    	    ######
#####     CODE BRIEFING: login details change	    ######
#####											    ######
#####     COMPANY	   : Chetu India Pvt Ltd.	    ######
#####											    ######
##########################################################
include_once("session.php");
include_once("../config.inc.php");
include_once("../functions/functions.php");
include_once("../includes/db.inc.php");
include_once("../includes/page.inc.php");


######### UPDATE THE RECORDS 
if( $_POST['submit'] == "Update" ) {

	$updateArr = array(	"username"		  =>  putData( $_POST['userName'] ),
					    "password"		  =>  putData( $_POST['pwd'] ),
					    "email"	          =>  putData( $_POST['email'] )
					  );

	  $whereClause = " id = '".$_SESSION['admin_user']['id']."' ";
	  updateData($updateArr, ADMIN, $whereClause);
	 $eerorMsg = "<div align='center' class='message'>Record updated successfully!</div>";
}

######## DISPLAY RECORD #############
$qry = "select * from ".ADMIN. " where id='".$_SESSION['admin_user']['id']."'" ;
$db->query( $qry );
if( $db->numRows() > 0 ) {
	$data = $db->fetchArray();
	$_SESSION['admin_user']['name'] = $data['username']; ###### get the updated user name
}
?>
<form name="frmMember" action="" method="post" onSubmit="return validate(this);">
<table width="95%"  cellpadding="0" cellspacing="0"  border="0">
<tr bgcolor="#FFFFFF" >
<td height="25" valign="middle" align="left" class="blue12">Admin Login Settings</td>
</tr>
<tr><td>
<?php echo $eerorMsg; ?>	   
<table border="0" cellpadding="0" cellspacing="0" align="center" width="60%" class="table-border">
<tr>
<td>
		 
		  <table width="100%"  cellpadding="3" cellspacing="1"  border="0">
		  <tr><td  align="center" class="td_heading" colspan="2">Admin Settings</td></tr>
  		  <tr bgcolor="#FFFFFF"><td  align="center" colspan="2">&nbsp;</td></tr>
		  <tr>
		  <td  align="left" class="td_row_padding" width="40%">&nbsp;Username </td>
 		  <td  align="left" class="td_row">&nbsp;<input type="text" name="userName" value="<?php echo useHTMLEntities( $data['username'] );?>" class="text"> </td>
		  </tr>
		  <tr>
		  <td  align="left" class="td_row_padding">&nbsp;Password </td>
 		  <td  align="left" class="td_row">&nbsp;<input type="password" name="pwd" value="<?php echo useHTMLEntities( $data['password'] );?>" class="text"> </td>
		  </tr>
		  <tr>
		  <td  align="left" class="td_row_padding">&nbsp;Confirm Password </td>
 		  <td  align="left" class="td_row">&nbsp;<input type="password" name="conPwd" value="<?php echo useHTMLEntities( $data['password'] );?>" class="text"> </td>
		  </tr>
		  <tr>
		  <td  align="left" class="td_row_padding">&nbsp;Email Address </td>
 		  <td  align="left" class="td_row">&nbsp;<input type="text" name="email" value="<?php echo $data['email'];?>" class="text"> </td>
		  </tr>
		  <tr>
		  <td  align="left" class="td_row_padding"></td>
 		  <td  align="left" class="td_row">&nbsp;<input type="submit" name="submit" value="Update" class="button">&nbsp;
		  <input type="reset" name="reset" value="Reset" class="button">
		  </td>
		  </tr>
		 </table>
</td>
</tr>
</table></form>
<SCRIPT LANGUAGE="JavaScript" src="../javascript/validation.js"></SCRIPT>
<script language="javascript">
function validate(frm) {
	

	if( trim(frm.userName.value) == "" ) {
		alert("Username should not be blank!");
		frm.userName.focus();
		return false;
	} else 	if( trim(frm.pwd.value) == "" ) {
		alert("Password should not be blank!");
		frm.pwd.focus();
		return false;
	} else 	if( trim(frm.conPwd.value) == "" ) {
		alert("Confirm Password should not be blank!");
		frm.conPwd.focus();
		return false;
	} else if( trim(frm.pwd.value) != trim(frm.conPwd.value)  ) {
		alert("Password mismatched!");
		frm.conPwd.focus();
		return false;
	} else if(! is_email( trim(frm.email.value) ) ) {
		alert("Email Address should be in valid format!");
		frm.email.focus();
		return false;
	}



return true;
}
</script>