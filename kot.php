 <html>
 <head>
 	
 <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/common.css" rel="stylesheet" type="text/css" />
<link href='css/kot.css' rel='stylesheet' type='text/css'></link> 
<script src="jquery.js"></script>
<script src="jquery-ui.min.js"></script>

 </head>
 <body >

     <div id="storebill"><div id='close' onclick="restore()">Close</div><div style='margin-left:10%;color:white;' id='Ktoken'>Kitchen Token ::&nbsp &nbsp<span id='token'></span></div> <input name='booking_id' placeholder='Booking id' onblur='verify(this.id)' type='text' id='bid'/><input name='room' placeholder='Room No' type='text' id='roomno'/><input onclick="storebill()" type="button" value="Go" id='go'>  </div>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="17%" valign="top">
    <div class="onecolumn" style="margin-left:10px;">
      <div class="header"><span><span class="ico gray clipboard"></span>Order</span></div>
      <div class="clear"></div>
      <div class="content">
        <div class="grid6" align="center">

       <div id='order' class='mydivs'>
        <div class='mydivs order' >Item</div>
        <div class='mydivs order' >Quantity</div>
        <div class='mydivs order' >Price</div>
        <div id="bill" >
          <div id="total" >Total::</div>
          <div id="amount"><pre></pre></div>

          </div>

           </div>
         <div class="clear"></div>
        </div>
      </div>
    </div>
    </td>
    <td width="16%" valign="top">
    <div class="onecolumn" style="margin-left:10px;">
      <div class="header"><span><span class="ico gray home"></span>Items</span></div>
      <div class="clear"></div>
      <div class="content">
        <div class="grid6" align="center">
         
         <div id='choice' class='mydivs'>
         </div>
       
         <div class="clear"></div>
        </div>
      </div>
    </div>
    </td>
    <td width="8%" valign="top">
    <div class="onecolumn" style="margin-left:10px;">
      <div class="header"><span><span class="ico gray home"></span>Categories</span></div>
      <div class="clear"></div>
      <div class="content">
        <div class="grid6" align="center">
         
              <div id='items' class='mydivs'>
                          <?php /*enter the item categories into array from the  database*/
         include_once "categoryget.php";
       for($i=0;$i<count($items);$i++){
           echo "<div id='items".$i."' class='mydivs choice' onclick='getchoice(this.id)'>".$items[$i]."</div>";
        }?>

       </div>
   
         <div class="clear"></div>
        </div>
      </div>
    </div>
    </td>
    </tr>
    </table>
<div id='action'style='margin:1%;background:none;width:98%;' class='mydivs'>
                    <div id='action1' class='mydivs c' onclick="printdiv()">Print Bill</div>
                    <div id='action2' class='mydivs c' onclick="store()">Store Bill</div>
     
       </div>  
       
       
    
       

       <script type="text/javascript" src="js/kot.js"></script>
 </body>
 </html>
