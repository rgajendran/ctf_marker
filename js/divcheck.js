$(document).ready(function(){
	var div1 = document.getElementById('grouperId1').offsetHeight;
	var div2 = document.getElementById('grouperId2').offsetHeight;
	var div3 = document.getElementById('grouperId3').offsetHeight;
	
	$('.grouper_map').height(Math.max(div1, div2, div3));
});
