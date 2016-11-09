var montharray = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var viewnode = 1;
var currentmonth = null;
var currentyear = null;
var roomtypes = null;
var rooms = {};
var table = [];
var reservedroomarray = [];
var date1 = null;
var date2 = null;

function processform(id) {
    var r = document.getElementById('regfrm');
    var form = new FormData(r);
    if (id == 'Reserve') form.append('reserv', 'Reserve');
    if (id == 'Check-In') form.append('checkin', 'Check-In');
    if (id == 'Block') form.append('block', 'Block');
    $.ajax({
        type: "post",
        url: "processform.php",
        data: form,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            console.log(data);
            document.getElementById('Reset').click();
            $('#form').hide();

            restore();
            document.getElementById('1day').click();

        },
        error: function () {
            alert("failed to submit form");
        }
    });
}


$(document).ready(function () {
    //$('#form').hide();
    $('#loading').show();

    var d = new Date();
    currentday = d.getDate();
    currentmonth = d.getMonth();
    currentyear = d.getFullYear();
    //$('#regfrm').hide();
    $('#regfrm2').hide();
    if (roomtypes == null) getypes();
    $("#datepicker").datepicker({
        inline: true,
        onSelect: function (dateText, obj) {
            var date = obj.selectedDay + "-" + obj.selectedYear + "-" + obj.selectedMonth;
            processdate(date);
        }
    });

});


function processdate(date) {
    date = date.split('-');
    getplaintable(reservedroomarray);
    currentday = date[0];
    currentyear = date[1];
    currentmonth = date[2];
    //alert(currentday+" "+currentyear+" "+currentmonth);
    if (viewnode == '1') $('#datehead').html("<span>" + currentday + "&nbsp</span><span>" + montharray[currentmonth] + "&nbsp</span><span>" + currentyear + "</span>");
    else {
        var d = (parseInt(currentday) + parseInt(viewnode));
        var m = currentmonth;
        if (d > monthmap[montharray[currentmonth]]) {
            d = d - monthmap[montharray[currentmonth]];
            if (m != 11) m++;
            else m = 0;
        }
        $('#datehead').html("<span>" + currentday + "&nbsp</span><span>" + montharray[currentmonth] +
            "&nbsp</span>" + "<span>" + currentyear + "&nbsp--</span><span>" + d + "&nbsp</span>" +
            "<span>" + montharray[m] + "&nbsp</span><span>" + currentyear + "&nbsp</span>");
    }
    document.getElementById(viewnode + 'day').click();
    setTimeout(function () {
        getnreservation(rooms, date[0], date[1], date[2], viewnode);
    }, 400);

};


function getypes() {
    $('#loading').fadeIn();
    $.ajax({
        type: "post",
        url: "getroomsbytype.php",
        data: {},
        success: function (data) {
            data = JSON.parse(data);
            roomtypes = data[0];
            rooms = data[1];
            getresult(roomtypes, rooms);
            $('#loading').fadeOut();
        },
        error: function () {
            alert("failed");
        }
    });
}


function restore() {
    numlock = 0;
    $('#header').css('opacity', '1');
    $('#holder').css('opacity', '1');
    $('#form').hide();
}


function getresult(a, b) {
    for (k = 0; k < a.length; k++) {
        processinitialtable(b[k], a[k]);
        //getreservationstatus(b[k], currentday, currentmonth, currentyear);
    }
    getnreservation(b, currentday, currentyear, currentmonth, viewnode);
}

/*this generates initial view for viewnode = 1 bcoz the 1 view is different */
function processinitialtable(arr, string) {
    var roomoftype = [];
    header = ["#", "Room No", "Name", "Check IN", "Check Out", "Status"];
    for (i = 0; i < arr.length; i++) {
        roomoftype[roomoftype.length] = ['', arr[i], '', '', '', 'Available'];
    }
    table[table.length] = roomoftype;
    generatetable(roomoftype.length, roomoftype[0].length, roomoftype, header, string, null);
}

var views = [1, 3, 7, 15, 30];
var viewcontainer = { "1": "", "3": "", "7": "", "15": "", "30": "" };


