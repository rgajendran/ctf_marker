$(document).ready(function(){
	$('#login_usr').focus();
	$('#login_psw').keypress(function(event){
		var key = (event.keyCode ? event.keyCode : event.which);
		if(key == 13){
			loginCheck();
		};
	});
	$('#login_submit').click(function(){
		loginCheck();
	});
});



var loginCheck = function(){
	var usr = $('#login_usr').val();
	var psw = $('#login_psw').val();
	$.ajax({
		method: "POST",
		url: "template/logincheck.php",
		data: {uname: usr, psw: psw},
		success: function(status){
			$('#login_status').html(status);
			$('#login_usr').val(usr);
			$('#login_psw').val('');
			var slogstat = $('#login_status').text();
			if(slogstat == "Login Success"){
				$(location).attr("href", "./main.php");
			}else if(slogstat == "Admin Login"){
				$(location).attr("href", "./admin.php");
			}
		}	
	});
};