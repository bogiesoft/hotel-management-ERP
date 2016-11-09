$(document).ready(function () {
    console.log("Jquery wrking :)");
    $('#loading').hide();
});

function retrieverow(rowid) {
    var row = rowid.replace('pre', 'td');
    console.log(rowid);
    var codeval = $('#' + row + ' input').val();
    var rowno = row.replace('td', '');
    console.log(rowno[0]);
    var maxlimit = null;
    $.ajax({
        type: "post",
        url: "retrieverow.php",
        data: { code: codeval },
        success: function (data) {
            console.log(data);
            var temparr = JSON.parse(data);
            //console.log(temparr[0]);
            if (temparr[0] !== null) {
                for (var i = 0; i < temparr.length; i++) {
                    //this is to up-date the select according tp available quantity

                    $('#td' + rowno[0] + (i + 1)).html("<span id='span" + rowno[0] + (i + 1) + "' style='margin-left:30%;margin-top:15%;'>" + temparr[i] + "</span>");
                    if ($('#th' + (i + 1)).html() == 'Available') {
                         max_limit = temparr[i].replace(/(^\d+)(.+$)/i, '$1');
                        var unit = temparr[i].replace(max_limit, '');
                        var inner = '';
                        if (max_limit >= 1) {
                            console.log("max-limit:--" + parseInt(max_limit));
                            for (var k = 0; k < parseInt(max_limit) ; k++) {
                                inner += "<option>" + (k + 1) + "</option>";
                            }
                            document.getElementById('maxlimit' + rowno[0]).innerHTML += inner;
                            $('#units' + rowno[0]).html(unit);
                        }
                        else {
                            alert("out of stock");
                            console.log("out of stock");
                        } 
                        //console.log(inner + 'maxlimit' + rowno[0]);
                     }

                }
            }
            else {
                alert('code not found plzz re-enter the code');
                $('#' + row + ' input').val('');
            }
        },
        error: function () {
        }
    });
    console.log(codeval);
}

var column_count = ($('#stockout').children().children().children('th').length - 2);

function resetsingle(id) {
    var key = id.replace('reset', '');
    key = key[0];
    for (var i = 0; i < column_count ; i++) {
        //console.log('#td' + key + i);
        if ($('#th' + i).html() == 'Required') {
            $('#td' + key + i + ' select').html('<option></option>');
            $('#td' + key + i + ' span').html('');
        }
        else if ($('#th' + i).html() == 'Code') {
            $('#td' + key + i ).html("<input class='form-control' type='text' style='margin-left:15%;margin-right:4%;float:left;'><pre id='pre"+ key + i+"'onclick='retrieverow(this.id)' style='cursor:pointer;width:10%;padding:1%;float:left;'>Get</pre>");
        }
        else { $('#td' + key + i + ' span').html(''); }
    }
}

function generatetable(num_rows) {
    $('#stockout tbody').html('');
    var ina = '';
    for (var j = 0; j < num_rows; j++) {
        ina+="<tr id='tr"+j+"'>";
        for (var i = 0; i < ($('#stockout').children().children().children('th').length - 1) ; i++) {
            if ($('#th' + i).html() == '#') ina += "<td width='5%' style='text-align:center' id='td" + j + i + "'>" + (j + 1) + "</td>";
            else if ($('#th' + i).html() == 'Code') {
                ina += "<td id='td" + j + i + "'><input class='form-control' type='text' style='margin-left:15%;margin-right:4%;float:left;'><pre id='pre" + j + i + "' onclick='retrieverow(this.id)' style='cursor:pointer;width:10%;padding:1%;float:left;'>Get</pre></td>";

            }
            else if ($('#th' + i).html() == 'Required') {
                ina += "<td style='width:20%' id='td"+j+i+"'><select id='maxlimit"+j+"' type='text' style='margin-left:15%;width:30%;height:10%;margin-right:3%;float:left;'><option></option></select><span id='units"+j+"' style='width:35%;height:10%;float:left'></span></td>";

            }
            else if ($('#th' + i).html() == 'Actions') {
                ina += "<td id='td" + j + i + "' onclick='getsingle(this.id)'><div><pre>Get</pre></div></td><td id='reset"+j+i+"' onclick='resetsingle(this.id)'><div><pre>Reset</pre></div></td>";

            }
            else if ($('#th' + i).html() == '&nbsp') {

            }
            else {
                ina += "<td id='td" + j + i + "'></td>";
            }
        }
        ina+="</tr>";
    }
    ina += "<tr><td></td><td onclick='reset()'><div class='inputbtn'><pre>Reset</pre></div></td><td></td><td></td><td></td><td onclick='getall()'><div class='inputbtn'><pre>Get</pre></div></td><td></td><td></td></tr>";

    $('#stockout tbody').html(ina);
}

