// Get the modal

function alert(){
	var modal = document.getElementById('myModal');
	
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	
	// When the user clicks the button, open the modal 
	this.menu = function(cid,country,h1,h2,h3) {
	    modal.style.display = "block";
	    document.getElementById('dialog-title').innerHTML = country;
	    document.getElementById('dialog-id').innerHTML = cid;
	    //-------------------------------------------------------------------
	    if(h1 == "Hint 1 (Not Disclosed)"){
	    	var color1 = "red";
	    }else{
	    	var color1 = "green";
	    }
	    if(h2 == "Hint 2 (Not Disclosed)"){
	    	var color2 = "red";
	    }else{
	    	var color2 = "green";
	    }
	    if(h3 == "Hint 3 (Not Disclosed)"){
	    	var color3 = "red";
	    }else{
	    	var color3 = "green";
	    }	    	    
	    //-------------------------------------------------------------------
	    document.getElementById('hint1').style.color = color1;
	    document.getElementById('hint2').style.color = color2;
	    document.getElementById('hint3').style.color = color3;
	    document.getElementById('hint1').innerHTML = h1;
	    document.getElementById('hint2').innerHTML = h2;
	    document.getElementById('hint3').innerHTML = h3;
	    var c = "green";
	    if(color1 === c && color2 === c && color3 === c){
	    	document.getElementById('fsubmit').innerHTML= "Show Answer ( 0 Points )";
	    }
	};
	
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	    modal.style.display = "none";
    	var text = document.getElementById('flag_hint').innerText;
        refresh();
	    document.getElementById('flag_hint').innerHTML = "Status";
	};
	
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	        var text = document.getElementById('flag_hint').innerText;
	        refresh();
	        document.getElementById('flag_hint').innerHTML = "Status";
	    }
	};
	
	function refresh(){
		//location.reload();
		$('#main').load('#wrapper');
		var l = document.getElementById("main").style.marginLeft;
		var ll = document.getElementById("mySidenav").style.width;
		if(l == "25%" && ll == "25%"){
			closeNav();
		}
	}
}

var Alert = new alert();

//Windows Side Menu

function openNav() {
	var winH = window.innerHeight;
    document.getElementById("mySidenav").style.width = "25%";
    document.getElementById("main").style.marginLeft = "25%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}

// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};