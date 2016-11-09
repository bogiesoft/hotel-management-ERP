<?php

############# INSERT RECORDS HERE

$randval =  randomval();

if( $_POST['reserv'] == "Group Reserve" or $_POST['checkin']=="Group Check-In" ) {

$countval = count($_POST['memname']);
if($countval>0){

for($g=0;$g<$countval;$g++){  //// FOR LOOP START
		
$date=date("Y-M-d"); 
$checkindate =  $_POST['indate'][$g];
$time = strtotime($checkindate);
$check_in_date = date("Y-m-d H:i:s", $time);

$checkoutdate =  $_POST['outdate'][$g];
$time1 = strtotime($checkoutdate);
$check_out_date = date("Y-m-d H:i:s", $time1);

if($_POST['reserv'] == "Group Reserve"){ $msgval = 1; $status = "reserved";}
if($_POST['checkin'] == "Group Check-In"){ $msgval= 2; $status = "check-in";}

$insertArr = array(
		
			"booking_id"	      	 =>  putData( $_POST['bookingid'] ),
			"initials"	     		 =>  putData( $_POST['initials'] ),
			"name"	      			 =>  putData( $_POST['fullname'] ),
			"address"	     		 =>  putData( $_POST['address'] ),
			"state"	     			 =>  putData( $_POST['state'] ),
			"city"	     			 =>  putData( $_POST['city'] ),
			"zip_code"	    		 =>  putData( $_POST['zip_code'] ),
			"country"	    		 =>  putData( $_POST['country'] ),
			"room_no"	     		 =>  putData( $_POST['room_no'][$g] ),
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
			
	        $last_insert_id = insertData($insertArr, RESERV);
			
		/*$cc = count($_POST['room_type_box_one']);
for($s=0;$s<$cc;$s++){
	$qin = "insert into reservation_members (res_id,name,room_type,room_no,adult,child) values('$last_insert_id','".$_POST['guest_name_box'][$s]."', '".$_POST['room_type_box_one'][$s]."', '".$_POST['room_number_box'][$s]."', '".$_POST['adult_box'][$s]."', '".$_POST['child_box'][$s]."')";	
	mysql_query($qin);
}*/

} /// end for loop

			redirect("membership.php?module=groupreservation&msg=$msgval");
	 }else{ // end if
	 $msgval = "3";
	 redirect("membership.php?module=groupreservation&msg=$msgval");
	 }
	 
}
//print_r($insertArr);	

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
<?php if($_GET['msg']==1){?>
<div id="toPopup" style="display: none;">

        <div class="close"></div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup_content"> <!--your content start-->
        <br>
            <p><strong>Group Reservation Done Successfully.</strong></p><br>
        </div> <!--your content end-->

</div>
    <?php } ?>
<?php if($_GET['msg']==2){?>
<div id="toPopup" style="display: none;">

        <div class="close"></div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup_content"> <!--your content start-->
        <br>
            <p><strong>Group Checked-In Successfully.</strong></p><br>
        </div> <!--your content end-->

</div>
    <?php } ?> 

<?php if($_GET['msg']==3){?>
<div id="toPopup" style="display: none;">

        <div class="close"></div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup_content"> <!--your content start-->
        <br>
            <p style="color: crimson;"><strong><img src="admin/images/Warning.png">&nbsp;Please select atleast one room!</strong></p><br>
        </div> <!--your content end-->

</div>
    <?php } ?> 
           
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
function roomaddf() {
 
var etable = document.getElementById("example");
var check_in = document.getElementById("check_in_date").value;
var check_out = document.getElementById("check_out_date").value;
var fullname = document.getElementById("fullname").value;
var phone = document.getElementById("phone").value;

 var items = [];

    $('.messageCheckbox:checked').each(function(n) {
        items[n] =  $(this).val();
    });

if(items==""){
		var t1 = document.getElementById("leastoner");
		t1.style.display="block";
		
	}

    var str=1;
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("tbleroom").innerHTML=xmlhttp.responseText;
	  
	  if(items!=""){
	  etable.style.display="none";
	  $( "div" ).removeClass( "modal-backdrop fade in" );
	  }
	  
    }
  }
  xmlhttp.open("GET","room_add.php?rooms="+items+"&check_in="+check_in+"&check_out="+check_out+"&fullname="+fullname+"&phone="+phone,true);
  xmlhttp.send();
  
}
</script>

