<?php
include_once("includes/db.inc.php");

$rooms = $_GET['rooms'];
$fullname = $_GET['fullname'];
$phone = $_GET['phone'];
$check_in1 =  date("Y-m-d", strtotime($_GET['check_in'])); 
$check_out1 =  date("Y-m-d", strtotime($_GET['check_out'])); 

if($rooms!=""){
 $rom = "select * from master_rooms where room_no IN($rooms) ";
$rom1=mysql_query($rom);

$i=1;
$bgcol="";
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbleroom">
<?php
	while($rarr = mysql_fetch_array($rom1)){
		if($i%2==0){ $bgcol = "#F9F9F9";}else{$bgcol = "";}
?>
  <tr bgcolor="<?php echo $bgcol;?>">
    <td width="4%"><?php echo $i;?></td>
    <td width="10%"><input type="text" name="room_no[]" id="room_no[]" value="<?php echo $rarr['room_no'];?>" readonly style="height:19px;border: #ccc solid 1px;border-radius: 3px;font-family: Tahoma, Arial, helvetica, sans-serif;font-size: 1em;line-height: normal;" size="5"></td>
    <td width="12%"><select name="room_type[]" style=" width:73px;border: #ccc solid 1px;border-radius: 3px;font-family: Tahoma, Arial, helvetica, sans-serif;font-size: 1em;">
                              <?php 
		$qc="select * from master_room_type ";
		$qc1 = mysql_query($qc);
		while($data = mysql_fetch_array($qc1)){
	?>
                                <option value="<?php echo $data['room_type']?>"><?php echo $data['room_type']?></option>
                               
                               <?php } ?>
                              </select>
    
    </td>
    <td width="20%"><input type="text" name="memname[]" style="height: 20px;width: 115px;line-height: normal;" value="<?php echo $fullname;?>"></td>
    <td width="17%" valign="top"><input type="text" name="memphone[]" id="memphone[]"  style="height: 20px;width: 105px;line-height: normal;" value="<?php echo $phone;?>" ></td>
    <td width="17%" valign="top"><input type="date" name="indate[]"  style="height: 20px;width: 130px;border: #ccc solid 1px;
border-radius: 3px;font-family: Tahoma, Arial, helvetica, sans-serif;font-size: 1em;" value="<?php echo $check_in1;?>"></td>
    <td width="18%" valign="top"><input type="date" name="outdate[]"  style="height: 20px;width: 130px;border: #ccc solid 1px;border-radius: 3px;font-family: Tahoma, Arial, helvetica, sans-serif;font-size: 1em;" value="<?php echo $check_out1;?>"></td>
    <td width="2%" valign="top"><button type="button" class="removebutton" style="cursor:pointer;" title="Remove this row">X</button></td>
  </tr>
   <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <?php $i++; } ?>
</table>

<?php }else{ ?>
<tr>
   <td align="center" colspan="10" style="color: cadetblue;">No room selected.</td>
  </tr>
  <?php } ?>

