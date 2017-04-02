// Get the modal



//Windows Side Menu

function openNav() {
	var winH = window.innerHeight;
    document.getElementById("mySidenav").style.width = "25%";
    document.getElementById("wrapper").style.width = "70%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("wrapper").style.width = "90%";
}

// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};