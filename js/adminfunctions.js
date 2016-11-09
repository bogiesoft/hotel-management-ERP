function deselect(id, color) {
    if (id != null)
        $('#' + id).css('background-color', color);

}

function select(id) {
    if (id.replace('td', '')[1] != 0) {
        color = document.getElementById(id).style.backgroundColor;
        deselect(flipflop, color);
        flipflop = id;
        selected = id;

        $('#' + id).css('background-color', '#ccc');
    }
}

function assignkeys(a, b, c, d) {
    addkey = a;
    editkey = b;
    deletekey = c;
    refreshkey = d;
}

function add(key) {
    numlock = 1;
    assignkeys(1, 0, 0, 0);
    initialiseform(parentnode, header);
}

function edit() {
    numlock = 1;
    assignkeys(0, 1, 0, 0);
    if (selected != null) {
        selectedid = selected.replace('td', '');
        var unedited = $('#' + selected).children('span').html();
        var placeholder = $('#' + selected).children('span').html();
        if (header[selectedid[1]] == 'Image') {
        }
        else if (isNaN(obj[selectedid[0]][selectedid[1]]) || (obj[selectedid[0]][selectedid[1]] === "")) {
            var tempdiv = $("<div id='temp" + selectedid + "'  class='temp'>" +
                "<input id='text" + selectedid + "' type='text' value ='" + placeholder + "'/>" +
                "<span  onclick='updatevalue(" + selectedid + ")'>Edit</span>" +
                "<span id ='" + selectedid + "' onclick= \"cancel(this.id,'" + unedited + "') \">Cancel</span></div>");
            $('#' + selected).replaceWith(tempdiv);
        }
        else if (header[selectedid[1]] == 'Max' || header[selectedid[1]] == 'Min') {
            var tempdiv = $("<div id='temp" + selectedid + "'  class='temp'>" +
                "<select id='select" + selectedid + "'>" + options + "</select>" +
                "<span  onclick='updatevalue(" + selectedid + ")'>Edit</span>" +
                "<span id ='" + selectedid + "' onclick= \"cancel(this.id,'" + unedited + "') \">Cancel</span></div>");
            $('#' + selected).replaceWith(tempdiv);
        }
        else if (!isNaN(obj[selectedid[0]][selectedid[1]])) {
            var tempdiv = $("<div id='temp" + selectedid + "'  class='temp'>" +
                "<select id='select" + selectedid + "'><option>Active</option>" +
                "<option>Not Active</option></select><span  onclick='updatevalue(" + selectedid + ")'>Edit</span>" +
                "<span id ='" + selectedid + "' onclick= \"cancel(this.id,'" + unedited + "') \">Cancel</span></div>");
            $('#' + selected).replaceWith(tempdiv);
        }
    }
    else if (selectedrow != null) {
        var editrow = [];
        for (i = 1; i < obj[selectedrow].length; i++) {
            if (header[i] == 'Image') {
                editrow[editrow.length] = obj[selectedrow][i];
                var tempdiv = $("<td id='temp" + selectedrow + i + "'><img id='tempimg" + selectedrow + i + "' src='" + obj[selectedrow][i] + "' style='width:200px;height:150px;'>" +
                    "<br><span onclick='triggerupload(this.id)' id='spantemp" + selectedrow + i + "' style='cursor:pointer;margin-left:50%;margin-top:10%;'>Upload</span>" +
                    "<form id='formtemp" + selectedrow + i + "' style='opacity:0.5'>" +
                    "<input id='imagetemp" + selectedrow + i + "'  onchange='triggersubmit(this.id)' name='dp' type='file' value='Upload'>" +
                    "<input id='submittemp" + selectedrow + i + "' type='button' onclick='submitimage(this.id)' value='Submit'></form></td>");
                $('#td' + selectedrow + i).replaceWith(tempdiv);
            }
            else if (isNaN(obj[selectedrow][i]) || header[i] == 'Pass') {
                editrow[editrow.length] = obj[selectedrow][i];
                var placeholder = $('#td' + selectedrow + i).children('span').html();
                var tempdiv = $("<td id='temp" + selectedrow + i + "'><div class='temp'><input id='text" + selectedrow + "' type='text' value ='" + placeholder + "'/></div></td>");
                if (i == obj[selectedrow].length - 1) tempdiv = $("<td id='temp" + selectedrow + i + "'><div  class='temp'><input id='text" + selectedrow + "' type='text' value ='" + placeholder + "'/><span id='edit" + selectedrow + "' onclick='editrow(this.id)'>Edit</span><span id='cancel" + selectedrow + "' onclick='cancelrow(" + JSON.stringify(editrow) + ",this.id)'>Cancel</span></div></td>");
                $('#td' + selectedrow + i).replaceWith(tempdiv);
            }
            else if (header[i] == 'No of Nights') {
                editrow[editrow.length] = obj[selectedrow][i];
                var placeholder = $('#td' + selectedrow + i).children('span').html();
                var tempdiv = $("<td id='temp" + selectedrow + i + "'><div class='temp'><input id='number" + selectedrow + "' type='number' value ='" + placeholder + "'/></div></td>");
                if (i == obj[selectedrow].length - 1) tempdiv = $("<td id='temp" + selectedrow + i + "'><div  class='temp'><input id='text" + selectedrow + "' type='text' value ='" + placeholder + "'/><span id='edit" + selectedrow + "' onclick='editrow(this.id)'>Edit</span><span id='cancel" + selectedrow + "' onclick='cancelrow(" + JSON.stringify(editrow) + ",this.id)'>Cancel</span></div></td>");
                $('#td' + selectedrow + i).replaceWith(tempdiv);
            }
            else if (header[i] == 'Status') {
                editrow[editrow.length] = obj[selectedrow][i];
                var check;
                check = obj[selectedrow][i] == 1 ? "checked" : '';
                var tempdiv = $("<td id='temp" + selectedrow + i + "'><div  class='temp'><input type='checkbox' id='check" + selectedrow + i + "' " + check + "></div></td>");
                if (i == obj[selectedrow].length - 1) tempdiv = $("<td id='temp" + selectedrow + i + "'><div  class='temp'><input type='checkbox' id='check" + selectedrow + i + "' " + check + "><span id='edit" + selectedrow + "' onclick='editrow(this.id)'>Edit</span><span id='cancel" + selectedrow + "' onclick='cancelrow(" + JSON.stringify(editrow) + ",this.id)'>Cancel</span></div></td>");
                $('#td' + selectedrow + i).replaceWith(tempdiv);
            }
            else {
                editrow[editrow.length] = obj[selectedrow][i];
                var option;
                option = obj[selectedrow][i];

                var tempdiv = $("<td id='temp" + selectedrow + i + "'><div  class='temp'><select id='temp" + selectedrow + i + "'><option>" + option + "</option></select></div></td>");

                if (i == obj[selectedrow].length - 1) tempdiv = $("<td id='temp" + selectedrow + i + "'>" +
                    "<div  class='temp'><select id='temp" + selectedrow + i + "'><option>" + option + "</option></select>" +
                    "<span id='edit" + selectedrow + "' onclick='editrow(this.id)'>Edit</span>" +
                    "<span id='cancel" + selectedrow + "' onclick='cancelrow(" + JSON.stringify(editrow) + ",this.id)'>Cancel</span>" +
                    "</div></td>");
                $('#td' + selectedrow + i).replaceWith(tempdiv);
            }
        }


        if (selectedrow % 2 == 0) $('#td' + selectedrow + 0).css('background', '#F9F9F9');
        else $('#td' + selectedrow + 0).css('background', '#FFFFFF');
    }
}

