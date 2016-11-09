function getbills(){
	var roomno = document.getElementById('roomnumber').value;
	$.ajax({
		type:"post",
		url:"setsession.php",
		data:{room:roomno},
		success:function(data){
            $('#loading').fadeIn(200);
            location.reload();       
		},
		error:function(){

		}
	});
}
$(document).ready(function(){
	$('#loading').hide();

});