$(document).foundation();

////////////////////////
// Timer JS
////////////////////////

function getTimeRemaining(endtime){
    var t = Date.parse(endtime);
    var seconds = Math.floor( (t/1000) % 60 );
    var minutes = Math.floor( (t/1000/60) % 60 );
    var hours = Math.floor( (t/(1000*60*60)) % 24 );
    var days = Math.floor( t/(1000*60*60*24) );
    return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
    };
}

console.log(getTimeRemaining(endtime));

function initializeClock(id, endtime){
    var clock = document.getElementById(id);
    var timeinterval = setInterval(function(){
        var t = getTimeRemaining(endtime);
        clock.innerHTML = 'days: ' + t.days + '<br>' +
            'hours: '+ t.hours + '<br>' +
            'minutes: ' + t.minutes + '<br>' +
            'seconds: ' + t.seconds;
        if(t.total<=0){
            clearInterval(timeinterval);
        }
    },1000);
}

initializeClock('clockdiv', deadline);