<script>
	$(document).on('click', 'button.removebutton', function () {
    // alert("aa");
     $(this).closest('tr').remove();
     return false;
 });

</script>

  
<form name="regfrm" action="" method="post">
<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td width="34%" valign="top"><div class="onecolumn" style="width:425px; height:486px;" >
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
        <td width="51%" valign="top"><div class="onecolumn" style="width:420px; height:240px;">
          <div class="header"> <span ><span class="ico gray home"></span>Stay Information</span></div>
          <div class="clear"></div>
          <div class="content" >
            <table width="100%" border="0"  cellpadding="3" cellspacing="0">
              <tr>
                <td width="34%"><label>Check In Date</label></td>
                <td width="66%"><?php   $event_start = date("Y/m/d H:i:s"); ?>
                  <input type="datetime-local" name="check_in_date" id="check_in_date" value="<?= date('Y-m-d\TH:i',strtotime($event_start)) ?>" style="height:25px; width:180px;" required></td>
              </tr>
              <tr>
                <td><label>Check Out Date</label></td>
                <td><input type="datetime-local" name="check_out_date" id="check_out_date" value="<?= date('Y-m-d\TH:i',strtotime($event_start. "+1 days")) ?>"  style="height:25px; width:180px;"></td>
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
        <td width="48%" valign="top"><div class="onecolumn" style="width:420px; height:240px;" >
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
            <td><div class="onecolumn"  style="width:100%;" >
              <div class="header" style="height:35px;"> <span ><span class="ico gray home"></span>Room Allotment</span></div>
              <div class="clear"></div>
              <div class="content" style="margin:0px; padding:0px;" >
                <table width="100%" border="0"  cellpadding="3" cellspacing="0">
                  <tr  style="background-color:#DBDBDB;">
                    <td width="4%"><strong>#</strong></td>
                    <td width="9%"><strong>Room No.</strong></td>
                    <td width="12%"><strong>Room Type</strong></td>
                    <td width="20%"><strong>Full Name</strong></td>
                    <td width="17%"><strong>Phone</strong></td>
                    <td width="17%"><strong>Check-In</strong></td>
                    <td width="21%"><strong>Check-Out</strong></td>
                    </tr>
                  <tr>
                    <td colspan="7" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbleroom">
                       <tr>
                    <td align="center" style="color: cadetblue;">No room selected.</td>
                    </tr>
                    </table></td>
                    </tr>
                  <tr>
                    <td colspan="7">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="7" align="right">&nbsp;                    </td>
                    </tr>
                  <tr>
                    <td colspan="7" height="20"></td>
                    </tr>
                  <tr>
                    <td colspan="7" height="20"></td>
                    </tr>
                  <tr>
                    <td colspan="7" height="20" align="right">
                    <div id="example" class="modal hide fade" style="display: none;">
            <div class="modal-header" style="border-bottom:none;">
              <a class="close" data-dismiss="modal">×</a>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="35%" align="left"><h3>Available Rooms</h3></td>
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
                    
                  <a data-toggle="modal" href="#example" class="button_exampless" style="height:30px; width:70px; padding:5px;">Add Rooms</a>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="7" height="20" align="right">&nbsp;</td>
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


<div style="float:right; margin-top:0px; padding-bottom:100px;"><input type="submit"  name="reserv" value="Group Reserve" class="button_exampless"/>&nbsp;<input type="submit"  name="checkin" value="Group Check-In" class="button_exampless"/>&nbsp;<input type="button" value="Cancel" class="button_exampless" onclick="window.history.back();" />&nbsp;&nbsp;<input type="reset" class="button_exampless"  value="Reset" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
</form>

