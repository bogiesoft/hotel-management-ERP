<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/stockdisplay.css">
<script type="text/javascript" src='js/jquery-ui.js'></script>                      
<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
<link href="css/jquery-ui.css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" valign="top">
    <div class="onecolumn" style="margin-left:10px;">
      <div class="header"><span><span class="ico gray clock"></span>Calendar</span></div>
      <div class="clear"></div>
      <div class="content">
        <div class="grid6" align="center">
              <div id="datepicker"></div>
              <div style='margin-top:10%;'>
              <span><strong>Start Date:- &nbsp</strong></span>
              <input type="datetime-local" onblur ='firequery(this.value)' id='start_date' name="start_date" value="" style="height:25px; width:180px;">
              </div>
              <div style='margin-top:5%;'>
              <span><strong>End Date:- &nbsp</strong></span>
              <input type="datetime-local" onblur ='firequery(this.value)' id='end_date' name="end_date" value="" style="height:25px; width:180px;">
              <div id='get' style='cursor:pointer;width:80%;border:1px solid blue;padding:2.5%;color:white;background:#2298d4;margin-top:6%;' onclick='query()'>Get Details</div>
              </div>
       </div>
       </div>
       </div>
       </td>
       <td width="67%" valign="top">
    <div class="onecolumn" style="margin-left:10px;">
      <div class="header"><span><span class="ico gray clipboard"></span>Transactions</span></div>
      <div class="clear"></div>
      <div class="content">
      <div class="grid6" align="center">

       <div id='display' style='width:100%;height:100%;'></div>
       </div>
       </div>
       </div>
       </td>
    
       </tr>

       </table>
<script type="text/javascript" src='js/stockdisplay.js'></script>