function triggerupload(id) {
    var k = id.replace('span', 'image');
    document.getElementById(k).click();
}

function triggersubmit(id) {
    var k = id.replace('image', 'submit');
    document.getElementById(k).click();
}

function submitimage(id) {
    var k = id.replace('submit', 'form');
    var imgform = document.getElementById(k);
    k = k.replace('formtemp', '');
    var form = new FormData(imgform);
    $.ajax({
        type: "post",
        url: "roomimageuploader.php",
        data: form,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            imgpath = data;
            document.getElementById('tempimg' + k).src = data;
        },
        error: function () {
        }
    });
}

function cancelrow(arr, id) {
    j = arr;
    var k = id.replace('cancel', '');
    k = parseInt(k);
    restorerow(j, k);
    numlock = 0;
}

function restorerow(j, k) {
    for (i = 0; i < j.length; i++) {
        p = i + 1;
        if (header[p] == 'Image') {
            var temp = $("<td id='td" + k + p + "' onclick='select(this.id)'><span><img src='" + j[i] + "' style='width:200px;height:150px'></span></td>");
            $('#temp' + k + p).replaceWith(temp);
        }
        else if (header[p] != 'Status') {
            var temp = $("<td id='td" + k + p + "' onclick='select(this.id)'><span>" + j[i] + "</span></td>");
            $('#temp' + k + p).replaceWith(temp);
        }
        else {
            var temp;
            if (j[i] == 1) temp = $("<td id='td" + k + p + "' onclick='select(this.id)'><img src='images/Accept.gif' width='20' ></td>");
            else temp = $("<td id='td" + k + p + "' onclick='select(this.id)'><span>N/A</span></td>");
            $('#temp' + k + p).replaceWith(temp);
        }
    }
    if (k % 2 == 0) $('#td' + k + 0).css('background', '#F9F9F9');
    else $('#td' + k + 0).css('background', '#FFFFFF');
    document.getElementById('check' + k + '0').checked = false;
    numlock = 0;
    selectedrow = null;
}

