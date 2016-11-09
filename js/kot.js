        $(document).ready(function(){
          $('#storebill').hide();
        	$('#loading').hide();
        	$('#choice').hide();
        	$('#action').hide();
        	$('#items').hide();
            $('#items').fadeIn(1000);
            $('#choice').fadeIn(1000);
            $('#action').fadeIn(1000);
            $('body').css('height','100%');
        });

/*this is to append the items with chosen category from database*/
        var datarray  = [];
        var pricearray 
        var namearray = [];
        
        function verify(id){
          var val = document.getElementById(id).value;
             $.ajax({
              type:"post",
              url:"kotverify.php",
              data:{id:val},
              success:function(data){
                 if(isNaN(parseInt(data))){
                  alert("No reservation found with the given id , please manually verify in the record ");
                  document.getElementById('roomno').value = '';
                }
                 else{document.getElementById('roomno').value = data;}
              },
              error:function(){
                alert("failed");
              }
             });

        }
        
        function restore(){
           
        $('#header').css('opacity','1');
        $('#footer').css('opacity','1');
        $('#choice').css('opacity','1');
        $('#order').css('opacity','1');
        $('#header').css('opacity','1');
        $('#items').css('opacity','1');
        $('#action').css('opacity','1');
        $('#storebill').fadeOut(300).animate({opacity:'-=0.6'},200);
     
         
        } 


         function getchoice(id){
        	$('#choice').html('');
        	$('#choice').css('padding-top','35%');
        	var a = document.getElementById(id).innerHTML;
        	a = a.toLowerCase();
        	$('#loading').fadeIn(500);        
          $.ajax({
          	url:"getitems.php",
          	type:"post",
          	data:{category:a},
          	success: function(data){
          		
          	  pricearray = [];
          		datarray = data.split(',');
              datarray = datarray.slice(0,datarray.length-1);
                
          		for(i=0;i<datarray.length;i++){
          			if(i%2==0&&datarray[i]!==''){
                  namearray[i/2] = datarray[i];
                  document.getElementById('choice').innerHTML+="<div id='choice"+i/2+"'  class='mydivs a' onclick='addorder(this.id)'>"+datarray[i]+"</div>";
                }
                else{
                  pricearray[pricearray.length] = datarray[i];
                }
              }  
          
		        $('#choice').css('padding-top','3%');
		        $('#loading').fadeOut(200);
          	},
          	error: function(){
          		
          	}
          });
          }
      
     function store(){
       var tok = token();
      document.getElementById('token').innerHTML = tok;
      
        $('#header').css('opacity','0.5');
        $('#footer').css('opacity','0.5');
        $('#choice').css('opacity','0.5');
        $('#order').css('opacity','0.5');
        $('#header').css('opacity','0.5');
        $('#items').css('opacity','0.5');
        $('#action').css('opacity','0.5');
        $('#storebill').fadeIn(300).animate({opacity:'+=0.6'},200);
     
     } 
     var rand = function() {
    return Math.random().toString(36).substr(2); // remove `0.`
    };

    var token = function() {
        return rand() + rand(); // to make it longer
    };

    function storebill(){
      var room = document.getElementById('roomno').value;
      var billarray = [];
      var Name = [];
      var Price = [];
      var Quantity = [];
      var l = document.getElementsByClassName('mydivs order').length/3;

      for(i=0;i<l-1;i++){
        order = document.getElementById('order'+i).innerHTML;
        quantity = parseInt(document.getElementById('quantity'+i).innerHTML);
        price = parseInt(document.getElementById('price'+i).innerHTML);

        Name[Name.length] = order;
        Quantity[Quantity.length] = quantity;
        Price[Price.length] = price;
        
      } 

      billarray[0] = Name;
      billarray[1] = Quantity;
      billarray[2] = Price;


      billarray = JSON.stringify(billarray);
      var t = document.getElementById('token').innerHTML;
      $.ajax({
        url:"storebill.php",
        type:"post",
        data:{bill:billarray,room:room,ktoken:t},
        timeout:2000,
        success: function(data){
          alert(data);
           restore();
        },
        error: function(){
          alert("failed");
        }
      });
      
     }

     function printdiv(){
            var divElements = document.getElementById('order').innerHTML;
            var oldPage = document.body.innerHTML;
            
            document.body.innerHTML = "<html><title>Bill</title><link rel='stylesheet' href='common.css'><link rel='stylesheet' href='css/bill.css'></link><body><div id='order' class='mydivs'>"+divElements+"<div id='thanks'>Thanks for using our services !!&#9787</div></div></body></html>";
            setTimeout(function(){
              window.print();
              document.body.innerHTML = "<html><head><link rel='stylesheet' href='common.css'></link><link rel='stylesheet' href='css/kot.css'></link><script src='jquery.js'></script></head><body>"+oldPage+"</body></html>";
    
            },100) }
    /*this is to add the order and make the bill*/


    function addorder(a){
    	$('#loading').fadeIn(100);
      $('#bill').remove();
    	b = document.getElementById(a).innerHTML;
    	var key  = namearray.indexOf(b);
      if(key==-1)
        key = 0;
      var match = 0;
      var size = document.getElementsByClassName('mydivs order');
      var n = 1;
      var price;
      if(size.length/3>1){
        
        for(i=0;i<(size.length/3)-1;i++){
        var item = document.getElementById('order'+i).innerHTML;
        if(b == item){
         price = document.getElementById('price'+i).innerHTML;
          n = (price/pricearray[key])+1;
          price = pricearray[key]*n;
          document.getElementById('price'+i).innerHTML=price;
          document.getElementById('quantity'+i).innerHTML=n;
          var total = 0;
       for(i=0;i<(size.length/3)-1;i++){
          price = document.getElementById('price'+i).innerHTML;
          price = parseInt(price);
          total+=price;
       }
       document.getElementById('order').innerHTML+="<div id='bill' ><div id='total'>Total::</div><div id='amount'><pre>"+total+"</pre></div></div>"   

          match = 1;
        }
      }
       if(match==0){
          a = (size.length/3)-1;
       document.getElementById('order').innerHTML+="<div class='mydivs order' id='order"+a+"' class='b'>"+b+"</div>";
       document.getElementById('order').innerHTML+="<div class='mydivs order' id='quantity"+a+"' class='b'>"+n+"</div>";
       document.getElementById('order').innerHTML+="<div class='mydivs order' id='price"+a+"' class='b'>"+pricearray[key]+"</div>";
       var total = 0;
       for(i=0;i<(size.length/3)-1;i++){
          price = document.getElementById('price'+i).innerHTML;
          price = parseInt(price);
          total+=price;
       }
       document.getElementById('order').innerHTML+="<div id='bill'><div id='total'>Total::</div><div id='amount'><pre>"+total+"</pre></div></div>"   
 }
     }
      else{ 
       a = (size.length/3)-1;
       document.getElementById('order').innerHTML+="<div class='mydivs order' id='order"+a+"' class='b'>"+b+"</div>";
       document.getElementById('order').innerHTML+="<div class='mydivs order' id='quantity"+a+"' class='b'>"+n+"</div>";
       document.getElementById('order').innerHTML+="<div class='mydivs order' id='price"+a+"' class='b'>"+pricearray[key]+"</div>";
       var total = 0;
       for(i=0;i<(size.length/3)-1;i++){
          price = document.getElementById('price'+i).innerHTML;
          price = parseInt(price);
          total+=price;
       }
       document.getElementById('order').innerHTML+="<div id='bill'><div id='total'>Total::</div><div id='amount'><pre>"+total+"</pre></div></div>"   

      }
      $('#loading').fadeOut(100); 
  
    	
    }      
