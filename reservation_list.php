<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">     
<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
<link rel="stylesheet" href="css/design.css" type="text/css" />
<link href="css/common.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>

<style>
#versionBar {
	
	margin-top: 240px !important;

}
</style>

<table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"> <table width="100%" border="0" cellspacing="0" cellpadding="0" class="botborder">
			  <tr>
<td width="30%" align="left"><h2 style="border:0px"><img src="images/users.png" width="45" align="absmiddle"/>Reservations List</h2></td>
				<td align="left">&nbsp;</td> 
			
				<td align="right">&nbsp;</td>
			  </tr>
			</table></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">

                   

                    <thead>
                        <tr>
                             <th width="43">#</th>                             
                             <th width="94">Booking ID<img src="images/bg_arrow.gif"></th>
                             <th width="179">Name<img src="images/bg_arrow.gif"></th>
                             <th width="133">City<img src="images/bg_arrow.gif"></th>
                             <th width="196">Country<img src="images/bg_arrow.gif"></th> 
                             <th width="113">Room No.<img src="images/bg_arrow.gif"></th> 
                             <th width="147">Check In<img src="images/bg_arrow.gif"></th>
                             <th width="150">Mobile<img src="images/bg_arrow.gif"></th>
                             <th width="121">Status<img src="images/bg_arrow.gif"></th>                               
                             <th width="99">Action</th>
                            
                      </tr>
                    </thead>
                    <tbody>

                        <?php
                         $sql=mysql_query("select * from reservation  group by booking_id order by id desc");
						$i=1;
						while($r=mysql_fetch_array($sql))
			            {
						 
						 $id = $r['id'];

					 ?>    
                           
                                <tr class="del<?php echo $id ?>">
                                <td><?php echo $i; ?></td>                               
                                <td><?php echo $r['booking_id']; ?></td>
                                <td><?php echo $r['name']; ?></td>
                                <td><?php echo $r['city']; ?></td> 
                                <td><?php echo $r['country']; ?></td>
                                <td style=""><?php echo $r['room_no']; ?></td>
                                <td><?php echo $r['check_in_date']; ?></td>
                                <td><?php echo $r['mobile']; ?></td>
                                <td><?php echo $r['status']; ?></td>                               
                                <td align="center"><div style="float:left; width:20px;">&nbsp;</div><div style="float:left;">
                                <a href="membership.php?module=viewreservation&id=<?php echo $id ?>" title="View" class="icon-2 info-tooltip"><img src="images/application_view_list.png" / width="20"></a></div>
                                 <div style="float:left; width:20px;">&nbsp;</div><div style="float:left;">
                                <?php if($r['is_active']==1){ ?>
                                  <a href="students.php?activate=0&id=<?php echo $id ?>" title="Active" class="icon-2 info-tooltip"><img src="images/Accept.gif" / width="20"></a>                                
                                <?php }elseif($r['status']==0){ ?>
                                <a style="color:##0088CC;" href="students.php?id=<?php echo $id ?>&activate=1"  title="Deactive" ><img src="images/Remove1.png" / width="20"></a>
								<?php } ?>
                                
                                
                               </div>
                               
                                <div style="clear:both;"></div>
                               
					          
							  
							  

                                
                                
                            </tr>


                        <?php $i++; } ?>

                    </tbody>
                </table></td>
  </tr>
</table>