function editrow(id) {
    var k = id.replace('edit', '');
    var editarray = [k];
    for (i = 1; i < obj[k].length; i++) {
        if (header[i] == 'Image') {
            if (parentnode == 'rtypes') rename('images/roomimages/' + $('#text' + k).val());
            editarray[editarray.length] = 'images/roomimages/' + $('#text' + k).val() + '.png';
        }
        else if (header[i] != 'Status') editarray[editarray.length] = $('#temp' + k + i).children('div').children('input').val();
        else {
            if (document.getElementById('check' + k + i).checked) {
                editarray[editarray.length] = 1;
            }
            else {
                editarray[editarray.length] = 0;
            }
        }
    }
    postedit(editarray);
    restorerow(editarray.slice(1, editarray.length), k);
    numlock = 0;
}

function rename(t) {
    t = t.replace(' ', '');
    t = t + '.png';
    $.ajax({
        type: "post",
        url: "rename.php",
        data: { currentpath: imgpath, rewritepath: t, key: '1' },
        success: function (data) {
            alert(data);
        },
        error: function () {
            console.log("failed renaming the image");
        }
    });
}

function postedit(arr) {
    arr = JSON.stringify(arr);
    $.ajax({
        type: "post",
        url: "editanything.php",
        timeout: 2000,
        data: { b: parentnode, insertarray: arr },
        success: function (data) {
            //console.log(data);
            numlock = 0;
        },
        error: function () {
        }
    });
}

function updatevalue(id) {
    $('#loading').fadeIn();
    var f = parseInt(id);
    if (header[f] != 'Min' && header[f] != 'Max') a = document.getElementById('text' + selectedid).value;
    else a = document.getElementById('select' + selectedid).value;
    var column = columnarray[selectedid[1]];
    var id = obj[selectedid[0]][0];
    postupdate(column, id, a, parentnode);
    numlock = 0;
}

function postupdate(column, id, value, b) {
    $.ajax({
        type: "post",
        url: "updateval.php",
        data: { column: column, id: id, value: value, b: b },
        success: function (data) {
            cancel(selectedid, a);
            $('#loading').fadeOut();
        },
        error: function () {
            alert("failed");
        }
    });
}

function cancel(id, unedited) {
    var div = $("<td id='td" + id + "' onclick='select(this.id)'><span>" + unedited + "</span></td>");
    $('#temp' + id).replaceWith(div);
    numlock = 0;
}

function refresh() {
    assignkeys(0, 0, 0, 1);
    retrievedata(parentnode, 0);
}

