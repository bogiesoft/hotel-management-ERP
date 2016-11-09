<?php

############# INSERT RECORDS HERE
print_r($_SESSION);
$randval =  randomval();

if( $_POST['savenclose'] == "Save & Close" or $_POST['saveval']=="Save" or $_POST['checkin']=="Check-In" ) {


$dateWithTimeZone =  $_POST['check_in_date'];
$time = strtotime($dateWithTimeZone);
$check_in_date = date("Y-m-d H:i:s", $time);

$check_out_date1 =  $_POST['check_out_date'];
$time1 = strtotime($check_out_date1);
$check_out_date = date("Y-m-d H:i:s", $time1);

if($_POST['savenclose'] == "Save & Close"){ $msgval = 1; $status = $_POST['status'];}
if($_POST['saveval'] == "Save"){ $msgval= 2; $status = $_POST['status'];}
if($_POST['checkin']=="Check-In"){ $msgval= 3; $status = "check-in";}
$dataid = $_POST['id'];

$updateArr = array(
		
			"initials"	     		 =>  putData( $_POST['initials'] ),
			"name"	      			 =>  putData( $_POST['fullname'] ),
			"address"	     		 =>  putData( $_POST['address'] ),
			"state"	     			 =>  putData( $_POST['state'] ),
			"city"	     			 =>  putData( $_POST['city'] ),
			"zip_code"	    		 =>  putData( $_POST['zip_code'] ),
			"country"	    		 =>  putData( $_POST['country'] ),
			"room_no"	     		 =>  putData( $_POST['room_no'] ),
			"room_type"	     		 =>  putData( $_POST['room_type'] ),
			"room_volume"	     	 =>  putData( $_POST['room_volume'] ),
			"check_in_date"	     	 =>  putData( $check_in_date ),
			"check_out_date"	     =>  putData( $check_out_date ),
			"adult_default"	     	 =>  putData( $_POST['adult_default'] ),
			"child_default"	     	 =>  putData( $_POST['child_default'] ),
			"email"	     	 		 =>  putData( $_POST['email'] ),
			"phone"	     	 		 =>  putData( $_POST['phone'] ),
			"mobile"	     		 =>  putData( $_POST['mobile'] ),
			"fax"	     			 =>  putData( $_POST['fax'] ),
			"identity"	     		 =>  putData( $_POST['identity'] ),
			"identity_no"	     	 =>  putData( $_POST['identity_no'] ),
			"nationality"	     	 =>  putData( $_POST['nationality'] ),
			"gender"	     		 =>  putData( $_POST['gender'] ),
			"vip_status"	     	 =>  putData( $_POST['vip_status'] ),
			"pay_mode"	     	 	 =>  putData( $_POST['pay_mode'] ),
			"company"	     		 =>  putData( $_POST['company'] ),
			"mode_arrival"	     	 =>  putData( $_POST['mode_arrival'] ),
			"source"	     		 =>  putData( $_POST['source'] ),
			"status"	     		 =>  $status		

			);
			
	 $whereClause = "id='".$dataid."'";
	 updateData($updateArr, RESERV,  $whereClause );
	 

	 if($_POST['savenclose'] == "Save & Close"){
	  redirect("membership.php?module=reservation_list");
	 }else{
	 redirect("membership.php?module=viewreservation&id=$dataid&msg=$msgval");		 
		 }
			
	 }
	 


if( $_POST['uncheckin'] == "Un-checkin" ){
	$dataid = $_POST['id'];
	if($_POST['uncheckin']=="Un-checkin"){ $msgval= 4; $status = "reserved";}
	
	$updateArr = array(
		
			"status"	     		 =>  putData( $status )
	
				);
			
	 $whereClause = "id='".$dataid."'";
	 updateData($updateArr, RESERV,  $whereClause );
	 redirect("membership.php?module=viewreservation&id=$dataid&msg=$msgval");	
}

	 ######## DISPLAY RECORD #############
$qry = " select * from ".RESERV." where id='".$_GET['id']."'";
$db->query( $qry );
if( $db->numRows() > 0 ) {
	$data = $db->fetchArray();
}

?>


<script>
function checkroom(gval){
var r = confirm("Are you sure to change the room?");
			if (r == true) {
				document.getElementById("roomno").value=gval;
			} else {
			   return false;
			}
	return false;
	}
