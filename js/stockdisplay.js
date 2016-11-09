$(document).ready(function () {
    $('#loading').show();
    $("#datepicker").datepicker({
        inline: true,
        onSelect: function (dateText, obj) {
            calendar++;
            var date = obj.selectedYear + "-" + obj.selectedMonth + '-' + obj.selectedDay;
            processdate(date, "00:00:00");
        }
    });
    var d = new Date();
    var timestamp = d.getTime();
    var date = new Date(timestamp);
    var year = date.getFullYear();
    var month = addzero(date.getMonth() + 1);
    var day = date.getDate();
    var hours = addzero(date.getHours());
    var minutes = addzero(date.getMinutes());
    var seconds = addzero(date.getSeconds());
    var timein = year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
    //console.log(timein);
    document.getElementById('start_date').value = year + "-" + month + "-" + day + "T" + hours + ":" + minutes;
    document.getElementById('end_date').value = year + "-" + month + "-" + (day + 1) + "T" + hours + ":" + minutes;
    var a1 = year + "-" + (month - 1) + "-" + day;
    var a2 = year + "-" + (month - 1) + "-" + (day + 1);
    date1 = year + "-" + (parseInt(month)-1) + "-" + day + " " + "00" + ":" + "00" + ":" + "00";
    date2 = year + "-" + (parseInt(month) - 1) + "-" + (parseInt(day) + 1) + " " + "00" + ":" + "00" + ":" + "00";
    console.log("date1:"+date1+" date2:"+date2);
    document.getElementById('get').click();
});

var flag = 0;
var date1 = null;
var date2 = null;
var calendar = 0;

function firequery(f) {
    calendar = 0;
    //console.log("date :" + f);
    var s = f.split("T");
    var z = s[0].split("-");
    var k = s[1].split(":");
    var jk = z[0]+"-"+(parseInt(z[1])-1) +"-"+z[2]+ " " + k[0] + ":" + k[1] + ":00";
    processdate(z[0] + "-" + (parseInt(z[1]) - 1) + "-" + z[2], k[0] + ":" + k[1] + ":00");
    console.log("jk :"+jk);
}

function setinputs(d, id) {
    var k = d.split(" ");
    var m = k[0].split("-");
    if (calendar != 0) m[1]++ ;
    //console.log("to rest:"+m[0] + "-" + (parseInt(m[1]) + 1) + "-" + m[2] + "T00:00");
    document.getElementById(id).value = m[0]+"-"+addzero(parseInt(m[1]))+"-"+m[2]+"T00:00";
}

function processdate(date,time) {
    date = date +" "+ time;
    //console.log("date selected :- " + date);
    if (flag == 0) { date1 = date; if(calendar!=0)setinputs(date1,'start_date');flag++; console.log("date1: " + date1); }
    else {
        date2 = date;
        if (calendar != 0) setinputs(date2, 'end_date');
        flag = 0;
        console.log("date1: " + date1 + " date2: " + date2);
    }
}

function query() {
    $('#loading').show();
    querydata(date1, date2);
}

function addzero(str) {
    if (str.toString().length == 1) {
        str = '0' + str;
    }
    return str;
}

function querydata(time1, time2) {
    $.ajax({
        type: "post",
        url: "getstockstats.php",
        data: { b: 'stockin', date1: time1, date2: time2 },
        success: function (data) {
            console.log(data);
            var obj = JSON.parse(data);
            //console.log(obj[1]);
            var entered = obj[0];
            var gotout = obj[1];
            var header = obj[2];
            first = 1;
            if (entered.length != 0 || gotout.length != 0) {
                first = 0;
                if (entered.length != 0) generatetable(entered.length, entered[0].length, 10, 'stockin', entered, header);
                if (gotout.length != 0) generatetable(gotout.length, gotout[0].length, 10, 'stockout', gotout, header);
            }
            else if (entered.length == 0 && gotout.length == 0) alert("no details found !!!");
            $('#loading').hide();
        },
        error: function () {
            alert("failed");
        }
    });
}

var first = 0;

function generatetable(num_rows, num_cols, width, id, obj, header) {
    if (first == 0) document.getElementById('display').innerHTML = ' ';
    var theader = "<table width='100%'  cellspacing='0' cellpadding='0' style='margin-top:5%;margin-bottom:5%' id='" + id + "'  class='table table-striped table-bordered '><thead>";
    var tbody = "<tbody>";
    for (var j = 0; j < num_cols; j++) {
        if (j != 0) theader += "<th id='th" + j + "' >" + header[j] + "<img src='images/bg_arrow.gif'></th>";
        else theader += "<th id='th" + j + "' >" + header[j] + "</th>";
    }
    theader += '</thead>';
    for (var i = 0; i < num_rows; i++) {
        tbody += "<tr id='tr" + i + "'>";
        for (var j = 0; j < num_cols; j++) {
            if (header[j] == '#') {
                tbody += "<td id='td" + i + "" + j + "' onclick='select(this.id)'><span>";
                tbody += "<input type='checkbox' id='check" + i + j + "' onclick='selectrow(this.id)'>";
                tbody += "</span></td>";

            }
            else {
                tbody += "<td id='td" + i + "" + j + "' onclick='select(this.id)'><span>";
                tbody += obj[i][j];
                tbody += "</span></td>";
            }

        }
        tbody += "</tr>";
    }
    var tfooter = "</tbody></table>";
    document.getElementById('display').innerHTML += theader + tbody + tfooter;
    setTimeout(function () {
        var table = $('#' + id).dataTable({ bFilter: true, bInfo: true, "iDisplayLength": 10 });
        table.fnDraw();
        $('#' + id + '_wrapper').css('margin-top', '5%');
    }, 200);
    
    first++;
}
