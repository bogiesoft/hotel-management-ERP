<?php
include_once"functions/functions.php";
$randval =  randomval();
?>
<script>
$(document).ready(function(){		
				
				$('.del').live('click',function(){
					$(this).parent().parent().remove();
				});
				var counter = 1;
				$('.add').live('click',function(){
					$(this).val('Delete');
					$(this).attr('class','del');
					counter++;
					var appendTxt = "<tr>			  <td width='3%'>"+counter+"</td>			  <td width='25%'><select name='room_type_box_one[]'><?php 
		$rt="select * from master_room_type";
		$rt1 = mysql_query($rt);
		while($rt21 = mysql_fetch_array($rt1)){
	?>			    <option><?php echo $rt21['room_type']?></option>	 <?php } ?></select></td>			  <td width='19%'><select name='room_number_box[]'>			      <option>101</option>			      <option>102</option>			      </select></td>			  <td width='23%'><table width='100%' border='0' cellspacing='0' cellpadding='0'>			    <tr>			      <td width='13%'><label>Adult</label></td>			      <td width='18%'><select name='adult_box'> <?php for($c=0;$c<=10;$c++){ ?><option><?php echo $c;?></option><?php } ?></select></td>			      <td width='13%'><label>Child</label></td>			      <td width='56%'><select name='child_box'> <?php for($c=0;$c<=10;$c++){ ?><option><?php echo $c;?></option><?php } ?> </select></td>			      </tr>			    </table></td>			  <td width='18%'><input type='text'   name='guest_name_box[]' /></td>			  <td width='12%'><input type='button' class='add' value='Add More' /></td>			  </tr><tr><td colspan='10'>&nbsp;</td></tr>";
					$("tr:last").after(appendTxt);			
				});        
			});
</script>
 <script src="js/bootstrap-modal.js"></script>  
 <link href="css/bootstrap.css" rel="stylesheet"> 
<style>
.roomcls{font-size: 1.2em;
font-weight: bold;
color: green;
position: relative;
width: 590px;
height: 30px;
left: 0px;
top: 0px;
text-decoration:underline;
}
</style>

<script>
	$(document).on('click', 'button.removebutton', function () {
    // alert("aa");
     $(this).closest('tr').remove();
     return false;
 });

</script>

  
<form name="regfrm" action="" method="post" id='regfrm2'>
<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td width="34%" valign="top"><div class="onecolumn" style="width:380px; margin-right:10px;height:500px;" >
  <div class="header"> <span ><span class="ico gray home"></span> Guest Information</span></div>
  <div class="clear"></div>
  <div class="content" >
    <div  class="grid2">
      <table width="100%" border="0" cellpadding="3" cellspacing="2">
        <tr>
          <td><label>ID</label></td>
          <td colspan="3"><span style="color:#F00;"><?php echo $randval; ?>
            <input type="hidden" value="<?php echo $randval;?>" name="bookingid" />
          </span></td>
        </tr>
        <tr>
          <td width="23%"><label>Name</label></td>
          <td colspan="3"><select name="initials">
            <option>Mr.</option>
            <option>Mrs.</option>
          </select>
            &nbsp;
            <input type="text" style="width:180px;" name="fullname"  id="fullname" placeholder="Full Name" required></td>
        </tr>
        <tr>
          <td><label>Address</label></td>
          <td colspan="3" valign="top"><textarea style="width:252px; min-height: 25px;" placeholder="Address" name="address"></textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="25%"><input type="text" style="width:100px;" placeholder="City" name="city"></td>
          <td width="52%"><input type="text" style="width:80px;" placeholder="State" name="state"></td>
        </tr>
        <tr>
          <td><label>Zip</label></td>
          <td colspan="3"><input type="text" style="width:80px;" placeholder="Zip Code" name="zip_code"></td>
        </tr>
        <tr>
          <td><label>Country</label></td>
          <td colspan="3"><select name="country" style="width:267px;" required>
            <option value="">--Select--</option>
            <?php 
		$qc="select * from master_country order by name desc";
		$qc1 = mysql_query($qc);
		while($qc21 = mysql_fetch_array($qc1)){
	?>
            <option value="<?php echo $qc21['name']?>"><?php echo $qc21['name']?></option>
            <?php } ?>
          </select></td>
        </tr>
        <tr>
          <td><label>Identity</label></td>
          <td colspan="3"><select name="identity">
            <?php 
		$qc="select * from master_identity";
		$qc1 = mysql_query($qc);
		while($qc21 = mysql_fetch_array($qc1)){
	?>
            <option value="<?php echo $qc21['identity']?>"><?php echo $qc21['identity']?></option>
            <?php } ?>
          </select>
            &nbsp;
            <input type="text" style="width:120px;" placeholder="ID Number" name="identity_no"></td>
        </tr>
        <tr>
          <td><label>Nationality</label></td>
          <td colspan="3"><select name="nationality"  style="width:267px;">
            <option value="">--Select--</option>
            <?php 
		$qc="select * from master_country order by name desc";
		$qc1 = mysql_query($qc);
		while($qc21 = mysql_fetch_array($qc1)){
	?>
            <option value="<?php echo $qc21['name']?>"><?php echo $qc21['name']?></option>
            <?php } ?>
          </select></td>
        </tr>
        <tr>
          <td><label>Gender</label></td>
          <td colspan="3"><input type="radio" name="gender" value="Male"  checked>
            Male&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio"  name="gender" id="gender" value="Female">
            Female</td>
        </tr>
        <tr>
          <td><label>Mode of Arrival</label></td>
          <td colspan="3"><select name="mode_arrival">
            <option>Airline</option>
            <option>Car</option>
            <option>Bus</option>
            <option>Train</option>
            <option>Walk-in</option>
          </select></td>
        </tr>
        <tr>
          <td><label>Source</label></td>
          <td colspan="3"><select name="source">
            <option>General</option>
          </select></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3">&nbsp;</td>
        </tr>
      </table>
      <div class="clear"></div>
    </div>
  </div>
