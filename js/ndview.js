var dayarray = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
var roomselected = null;
reservednroomarray = {};
function initialiseviewtable(view, date, month, year) {
    fir = 0;
    document.getElementById('display').innerHTML = '';
    for (var k = 0; k < roomtypes.length; k++) {
        generateviewtable(view, roomtypes[k], rooms[k], date, month, year);
    }
}

function getnreservation(roomarr, day, year, month, time) {
    reservedroomarray = [];
    $('#loading').fadeIn();
    $.ajax({
        type: "post",
        url: "getreservationbydates.php",
        data: { roomarray: JSON.stringify(roomarr), day: day, month: month, year: year, time: time },
        success: function (data) {
            console.log(data);
            reservednroomarray = JSON.parse(data);
            console.log(JSON.parse(reservednroomarray[0]));
             if (time != '1') {
                colortable(reservednroomarray);
                $('#loading').fadeOut();
             }
             else {
                modifytable(reservednroomarray);
                $('#loading').fadeOut();
             }
        },
        error: function () {
            alert("failed");
        }
    });
}

function colortable(superarr) {
    var temparr = {};
    for (var s = 0; s < superarr.length; s++) {
        temparr = {};
        temparr = JSON.parse(superarr[s]);
               for (var t = 0; t < temparr.length; t++) {
                var d1 = temparr[t][2].split(" ");
                var d2 = temparr[t][3].split(" ");
                //console.log(d1+" "+d2);
                d1 = d1[0].split("-");
                d2 = d2[0].split("-");
                var startid = $('#tr' + temparr[t][0] + ' td:first-child').attr('id');
                var col;
                if (temparr[t][temparr[t].length - 1] == 'reserved') col = 'cyan';
                else if (temparr[t][temparr[t].length - 1] == 'check-in') col = '#3660ff';
                $('#tr' + temparr[t][0] + '> #' + startid).html(temparr[t][0]);
                $('#tr' + temparr[t][0] + '> #' + startid).css('background', 'white');
                var startdatekey = null;
                for (var i = 1; i < viewnode; i++) {
                    if ($('#th' + i).html().split('&nbsp;')[0] == d1[2]) startdatekey = i;
                }
                console.log(startdatekey);
                var great = viewnode < (d2[2] - d1[2]) ? viewnode : (d2[2] - d1[2]);
                for (var i = 0; i <= great ; i++) {
                    //      console.log('#tr' + temparr[t][0]+"  "+'#td' + startid[2] + (startdatekey + i));
                    $('#tr' + temparr[t][0] + '> #td' + startid[2] + (startdatekey + i)).css('background', col);

                }
                reservedroomarray[reservedroomarray.length] = temparr[t];
            }

            temparr = {};
        
    }
     $('#loading').fadeOut();
}

function selectcell(fullobj) {
    var id = fullobj.id;
    var type = fullobj.dataset.type;
    console.log(type + " " + id);
    console.log(type + viewnode);
    var tempid;
    var tempdate = '';
    roomid = $(fullobj).parent('tr').attr('id');
    var room = roomid.replace('tr', '');

    console.log(roomid);
    if (date1 == null) {
        roomselected = roomid;
        $(fullobj).css('background', 'cyan');
        var lklk = id.replace('td', '')[1];
        tempdate = $('#th' + lklk).html();
        tempdate = tempdate.split('&nbsp;');
        date1 = currentyear + '-' + (currentmonth + 1) + '-' + tempdate[0] + 'T00:00';
        console.log("date1:" + date1);
    }
    else if (roomid == roomselected) {
        $(fullobj).css('background', 'cyan');
        var lklk = id.replace('td', '')[1];
        tempdate = $('#th' + lklk).html();
        tempdate = tempdate.split('&nbsp;');
        date2 = currentyear + '-' + (currentmonth + 1) + '-' + tempdate[0] + 'T00:00';
        console.log("date2:" + date2);
        $('#regfrm2').hide();
        $('#regfrm').show();
        $('#form').show();
        $('#room_no').val(room);
        $('#room_type').val(type);
        document.getElementById('check_in_date').value = date1;
        document.getElementById('check_out_date').value = date2;
        date1 = null;
        date2 = null;
    } 

}
var fir = 0;
var monthmap = { "January": 31, "February": 28, "March": 31, "April": 30, "May": 31, "June": 30, "July": 31, "August": 31, "September": 30, "October": 31, "November": 30, "December": 31 };

