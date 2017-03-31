// Get the modal



//Windows Side Menu

function openNav() {
	closeNav1();
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

//Registration
function openNav1() {
	closeNav();
	var winH = window.innerHeight;
    document.getElementById("mySidenav1").style.width = "25%";
    document.getElementById("main").style.marginLeft = "25%";
}

function closeNav1() {
    document.getElementById("mySidenav1").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}

// Get the modal
var modal1 = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
};