</div>
</td>
    <td width="66%" colspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="51%" valign="top"><div class="onecolumn" style="width:380px; margin-right:10px">
          <div class="header"> <span ><span class="ico gray home"></span>Stay Information</span></div>
          <div class="clear"></div>
          <div class="content" >
            <table width="100%" border="0"  cellpadding="3" cellspacing="0">
              <tr>
                <td width="34%"><label>Check In Date</label></td>
                <td width="66%"><?php   $event_start = date("Y/m/d H:i:s"); ?>
                  <input type="datetime-local" name="check_in_date" id="check_in_date2" value="" style="height:25px; width:180px;" required></td>
              </tr>
              <tr>
                <td><label>Check Out Date</label></td>
                <td><input type="datetime-local" name="check_out_date" id="check_out_date2" value=""  style="height:25px; width:180px;"></td>
              </tr>
              <tr>
                <td valign="top"><label>Company</label></td>
                <td valign="top"><input type="text" style="width:167px;" name="company"></td>
              </tr>
              <tr>
                <td valign="top"><label>VIP Status</label></td>
                <td valign="top"><select name="vip_status" style="width:115px;">
                  <option>Regular</option>
                  <option>Vip</option>
                  <option>VVip</option>
                </select></td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
              </tr>
            </table>
            <div class="clear"></div>
          </div>
        </div></td>
        <td width="1%" valign="top">&nbsp;</td>
        <td width="48%" valign="top"><div class="onecolumn" style="width:400px; margin-right:10px" >
          <div class="header"> <span ><span class="ico gray home"></span> Contact Information</span></div>
          <div class="clear"></div>
          <div class="content" >
            <table width="100%" border="0"  cellpadding="2" cellspacing="0">
              <tr>
                <td width="26%"><label>Email</label></td>
                <td colspan="3"><input type="email" style="width:218px;padding:8px;" name="email"></td>
              </tr>
              <tr>
                <td><label>Phone</label></td>
                <td colspan="3" valign="top"><input type="text" style="width:220px;"  name="phone" id="phone"></td>
              </tr>
              <tr>
                <td><label>Mobile</label></td>
                <td colspan="3"><input type="text" style="width:220px;" required name="mobile"></td>
              </tr>
              <tr>
                <td><label>Fax</label></td>
                <td colspan="3"><input type="text" style="width:220px;" name="fax"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="16%">&nbsp;</td>
                <td width="58%" colspan="2">&nbsp;</td>
              </tr>
            </table>
            <div class="clear"></div>
          </div>
        </div></td>
      </tr>
      <tr>
        <td colspan="3" height="10"></td>
      </tr>
      <tr>
        <td colspan="3" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><div class="onecolumn"  style="width:90%;" >
              <div class="header" style="height:35px;"><span><span class="ico gray home"></span>Room Allotment</span></div>
              <div class="clear"></div>
              <div class="content" style="margin:0px; padding:0px;">
                <table width="100%" border="0"  cellpadding="3" cellspacing="0" id='displayrooms'>
                  <tr  style="background-color:#DBDBDB;">
                    <td width="7%"><strong>#</strong></td>
                    <td width="13%"><strong>Room No.</strong></td>
                    <td width="12%"><strong>Room Type</strong></td>
                    <td width="17%"><strong>Check-In</strong></td>
                    <td width="21%"><strong>Check-Out</strong></td>
                  </tr>
                    
                  </table>
                <div class="clear"></div>
                </div>
              </div></td>
            </tr>
          </table></td>
      </tr>
      </table></td>
    </tr>
  <tr>
 
    <td colspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      
    </table></td>
    </tr>
</table>
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  </table>


<div style="float:right; margin-top:0px; padding-bottom:100px;"><input type="button"  id='Group Reserve' name="reserv" onclick='processgroupform(this.id)' value="Group Reserve" class="button_exampless"/>&nbsp;<input type="button" id='Group Check-In' name="checkin" value="Group Check-In" onclick='processgroupform(this.id)' class="button_exampless"/>&nbsp;<input type="button" value="Cancel" class="button_exampless" onclick="restore()" />&nbsp;&nbsp;<input type="reset" class="button_exampless" id='reset' value="Reset" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
</form>

