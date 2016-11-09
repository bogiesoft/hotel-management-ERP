<?php
include_once("../config.inc.php");
include_once("../functions/functions.php");
include_once("../includes/db.inc.php");
include_once("../includes/page.inc.php");

######  GET THE QUERY STRING 
$qryString = $_REQUEST['module'];
$errorMsg = "";

######## TO ACTIVATE
if( $_REQUEST['task'] == "active" && preg_match("/^([0-9]+)$/", $_REQUEST['id'], $reg) ) {
	$qry = " update ".PAYMODE." set is_active='1' where id=".$_REQUEST['id'];
	$db->query( $qry );
	$errorMsg = "<div align='center' class='message'>Record activated successfully!</div>";
}

######## TO DE-ACTIVATE
if( $_REQUEST['task'] == "deactive" && preg_match("/^([0-9]+)$/", $_REQUEST['id'], $reg) ) {
	$qry = " update ".PAYMODE." set is_active='0' where id=".$_REQUEST['id'];
	$db->query( $qry );
	$errorMsg = "<div align='center' class='message'>Record de-activated successfully!</div>";
}

######## TO DELETE SINGLE RECORD
if( $_REQUEST['task'] == "delete_single" && preg_match("/^([0-9]+)$/", $_REQUEST['id'], $reg) ) {
    $qry = " delete from ".PAYMODE." where id=".$_REQUEST['id'];
	$db->query( $qry );
	$errorMsg = "<div align='center' class='message'>Record deleted successfully!</div>";
}

######## TO DELETE MULTIPLE RECORDS
if( $_REQUEST['task'] == "delete" ) {
	$qry = " delete from ".PAYMODE." where id in(".@implode(",", $_POST['chk']).")";
	$db->query( $qry );
	$errorMsg = "<div align='center' class='message'>Records deleted successfully!</div>";
}



############# INSERT RECORDS HERE

if( $_POST['submit'] == "Submit" ) {

 	$updateArr = array(
		

			"payment_mode"             =>  putData( $_POST['payment_mode'] )
			);
			
	 $whereClause = "id=".$_REQUEST['id'];
	 updateData($updateArr, PAYMODE,  $whereClause );
	redirect("membership.php?module=master_pay_mode");
}
//print_r($insertArr);	 
	 ######## DISPLAY RECORD #############
$qry = " select * from ".PAYMODE."  where id='".$_GET['id']."'";
$db->query( $qry );
if( $db->numRows() > 0 ) {
	$data = $db->fetchArray();
}
	 ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="95%"  cellpadding="0" cellspacing="0"  border="0">
<tr bgcolor="#FFFFFF" >
<td height="25" valign="middle" align="left" class="blue12">&nbsp;&nbsp;&nbsp;Edit Payment Mode</td>
</tr>
<tr><td>
<?php if($_GET['msg']==1){ echo $eerorMsg = "<div align='center' class='message'>Record Inserted successfully!</div>"; } ?>	
<form name="addfrmMember" action="" method="post">
   
<table border="0" cellpadding="0" cellspacing="0" align="center" width="80%" class="table-border">
<tr>
<td>
		 
		  <table width="100%"  cellpadding="6" cellspacing="3"  border="0">
		  <tr>
		    <td  align="center" class="td_heading" colspan="3">Payment Mode Information</td></tr>
  		  <tr bgcolor="#FFFFFF"></tr>
		   <TR>
  		   <td width="44%"  align="left" class="td_row_padding">&nbsp;</td>
 		   <td  align="left" class="td_row" width="56%">&nbsp;</td>
		  </TR>
							
		  <tr>
		    <td  align="left" class="td_row_padding" >&nbsp;Payment Mode&nbsp;<font color="#FF0000">*</font></td>
		    <td  align="left" class="td_row" colspan="2">&nbsp;<input type="text" name="payment_mode" value="<?php echo $data['payment_mode'];?>" class="text" required="required"> </td>
		    </tr>

		  <tr>
		    <td  align="left" class="td_row_padding"></td>
		    <td  align="left" class="td_row" colspan="2">&nbsp;<input type="submit" name="submit" value="Submit" class="button">&nbsp;
		      <input type="reset" name="reset" value="Reset" class="button">		  </td>
		    </tr>
          <tr>
		  <td  align="left" class="td_row_padding">&nbsp;</td>
 		  <td  align="left" class="td_row" colspan="2">&nbsp;</td>
		  </tr>
          
		 </table>
</td>
</tr>
</table>
</form>
</td></tr></table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="blue12">&nbsp;</td>

  </tr>
  <tr>
    <td class="blue12">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


<script language="javascript">

// check all the check boxes
function checkAll( frm, chkAllV ) {

	for( var i=0; i<frm.elements.length; i++ ) {
		if( frm.elements[i].name == "chk[]")		
				frm.elements[i].checked = chkAllV;	
	}
	
}

// delete confirmation
function confirmDelete( user_id ) {
	if( confirm("Are you sure to delete this Record?") ) {
			document.frmMember.task.value = "delete_single";	
			document.frmMember.action = "?module="+document.frmMember.qryString.value+"&id="+user_id;
			document.frmMember.submit();
		}
}

// delete confirmation
function DeleteMore( user_id ) {
	if ( isChecked() ) {
		if( confirm("Are you sure to delete this Record?") ) {
			document.frmMember.task.value = "delete";	
			document.frmMember.action = "?module="+document.frmMember.qryString.value;
			document.frmMember.submit();
		}
	} else {
		alert("Please select the check boxes to delete the records!");
	}
}

function isChecked() {
	var flag = false;	
	for( var i=0; i<document.frmMember.elements.length; i++ ) {
		if( document.frmMember.elements[i].name == "chk[]" && document.frmMember.elements[i].checked ) {		
				flag = true;
				break;
		}
	}
	return flag;
}
</script>



