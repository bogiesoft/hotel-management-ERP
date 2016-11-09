<?php
##################################################################
#####     CREATED BY   : Ankur Agarwal 			            ######
#####	  CREATION DATE: 31 July 2006	    	            ######
#####     CODE BRIEFING: edit individual		            ######
#####					 membership		        		    ######
#####     COMPANY	   : Divya InfoSoft India Pvt Ltd.	    ######
#####											            ######
##################################################################

include_once("session.php");
include_once("../config.inc.php");
include_once("../functions/functions.php");
include_once("../includes/db.inc.php");
include_once("../includes/page.inc.php");
include_once("../includes/upload.inc.php");

######### UPDATE THE RECORDS 

if( $_POST['submit'] == "Update" ) {

 	$updateArr = array(
		
			"cat_name"	          =>  putData( $_POST['CategoryName'] ),
			"cat_link"             =>  putData( $_POST['CategoryLink'] ),
			);
			
	 $whereClause = "id=".$_REQUEST['id'];
	 updateData($updateArr, CATEGORY,  $whereClause );
	$eerorMsg = "<div align='center' class='message'>Record updated successfully!</div>";
}

######## DISPLAY RECORD #############
$qry = " select * from ".CATEGORY." where id=".$_REQUEST['id'];
$db->query( $qry );
if( $db->numRows() > 0 ) {
	$data = $db->fetchArray();
	//echo $data['photo'];
}

?>

<form name="frmMember" action="" method="post" onSubmit="return validate(this);" >
<table width="95%"  cellpadding="0" cellspacing="0"  border="0">
<tr bgcolor="#FFFFFF" >
<td height="25" valign="middle" align="left" class="blue12">Edit Category Record </td>
</tr>
<tr><td>
<?php echo $eerorMsg; ?>	   
<table border="0" cellpadding="0" cellspacing="0" align="center" width="80%" class="table-border">
<tr>
<td >
		 
		  <table width="100%"  cellpadding="1" cellspacing="1"  border="0">
		  <tr><td  align="center" class="td_heading" colspan="3">Category Information</td></tr>
  		  <tr bgcolor="#FFFFFF"><td  align="center" colspan="3">&nbsp;</td></tr>
		  <tr>
		  <td width="42%"  align="left" class="td_row_padding" >&nbsp;Category Name&nbsp;<font color="#FF0000">*</font></td>
 		  <td width="58%" colspan="2"  align="left" class="td_row">&nbsp;<input type="text" name="CategoryName" value="<?php echo useHTMLEntities( $data['cat_name'] );?>" class="text" /></td>
		  </tr>

		  <tr>
		  <td  align="left" class="td_row_padding">&nbsp;Category Link&nbsp;<font color="#FF0000">*</font></td>
 		  <td  align="left" class="td_row" colspan="2">&nbsp;<?php echo createComboBox($catlink, "CategoryLink", $data['cat_link'], " class='combotext' ");?> </td>
		  </tr>

		  <tr>
		  <td  align="left" class="td_row_padding"></td>
 		  <td  align="left" class="td_row" colspan="2">&nbsp;<input type="submit" name="submit" value="Update" class="button">&nbsp;
		  <input type="reset" name="reset" value="Reset" class="button"></td>
		  </tr>
		 </table>
</td>
</tr>
</table></td></tr></table></form>

<SCRIPT LANGUAGE="JavaScript" src="../../javascript/validation.js"></SCRIPT>
<script language="javascript">
function validate(frm) {
	
    
	if( trim(frm.CategoryName.value) == "" ) {
		alert("Category Name should not be blank!");
		frm.CategoryName.focus();
		return false;
	} else 	if( trim(frm.CategoryLink.value) == "" ) {
		alert("Category Link should not be blank!");
		frm.CategoryLink.focus();
		return false;
	} 
return true;
}

</script>