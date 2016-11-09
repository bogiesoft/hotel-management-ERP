$(document).ready(function(){
	$('#messagepanel').hide();	
});
var numlock = 0;
var key = 0;
$(document).keypress(function(event){
	if(numlock==0){
   if((event.which==77||event.which==109)&&key == 0){
     $('#messagepanel').fadeIn(200).animate({'margin-left':'-=12%'},300);
     key++;
   }
   else{
   	$('#messagepanel').fadeOut(200).animate({'margin-left':'+=12%'},300);
     key--;
   }
 }
});