<link rel="stylesheet" type="text/css" href="css/frontdesk.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
<link href="css/jquery-ui.css" rel="stylesheet">

<script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>

<div id='form' style='display:none;'>
   <div class='close' onclick='restore()'></div>
   <div id='popup_content'>
    <?php include_once"reserveform.php";?>
    <?php include_once"groupreserve.php";?>
   </div>
   </div>
<div id='holder'>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="13%" valign="top">
    <div class="onecolumn" style="margin-left:10px;">
      <div class="header"><span><span class="ico gray clock"></span>Calendar</span></div>
      <div class="clear"></div>
      <div class="content">
        <div class="grid6" align="center">
          <div id="datepicker"></div>
		  

          <div class="clear"></div>
        </div>
      </div>
    </div>
    <div class="onecolumn" style="margin-left:10px;">
      <div class="header"> <span ><span class="ico gray pencil"></span>Info</span></div>
      <div class="clear"></div>
      <div class="content" >
        <div  class="grid5" align="center">

          <table width="100%" border="0">
            <tr>
              <td>
                <div style="margin-left:40%;border:1px solid black;width:16px;height:16px;background:cyan;padding:1px;"></div>
              </td>  
              <td>
                  <span style="margin-left:30%;float:left;font-weight:bold">Reserved</span>
              </td>
              </tr>
            <tr>
              <td>
                <div style="margin-left:40%;border:1px solid black;width:16px;height:16px;background:#3660ff;padding:1px;"></div>
              </td>
              <td>
                <span style="margin-left:30%;float:left;font-weight:bold">Check-In</span>
              </td>
            </tr>
            <tr>
              <td>
                <div style="margin-left:40%;border:1px solid black;width:16px;height:16px;background:#991f5c;padding:1px;"></div>
              </td>
              <td>
                <span style="margin-left:30%;float:left;font-weight:bold">Blocked</span>
              </td>
            </tr>
            <tr>
              <td>
                <div style="margin-left:40%;border:1px solid black;width:16px;height:16px;background:#dddddd;padding:1px;"></div>
              </td>
              <td>
                <span style="margin-left:30%;float:left;font-weight:bold">Available</span>
              </td>
            </tr>
          </table>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    </td>
    <td width="75%" valign="top">
    <div class="onecolumn" style="margin-left:10px;">
      <div class="header"><span><span class="ico gray clipboard"></span>Dashboard</span></div>
      <div class="clear"></div>
      <div class="content">
      <div class="grid1" align="center" id='1day' onclick='processview(this.id)' style='width:10%;border:1px solid cyan;padding:1%;margin-right:0%;border-bottom:0;cursor:pointer;'><span>1 Day View</span></div>
      <div class="grid1" align="center" id='3day' onclick='processview(this.id)' style='width:10%;padding:1%;cursor:pointer;margin-right:0%;border-bottom:1px solid cyan'><span>3 Day View</span></div>
      <div class="grid1" align="center" id='7day' onclick='processview(this.id)' style='width:10%;padding:1%;cursor:pointer;margin-right:0%;border-bottom:1px solid cyan'><span>7 Day View</span></div>
      <div class="grid1" align="center" id='15day' onclick='processview(this.id)' style='width:10%;padding:1%;cursor:pointer;margin-right:0%;border-bottom:1px solid cyan'><span>15 Day View</span></div>
      <div class="grid1" align="center" id='30day' onclick='processview(this.id)' style='width:10%;padding:1%;cursor:pointer;margin-right:0%;border-bottom:1px solid cyan'><span>30 Day View</span></div>

        <div class="grid5" align="center" id='display' style='border:1px solid cyan;border-top:0;border-right:0;padding-left:1%;'>

        <div class="clear"></div>
        </div>
      </div>
    </div>
    </td> 
  </tr>
</table>
</div>
               <div class="clear"></div>
<!-- // End onecolumn -->
                    
                    
<!-- // End onecolumn -->
<script type="text/javascript" src='js/jquery-ui.js'></script>	                    
<script type="text/javascript" src="js/multiplereserv.js"></script>

<script type="text/javascript" src="js/frontdesk.js"></script>                 
<script type="text/javascript" src="js/ndview.js"></script>  