function generateviewtable(view, id, roomsarr, sdate, month, year) {
    var width = '100%';
    if (view == '30') {
        $('body').css('overflow', 'auto');
        width = '500px';
    }
    else $('body').css('overflow-x', 'hidden');
    var headdiv;
    var v = parseInt(view);
    sdate = parseInt(sdate);
    var last = sdate + v;
    var lastmonth = montharray[month];
    if (last > monthmap[montharray[month]]) {
        last = last - monthmap[montharray[month]];
        if (month != 11) lastmonth = montharray[month + 1];
        else lastmonth = montharray[0];
    }
    if (fir == 0) headdiv = "<br><br><div id='datehead' style='margin-top:5%;'><span>" + sdate + "&nbsp</span><span>" + montharray[month] + "&nbsp</span><span>" + year + "&nbsp</span>--<span>" + last + "&nbsp</span><span>" + lastmonth + "&nbsp</span><span>" + year + "&nbsp</span></div><br>";
    else headdiv = '';
    headdiv += "<table style='margin-top:2%;margin-bottom:2%;cursor:pointer;text-align:center;' width='" + width + "' id='" + id + "toggle'><tbody><tr><td style='font-weight:bold;' id='" + id + view + "click' onclick='toggle(this.id)'>" + id + "</td></tr></tbody><table>"

    sdate = parseInt(sdate);

    //var stringdate = " "+montharray[month] + " " + sdate + " ," + year+" 00:00:00";
    var header = ["Room No"];
    var k;
    //alert(monthmap[montharray[month]]);
    month = parseInt(month);
    for (var i = 1; i < v + 1; i++) {
        if (sdate <= monthmap[montharray[month]]) {
            var stringdate = (month + 1) + " " + sdate + ", " + year;
            k = new Date(stringdate);
            header[i] = sdate + "&nbsp" + dayarray[k.getDay()];
            sdate++;
        }
        else {
            sdate = 1; if (month != 11) month++; else month = 0;
            var stringdate = (month + 1) + " " + sdate + ", " + year;
            k = new Date(stringdate);
            header[i] = sdate + "&nbsp" + dayarray[k.getDay()];
            sdate++;
        }
    }
    var num_rows = roomsarr.length;
    var num_cols = v + 1;
    console.log(id + " " + view);
    var theader = "<table id='" + id + view + "' width='" + width + "'  cellspacing='0' cellpadding='0' style='margin-top:2%;'  class='table table-striped table-bordered '><thead>";
    for (var i = 0; i < num_cols; i++) {
        theader += "<th id='th" + i + "'>" + header[i] + "</th>";
    }
    theader += "</thead>";
    var tbody = "<tbody>";

    for (var i = 0; i < num_rows; i++) {
        tbody += "<tr id='tr" + roomsarr[i] + "'>";
        for (var j = 0; j < num_cols; j++) {
            tbody += "<td data-type='" + id + "' id='td" + i + j + "' onclick='selectcell(this)'>";
            if (j == 0) tbody += roomsarr[i];
            else tbody += "";
            tbody += "</td>";
        }
        tbody += "</tr>";
    }
    var tfooter = "</tbody></table>";
    document.getElementById('display').innerHTML += headdiv + theader + tbody + tfooter;
    setTimeout(function () {
        var table = $('#' + id + view).dataTable({ bFilter: true, bInfo: true, "iDisplayLength": 10 });
        table.fnDraw();
    }, 200);
    if (view == 30) {
        /*$('#1day').css('width', '5%');
        $('#3day').css('width', '5%');
        $('#7day').css('width', '5%');
        $('#15day').css('width', '5%');*/
    }
    else {
        $('#1day').css('width', '10%');
        $('#3day').css('width', '10%');
        $('#7day').css('width', '10%');
        $('#15day').css('width', '10%');

    }
    //viewcontainer[view] = document.getElementById('display').innerHTML;
    fir++;
}

