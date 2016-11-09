<?php 
include_once "functions/functions.php";
$room = '';
$bill = '';
$token = '';
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
 	if(isset($_POST['bill'])&&isset($_POST['room'])&&isset($_POST['ktoken'])){
       $bill = $_POST['bill'];
       $room = $_POST['room'];
       $billname = 'bills/'.$room.'.xml';
       $token =  $_POST['ktoken'];
       $billarray = json_decode($bill);
			       	 $itemarray = $billarray[0];
			       	 $quantityarray = $billarray[1];
			       	 $pricearray = $billarray[2]; 
			       	 
			       if(!file_exists($billname)){
			       	 $xml = new XMLWriter();
			            $xml->openmemory();
			            $xml->startDocument('1.0','UTF-8');
			             
			            $xml->startElement('bills');

			            $xml->startElement('bill');
			            $xml->writeAttribute('counter',0);
			            $xml->writeAttribute('token',$token);
			            
			            
			            $l = count($billarray)-1;
			            for($i=0;$i<$l;$i++){
			            $xml->startElement('item');
			            $xml->text($itemarray[$i]);
			            $xml->endElement();

			            $xml->startElement('quantity');
			            $xml->text($quantityarray[$i]);
			            $xml->endElement();

			            $xml->startElement('price');
			            $xml->text($pricearray[$i]);
			            $xml->endElement();
			            }


			            $xml->endElement();
			            
			            $xml->endElement();  

			            $xml->endDocument();

			            file_put_contents($billname, $xml->outputMemory());
			       }

			       else{

			       	$doc = new DOMDocument;
			       	$doc->load($billname);
			       	$thedoc = $doc->documentElement;
			       	$list = $thedoc->getElementsByTagName('bill');
                    $counter = 0;
			       	foreach ($list as $bill) {
			       	 	$counter++;
			       	 } 

			       	$billnode = $doc->createElement('bill');
			       	$billnode->setAttribute('counter',$counter);
			       	$billnode->setAttribute('token',$token);
                    $l = count($billarray)-1;

                    for($j=0;$j<$l+1;$j++){
                    $itemnode = $doc->createElement('item');
                    $itemtext = $doc->createTextNode($itemarray[$j]);
                    $itemnode->appendChild($itemtext);
                    $billnode->appendChild($itemnode);

                    $quantitynode = $doc->createElement('quantity');
                    $quantitytext = $doc->createTextNode($quantityarray[$j]);
                    $quantitynode->appendChild($quantitytext);
                    $billnode->appendChild($quantitynode);

                    $pricenode = $doc->createElement('price');
                    $pricetext = $doc->createTextNode($pricearray[$j]);
                    $pricenode->appendChild($pricetext);
                    $billnode->appendChild($pricenode);
                    
                    } 
                    $doc->documentElement->appendChild($billnode);

                        file_put_contents($billname, $doc->saveXML());
 			       }
     }
 }

?>