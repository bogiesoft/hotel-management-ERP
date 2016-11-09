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
		$rt="+select * from master_room_type+";
		$rt1 = mysql_query($rt);
		while($rt21 = mysql_fetch_array($rt1)){
	?>			    <option><?php echo $rt21['room_type']?></option>	 <?php } ?></select></td>			  <td width='19%'><select name='room_number_box[]'>			      <option>101</option>			      <option>102</option>			      </select></td>			  <td width='23%'><table width='100%' border='0' cellspacing='0' cellpadding='0'>			    <tr>			      <td width='13%'><label>Adult</label></td>			      <td width='18%'><select name='adult_box'> <?php for($c=0;$c<=10;$c++){ ?><option><?php echo $c;?></option><?php } ?></select></td>			      <td width='13%'><label>Child</label></td>			      <td width='56%'><select name='child_box'> <?php for($c=0;$c<=10;$c++){ ?><option><?php echo $c;?></option><?php } ?> </select></td>			      </tr>			    </table></td>			  <td width='18%'><input type='text'   name='guest_name_box[]' /></td>			  <td width='12%'><input type='button' class='add' value='Add More' /></td>			  </tr><tr><td colspan='10'>&nbsp;</td></tr>";
					$("tr:last").after(appendTxt);			
				});        
			});
</script>
    