function processview(id) {
    //Cleans up the canvas for new data to be displayed :) 
    document.getElementById('display').innerHTML = '';
    /*this is a small hack to set up all the borders , so that u get an illusion of tabs :)
    bt i was a moron i could hv used jquery ui tabs and changed its css :) */
    for (l = 0; l < views.length; l++) {
        $('#' + views[l] + 'day').css('border', '0');
        $('#' + views[l] + 'day').css('border-bottom', '1px solid cyan');
    }
    $('#' + id).css('border', '1px solid cyan');
    $('#' + id).css('border-bottom', '0');
    if (id != '1day') {
        $('#1day').css('border-left', '1px solid white');
    }
    id = id.replace('day', '');
    // now id contains the integer view 1|3|7|15|30

    viewnode = id;  //this sets the universal parent viewnode
    if (viewnode != '1') {
        initialiseviewtable(viewnode, currentday, currentmonth, currentyear);
        getnreservation(rooms, currentday, currentyear, currentmonth, viewnode);// this function retrieves reservation status and colors the table apppropriately
    }
    else {
        first = 0;
        getresult(roomtypes, rooms);
    }

}

var selectedcheck = {};

/* Colors the table with the reservation data and prepares a reserved rooms flipflop fr clearing on next data serve :) */
function modifytable(obj) {
    var color;
    var temparr = {};
    for (var k = 0; k < obj.length; k++) {
        temparr = JSON.parse(obj[k]);
        for (var i = 0 ; i < temparr.length; i++) {
            td = '';
            if (temparr[i][temparr[i].length - 1] == 'reserved') color = "cyan";
            else if (temparr[i][temparr[i].length - 1] == 'check-in') color = '#3660ff';
            else if (temparr[i][temparr[i].length - 1] == 'block') color = '#991f5c';
            for (var j = 0; j < temparr[i].length; j++) {
                if (j == 0) td += "<td style='background-color:" + color + "'><span><input type='checkbox' id='check" + temparr[i][j] + "' onchange='updatecheck(this.id)'></span></td><td style='background-color:" + color + ";color:black;' id='td" + temparr[i][j] + "'>" + temparr[i][j] + "</td>";
                else if (j == temparr[i].length - 1) td += "<td onclick='destroy(" + temparr[i][0] + ")' style='background-color:" + color + ";color:white;cursor:pointer'><span>" + temparr[i][j] + "</span><img src='images/edit.png' style='margin-left:7%;cursor:pointer;' width='16' height='16'></td>";
                else { td += "<td style='background-color:" + color + ";color:black;' id='" + reserveid[0] + j + "'>" + temparr[i][j] + "</td>"; }
            }
            reservedroomarray[reservedroomarray.length] = temparr[i];
            document.getElementById('tr' + temparr[i][0]).innerHTML = td;

        }
       
    }
}
/*This cleares the table of any previous reservation data*/

function getplaintable(arr) {
    if (arr.length > 0) {
        for (var i = 0; i < arr.length; i++) {
            if (arr[i].length > 0) {
                $('#tr' + arr[i][0]).css('background-color', 'white');
                $('#tr' + arr[i][0]).html("<td>" + arr[i][0] + "</td><td></td><td></td><td></td><td>Available</td>");
            }
        }
    }

}

function toggle(id) {
    var k = id.replace('click', '');
    $('#' + k + '_wrapper').slideToggle();
}

function diffuse() {
    $('#loading').show();
    $('#header').css('opacity', '0.6');
    $('#holder').css('opacity', '0.6');
    $('#form').show();
    $('#regfrm').show();
    $('#loading').hide();
}
var reserveid = '00';
var room_no = [];
var room_type = [];
var indate = [];
var outdate = [];

function addzero(str) {
    if (str.toString().length == 1) str = '0' + str;
    return str;
}

