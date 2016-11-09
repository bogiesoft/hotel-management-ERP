<?php
include_once("../config.inc.php");
include_once("../functions/functions.php");
include_once("../includes/db.inc.php");
include_once("../includes/page.inc.php");

######  GET THE QUERY STRING 
$qryString = $_REQUEST['module'];
$errorMsg = "";

#
############# INSERT RECORDS HERE

if( $_POST['sumit'] == "Update" ) {
	
$facilitychk1 = $_POST['facilitychk'];

$facilitychk = implode(",",$facilitychk1);

$date=date("Y-M-d"); 


	
	$updateArr = array(
		

			"room_type"	     	 =>  putData( $_POST['room_type'] ),
			"room_name"	      	 =>  putData( $_POST['room_name'] ),
			"room_volume"	 	 =>  putData( $_POST['room_volume'] ),
			"room_name"	     	 =>  putData( $_POST['room_no'] ),
			"room_facilities"	 =>  putData( $facilitychk ),			
			"description"	 	 =>  putData( $_POST['description'] ),
			"default_occupancy"	 =>  putData( $_POST['default_occupancy'] ),
			"max_occupancy"	     =>  putData( $_POST['max_occupancy'] ),
			"floor"	      		 =>  putData( $_POST['floor'] )
			
			);
			
	 $whereClause = "id=".$_REQUEST['id'];
	 updateData($updateArr, ROOMS,  $whereClause );

	 redirect("membership.php?module=master_room_listing&msg=2");
	 
	

	 }
//print_r($insertArr);	 
	 ######## DISPLAY RECORD #############
$qry = " select * from ".ROOMS." where id='".trim($_GET['id'])."'";
$db->query( $qry );
if( $db->numRows() > 0 ) {
	$data = $db->fetchArray();
}
	 ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="95%"  cellpadding="0" cellspacing="0"  border="0">
<tr bgcolor="#FFFFFF" >
<td height="25" valign="middle" align="left" class="blue12">&nbsp;&nbsp;&nbsp;Edit  Room  </td>
</tr>
<tr><td>
<?php if($_GET['msg']==1){ echo $eerorMsg = "<div align='center' class='message'>Record Updated successfully!</div>"; } ?>	

<form name="addfrmMember" action="" method="post">
   
<table border="0" cellpadding="0" cellspacing="0" align="center" width="80%" class="table-border">
<tr>
<td>
		 
		  <table width="100%"  cellpadding="6" cellspacing="3"  border="0">
		  <tr>
		    <td  align="center" class="td_heading" colspan="3">Room  Information</td></tr>
  		  <TR>
  		    <td width="44%"  align="left" class="td_row_padding">&nbsp;</td>
  		    <td  align="left" class="td_row" width="56%">&nbsp;</td>
		    </TR>
							
		  <tr>
		    <td  align="left" class="td_row_padding" >&nbsp;Room Number. &nbsp;<font color="#FF0000">*</font></td>
		    <td  align="left" class="td_row" colspan="2"><input type="text" name="room_no" disabled value="<?php echo $data['room_no']?>"  class="text" required> </td>
		    </tr>

		  <tr>
		    <td  align="left" class="td_row_padding">Room Acronyms</td>
		    <td  align="left" class="td_row" colspan="2"><input type="text" name="room_name" value="<?php echo $data['room_name']?>"  class="text"></td>
		    </tr>
		  <tr>
		    <td  align="left" class="td_row_padding">Room Type</td>
		    <td  align="left" class="td_row" colspan="2"><select name="room_type" class="text">
            <?php
				$rt = "select * from master_room_type";
				$rt1=mysql_query($rt);
				while($rt2 = mysql_fetch_array($rt1)){
					if($data['room_type']==$rt2['room_type']){ $slced='selected'; }else{ $slced=''; }
			?>
            <option value="<?php echo $rt2['room_type']?>" <?php echo $slced;?>><?php echo $rt2['room_type']?></option>
			<?php } ?>
            	</select></td>
		    </tr>
		  <tr>
		    <td  align="left" class="td_row_padding">Single / Double Room</td>
		    <td  align="left" class="td_row" colspan="2"><select name="room_volume" class="text">
		      <?php  if($data['room_volume']=='Single'){ $slced1='selected'; }else{ $slced2='selected'; } ?>
              <option value="Single" <?php echo $slced1;?>>Single</option>
		      <option value="Double" <?php echo $slced2;?>>Double</option>
		      </select></td>
		    </tr>
		  <tr>
		    <td  align="left" class="td_row_padding">Room Facilities</td>
		    <td colspan="2"  align="left" valign="top" class=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td align="left" style="line-height:30px;">
		          <?php 
				  	$roomf = explode(",",$data['room_facilities']);
					$serf = "select * from master_room_facilities order by id desc";
					$serf1=mysql_query($serf);
					while($serf1data = mysql_fetch_array($serf1)){
						
				  
						 if(in_array($serf1data['facility'], $roomf)){ $chkval = 'checked';}else{ $chkval = '';}
						
				?><input type="checkbox" name="facilitychk[]"  <?php echo $chkval;?> value="<?php echo $serf1data['facility'];?>" /><?php echo $serf1data['facility'];?>
		        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?php } ?>
		          </td>
		        </tr>
		      </table></td>
		    </tr>
		  <tr>
		    <td  align="left" class="td_row_padding">Description</td>
		    <td  align="left" class="td_row" colspan="2"><textarea name="description" class="text" style="width:200px; height:50px;"><?php echo $data['description']?></textarea></td>
		    </tr>
		  <tr>
		    <td  align="left" class="td_row_padding">Default Occupancy</td>
		    <td  align="left" class="td_row" colspan="2"><input type="text" name="default_occupancy" style="width:50px;" value="<?php echo $data['default_occupancy']?>"  class="text"></td>
		    </tr>
		  <tr>
		    <td  align="left" class="td_row_padding">Maximum Occupancy</td>
		    <td  align="left" class="td_row" colspan="2"><input type="text" name="max_occupancy"   style="width:50px;" value="<?php echo $data['max_occupancy']?>" class="text" ></td>
		    </tr>
		  <tr>
		    <td  align="left" class="td_row_padding">Room at which Floor</td>
		    <td  align="left" class="td_row" colspan="2"><select name="floor" class="text">
		      <?php
			  	for($f=1;$f<=25;$f++){
					if($data['floor']==$f){ $sele = 'selected'; }else{ $sele = ''; }
			  ?>
              <option value="<?php echo $f;?>" <?php echo $sele;?> ><?php echo $f;?>&nbsp;Floor</option>
		      <?php }?>
		      </select></td>
		    </tr>
		  <tr>
		    <td  align="left" class="td_row_padding"></td>
		    <td  align="left" class="td_row" colspan="2">&nbsp;</td>
		    </tr>
		  <tr>
		    <td  align="left" class="td_row_padding"></td>
		    <td  align="left" class="td_row" colspan="2">&nbsp;<input type="submit" name="sumit" value="Update" class="button">&nbsp;
		      <input type="reset" name="reset" value="Reset" class="button"><input type="hidden" name="id" value="<?php echo $_GET['id'];?>">		  </td>
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



