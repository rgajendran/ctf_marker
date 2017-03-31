$(document).ready(function(){
			$('#signup').click(function(){
				regis();
			});
		});
		
var regis = function(){
			var username = $('#usr').val();
			var password = $('#psw').val();
			var repassword = $('#psw-repeat').val();
			var token = $('#tkn').val();
			$.ajax({
				method: "POST",
				url: "template/register.php",
				data: {usr: username, ps1: password, ps2: repassword, tkn:token},
				success: function(status){
					$('#reg_status').html(status);
				}
			});
};