console.log("extra code included");
var options = '';

for (var i = 1; i < 11; i++) {
    options += "<option value='" + i + "'>" + i + "</option>";
}

function checkall(jk) {
    var che = document.getElementById(jk).checked;
    if (che) {
        for (var i = 0; i < 7; i++) {
            $('#week' + i).attr('checked', true);
        }
    }
    else {
        for (var i = 0; i < 7; i++) {
            $('#week' + i).attr('checked', false);
        }
    }
}

var roomclasses = '';
var roomfacilities = '';
var roomtypes = '';

function roomform() {
    
    if (masterobj[pointerarray['rtypes']] == 0 || masterobj[pointerarray['rfacilities']] == 0 || masterobj[pointerarray['rclasses']] == 0) {
        if (masterobj[pointerarray['rtypes']] == 0) retrievedata('rtypes', 1);
        if (masterobj[pointerarray['rfacilities']] == 0) retrievedata('rfacilities', 1);
        if (masterobj[pointerarray['rclasses']] == 0) retrievedata('rclasses', 1);
    }
    if (masterobj[pointerarray['rtypes']] != 0) {
        for (i = 0; i < masterobj[pointerarray['rtypes']][0].length; i++) {
            roomtypes += "<option>" + masterobj[pointerarray['rtypes']][0][i][1] + "</option>";
        }
    }
    if (masterobj[pointerarray['rfacilities']] != 0) {
        for (i = 0; i < masterobj[pointerarray['rfacilities']][0].length; i++) {
            roomfacilities += "<option>" + masterobj[pointerarray['rfacilities']][0][i][1] + "</option>";
        }
    }
    if (masterobj[pointerarray['rclasses']] != 0) {
        for (i = 0; i < masterobj[pointerarray['rclasses']][0].length; i++) {
            roomclasses += "<option>" + masterobj[pointerarray['rclasses']][0][i][1] + "</option>";
        }
    }
}

function foodform() {
    kcategories = '';
    kcategories = retrieveproto('kcategories', kcategories);
}

function userform() {
    privileges = '';
    if (masterobj[pointerarray['userlevels']] == 0) {
        retrievedata('userlevels', 1);
    }
    else {
        for (i = 0; i < masterobj[pointerarray['userlevels']][0].length; i++) {
            privileges += "<option>" + masterobj[pointerarray['userlevels']][0][i][1] + "</option>";
        }
    }
}

function userlevelform() {
    rights = '';
    rights = retrieveproto('userrights', rights);
}

