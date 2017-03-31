var x = setInterval(function() {

    var now = new Date().getTime();
    var countDownDate = new Date(endtime).getTime();
    var distance = countDownDate - now;
    
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    if(hours.length < 2){
    	hours = "0"+hours;
    }
    
    document.getElementById("timer").innerHTML = (hours<10?'0':' ')+ hours  + " : " + (minutes<10?'0': '')+minutes + " : " + (seconds<10?'0':' ')+seconds;
    
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("timer").innerHTML = "TIME UP";
    }
}, 1000);