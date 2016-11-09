function updatecheck(id) {
    if (selectedcheck[id] == 0) selectedcheck[id] = 1;
    else { selectedcheck[id] = 0; }
    console.log(JSON.stringify(selectedcheck));
}

function processgroupform(id) {
    var r = document.getElementById('regfrm2');
    var form = new FormData(r);
    if (id == 'Group Reserve') form.append('reserv', 'Group Reserve');
    if (id == 'Group Check-In') form.append('checkin', 'Group Check-In');
    form.append('indate', JSON.stringify(indate));
    form.append('outdate', JSON.stringify(outdate));
    form.append('room_no', JSON.stringify(room_no));
    form.append('room_type', JSON.stringify(room_type));
    form.append('count', room_no.length);
    $.ajax({
        type: "post",
        url: "groupprocessform.php",
        data: form,//{$('#regfrm').serialize(),'reserv':'Reserve'},
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            document.getElementById('reset').click();
            $('#regfrm2').hide();
            $('#form').hide();
            restore();
            document.getElementById(viewnode+'day').click();

            
        },
        error: function () {
            alert("failed to submit form");
        }
    });

}

function destroy(id) {
    id = 'tr' + id;
    $('#regfrm').show();
    var f = $('#' + id).children().length;
    var temparr = [];
    for (var i = 1; i < f; i++) {
        if (i != f - 1) temparr[i - 1] = $('#' + id).children('td').eq(i).html();
        else temparr[i - 1] = $('#' + id).children('td').eq(i).children('span').html();
    }

    $.ajax({
        type: "post",
        url: "editreserve.php",
        data: { details: JSON.stringify(temparr) },
        success: function (data) {
            var temparr = JSON.parse(data);
            $('#form').show();
            for (key in temparr) {
                if (!temparr.hasOwnProperty(key)) continue;
                //console.log(key + "\n");
                if (key != 'id'&&key!='added_date'&&key!='is_active'&&key!='status') {
                    if (document.getElementById(key) != null && key != 'check_in_date'&&key!='check_out_date') document.getElementById(key).value = temparr[key];
                    else if (key == 'check_in_date' || key == 'check_out_date') { temparr[key] = temparr[key].split(" ")[0] + 'T' + hours + ':' + minutes; document.getElementById(key).value = temparr[key]; }
                    else console.log(key);
                }
                //console.log(temparr[key] + "\n");
            }
        },
        error: function () {
        }
    });
    //$('#' + id).hide();
}