var units = '';
var taxes = '';
var rtypefac = '';
var dateproto = '';
function retrieveproto(idkey, variable) {
    variable = '';
    if (masterobj[pointerarray[idkey]] == 0) retrievedata(idkey, 1);
    else if (masterobj[pointerarray[idkey]] != 0) {
        for (var i = 0; i < masterobj[pointerarray[idkey]][0].length; i++) {
            variable += "<option>" + masterobj[pointerarray[idkey]][0][i][1] + "</option>";
        }
    }
    return variable;
}
function formformarray(arr) {
    if (parentnode == 'rooms') roomform();
    if (parentnode == 'kitems') foodform();
    if (parentnode == 'users') userform();
    if (parentnode == 'userlevels') userlevelform();
    if (parentnode == 'rtypes') rtypefac = retrieveproto('rfacilities',rtypefac)
    if (parentnode == 'mprototypes') units = retrieveproto('munits', units);
    if (parentnode == 'mrates') {
        taxes = retrieveproto('mtaxes', taxes);
        roomtypes = retrieveproto('rtypes', roomtypes);
        dateproto = retrieveproto('mprototypes',dateproto);
    }

    for (i = 1; i < header.length; i++) {

        if (header[i] == 'Status') {
            arr[header[i]] = "<input type='checkbox' id='" + header[i] + "' checked>";
        }
        else if (header[i] == 'Room Type' || header[i] == 'Room Class' || header[i] == 'Room Facilities' || header[i] == 'Category' || header[i] == 'Privilege' || header[i] == 'Rights') {

            if (parentnode == 'rooms') {
                if (header[i] == 'Room Type') appendText = "<select id='" + header[i] + "'><option></option>" + roomtypes;
                if (header[i] == 'Room Facilities') appendText = "<select id='" + header[i] + "'><option></option>" + roomfacilities;
                if (header[i] == 'Room Class') appendText = "<select id='" + header[i] + "'><option></option>" + roomclasses;
                appendText += "</select>";
                arr[header[i]] = appendText;
            }
            else if (parentnode == 'kitems') {
                if (header[i] == 'Category') appendText = "<select id='" + header[i] + "'><option></option>" + kcategories;
                appendText += "</select>";
                arr[header[i]] = appendText;
            }
            else if (parentnode == 'users') {
                if (header[i] == 'Privilege') appendText = "<select id='" + header[i] + "'><option></option>" + privileges;
                appendText += "</select>";
                arr[header[i]] = appendText;
            }
            else if (parentnode == 'userlevels') {
                if (header[i] == 'Rights') appendText = "<select id='" + header[i] + "'><option></option>" + rights;
                appendText += "</select>";
                arr[header[i]] = appendText;
            }
            else arr[header[i]] = "<input type='text' id='" + header[i] + "'>";
        }
        else if (header[i] == 'Image') {
            if (parentnode == 'rtypes') {
                arr[header[i]] = "<img id='descimg' style='width:100%;height:100%;' src ='images/room.png'>" +
                    "<span onclick='imagejugaad()' style='cursor:pointer'>Upload</span>" +
                    "<form id='imageform' style='opacity:0.5'>" +
                    "<input id='roomimage'  onchange='jugaadcomplete()' name='dp' type='file' value='Upload'>" +
                    "<input id='submitimage' type='button' onclick='processimage()' value='Submit'></form>";
            }
        }
        else if (header[i] == 'Start Date' || header[i] == 'End Date') {
            arr[header[i]] = "<input id='" + header[i] + "' type='date' name='date'>";
        }
        else if (header[i] == 'Rate Type') {
            arr[header[i]] = "<select id='" + header[i] + "'><option id='single'>Nightly</option><option id='multiple'>Multiple,nights</option></select>";
        }
        else if (header[i] == 'Available Days') {
            arr[header[i]] = "<div style='margin-left:20%;margin-top:-5%;margin-bottom:2%;'><input id='mastercheck' onclick='checkall(this.id);' type='checkbox'>Check All</div><br>" +
                "<div id='weekdays'>" +
                "<span><input id='week0' type='checkbox'>Sun</span><span><input id='week1' type='checkbox'>Mon" +
                "</span><span><input id='week2' type='checkbox'>Tue</span><span><input id='week3' type='checkbox'>Wed" +
                "</span><span><input id='week4' type='checkbox'>Thu</span><span><input id='week5' type='checkbox'>Fri</span>" +
                "<span><input id='week6' type='checkbox'>Sat</span></div>";
        }
        else if (header[i] == 'Rate per Adult') {
            arr[header[i]] = "<div style='margin-left:-10%;' class='formspan'><span style='margin-right:120%;'>1</span><span style='margin-right:120%;'>2</span><span style='margin-right:120%;'>3</span><span style='margin-right:120%;'>4</span><span style='margin-right:120%;'>5</span></div><br><div style='margin-left:-80%;'>" +
                "<span>(default\nprice)&nbsp</span><input id='adult0' style='width:7%;margin-right:5%;'  type='number'>" +
                "<span>(extra)&nbsp</span>" +
                "<input id='adult1'style='width:7%;margin-right:2%;'  type='number'><input id='adult2'style='width:7%;margin-right:2%;'  type='number'><input id='adult3'style='width:7%;margin-right:2%;'  type='number'>" +
                "<input id='adult4'style='width:7%;margin-right:2%;'  type='number'><input id='adult5' style='width:7%;margin-right:2%;'  type='number'><select id='adultunit' style='margin-left:1%;'>" + units + "</select>" +
                " </div>";
        }
        else if (header[i] == 'Rate per Child') {
            arr[header[i]] = "<div style='margin-left:-10%;' class='formspan'><span style='margin-right:120%;'>1</span><span style='margin-right:120%;'>2</span><span style='margin-right:120%;'>3</span><span style='margin-right:120%;'>4</span><span style='margin-right:120%;'>5</span></div><br><div style='margin-left:-80%;'>" +
                "<span>(default\nprice)&nbsp</span><input id='child0'style='width:7%;margin-right:5%;'  type='number'>" +
                "<span>(extra)&nbsp</span>" +
                "<input id='child1'style='width:7%;margin-right:2%;'  type='number'><input id='child2'style='width:7%;margin-right:2%;'  type='number'><input id='child3' style='width:7%;margin-right:2%;'  type='number'>" +
                "<input id='child4' style='width:7%;margin-right:2%;'  type='number'><input id='child5' style='width:7%;margin-right:2%;'  type='number'><select id='childunit' style='margin-left:1%;'>" + units + "</select>" +
                " </div>";
        }
        else if (header[i] == 'No of Nights') {
            arr[header[i]] = "<input type='number' id='" + header[i] + "'>";
        }
        else if (header[i] == 'Taxes Applicable') {
            arr[header[i]] = "<div style='margin-left:5%;'><input style='margin-left:-15%;  type='text' id='" + header[i] + "'><select style='margin-left:5%;' data-input='"+header[i]+"'  id='select"+i + "' onchange='updateinput(this)'><option></option>" + taxes + "</select></div>";
        }
        else if (header[i] == 'Room types to apply') {
            arr[header[i]] = "<div style='margin-left:5%;'><input style='margin-left:-15%;  type='text' id='" + header[i] + "'><select style='margin-left:5%;' data-input='" + header[i] + "'  id='select" + i + "' onchange='updateinput(this)'><option></option>" + roomtypes + "</select></div>";
        }
        else if (header[i] == 'Rate prototype') {
            arr[header[i]] = "<select id='" + header[i] + "'>" + dateproto + "</select>";
        }
        else if (header[i] == 'Facilities') {
            if (parentnode == 'rtypes') {
                arr[header[i]] = "<select id='" + header[i] + "'><option></option>" + rtypefac + "</select>";
            }
        }
        else if (header[i] == 'Min' || header[i] == 'Max' || header[i] == 'Floor') {
            arr[header[i]] = "<select id='" + header[i] + "'>" + options + "</select>";
        }
        else {
            arr[header[i]] = "<input type='text' id='" + header[i] + "'>";
        }

    }
    //  alert(JSON.stringify(arr));
    return arr;
} 

function updateinput(selectobj) {
    selectid = selectobj.id;
    inputid = selectobj.dataset.input;
    console.log('#' + selectid);
    document.getElementById(inputid).value += $('#' + selectid).val() + ',';
}