function reset() {
    console.log("reset() called");
    var length = $('#stockout tbody tr ').length;
    for (var i = 0; i < length -1; i++) {
          $('#tr' + i + ' input').val('');
          console.log('reset' + i + '6');
          if (i != length - 2) document.getElementById('reset' + i  + '6').click();
          else document.getElementById('reset' + i + '6').click();
    }
    console.log(length);
}

function getall() {
    console.log("getall() called!!");
    var length = $('#stockout tbody tr ').length;
    console.log(length);
    var error = 0;
    for (var i = 0; i < length - 1; i++) {
        if ($('#tr' + i).children().children('input').length != 0 || $('#tr' + i).children().children('select').val() == '') {
            error = 1;
        }
        
    }
    if (error == 1) alert("To Get all the products first fill d rows by entering all the codes");
    else {
        var getallarr = [];
        var temparr = [];
        for (var i = 0; i < length - 1; i++) {
            temparr = [];
            for (var j = 1; j < ($('#stockout').children().children().children('th').length - 2) ; j++) {
                if ($('#th' + j).html() == 'Required') { temparr[(j - 2)] = $('#td' + i + j).children('select').val() + $('#td' + i + j).children('span').html(); }
                else if ($('#th' + j).html() != 'Available') temparr[(j - 1)] = $('#td' + i + j).children('span').html();
            }
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
            temparr[temparr.length] = timein;
            getallarr[i] = temparr;
        }
        
        console.log(JSON.stringify(getallarr));

        $.ajax({
            type: "post",
            url: "getallstocks.php",
            data: { masteritemdetails: JSON.stringify(getallarr) },
            success: function (data) {
                console.log(data);
                reset();
            },
            error: function () {
            }
        });
    }
}

function getsingle(id) {
    var key = id[2];
    var proceedT = $('#tr' + key).children().children('input').length;
    console.log(proceedT);
    // this indicates user has not put in the code so warn him
    if (proceedT == 1) {
        alert("please enter a code of the desired item");
    }
    else {
        if ($('#tr' + key).children().children('select').val() == '') alert("Plzz select the quantity required");
        else {
            console.log("Selected :--" + $('#tr' + key).children().children('select').val());
            var getarr = [];
            for (var i = 0; i < ($('#stockout').children().children().children('th').length - 2) ; i++) {
                if ($('#th' + i).html() != 'Available' && $('#th' + i).html() != '#') {
                    if ($('#th' + i).html() != 'Required') {
                        //console.log(i + ':--' + $('#td' + key + i + ' span').html());
                        getarr[i-1] = $('#td' + key + i + ' span').html();
                    }
                    else {
                        getarr[i-2] = $('#td' + key + i + ' select').val() + $('#td' + key + i + ' span').html();
                    }
                }

            }
            console.log(JSON.stringify(getarr));
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
            getarr[getarr.length] = timein;
            $.ajax({
                type: "post",
                url: "getsingle.php",
                data: { itemdetails: JSON.stringify(getarr)},
                success: function (data) {
                    console.log(data);
                    for (var i = 0; i < ($('#stockout').children().children().children('th').length - 2) ; i++) {
                      if ($('#th' + i).html() == 'Required') {
                            var tempspan = $("<span id='gotout"+key+"' style='float:left;margin-left:15%;margin-right:4%;'>"+$('#td' + key + i + ' select').val()+"</span>");
                            $('#maxlimit' + key).replaceWith(tempspan);
                            document.getElementById('reset' + key + '6').click();
                        }
                    }
                },
                error: function () {
                    console.log("failed");
                }
            });
        }
    }
}