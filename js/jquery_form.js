		$(document).ready(function(){
			$(".map__image").draggable();
		});
		//Chat
		$(document).ready(function(){
   			$("#chat").click(function(){
        		$("#info_chat").slideToggle("slow");
    		});
		});
		
		$(document).ready(function(){
			$('#fsubmit').click(function(){
				gethint();
			});
			
			//$('#fhint').click(function(){
			//	var coun_id1 = $('#dialog-id').text();
			//	var team1 = $('#SSteam').val();
			//	$.ajax({
			//	method: "POST",
			//	url: "template/flagcheck.php",
			//	data: {type: "hint", cid: coun_id1, team: team1},
			//	success: function(status){
			//		$('#flag_hint').html(status);
			//		$('#modal-country-flag').val('');
			//	}
			//});
			//});
		});
		var gethint = function(){
			var coun_id = $('#dialog-id').text();
			$.ajax({
				method: "POST",
				url: "template/gethint.php",
				data: {cid: coun_id, team: tm1},
				success: function(status){
					var data = status;
					var arr = data.split('?');
					$('#hint1').html(arr[0]);
					$('#hint2').html(arr[1]);
					$('#hint3').html(arr[2]);
				}
			});
		};	
		//chat
		$(document).ready(function(){
			$('#div3_chat_input').keypress(function(event){
				var key = (event.keyCode ? event.keyCode : event.which);
				if(key == 13){
					var chat = $('#div3_chat_input').val();
					$.ajax({
						method: "POST",
						url: "template/chat.php",
						data: {team: tm1, chat: chat, user: user},
						success: function(status){
							$('#div3_chat_input').val('');
						}
					});
				}
			});
		});	