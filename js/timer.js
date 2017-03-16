// Set the date we're counting down to
//var time = document.getElementById("SSeam").innerHTML document.getElementById("SSTime").value
//var countDownDate = new Date("Feb 14, 2017 23:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    var countDownDate = new Date(endtime).getTime();
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    if(hours.length < 2){
    	hours = "0"+hours;
    }
    
    // Output the result in an element with id="demo"
    document.getElementById("timer").innerHTML = (hours<10?'0':' ')+ hours  + " : " + (minutes<10?'0': '')+minutes + " : " + (seconds<10?'0':' ')+seconds;
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("timer").innerHTML = "TIME UP";
    }
}, 1000);