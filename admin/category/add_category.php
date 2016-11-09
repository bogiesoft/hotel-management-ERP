<?ph
include_once("../config.inc.php");
include_once("../functions/functions.php");
include_once("../includes/db.inc.php");
include_once("../includes/page.inc.php");


############# INSERT RECORDS HERE

if( $_POST['submit'] == "Submit" ) {

$date=date("Y-M-d"); 

$insertArr = array(
		
			"cat_name"	      =>  putData( $_POST['CategoryName'] ),
			"cat_link"        =>  putData( $_POST['CategoryLink'] ),
			);
			
	        $last_insert_id = insertData($insertArr, CATEGORY);
			$eerorMsg = "<div align='center' class='message'>Record Inserted successfully!</div>";
	 }
//print_r($insertArr);	 
	 ######## DISPLAY RECORD #############
$qry = " select * from ".CATEGORY." where id= $last_insert_id";
$db->query( $qry );
if( $db->numRows() > 0 ) {
	$data = $db->fetchArray();
}
	 ?>

<form name="frmMember" action="" method="post" onSubmit="return validate(this);">
<table width="95%"  cellpadding="0" cellspacing="0"  border="0">
<tr bgcolor="#FFFFFF" >
<td height="25" valign="middle" align="left" class="blue12">Add New Category </td>
</tr>
<tr><td>
<?php echo $eerorMsg; ?>	   
<table border="0" cellpadding="0" cellspacing="0" align="center" width="80%" class="table-border">
<tr>
<td>
		 
		  <table width="100%"  cellpadding="1" cellspacing="1"  border="0">
		  <tr><td  align="center" class="td_heading" colspan="3">Category Information</td></tr>
  		  <tr bgcolor="#FFFFFF"></tr>
		   <TR>
  		   <td width="44%"  align="left" class="td_row_padding">&nbsp;</td>
 		   <td  align="left" class="td_row" width="56%">&nbsp;</td>
		  </TR>
							
		  <tr>
		  <td  align="left" class="td_row_padding" >&nbsp;Category Name&nbsp;<font color="#FF0000">*</font></td>
 		  <td  align="left" class="td_row" colspan="2">&nbsp;<input type="text" name="CategoryName" value="<?php echo useHTMLEntities( $data['cat_name'] );?>" class="text"> </td>
		  </tr>

		  <tr>
		  <td  align="left" class="td_row_padding">&nbsp;Category Link&nbsp;<font color="#FF0000">*</font></td>
 		  <td  align="left" class="td_row" colspan="2">&nbsp;<?php echo createComboBox($catlink, "CategoryLink", $data['cat_link'], " class='combotext' ");?> </td>
		  </tr>

		  <tr>
		  <td  align="left" class="td_row_padding"></td>
 		  <td  align="left" class="td_row" colspan="2">&nbsp;<input type="submit" name="submit" value="Submit" class="button">&nbsp;
		  <input type="reset" name="reset" value="Reset" class="button">		  </td>
		  </tr>
		 </table>
</td>
</tr>
</table></form>
<SCRIPT LANGUAGE="JavaScript" src="../javascript/validation.js"></SCRIPT>
<script language="javascript">
function validate(frm) {
	
    
	if( trim(frm.CategoryName.value) == "" ) {
		alert("Category Name should not be blank!");
		frm.CategoryName.value="";
		frm.CategoryName.focus();
		return false;
	} else 	if( trim(frm.CategoryLink.value) == "" ) {
		alert("Category Link should not be blank!");
		frm.CategoryLink.value="";
		frm.CategoryLink.focus();
		return false;
	} 
return true;
}

</SCRIPT>
