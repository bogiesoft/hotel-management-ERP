<html>
 <head>
    <meta name="viewport" content="width:device-width,initial-scale=1">
 	<link rel="stylesheet" type="text/css" href="css/stockin.css">
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
 	<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
     <script type="text/javascript">
     var suppliers = [];
      function getsuppliers(str){
      	suppliers = JSON.parse(str);
      }
     </script>
 </head>
 

<body>
       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="botborder">
			  <tr>
         <td width="30%" >
          <h2 style="padding-left:20%;border:0px" ><img src="images/users.png" width="45" />Stock In</h2></td>
			
				<td >&nbsp;<span style='margin-left:70%;margin-right:2%;'><strong>no of entries:</strong></span>
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
      <?php
      $options = '';
      $suppliers = array();
        $query = "SELECT * FROM master_suppliers";
        $result = mysql_query($query);
        $i = 0;
		while($obj = mysql_fetch_object($result)){
			$suppliers[$i] = $obj->supplier;
			$options.="<option>".$obj->supplier."</option>";
			$i++;
		}

      $headerarray = array("#","Code","Item","Price  (per unit)","Supplier","Quantity","Actions","&nbsp");
        echo "<table id ='tablestockin' style='margin-top:2%;border-collapse:collapse;margin-left:6%;'class='table table-striped table-bordered' >";
         echo "<thead>";
		          echo "<tr>";
		           for($i=0;$i<count($headerarray);$i++){
		           	echo "<th id='th".$i."' style='text-align:center'>".$headerarray[$i]."</th>";
		           }
		          echo "</tr>";
         echo "</thead>";
         echo "<tbody>";
		         for($i=0;$i<10;$i++){
		        	echo "<tr id='tr".$i."'>";

		        	  for($j=0;$j<count($headerarray);$j++){
		        	   if($headerarray[$j]=="Actions") echo "<td id='td".$i.$j."' style='width:10%;' onclick='storesingle(this.id)'><div><pre>Store</pre></div></td><td style='width:10%;' id='reset".$i.$j."' onclick='resetsingle(this.id)'><div><pre>Reset</pre></div></td>";
		        	   else if($headerarray[$j]=='&nbsp'){}
		        	   else if($headerarray[$j]=='Supplier'){ echo "<td style='width:20%' id='td".$i.$j."'><select id='select".$i.$j."' style='width:80%;height:10%;float:left;margin-left:5%;'>".$options."</select></td>";}
		        	   else if($headerarray[$j]=='Quantity'){  echo "<td style='width:25%' id='td".$i.$j."'><input class='form-control' type='text' style='margin-left:2%;margin-right:1%;float:left;'><select style='width:20%;height:10%;float:left'><option>Kg</option><option>Litre</option><option>Units</option></select></td>";}
	 		           else if($headerarray[$j]!='#') echo "<td id='td".$i.$j."'><input class='form-control' type='text' style='margin-left:15%'></td>";
		        	   else echo "<td id='td".$i.$j."' width='5%' style='text-align:center'>".($i+1)."</td>";
		        	  }
                      
		        	echo "</tr>";
		         }
                  echo "<tr><td></td><td></td><td></td><td></td><td onclick='reset()'><div class='inputbtn'><pre>Reset</pre></div></td><td onclick='storeall()'><div class='inputbtn'><pre>Store</pre></div></td><td></td></tr>";
		   
         echo "</tbody>";
        echo "</table>";

        
        echo "<script type='text/javascript'>getsuppliers('".json_encode($suppliers)."')</script>";
      ?>
      <script type="text/javascript" src='js/stockin.js'></script>
</body>
</html> 