</script>
<script src="js/bootstrap-modal.js"></script>  
<link href="css/bootstrap.css" rel="stylesheet"> 
 
<?php if($_GET['msg']==2){?>
<div id="toPopup" style="display: none;">

        <div class="close"></div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup_content"> <!--your content start-->
        <br>
            <p><strong>Done Successfully.</strong></p><br>
        </div> <!--your content end-->

    </div>
    <?php } ?>
<?php if($_GET['msg']==3){?>
<div id="toPopup" style="display: none;">

        <div class="close"></div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup_content"> <!--your content start-->
        <br>
            <p><strong>Checked-In Done Successfully.</strong></p><br>
        </div> <!--your content end-->

    </div>
    <?php } ?>    
<?php if($_GET['msg']==4){?>
<div id="toPopup" style="display: none;">

        <div class="close"></div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup_content"> <!--your content start-->
        <br>
            <p><strong>Un-Check-In Done Successfully.</strong></p><br>
        </div> <!--your content end-->

    </div>
    <?php } ?>    
<form name="regfrm" action="" method="post">
<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><div class="onecolumn" style="width:420px; height:240px;" >
                      <div class="header"> <span ><span class="ico gray home"></span> Guest Information</span> </div>
                        <div class="clear"></div>
                        <div class="content" >

                            <div  class="grid2">
                                <table width="100%" border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td><label>ID</label></td>
    <td colspan="3"><span style="color:#F00;"><?php echo $data['booking_id']; ?></span></td>
  </tr>
  <tr>
    <td width="17%"><label>Name</label></td>
    <td colspan="3">
    <select name="initials">
    <?php
	 if($data['initials']=='Mr.'){ $mr = 'selected'; }else{$mrs = 'selected';} 
	
	?>
      <option <?php echo $mr;?>>Mr.</option>
      <option <?php echo $mrs;?>>Mrs.</option>
      
    </select>
      &nbsp;
      <input type="text" style="width:180px;" name="fullname" placeholder="Full Name"  value="<?php echo $data['name']; ?>" required></td>
    </tr>
  <tr>
    <td><label>Address</label></td>
    <td colspan="3" valign="top"><textarea style="width:252px; min-height: 25px;" placeholder="Address" name="address"><?php echo $data['address']; ?></textarea></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="25%"><input type="text" style="width:100px;" placeholder="City" name="city"  value="<?php echo $data['city']; ?>"></td>
    <td width="21%"><input type="text" style="width:80px;" placeholder="State" name="state"  value="<?php echo $data['state']; ?>"></td>
    <td width="37%"><input type="text" style="width:80px;" placeholder="Zip Code" name="zip_code"  value="<?php echo $data['zip_code']; ?>"></td>
  </tr>
  <tr>
    <td><label>Country</label></td>
    <td colspan="3"><select name="country" style="width:267px;" required>
    <option value="">--Select--</option>
    <?php 
		$qc="select * from master_country order by name desc";
		$qc1 = mysql_query($qc);
		while($qc21 = mysql_fetch_array($qc1)){
			if($data['country']==$qc21['name']){ $contry = "selected";}else{$contry = "";}
	?>
      <option value="<?php echo $qc21['name']?>" <?php echo $contry;?>><?php echo $qc21['name']?></option>
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
    <td valign="top"><div class="onecolumn" style="width:420px; height:240px;">
                      <div class="header"> <span ><span class="ico gray home"></span>Stay Information</span> </div>
                        <div class="clear"></div>
                        <div class="content" >
                          <table width="100%" border="0"  cellpadding="3" cellspacing="0">
                            <tr>
                              <td width="34%"><label>Room Type</label></td>
                              <td width="66%"><select name="room_type">
                              <?php 
		$qc="select * from master_room_type ";
		$qc1 = mysql_query($qc);
		while($rtpe = mysql_fetch_array($qc1)){
			if($data['room_type']==$rtpe['room_type']){ $rt12 = "selected";}else{$rt12 = "";}
	?>
                                <option value="<?php echo $rtpe['room_type']?>" <?php echo $rt12;?>><?php echo $rtpe['room_type']?></option>
                               
                               <?php } ?>
                              </select>
                                &nbsp;
                                <select name="room_volume">
                                <?php
	 if($data['room_volume']=='Single Room'){ $rv = 'selected'; }else{$rvs = 'selected';} 	?>
                                  <option value="Single Room" <?php echo $rv; ?>>Single Room</option>
                                  <option value="Double Room" <?php echo $rvs; ?>>Double Room</option>
                                </select></td>
                            </tr>
                            <tr>
                              <td><label>Room No.</label></td>
                              <td valign="top">
                       
                          <select name="room_no_na" style="width:105px;" required onchange="checkroom(this.value)">
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
			
			if($data['room_no']==$qr21['room_no']){ $rsel = 'selected'; }else{ $rsel = '';}
	?>
                                
                                <option value="<?php echo $qr21['room_no'];?>" <?php echo $disble;?>   style="background-color:#<?php echo $bgcol;?>;" <?php echo $rsel; ?>><?php echo $qr21['room_no'];?></option>
                                <?php  } ?>
                              </select>
                              <input type="hidden" name="room_no" id="roomno" value="<?php echo $data['room_no'];?>" />
                              </td>
                            </tr>
                            <tr>
                              <td><label>Check In Date</label></td>
                              <td>
                              <?php   $event_start = $data['check_in_date']; ?>
                              <input type="datetime-local" name="check_in_date" value="<?= date('Y-m-d\TH:i',strtotime($event_start)) ?>" style="height:25px; width:180px;" required></td>
                            </tr>
                            <tr>
                              <td><label>Check Out Date</label></td>
                              <td>
                              <?php   $event_end = $data['check_out_date']; ?>
                              <input type="datetime-local" name="check_out_date" value="<?= date('Y-m-d\TH:i',strtotime($event_end)) ?>"  style="height:25px; width:180px;"></td>
                            </tr>
                            <tr>
                              <td colspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="40%" align="right"><label>Adult&nbsp;</label></td>
                                  <td width="18%"><select name="adult_default">
                                    <?php for($c=1;$c<=10;$c++){ 
										if($data['adult_default']==$c){ $asel = "selected"; }else{ $asel = ""; }
									?>
                                    <option value="<?php echo $c;?>" <?php echo $asel; ?>><?php echo $c;?></option>
                                    <?php } ?>
                                  </select></td>
                                  <td width="8%"><label>Child&nbsp;</label></td>
                                  <td width="34%"><select name="child_default">
                                     <?php for($ch=0;$ch<10;$ch++){ 
									 	if($data['child_default']==$ch){ $aselh = "selected"; }else{ $aselh = ""; }
									 ?>
                                    <option value="<?php echo $ch;?>" <?php echo $aselh; ?>><?php echo $ch;?></option>
                                    <?php } ?>
                                  </select></td>
                                </tr>
                              </table></td>
                            </tr>
                          </table>
                          <div class="clear"></div>

              </div>
          </div></td>
    <td valign="top"><div class="onecolumn" style="width:420px; height:240px;" >
                      <div class="header"> <span ><span class="ico gray home"></span> Contact Information</span> </div>
                        <div class="clear"></div>
                        <div class="content" >
                          <table width="100%" border="0"  cellpadding="2" cellspacing="0">
                            <tr>
                              <td width="26%"><label>Email</label></td>
                              <td colspan="3">
                              <input type="email" style="width:218px;padding:8px;" name="email" value="<?php echo $data['email'];?>"></td>
                            </tr>
                            <tr>
                              <td><label>Phone</label></td>
                              <td colspan="3" valign="top"><input type="text" style="width:220px;"  name="phone"  value="<?php echo $data['phone'];?>"></td>
                            </tr>
                            <tr>
                              <td><label>Mobile</label></td>
                              <td colspan="3"><input type="text" style="width:220px;" required name="mobile"  value="<?php echo $data['mobile'];?>"></td>
                            </tr>
                            <tr>
                              <td><label>Fax</label></td>
                              <td colspan="3"><input type="text" style="width:220px;" name="fax"  value="<?php echo $data['fax'];?>"></td>
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
    <td valign="top"><div class="onecolumn"  style="width:420px;" >
                      <div class="header"> <span ><span class="ico gray home"></span> Other Information</span> </div>
                        <div class="clear"></div>
                        <div class="content" >
                          <table width="100%" border="0"  cellpadding="3" cellspacing="0">
                            <tr>
                              <td width="26%"><label>Identity</label></td>
                              <td colspan="3"><select name="identity">
                                <?php 
		$qc="select * from master_identity";
		$qc1 = mysql_query($qc);
		while($qc21 = mysql_fetch_array($qc1)){
			if($data['identity']==$qc21['identity']){ $identy = "selected";}else{$identy = "";}
	?>
                                
                                <option value="<?php echo $qc21['identity']?>" <?php echo $identy;?>><?php echo $qc21['identity']?></option>
                                
                                <?php } ?>
                              </select>
                              &nbsp;
                              <input type="text" style="width:120px;" placeholder="ID Number" name="identity_no" value="<?php echo $data['identity_no'];?>"></td>
                            </tr>
                            <tr>
                              <td><label>Nationality</label></td>
                              <td colspan="3" valign="top">
                              <select name="nationality"  style="width:267px;">
                              <option value="">--Select--</option>
    <?php 
		$qc="select * from master_country order by name desc";
		$qc1 = mysql_query($qc);
		while($qc21 = mysql_fetch_array($qc1)){
			if($data['nationality']==$qc21['name']){ $nationliy = "selected";}else{$nationliy = "";}
	?>
      <option value="<?php echo $qc21['name']?>" <?php echo $nationliy;?>><?php echo $qc21['name']?></option>
	<?php } ?>
    </select></td>
                            </tr>
                            <tr>
                              <td><label>Gender</label></td>
                              <td colspan="3">
                              <?php 
							  	if($data['gender']=='Male'){ $male = 'checked';}else{$fmale = 'checked';}
							  ?>
                              <input type="radio" name="gender" value="Male"  <?php echo $male;?>>Male&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="gender" id="gender" value="Female" <?php echo $fmale;?>>Female</td>
                            </tr>
                            <tr>
                              <td><label>VIP Status</label></td>
                              <td colspan="3"><select name="vip_status" style="width:115px;">
                              <?php 
							  if($data['vip_status']=='Regular'){ $rgular = "selected";}
							  if($data['vip_status']=='Vip'){ $vip = "selected";}
							  if($data['vip_status']=='VVip'){ $vvip = "selected";}
							  ?>
                                <option value="Regular" <?php echo $rgular;?>>Regular</option>
                                <option value="Vip" <?php echo $vip;?>>Vip</option>
                                <option value="VVip" <?php echo $vvip;?>>VVip</option>
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
    <td valign="top"><div class="onecolumn"  style="width:420px;" >
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
                              <td colspan="3" valign="top"><select name="pay_mode">
                              <option value="">--Select--</option>
                                <?php 
		$qc="select * from master_payment_mode";
		$qc1 = mysql_query($qc);
		while($qc21 = mysql_fetch_array($qc1)){
			if($data['pay_mode']==$qc21['payment_mode']){ $paymo = "selected";}else{$paymo = "";}
	?>
                                <option value="<?php echo $qc21['payment_mode']?>" <?php echo $paymo;?>><?php echo $qc21['payment_mode']?></option>
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
    <td valign="top"><div class="onecolumn"  style="width:420px;" >
                      <div class="header"> <span ><span class="ico gray home"></span> Other</span></div>
                        <div class="clear"></div>
                        <div class="content" >
                          <table width="100%" border="0"  cellpadding="3" cellspacing="0">
                            <tr>
                              <td width="26%"><label>Company</label></td>
                              <td colspan="3"><input type="text" style="width:180px;" name="company" value="<?php echo $data['company'];?>"></td>
                            </tr>
                            <tr>
                              <td><label>Mode of Arrival</label></td>
                              <td colspan="3" valign="top"><select name="mode_arrival">
                              <?php 
							  if($data['mode_arrival']=="Airline"){ $Airline = "selected";}
							  if($data['mode_arrival']=="Car"){ $Car = "selected";}
							  if($data['mode_arrival']=="Bus"){ $Bus = "selected";}
							  if($data['mode_arrival']=="Train"){ $Train = "selected";}
							  if($data['mode_arrival']=="Walk-in"){ $walkin = "selected";}
							  ?>
                                <option value="Airline" <?php echo  $Airline;?>>Airline</option>
                                <option value="Car" <?php echo  $Car;?>>Car</option>
                                <option value="Bus" <?php echo  $Bus;?>>Bus</option>
                                <option value="Train" <?php echo  $Train;?>>Train</option>
                                <option value="Walk-in" <?php echo  $walkin;?>>Walk-in</option>
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


<div style="float:right; margin-top:0px; padding-bottom:100px;"><input type="submit"  name="savenclose" value="Save & Close" class="button_exampless"/>
  &nbsp;&nbsp;<input type="submit"  name="saveval" value="Save" class="button_exampless"/>
  &nbsp;&nbsp;
 <?php if($data['status']=="reserved"){  ?>
 	<input type="submit"  name="checkin" value="Check-In" class="button_exampless"/>
    <?php } if($data['status']=="check-in"){ ?>
  <input type="submit"  name="uncheckin" value="Un-checkin" class="button_exampless"/>
  <?php } ?>
  &nbsp;<input type="submit"  name="checkout" value="Check-Out" class="button_exampless"/>
  &nbsp;&nbsp;<a data-toggle="modal" href="#example" class="button_exampless" style="height:30px; width:70px; padding:5px; color:white;">Payments</a>
  &nbsp;&nbsp;<input type="button"  name="greciept" value="Guest Receipt" class="button_exampless"/>
  &nbsp;&nbsp;<input type="button" value="Cancel Reservation" class="button_exampless" onclick="window.history.back();" />
  &nbsp;&nbsp;<input type="button" value="Close" class="button_exampless" onclick="window.history.back();" />
  <input type="hidden" name="id" value="<?php echo $_GET['id']?>" />&nbsp;<input type="hidden" name="status" value="<?php echo $data['status']?>" />
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
</form>

<div id="example" class="modal hide fade" style="display: none;">
            <div class="modal-header" style="border-bottom:none;">
              <a class="close" data-dismiss="modal">×</a>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="35%" align="left"><h3>Payment</h3></td>
    <td width="65%" align="left" style="border-bottom:1px solid #EEEEEE;"><span style="color: crimson; display:none;" id="leastoner">Please select atleast one room.</span></td>
   
  </tr>
</table>

            </div>
            <div class="modal-body">
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" class="roomcls">Single Room</td>
  </tr>
   <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
 <?php 
 	$rom = "select room_no from master_rooms where room_volume = 'Single'";
	$rom1=mysql_query($rom);
	while($rarr = mysql_fetch_array($rom1)){
	
		
	 $qleft = "select room_no from reservation where room_no = '".$rarr['room_no']."' ";
	$qleft1 = mysql_query($qleft);
	$qleft1_num = mysql_num_rows($qleft1);
	
	if($qleft1_num==0){
 ?>
 
  <tr>
    <td width="15%" valign="top">&nbsp;&nbsp;&nbsp;<?php echo $rarr['room_no'];?></td>
    <td width="85%" valign="top"><input type="checkbox" class="messageCheckbox" value="<?php echo $rarr['room_no']?>" name="roomchk[]">&nbsp;Select</td>
    </tr>
   <?php } } ?>
  <tr>
    <td colspan="2" class="roomcls">Double Room</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 <?php 
 	$rom = "select room_no from master_rooms where room_volume = 'Double'";
	$rom1=mysql_query($rom);
	while($rarr = mysql_fetch_array($rom1)){
	
		
	 $qleft = "select room_no from reservation where room_no = '".$rarr['room_no']."' ";
	$qleft1 = mysql_query($qleft);
	$qleft1_num = mysql_num_rows($qleft1);
	
	if($qleft1_num==0){
 ?>
  
  <tr>
    <td>&nbsp;&nbsp;&nbsp;<?php echo $rarr['room_no'];?></td>
    <td><input type="checkbox" class="messageCheckbox"  value="<?php echo $rarr['room_no']?>" name="roomchk[]">&nbsp;Select</td>
  </tr>
   <?php  } } ?>
             </table>
		        
            </div>
            <div class="modal-footer">
              <a href="#" style="padding:5px 15px 5px" class="btn btn-success" onClick="roomaddf()">Add</a>
              <a href="#" style="padding:5px 15px 5px" class="btn btn-success" data-dismiss="modal">Close</a>
            </div>
          </div>