<form name="regfrm" method="post" id='regfrm'>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
      <table width="60%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top"><div class="onecolumn" style="width:100%;margin-left:-5%;margin-top:-3%; height:250px;margin-right:4%;">
                      <div class="header"> <span><span class="ico gray home"></span> Guest Information</span></div>
                        <div class="clear"></div>
                        <div class="content">

                            <div class="grid1">
                                <table width="60%" border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td><label>ID</label></td>
    <td colspan="2"><span style="color:#F00;" id='booking_idspan'><?php echo $randval;?><input type="hidden" value="<?php echo $randval;?>" name="bookingid" id='booking_id'/></span></td>
  </tr>
  <tr>
    <td width="17%"><label>Name</label></td>
    <td colspan="3"><select name="initials" id='initials'>
      <option>Mr.</option>
      <option>Mrs.</option>
      
    </select>
      &nbsp;
      <input type="text" style="width:180px;" name="fullname" placeholder="Full Name" id='name' required></td>
    </tr>
  <tr>
    <td><label>Address</label></td>
    <td colspan="3" valign="top"><textarea id='address' style="width:252px; min-height: 25px;" placeholder="Address" name="address"></textarea></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="25%"><input type="text" style="width:100px;" id='city' placeholder="City" name="city"></td>
    <td width="21%"><input type="text" style="width:80px;" id='state' placeholder="State" name="state"></td>
    <td width="37%"><input type="text" style="width:80px;" id='zip_code' placeholder="Zip Code" name="zip_code"></td>
  </tr>
  <tr>
    <td><label>Country</label></td>
    <td colspan="3"><select name="country" id='country' style="width:267px;" required>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
                              </table>
                            <div class="clear"></div>
                        </div>
                    </div>
               </div></td>
    <td valign="top"><div class="onecolumn" style="width:400px;margin-top:-3%; height:250px;margin-right:5%;">
                      <div class="header"> <span ><span class="ico gray home"></span>Stay Information</span> </div>
                        <div class="clear"></div>
                        <div class="content">
                          <table width="100%" border="0"  cellpadding="3" cellspacing="0">
                            <tr>
                              <td width="34%"><label>Room Type</label></td>
                              <td width="66%"><select name="room_type" id='room_type'>
                              <?php 
		$qc="select * from master_room_type ";
		$qc1 = mysql_query($qc);
		while($data = mysql_fetch_array($qc1)){
	?>
                                <option value="<?php echo $data['room_type']?>"><?php echo $data['room_type']?></option>
                               
                               <?php } ?>
                              </select>
                                &nbsp;
                                <select name="room_volume" id='room_volume'>
                                  <option>Single Room</option>
                                  <option>Double Room</option>
                                </select></td>
                            </tr>
                            <tr>
                              <td><label>Room No.</label></td>
                              <td valign="top">
                       
                          <select name="room_no" style="width:105px;" id='room_no'  required>
                              <option value="">--Select--</option>
                                 <?php 
		$qr="select * from master_rooms order by id asc";
		$qr1 = mysql_query($qr);
		while($qr21 = mysql_fetch_array($qr1)){
			
			$selr = "select room_no, status from reservation  where room_no='".$qr21['room_no']."'";
			$selr1=mysql_query($selr);
			$selr_ob = mysql_fetch_object($selr1);
			if($selr_ob->room_no == $qr21['room_no']){ $bgcol = 'C1DDF1';}else{$bgcol = '';}
			if(($selr_ob->room_no == $qr21['room_no']) and ($selr_ob->status=='reserved' or $selr_ob->status=='check-in') ){ $disble = 'disabled';}else{$disble = '';}
	?>
                                <!--<?php echo $disble;?>   style="background-color:#<?php echo $bgcol;?>;" -->
                                <option value="<?php echo $qr21['room_no'];?>"  id="<?php echo $qr21['room_no'];?>"><?php echo $qr21['room_no'];?></option>
                                <?php  } ?>
                              </select></td>
                            </tr>
                            <tr>
                              <td><label>Check In Date</label></td>
                              <td>
                              <?php   $event_start = date("Y/m/d H:i:s"); ?>
                              <input type="datetime-local" id='check_in_date' name="check_in_date" value="" style="height:25px; width:180px;" required></td>
                            </tr>
                            <tr>
                              <td><label>Check Out Date</label></td>
                              <td><input type="datetime-local" id='check_out_date' name="check_out_date" value=""  style="height:25px; width:180px;"></td>
                            </tr>
                            <tr>
                              <td colspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="40%" align="right"><label>Adult&nbsp;</label></td>
                                  <td width="18%"><select name="adult_default" id='adult_default'>
                                    <?php for($c=1;$c<=10;$c++){ ?>
                                    <option value="<?php echo $c;?>"><?php echo $c;?></option>
                                    <?php } ?>
                                  </select></td>
                                  <td width="8%"><label>Child&nbsp;</label></td>
                                  <td width="34%"><select name="child_default" id='child_default'>
                                     <?php for($c=0;$c<10;$c++){ ?>
                                    <option value="<?php echo $c;?>"><?php echo $c;?></option>
                                    <?php } ?>
                                  </select></td>
                                </tr>
                              </table></td>
                            </tr>
                          </table>
                          <div class="clear"></div>

              </div>
          </div></td>
    <td valign="top"><div class="onecolumn" style="width:360px;margin-top:-3%; height:250px;margin-right:2%;margin-left:6%;" >
                      <div class="header"> <span ><span class="ico gray home"></span> Contact Information</span> </div>
                        <div class="clear"></div>
                        <div class="content" >
                          <table width="100%" border="0"  cellpadding="2" cellspacing="0">
                            <tr>
                              <td width="26%"><label>Email</label></td>
                              <td colspan="3">
                              <input type="email" style="width:218px;padding:8px;" name="email" id='email'></td>
                            </tr>
                            <tr>
                              <td><label>Phone</label></td>
                              <td colspan="3" valign="top"><input type="text" style="width:220px;" id='phone' name="phone"></td>
                            </tr>
                            <tr>
                              <td><label>Mobile</label></td>
                              <td colspan="3"><input type="text" style="width:220px;" required id='mobile' name="mobile"></td>
                            </tr>
                            <tr>
                              <td><label>Fax</label></td>
                              <td colspan="3"><input type="text" style="width:220px;" id='fax' name="fax"></td>
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
</table>
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><div class="onecolumn"  style="width:410px;margin-right:15px;" >
                      <div class="header"> <span ><span class="ico gray home"></span> Other Information</span> </div>
                        <div class="clear"></div>
                        <div class="content" >
                          <table width="100%" border="0"  cellpadding="3" cellspacing="0">
                            <tr>
                              <td width="26%"><label>Identity</label></td>
                              <td colspan="3"><select name="identity" id='identity'>
                                <?php 
		$qc="select * from master_identity";
		$qc1 = mysql_query($qc);
		while($qc21 = mysql_fetch_array($qc1)){
	?>
                                
                                <option value="<?php echo $qc21['identity']?>"><?php echo $qc21['identity']?></option>
                                
                                <?php } ?>
                              </select>
                              &nbsp;
                              <input type="text" style="width:120px;" placeholder="ID Number" name="identity_no" id='identity_no'></td>
                            </tr>
                            <tr>
                              <td><label>Nationality</label></td>
                              <td colspan="3" valign="top">
                              <select name="nationality" id="nationality"  style="width:267px;">
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
                              <td colspan="3"><input type="radio" name="gender" id='gender' value="Male"  checked>Male&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="gender" id="gender" value="Female">Female</td>
                            </tr>
                            <tr>
                              <td><label>VIP Status</label></td>
                              <td colspan="3"><select name="vip_status" id='vip_status' style="width:115px;">
                               <option value="Regular">Regular</option>
                                <option value="Vip">Vip</option>
                                <option value="VVip">VVip</option>
                              </select></td>
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
    <td valign="top"><div class="onecolumn"  style="width:400px; margin-right:10px" >
                      <div class="header"> <span ><span class="ico gray home"></span> Billing Information</span> </div>
                        <div class="clear"></div>
                        <div class="content" >
                          <table width="100%" border="0"  cellpadding="3" cellspacing="0">
                            <tr>
                              <td width="26%"><label>Rates</label></td>
                              <td colspan="3"><input type="text" style="width:105px;" placeholder="0.00"></td>
                            </tr>
                            <tr>
                              <td><label>Payment Mode</label></td>
                              <td colspan="3" valign="top"><select name="pay_mode" id="pay_mode">
                              <option value="">--Select--</option>
                                <?php 
		$qc="select * from master_payment_mode";
		$qc1 = mysql_query($qc);
		while($qc21 = mysql_fetch_array($qc1)){
	?>
                                <option value="<?php echo $qc21['payment_mode']?>"><?php echo $qc21['payment_mode']?></option>
                                <?php } ?>
                              </select></td>
                            </tr>
                            <tr>
                              <td><label>Discount</label></td>
                              <td colspan="3"><input type="text" style="width:105px;" placeholder="0.00"></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td width="16%">&nbsp;</td>
                              <td width="58%" colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="4" height="20"></td>
                            </tr>
                          </table>
                          <div class="clear"></div>
                       
              </div>
          </div></td>
    <td valign="top"><div class="onecolumn"  style="width:360px;" >
                      <div class="header"> <span ><span class="ico gray home"></span> Other</span></div>
                        <div class="clear"></div>
                        <div class="content" >
                          <table width="100%" border="0"  cellpadding="3" cellspacing="0">
                            <tr>
                              <td width="26%"><label>Company</label></td>
                              <td colspan="3"><input type="text" style="width:180px;" name="company" id="company"></td>
                            </tr>
                            <tr>
                              <td><label>Mode of Arrival</label></td>
                              <td colspan="3" valign="top"><select name="mode_arrival" id="mode_arrival">
                               <option value="Airline">Airline</option>
                                <option value="Car">Car</option>
                                <option value="Bus">Bus</option>
                                <option value="Train">Train</option>
                                <option value="Walk-in">Walk-in</option>
                              </select></td>
                            </tr>
                            <tr>
                              <td><label>Source</label></td>
                              <td colspan="3"><select name="source" id="source">
                                <option>General</option>
                              </select></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td width="16%">&nbsp;</td>
                              <td width="58%" colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="4" height="20"></td>
                            </tr>
                          </table>
                          <div class="clear"></div>
                        
                    </div>
          </div></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top">&nbsp;</td>
        </tr>
  </table></td>
  </tr>
</table>

  <div style="float:right;">
    <input type="button" onclick="processform(this.id)" name="reserv" value="Reserve" id='Reserve' class="button_exampless"/>&nbsp;
    <input type="button" onclick="processform(this.id)" name="checkin" value="Check-In" id='Check-In' class="button_exampless"/>&nbsp;
    <input type="button" onclick="processform(this.id)" name="block" value="Block" id='Block' class="button_exampless"/>&nbsp;
    <input type="button" value="Cancel" class="button_exampless" onclick="restore()" />&nbsp;
    <input id='Reset' type="reset" class="button_exampless"  value="Reset" />
  </div>

</form>