function select(obj) {
    $('#loading').show();
    var d = new Date();
    var timestamp = d.getTime();
    var date = new Date(timestamp);

    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
    var timein = year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
    if (hours.toString().length == 1) hours = '0' + hours;
    var date1 = currentyear + '-' + addzero(parseInt(currentmonth) + 1) + '-' + addzero(currentday) + 'T' + addzero(hours) + ':' + addzero(minutes);
    var date2 = currentyear + '-' + addzero(parseInt(currentmonth) + 1) + '-' + addzero(parseInt(currentday) + parseInt(viewnode)) + 'T' + addzero(hours) + ':' + addzero(minutes);
    console.log(date1 + " " + date2);
    document.getElementById('check_in_date').value = date1;
    document.getElementById('check_out_date').value = date2;
    document.getElementById('check_in_date2').value = date1;
    document.getElementById('check_out_date2').value = date2;

    id = obj.id;
    type = obj.dataset.type;
    k = id.replace('td', '');
    reserveid = k;
    roomno = $('#' + type).children().children().find('#td' + k[0] + 1).children('span').text();
    console.log(roomno);
    //if a single room is clicked
    if (selectedcheck['check' + roomno] == 0) {
        $('#regfrm2').hide();
        $('#regfrm').show();

        $('#' + roomno).attr('selected', 'true');
        diffuse();
        $('#loading').hide();
    }
    else {
        $('#regfrm').hide();
        $('#regfrm2').show();
        $('#form').show();
        $('#loading').show();
        var counter = 1;
        document.getElementById('displayrooms').innerHTML = '<td>#</td><td>Room No</td><td>Room Type</td><td>Check In</td><td>Check Out</td>';
        for (key in selectedcheck) {
            if (!selectedcheck.hasOwnProperty(key)) continue;
            //console.log(selectedcheck[key]);
            if (selectedcheck[key] == 1) {
                var id = key.replace('check', 'tr');
                var k = $('#' + id).closest('table').attr('id');
                id = id.replace('tr', '');
                var checkin = date1.split('T')[0] + " " + date1.split('T')[1];
                var checkout = date2.split('T')[0] + " " + date2.split('T')[1];
                room_no[counter - 1] = id;
                room_type[counter - 1] = k;
                indate[counter - 1] = checkin;
                outdate[counter - 1] = checkout;
                document.getElementById('displayrooms').innerHTML += "<tr style='background-color:#DBDBDB;'><td>" + counter + "</td><td>" + id + "</td><td>" + k + "</td><td>" + checkin + "</td><td>" + checkout + "</td></tr>";
                counter++;
            }
        }
        console.log(JSON.stringify(room_no));
        $('#loading').hide();
    }
    
}
var first = 0;

function generatetable(num_rows, num_cols, obj, header, id, img) {
    var headdiv;
    if (first == 0) headdiv = "<br><br><div id='datehead' style='margin-top:5%;'><span>" + currentday + "&nbsp</span><span>" + montharray[currentmonth] + "&nbsp</span><span>" + currentyear + "&nbsp</span></div>";
    else headdiv = '';
    headdiv += "<table style='margin-bottom:2%;cursor:pointer;width = 100%;' id='" + id + "toggle'><tbody><tr><td style='font-weight:bold;' id='" + id + "click' onclick='toggle(this.id)'>" + id + "</td></tr></tbody><table>"
    var theader = "<table width='100%'  id='" + id + "' cellspacing='0' cellpadding='0' style='margin-top:2%;margin-bottom:1%;'  class='table table-striped table-bordered '><thead>";
    var tbody = "<tbody>";
    for (var j = 0; j < num_cols; j++) {
        if (j != 0)
            theader += "<th id='th" + j + "' >" + header[j] + "<img src='images/bg_arrow.gif'></th>";
        else
            theader += "<th id='th" + j + "' >" + header[j] + "</th>";
    }
    theader += '</thead>';
    for (var i = 0; i < num_rows; i++) {
        tbody += "<tr id='tr" + obj[i][1] + "'>";
        selectedcheck["check" + obj[i][1]] = 0;
        for (var j = 0; j < num_cols; j++) {
            if (j != img) {
                if (header[j] == 'Status') {
                    tbody += "<td id='td" + i + "" + j + "' data-type='" + id + "' onclick='select(this)'><span>";
                    tbody += obj[i][j];
                    tbody += "</span></td>";
                }
                else if (header[j] == '#') {
                    tbody += "<td><span>";

                    tbody += "<input id='check" + obj[i][1] + "' type='checkbox' onclick='updatecheck(this.id)'>";
                    tbody += "</span></td>";
                }
                else {
                    tbody += "<td id='td" + i + "" + j + "' data-type='" + id + "' onclick='select(this)'><span>";
                    tbody += obj[i][j];
                    tbody += "</span></td>";
                }
            }
            else {
                if (obj[i][j] == 1)
                    tbody += "<td id='td" + i + "" + j + "' onclick='select(this.id)'><img src='images/Accept.gif' width='20' ></td>";
                else {
                    tbody += "<td id='td" + i + "" + j + "' onclick='select(this.id)'><span>N/A</span></td>";
                }
            }
        }
        tbody += "</tr>";
    }
    var tfooter = "</tbody></table>";
    document.getElementById('display').innerHTML += headdiv + theader + tbody + tfooter;
    setTimeout(function () {
        var table = $('#' + id).dataTable({ bFilter: true, bInfo: true, "iDisplayLength": 10 });
        table.fnDraw();
    }, 200);
    first++;
    $('#datehead').css('margin-top', '2%');
}