function del(id) {
    assignkeys(0, 0, 1, 0);
    var key = null;
    if (selected != null || selectedrow != null) {
        if (selected != null) {
            selectedid = selected.replace('td', '');
            if (confirm("Are u sure u want to delete row" + obj[selectedid[0]][0] + " ?") == 'true') key = obj[selectedid[0]][0];
            else {
                key = null;
                selectedid = null;
            }
        }
        if (selectedrow != null) {
            if (confirm("Are u sure u want to delete row" + obj[selectedrow][0] + " ?") == true) key = obj[selectedrow][0];
            else {
                key = null;
                selectedrow = null;
            }
        }
        $('#loading').fadeIn();
        $.ajax({
            type: "post",
            url: "deleterow.php",
            data: { id: key, b: parentnode },
            success: function (data) {
                if (selected != null) $('#tr' + selectedid[0]).hide();
                if (selectedrow != null) $('#tr' + selectedrow).hide();
                adjustelement(obj, key);
                refresh();
            },
            error: function (error) {
                alert("failed to delete row " + error.data);
            }
        });
        var unedited = $('#' + selected).children('span').html();
    }
}

function trialfunction(string) {
    var tempobj = {};
    string = string.split(',');
    for (i = 0; i < string.length; i++) {
        tempobj[string[i]] = "1";
    }
    //alert(JSON.stringify(tempobj));
}

function generatetable(num_rows, num_cols, width, id, obj, header, img) {
    //<div style='width:100%;text-align:center;font-size:1.2em;margin-bottom:1%;'><span><pre>"+parentnode+"</pre></span></div>
    var theader = "<table width='100%'  cellspacing='0' cellpadding='0' style='margin-top:2%;' id='resulttable'  class='table table-striped table-bordered '><thead>";
    var tbody = "<tbody>";
    for (var j = 0; j < num_cols; j++) {
        if (j != 0)
            theader += "<th id='th" + j + "' >" + header[j] + "<img src='images/bg_arrow.gif'></th>";
        else
            theader += "<th id='th" + j + "' >" + header[j] + "</th>";
    }
    theader += '</thead>';
    for (var i = 0; i < num_rows; i++) {
        tbody += "<tr id='tr" + i + "'>";
        for (var j = 0; j < num_cols; j++) {
            if (j != img) {
                if (header[j] == '#') {
                    tbody += "<td id='td" + i + "" + j + "' onclick='select(this.id)'><span>";
                    tbody += "<input type='checkbox' id='check" + i + j + "' onclick='selectrow(this.id)'>";
                    tbody += "</span></td>";

                }
                else if (header[j] == 'Rights') {
                    var ll = JSON.parse(obj[i][j]);
                    var zzz = '';
                    for (k = 0; k < privilegearray.length; k++) {
                        if (ll[privilegearray[k]] == 1) {
                            zzz += privilegearray[k] + ',';

                        }
                    }
                    tbody += "<td id='td" + i + "" + j + "' onclick='select(this.id)'><span>";
                    tbody += zzz;
                    tbody += "</span></td>";
                }
                else if (header[j] == 'Image') {
                    tbody += "<td id='td" + i + "" + j + "' onclick='select(this.id)'><span>";
                    if (obj[i][j] != '') tbody += "<img src ='" + obj[i][j] + "' style='width:200px;height:150px;'>";
                    else tbody += "<img src='images/room.png' style='width:100%;height:100%;'>";
                    tbody += "</span></td>";
                }
                else {
                    tbody += "<td id='td" + i + "" + j + "' onclick='select(this.id)'><span>";
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
    document.getElementById('display').innerHTML = theader + tbody + tfooter;
    var table = $('#resulttable').dataTable({ bFilter: true, bInfo: true });
    table.fnDraw();

}

function selectrow(id) {
    var id = id.replace('check', '');
    id = id[0];
    selected = null;
    selectedrow = id;
    if (document.getElementById('check' + id + 0).checked) {
        for (i = 0; i < obj[id].length; i++) {
            $('#td' + id + i).css('background', '#ccc');
        }
    }
    else {
        if (id % 2 == 0) {
            for (i = 0; i < obj[id].length; i++) {
                $('#td' + id + i).css('background', '#F9F9F9');

            }
            $('#td' + id + 0).css('background', '#F9F9F9');

        } else {
            for (i = 0; i < obj[id].length; i++) {
                $('#td' + id + i).css('background', '#FFFFFF');
            }
            $('#td' + id + 0).css('background', '#FFFFFF');

        }
    }
}