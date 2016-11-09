$(document).ready(function () {
    console.log("Jquery wrking !!");
    $('#loading').hide();
});
var rows = 10;

function storesingle(itemid) {
    itemid = itemid.replace('td', '');
    var temparr = [];
    var empty = null;
    // checks whether all fields are filled out :)
    for (var i = 1; i < itemid[1]; i++) {
        //console.log('td' + itemid[0] + i);
        if ($('#td' + itemid[0] + i).children('input').val() == '') empty = 1;
    }
    // if all fields r nt filled prompt the user to do so 
    if (empty == 1) alert("plzz fill out all the details");
        // all the fields are filled out so collect the data 
    else {

        for (var i = 1; i < itemid[1]; i++) {
            //console.log('td' + itemid[0] + i);
            //console.log($('#th' + i).html());
            if ($('#th' + i).html() == 'Supplier') {
                console.log("pointer's here :)");
                temparr[i - 1] = $('#td' + itemid[0] + i).children('select').val();

            }
            else if ($('#td' + itemid[0] + i).children().length == 1) temparr[i - 1] = $('#td' + itemid[0] + i).children('input').val();
            else {
                temparr[i - 1] = $('#td' + itemid[0] + i).children('input').val() + $('#td' + itemid[0] + i).children('select').val();
            }
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
        if (isNaN(parseInt(temparr[2]))) alert("Price should be a number :) ");
            // store dat array of values into the proper table
        else {
            console.log(JSON.stringify(temparr));
            $.ajax({
                type: "post",
                url: "stocksingle.php",
                data: { itemdetails: JSON.stringify(temparr) },
                success: function (data) {

                    for (var i = 1; i < itemid[1]; i++) {
                        //console.log('td' + itemid[0] + i);
                        $('#td' + itemid[0] + i).children('input').val('');
                    }

                },
                error: function () {
                    alert("failed");
                }
            });

        }
    }
}

function reset() {
    console.log("reset() called");
    var length = $('#tablestockin tbody tr ').length;
    for (var i = 0; i < length - 1; i++) {
        for (var j = 1; j < column_count; j++) {
            $('#td' + i + j + ' input').val('');
        }
    }
}

function resetsingle(id) {
    var h = id.replace('reset', '');
    for (var i = 1; i < h[1]; i++) {
        $('#td' + h[0] + i).children('input').val('');
    }

}

var suppoptions = '';

    for (var k = 0; k < suppliers.length; k++) {
        suppoptions += '<option>' + suppliers[k] + '</option>';
    }
    var column_count = $('#tablestockin').children().children().children('th').length;
function generatetable(num_rows) {
    $('#tablestockin tbody').html('');
    var inner = '';
    for (var i = 0; i < num_rows; i++) {
        inner += "<tr id='tr" + i + "'><td id='td" + i + "0' style='width:2%;text-align:center'>" + (i + 1) + "</td>";
        for (var j = 1; j < column_count; j++) {
            console.log($('#th' + j).html());
            if ($('#th' + j).html() == 'Quantity') {
                inner += "<td id= 'td" + i + j + "' style='width:15%;'><input class='form-control' type='text' style='margin-left:2%;margin-right:1%;float:left;width:60%;'><select style='width:20%;height:10%;float:left'><option>Kg</option><option>Litre</option><option>units</option></select></td>";
            }
            else if ($('#th' + j).html() == 'Supplier') {
                inner+="<td style='width:15%' id='td"+i+j+"'><select id='select"+i+j+"' style='width:80%;height:10%;float:left;margin-left:5%;'>"+suppoptions+"</select></td>";
            }
            else if ($('#th' + j).html() == 'Actions') {
                inner += "<td id='td" + i + j + " onclick='storesingle(this.id)'><div><pre>Store</pre></div></td><td id='reset" + i + j+"' onclick='resetsingle(this.id)'><div><pre>Reset</pre></div></td>";
            }
            else if ($('#th' + j).html() == '&nbsp;') {
            }
            else inner += "<td id='td" + i + j + "'><input class='form-control' type='text' style='margin-left:10%'></td>";
        }
        inner += "</tr>";
    }
    inner += "<tr><td></td><td></td><td></td><td></td><td onclick='reset()'><div class='inputbtn'><pre>Reset</pre></div></td><td onclick='storeall()'><div class='inputbtn'><pre>Store</pre></div></td><td></td><td></td></tr>";
    $('#tablestockin tbody').html(inner);
}

var a = 6;

function storeall() {
    console.log("storeall() called");
    var length = $('#tablestockin tbody tr ').length - 1;
    var empty = null;
    for (var i = 0; i < length ; i++) {
        for (var j = 1; j < a; j++) {
            if ($('#td' + i + j + ' input').val() == '') empty = 1;
        }
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

    var temparr = [];
    var subtemparr = [];
    if (empty == 1) alert("plzz fill all the details :)");
    else {
        for (var i = 0; i < length ; i++) {
            subtemparr = [];
            for (var j = 1; j < column_count- 2; j++) {
                if ($('#th' + j).html() == 'Supplier') {
                    subtemparr[j - 1] = $('#td' + i + j + ' select').val();
                }
                else if ($('#th' + j).html() == 'Quantity') {
                    console.log($('#td' + i + j + ' input').val());
                    subtemparr[j - 1] = $('#td' + i + j + ' input').val() + $('#td' + i + j + ' select').val();
                }
                else {
                    subtemparr[j - 1] = $('#td' + i + j + ' input').val();
                }

            }
            subtemparr[subtemparr.length] = timein;
            temparr[i] = subtemparr;
        }
        $.ajax({
            type: "post",
            url: "storeall.php",
            data: { masterdetailsarr: JSON.stringify(temparr) },
            success: function (data) {
                alert(data);
            },
            error: function () {
            }
        });
        console.log(JSON.stringify(temparr));
    }
}