<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/displaybill.css">
  <script type="text/javascript" src='jquery.js'></script>
</head>
<body>

<div id="container">
<div id='enterroom'><input type='text' id='roomnumber' placeholder='room_no'><input type="button" value='Get Bills' onclick="getbills()"></div>
<?php 
 $roomno = '';
 session_start();
 if(isset($_SESSION['room'])){
 	if($_SESSION['room']!=''){
 	$roomno = $_SESSION['room'];
 
 $billname = 'bills/'.$roomno.'.xml';
if(file_exists($billname)){
	echo "<div id='billabel' class='billcard'><div id='item' class='content'>Item</div><div id='quantity' class='content'>Quantity</div><div id='price' class='content'>Price</div></div>";

	$doc = new DOMDocument;
    $doc->load($billname);
    $thedoc = $doc->documentElement;
    $billcards = $thedoc->getElementsByTagName('bill');
   
 foreach ($billcards as $billcard) {
 	$itemarray =  array();
 	$quantityarray =  array();
 	$pricearray =  array();
 	$a = $billcard->getAttribute('counter');
 	$items = $billcard->getElementsByTagName('item');
    $quantitys = $billcard->getElementsByTagName('quantity');
 	$prices = $billcard->getElementsByTagName('price');
    
 	foreach ($items as $item) {
 		$itemarray[(count($itemarray))] = $item->nodeValue;
       }
      
 		

    foreach ($quantitys as $quantity) {
 		$quantityarray[(count($quantityarray))] = $quantity->nodeValue;
 	}

 	foreach ($prices as $price) {
 		$pricearray[(count($pricearray))] = $price->nodeValue;
 	}
 	
    echo"<div id='bill".$a."' class='a'>"; 
 	if($a==0){
 		$limit = count($items)+2; 
 	}
 	else{
  		$limit = count($items)+1; 

 	}
 	for($i=0;$i<$limit;$i++){
    
    echo "<div id='item".$a.$i."' class='content'>".$itemarray[$i]."</div>";
    echo "<div id='quantity".$a.$i."' class='content'>".$quantityarray[$i]."</div>";
    echo "<div id='price".$a.$i."' class='content'>".$pricearray[$i]."</div>";
    }
    
    echo "</div><div id='divider'></div>";

     }
   }
 }
}
?>

</div>
<script type="text/javascript" src='js/displaybill.js'></script>

</body>
</html>
