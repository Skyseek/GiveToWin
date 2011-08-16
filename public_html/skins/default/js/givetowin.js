////////////////////////////////////////////////////////////////////////////////
//
// Give To Win
// Copyright © 2011 Give To Win
// All Rights Reserved.
//
// NOTICE:
//
// Give To Win does NOT permit you to use, modify, and/or distribute this file.
//
////////////////////////////////////////////////////////////////////////////////

function loginWithFacebook() {
	FB.login(function(response) {
		if (response.session) {
			location.href = "/Facebook/Login";
		} else {
			// user cancelled login
		}
	});
}

timer = {
    hourDiv:null,
    minutesDiv:null,
    secondsDiv:null,

    secondsLeft: 0,
    intervalID: null,

    init:function(secondsLeft) {
        this.hourDiv = $('hoursTimerDiv');
        this.minutesDiv = $('minutesTimerDiv');
        this.secondsDiv = $('secondsTimerDiv');
        this.secondsLeft = secondsLeft;


        this.intervalID = setInterval(timer.intervalHandler, 1000);
    },

    clear:function() {
      clearInterval(this.intervalID);
    },

    intervalHandler:function() {
        timer.secondsLeft--;

        var hours = 0;
        var minutes = 0;
        var seconds = timer.secondsLeft;

        if(seconds > 3600) {
            hours = Math.floor(seconds / 3600);
            seconds %= 3600;
        }

        if(seconds > 60) {
            minutes = Math.floor(seconds / 60);
            seconds %= 60;
        }

        timer.hourDiv.innerHTML = hours.toString();
        timer.minutesDiv.innerHTML = minutes.toString();
        timer.secondsDiv.innerHTML = seconds.toString();

        if(timer.secondsLeft == 0) {
            timer.clear();
        }
    }
}