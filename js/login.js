$(document).ready(function () {	  
			$('#login').show().animate({   opacity: 1 }, 2000);
			$('.logo').show().animate({   opacity: 1,top: '40%'}, 800,function(){			
			$('.logo').show().delay(1200).animate({   opacity: 1,top: '12%' }, 300,function(){
				$('.formLogin').animate({   opacity: 1,left: '0' }, 300);
				$('.userbox').animate({ opacity: 0 }, 200).hide();
			 });		

			  })	
			$(".on_off_checkbox").iphoneStyle();
			$('.tip a ').tipsy({gravity: 'sw'});
			$('.tip input').tipsy({ trigger: 'focus', gravity: 'w' });
		});	
	    $('.userload').click(function(e){
			$('.formLogin').animate({   opacity: 1,left: '0' }, 300);			    
			  $('.userbox').animate({ opacity: 0 }, 200,function(){
				  $('.userbox').hide();				
			   });
	    });
	    
	$('#but_login').click(function(e){				
		  if(document.formLogin.username.value == "" || document.formLogin.password.value == "")
		  {
			  showError("Please Input Username / Password");
			  $('.inner').jrumble({ x: 4,y: 0,rotation: 0 });	
			  $('.inner').trigger('startRumble');
			  setTimeout('$(".inner").trigger("stopRumble")',500);
			  setTimeout('hideTop()',5000);
			  return false;
		  }		
		 hideTop();
		 loading('Checking',1);	

		 
		 
	var gg;
	var uname=$("#username_id").val();
	var password=$("#password").val();	
	if ($('#on_off').is(":checked"))
	{
	var remember=1;
	}else{
	var remember=0;	
		}
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		gg=xmlhttp.responseText;
		
	//alert(gg);
	
	setTimeout( "unloading()", 2000 );
	if(gg == 2){ 
	 setTimeout('loginwrong("Invalid login. Try again!")',1000);
	 setTimeout('hideTop()',8000);
	 //setTimeout( "Login()", 2500 );
	}else{
	setTimeout( "Login()", 2500 );
	}
	
	}
	}
	xmlhttp.open("GET","loginchk.php?q="+uname+"&p="+password+"&remember="+remember,true);
	xmlhttp.send();
		 
	});	

		
																 
function Login(){
	
	$("#login").animate({   opacity: 1,top: '49%' }, 200,function(){
		 $('.userbox').show().animate({ opacity: 1 }, 500);
			$("#login").animate({   opacity: 0,top: '60%' }, 500,function(){
				$(this).fadeOut(200,function(){
				  $(".text_success").slideDown();
				  $("#successLogin").animate({opacity: 1,height: "200px"},500);   			     
				});							  
			 })	
     })	
			setTimeout( "window.location.href='membership.php?module=dashboard'", 3000 );
}


	
$('#alertMessage').click(function(){
	hideTop();
});

function showError(str){
	$('#alertMessage').addClass('error').html(str).stop(true,true).show().animate({ opacity: 1,right: '10'}, 500);	
	
}

function showSuccess(str){
	$('#alertMessage').removeClass('error').html(str).stop(true,true).show().animate({ opacity: 1,right: '10'}, 500);	
}

function hideTop(){
	$('#alertMessage').animate({ opacity: 0,right: '-20'}, 500,function(){ $(this).hide(); });	
}	
function loading(name,overlay) {  
	  $('body').append('<div id="overlay"></div><div id="preloader">'+name+'..</div>');
			  if(overlay==1){
				$('#overlay').css('opacity',0.1).fadeIn(function(){  $('#preloader').fadeIn();	});
				return  false;
		 }
	  $('#preloader').fadeIn();	  
 }
 function unloading() {  
		$('#preloader').fadeOut('fast',function(){ $('#overlay').fadeOut(); });
 }




function loginwrong(str) {
	$('#alertMessage').addClass('error').html(str).stop(true,true).show().animate({ opacity: 1,right: '10'}, 500);
}
