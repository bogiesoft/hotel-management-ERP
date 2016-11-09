<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">     
<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
<link rel="stylesheet" href="css/design.css" type="text/css" />
<link href="css/common.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/house_keep.css">
<script src="js/jquery-ui.js"></script>

</body>
</html>
<script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>

    <div style="position:relative;" id="popup" title="Give us your valuable feedback"> Room No: <input style="position:relative;left:30%;" id="name" name="name" type="text"><br>Message<br><textarea rows="10" cols="30" style="position:relative;left:38%;" name="feedback" id="message"></textarea></div>
  <table width="96%" align="center"border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"> 
     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="botborder">
              <tr>
<td width="30%" align="left"><h2 style="border:0px"><img src="images/users.png" width="45" align="absmiddle"/>House Keeping</h2></td>
                <td align="left">&nbsp;</td> 
            
                <td align="right">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
     </table>
    </td>
  </tr>

  <tr style="position:relative;">
    <td style="margin:2%;padding:2%;border:1px solid #f0f0f0;">
    <label style="">Housekeeping Status<select id="house_status" onchange="status(this.value,this.id);"><option>Select</option><option>Clean</option><option>Dirty</option><option>Repair</option><option>Inspect</option></select></label>
    <label style="padding:4%;">Housekeeping Priority<select id="house_priority" onchange="priority(this.value,this.id);"><option>Select</option><option>Low</option><option>High</option></select></label>
    <label style="padding:4%;">Assignee<select id="house_keeper" onchange="assignee(this.value,this.id);"><option>Select</option><option>Catherine</option><option>King</option></select></label>
    </td>
  </tr>
  <tr>
    <td align="center">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">

                   

                    <thead>
                        <tr>
                             <th width="43">#</th>                             
                             
                             <th id = "room_no" width="103">Room no<img src="images/bg_arrow.gif"></th>
                             <th id = "room_type" width="106">Room type<img src="images/bg_arrow.gif"></th> 
                             <th id = "assignee" width="113">Assignee<img src="images/bg_arrow.gif"></th>
                             <th id = "housekeeping_status" width="103">Housekeeping Status<img src="images/bg_arrow.gif"></th>
                             <th id = "housekeeping_priority" width="146">Housekeeping priority<img src="images/bg_arrow.gif"></th> 
                             <th id = "status" width="121">Status<img src="images/bg_arrow.gif"></th>
                             <th id = "feedback" width="121">Remarks<img src="images/bg_arrow.gif"></th>                               
                            
                            
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                        
                        
                        
                         $j = mysql_query("SELECT COUNT(id) FROM master_rooms");
                         $k = mysql_fetch_array($j);

                         $i = 1;
                       while($i<=$k[0]){ 
                
                         $a = mysql_query("SELECT * FROM master_rooms WHERE id='$i'");
                         $b = mysql_fetch_array($a);    
                         $room = $b['room_no'];
                         $c = mysql_query("SELECT * FROM reservation WHERE  room_no=$room");
                         if(mysql_num_rows($c)){
                           $status = 'reserved';
                         }
                         else{
                            $status = 'available';
                         }
                         $room = $b['room_no']; 
                         $e = mysql_query("SELECT name FROM house_keeping WHERE room_no='$room'");
                         $f = mysql_fetch_array($e);

                     ?>    
                           
                                <tr class="del<?php echo $id ?>">
                                <td><?php echo "<input type='checkbox' id='check$room' class='a'>"; ?></td>                               
                                <td><?php echo $b['room_no'];?></td>
                                <td><?php echo $b['room_type'];?></td> 
                                <td><?php echo $f['name']; ?></td>
                                <td id="<?php echo "house_status".$i;?>"><?php echo $b['house_keeping_status'];?></td>
                                <td><?php echo $b['priority']; ?></td>
                                <td><?php echo $status?></td>
                                <td><a id="<?php echo $b['room_no'];?>" onclick="feedback(this.id)" href="#"><?php echo $b['room_no']; ?></a>
                                </td>                              
                                
            
                               
                                <div style="clear:both;"></div>
                               
                              
                              
                              

                                
                                
                            </tr>


                        <?php $i++; } ?>

                    </tbody>
                </table></td>
  </tr>


</table>
<script type="text/javascript" src='js/housekeep.js'></script>


