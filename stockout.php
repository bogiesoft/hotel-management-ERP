<link rel="stylesheet" type="text/css" href="css/stockout.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="botborder">
			  <tr>
         <td width="30%" ><h2 style="padding-left:15%;border:0px" ><img src="images/users.png" width="45" />Stock Out</h2></td>
			
				<td >&nbsp;<span style='margin-left:65%;margin-right:2%;'><strong>no of rows:</strong></span>
	      <select id='tablerow' onchange='generatetable(this.value)'><option></option>
	       <?php
	        for($i=0;$i<50;$i++){
	        	echo "<option>".($i+1)."</option>";
	        }
	       ?>	
	      </select>
	      </td><td></td>
			  </tr>
			</table>
			<div id='container' style='width:80%;margin-left:10%;' class='responsive'>
      <?php
      $headerarray = array("#","Code","Item","Price  (per unit)","Available","Required","Actions","&nbsp");
        echo "<table id ='stockout' style='border-collapse:collapse;margin-top:2%;'class='table table-striped table-bordered' >";
         echo "<thead>";
		          echo "<tr>";
		           for($i=0;$i<count($headerarray);$i++){
		           	echo "<th id='th".$i."' style='text-align:center'>".$headerarray[$i]."</th>";
		           }
		          echo "</tr>";
         echo "</thead>";
         echo "<tbody>";
		         for($i=0;$i<7;$i++){
		        	echo "<tr id='tr".$i."'>";

		        	  for($j=0;$j<count($headerarray);$j++){
		        	   if($headerarray[$j]=="Actions") echo "<td  id='td".$i.$j."' onclick='getsingle(this.id)'><div><pre>Get</pre></div></td><td  id='reset".$i.$j."' onclick='resetsingle(this.id)'><div><pre>Reset</pre></div></td>";
		        	   else if($headerarray[$j]=='&nbsp'){}
		        	   else if($headerarray[$j]=='Required'){  echo "<td style='width:20%' id='td".$i.$j."'><select id='maxlimit".$i."' type='text' style='margin-left:15%;width:30%;height:10%;margin-right:3%;float:left;'><option></option></select><span id='units".$i."' style='width:35%;height:10%;float:left'></span></td>";}
	 		           else if($headerarray[$j]=='Code'){
                           echo "<td id='td".$i.$j."'><input class='form-control' type='text' style='margin-left:15%;margin-right:4%;float:left;'><pre id='pre".$i.$j."' onclick='retrieverow(this.id)' style='cursor:pointer;width:10%;padding:1%;float:left;'>Get</pre></td>";
	 		           }
	 		           else if($headerarray[$j]!='#') echo "<td id='td".$i.$j."'></td>";
		        	   else echo "<td id='td".$i.$j."' width='5%' style='text-align:center'>".($i+1)."</td>";
		        	  }
                      
		        	echo "</tr>";
		         }
                  echo "<tr><td></td><td onclick='reset()'><div class='inputbtn'><pre>Reset</pre></div></td><td></td><td></td><td></td><td onclick='getall()'><div class='inputbtn'><pre>Get</pre></div></td><td></td><td></td></tr>";
		   
         echo "</tbody>";
        echo "</table>";
      ?>
      </div>
      <script type="text/javascript" src='js/stockout.js'></script>
