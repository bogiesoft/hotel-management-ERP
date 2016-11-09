<?php
###################################################################
#####     CREATED BY   : Ankur Agarwal 			             ######
#####	  CREATION DATE: 07 Nov 2006	    	             ######
#####     CODE BRIEFING: Listing of Category		   		 ######
#####											             ######
#####     COMPANY	   : Divya InfoSoft India Pvt Ltd.	     ######
#####											             ######
###################################################################


include_once("session.php");
include_once("../config.inc.php");
include_once("../functions/functions.php");
include_once("../includes/db.inc.php");
include_once("../includes/page.inc.php");

######  GET THE QUERY STRING 
$qryString = $_REQUEST['module'];
$errorMsg = "";

######## TO ACTIVATE
if( $_REQUEST['task'] == "active" && preg_match("/^([0-9]+)$/", $_REQUEST['id'], $reg) ) {
	$qry = " update ".CATEGORY." set is_active='1' where id=".$_REQUEST['id'];
	$db->query( $qry );
	$errorMsg = "<div align='center' class='message'>Record activated successfully!</div>";
}

######## TO DE-ACTIVATE
if( $_REQUEST['task'] == "deactive" && preg_match("/^([0-9]+)$/", $_REQUEST['id'], $reg) ) {
	$qry = " update ".CATEGORY." set is_active='0' where id=".$_REQUEST['id'];
	$db->query( $qry );
	$errorMsg = "<div align='center' class='message'>Record de-activated successfully!</div>";
}

######## TO DELETE SINGLE RECORD
if( $_REQUEST['task'] == "delete_single" && preg_match("/^([0-9]+)$/", $_REQUEST['id'], $reg) ) {
    $qry = " delete from ".CATEGORY." where id=".$_REQUEST['id'];
	$db->query( $qry );
	$errorMsg = "<div align='center' class='message'>Record deleted successfully!</div>";
}

######## TO DELETE MULTIPLE RECORDS
if( $_REQUEST['task'] == "delete" ) {
	$qry = " delete from ".CATEGORY." where id in(".@implode(",", $_POST['chk']).")";
	$db->query( $qry );
	$errorMsg = "<div align='center' class='message'>Records deleted successfully!</div>";
}

######### FETCH RECORD FROM CATEGORY TABLE
$qry = " select id, cat_name, cat_link, is_active from ".CATEGORY;
/*if( $_REQUEST['module'] == "CATEGORY_listing" ) {
	$headingName = "CATEGORYs Listing";
	//$qry .= " where user_type='i' ";
}*/
//if( $_REQUEST['module'] == "CATEGORY_listing" ) {
	$headingName = "Category Listing";
	//$qry .= " where user_type='b' ";
//}
?>
<form name="frmMember" action="" method="post">
<table width="95%"  cellpadding="0" cellspacing="0"  border="0">
<tr bgcolor="#FFFFFF" >
<td valign="middle" align="left" class="blue12"><?php echo $headingName; ?><?php echo $errorMsg; ?></td>
</tr>
<tr><td>
	<table border="0" cellpadding="0" cellspacing="0" align="center" width="65%" >
	<tr>
<td align="left" width="25%">
<input type="button" name="deleteAll" value="Delete" class="button" onClick="DeleteMore();">

<input type="hidden" name="task" value="">
                              
<input type="hidden" name="qryString" value="<?php echo $qryString;?>"></td>
<td align="right" width="25%"><a href="membership.php?module=add_category">Add New Category</a></td>
</tr>
<tr>
<td colspan="2" bgcolor="#10147E">
		  <table width="100%"  cellpadding="1" cellspacing="1"  border="0">
		  <tr>
		  <td  align="center" class="td_heading"><input type="checkbox" name="chkAll" onclick="checkAll(document.frmMember, this.checked);"></td>
		  <td  align="left" class="td_heading">&nbsp;Category Name </td>
		  <td  align="left" class="td_heading">&nbsp;Category Link </td>
		  <td  align="center" class="td_heading">&nbsp;Action </td>
		  </tr>
		  <?php
		   //$qry .= " order by dob"; 
		   $db->query( $qry );
		   $page = new Page();
		   $page->set_page_data('', $db->numRows(), 5, 0, true, false, false);
		   $page->set_qry_string( "module=".$qryString );
		   $qry = $page->get_limit_query($qry);
		   $db->query( $qry );
		   if( $db->numRows() > 0 ) {
		    	while( $data = $db->fetchArray() ) {
					$indOrbus = 'edit_cat';
					########### USED FOR ACTIVATE AND DEACTIVATE
					$image = "b_drop.png";
					$imageTitle = "Make Activate";
					$oprType = "task=active";
					if( $data['is_active'] == "1" ) {
						$image = "ok.gif";
						$imageTitle = "Make De-activate";
						$oprType = "task=deactive";
					}

		  ?>
		  <tr>
		  <td  align="center" class="td_row"><input type="checkbox" name="chk[]" value="<?php echo $data['id']; ?>"></td>
		  <td  align="left" class="td_row">&nbsp;<?php echo $data['cat_name'];?></td>
		  <td  align="left" class="td_row">&nbsp;<?php echo $data['cat_link'];?></td>
		  		   
		  <td  align="center" class="td_row">&nbsp;<a href="membership.php?module=<?php echo $indOrbus; ?>&id=<?php echo $data['id'];?>"><img src="images/b_edit.png" border="0" alt="Edit" title="Edit"></a>&nbsp;<a href="#" onclick="return confirmDelete(<?php echo $data['id'];?>);"><img src="images/delete.gif" border="0"  title="Delete"></a>&nbsp;
		  <a  href="membership.php?module=<?php echo $qryString; ?>&id=<?php echo $data['id'];?>&<?php echo $oprType; ?>"><img src="images/<?php echo $image; ?>" border="0" title="<?php echo $imageTitle; ?>"></a>		   </td>
		  </tr>
		 <?php } ## END OF WHILE?>	
		  <tr height="20" bgcolor="White">
		  <td  class="tableborder" align="right" colspan="9"><span class="Heading">&nbsp;<?php $page->get_page_nav(); ?></span>&nbsp;</td>
		  </tr>
		  <?php } ## END OF IF STATEMENT 
			else {
		  ?>	
		 <tr bgcolor='White'><td colspan='9' class='message' align='center'>NO RECORD FOUND!!!</td></tr>
		 <?php } #### END OF ELSE  ?>
		 </table></td>
</tr>
</table>
</form>
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
}</script>