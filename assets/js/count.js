function checkOut(){

    $.ajax({
        type: 'POST',
        url: './sql.php',
        data: {
            getSession: 2
        },
        dataType: 'json',
        success: function (response) {

            $.each(response, function (key,data) {
                terminateSession(data.endTime,data.studentNo)
            });

        }
    });

}

function terminateSession(time,id){

    var date = new Date();
    var today = new Date(date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate()+' '+time);
    var compare = new Date();

    if(today.getTime() < compare.getTime()) {

        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {
                endBooking: id
            },
            dataType: 'json',
            success: function (response) {
                window.location.reload();
            }
        });
    }

}

function getCount(){

    var d = new Date();

    var time = new Date(d.getFullYear()+'-'+(d.getMonth()+1)+'-'+d.getDate()+' '+localStorage.getItem('sessionEnd'));
    var start = localStorage.getItem('sessionStart');

    var hrs = time.getHours();
    hrs = Math.floor(hrs*60);
    var min = time.getMinutes();
    var firstHr = hrs+min;

    var hrs2 =new Date().getHours();
    hrs2 = Math.floor(hrs2*60);
    var min2 = new Date().getMinutes();
    var lastHr = hrs2+parseInt(min2);

    var dif = firstHr - lastHr;

    if(!isNaN(dif)) {

        var date = new Date();
        var today = new Date(date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate()+' '+start);
        var compare = new Date();

        $('.time-bar-count').css('color', '#8a8d93').html(dif + ' Mins');
        $('.time-bar').css('width', (dif / (Math.floor(parseInt(localStorage.getItem('sessionDur'))*60)))*100 + '%');


        if (dif < 20) {
            $('.time-bar-count').css('color', 'red');
        }

        if (dif < 1) {
            $('.time-bar-count').css('color', '#8a8d93').html('0 Mins');
            $.ajax({
                type: 'POST',
                url: './sql.php',
                data: {
                    complete: localStorage.getItem('sessionID')
                },
                dataType: 'json',
                success: function (response) {

                }
            });

            localStorage.removeItem('sessionStart');
            localStorage.removeItem('sessionEnd');
            localStorage.removeItem('sessionDur');
            localStorage.removeItem('sessionID');
        }
    }

}

setInterval(function () {
    getCount();
    //checkOut();
},8000);

getCount();
//checkOut();


function loadData(){
    $.ajax({
        type: 'POST',
        url: './sql.php',
        data: {loadData:1},
        dataType: 'json',
        success: function(response){

            var cancelled=0;
            var accepted = 0;
            var pending = 0;


            $.each(response,function (key,data) {
                if(data.status=='accepted'){
                    accepted++;
                }else if(data.status=='pending'){
                    pending++;
                }else if(data.status=='cancelled'){
                    cancelled++;
                }
            });

            $('.tot-booking').text('Total Bookings('+response.length+')');
            $('.act-booking').text('Scheduled Booking('+pending+')');
            $('.can-booking').text('Cancelled Bookings('+cancelled+')');
        }
    });



    $.ajax({
        type: 'POST',
        url: './sql.php',
        data: {
            getSession: 5
        },
        dataType: 'json',
        success: function (response) {

            var d = new Date();
            $.each(response, function (a,b) {
                 var time = new Date(b.date+' '+b.startTime);
                 var d1=d.getFullYear()+'-'+(d.getMonth()+1)+'-'+d.getDate();
                 var d2=time.getFullYear()+'-'+(time.getMonth()+1)+'-'+time.getDate();

                if(d1 == d2){
                    if(time.getTime() < d.getTime()){
                        localStorage.setItem('sessionStart',b.startTime);
                        localStorage.setItem('sessionEnd',b.endTime);
                        localStorage.setItem('sessionDur',b.duration);
                        localStorage.setItem('sessionID',b.id);
                    }

                }

            });


        }});

}
loadData();

