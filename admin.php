<html>
 <head>
	<meta name="viewport" content="width:device-width,initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/admin.css">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">     
<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
<script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>

 </head>	
 <body>
   <div id='form' style='display:none;'>
    <div class='close' onclick='restore()'></div>
   <div id='popup_content'>
   </div>
   </div>

 <div id="holder">
 

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td width="20%" valign="top">
     <div class="onecolumn" style="margin-left:10px;position:relative;height:550px;overflow:auto">
       <div class="header"><span style='margin-left:30%;'><span class="ico gray pencil"></span>Actions</span></div>
        <div class="clear"></div>
         <div class="content">
            <div id='actions' class='grid5' align='center' >
              <table  width="100%" border="0" class='k'>               
                  <?php
                   // add the innermost  items here 
                   $menuitems = array("0"=>array('Room facilities','Room Classes','Room Types','Rooms'),"1"=>array('Set Categories','View items'),
                    "2"=>array("Rates","Tax-list","Rent Addons","Rate Prototypes"),"3"=>array("Floor List"),"4"=>array('POS points','POS categories','POS produts'),
                    "5"=>array("Users","User levels","User Rights"),"6"=>array('Discount Reasons','Discount Departments','Monetary Units'));
                   // the ids given to li and the div followed 
                   $ids = array("0"=>array('rul','rdrawer'),"1"=>array('kul','kdrawer'),"2"=>array('mul','mdrawer'),
                    "3"=>array('jul','jdrawer'),"4"=>array('hul','hdrawer'),"5"=>array('nul','ndrawer'),"6"=>array('dul','ddrawer'));
                   // the ids given to ol's 
                   $menutags = array("0"=>array('rfacilities','rclasses','rtypes','rooms'),"1"=>array('kcategories','kitems'),
                    "2"=>array('mrates','mtaxes','maddons','mprototypes'),"3"=>array('floorlist'),"4"=>array('ppoints','pcategories','pprodutcs'),
                    "5"=>array('users','userlevels','userrights'),"6"=>array('dreasons','ddepartments','munits'));
                   // the menu headings here :)
                   $titlearray = array('Room Setting`s','KOT Settings','Rates','Property Info','POS settings','Users','Accounting');   
                   for($i=0;$i<count($titlearray);$i++){
                    echo "<tr><td width='80%' ><div id='".$ids[$i][0]."' ><pre>".$titlearray[$i]."</pre></div><div id='".$ids[$i][1]."' >";
                    for($j=0;$j<count($menutags[$i]);$j++){
                         echo "<ol id=".$menutags[$i][$j]." onclick='parse(this.id)'><pre class='panel'>".$menuitems[$i][$j]."</pre></ol>";
                    } 
                    echo"</div></td></tr>";
                   }
                   ?>
              </table>
           </div> 
        </div>
     </div>    
   </td>
   <td width="100%" valign="top">
   <div class="onecolumn" style="margin-left:10px;">
  <div class="header"><span><span class="ico gray clipboard"></span>WorkSpace</span></div>
    <div class="clear"></div>
     <div class='content'>
     <table width="100%" border="0">
     <div id='display'></div>
       <div id="results" class='grid5'></div>
        <div id="footactions">
          <pre  id='addkey' onclick="add(0)">Add</pre><pre id='editkey' onclick="edit()"><img src='images/edit.png' style='margin-right:7%;' width='16' height='16'>Edit</pre><pre id='delkey' onclick="del()"><img src='images/trash.png' style='margin-right:7%;' width='16' height='16'>Delete</pre><pre id='refreshkey' onclick="refresh()"><img src='images/eeArrow.png' style='margin-right:7%;' width='16' height='16'>Refresh</pre>
        </div>
     </div>
    </table>
    </div>
  </div>
  </td>
</tr>
  </table> 
  </div>
   <script type="text/javascript" src='js/adminextra.js'></script>
  <script type="text/javascript" src='js/admin.js'></script>
  <script type="text/javascript" src='js/arrayfunctions.js'></script>
  <script type="text/javascript" src='js/adminfunctions.js'></script>  
</body>
</html> 
