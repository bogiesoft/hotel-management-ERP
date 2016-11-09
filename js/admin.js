/* Works even if we don't initialise vars , bt don't mess with it , it is a good practice :) */
var addkey = null;
var editkey = null;
var deletekey = null;
var refreshkey = null;
var header = [];
var img = null;
var obj = null;
var parentnode = null;
var selected = null;
var selectedrow = null;
var flipflop = null;
var columnarray = [];
// golden rule := masterobj.length = pointerarray's last element +1
var masterobj = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
var pointerarray = { "rfacilities": 0, "rclasses": 1, "rtypes": 2, "rooms": 3, "kitems": 4, "kcategories": 5, "users": 6, "userlevels": 7, "userrights": 8, "mtaxes": 9, "maddons": 10, "mprototypes": 11, "munits": 12, "mrates": 13 };
var fliparray = [];
var appendText = '';
var formarray = {};
var tempcontainer = [];
var privilegearray = ["Reservation", "AdminPanel", "RoomOperations", "Dashboard"];
referencearray = {
    "id": "#",
    "facility": "Facility",
    "room_facilities": "Room Facilities",
    "is_active": "Status",
    "description": "Description",
    "class": "Room Class",
    "room_type": "Room Type",
    "room_no": "Room No",
    "default_occupancy": "Min",
    "max_occupancy": "Max",
    "floor": "Floor",
    "house_keeping_status": "House keeping",
    "priority": "priority",
    "category": "Category",
    "item": "Item",
    "price": "Price",
    "username": "User Name",
    "password": "Pass",
    "email": "Email",
    "privilege": "Privilege",
    "status": "Status",
    "rights": "Rights",
    "image": "Image",
    "accronym": "Accronym",
    "facilities": "Facilities",
    "access": "Access to",
    "name": "Name",
    "value": "Value",
    "charge_type": "Charge Type",
    "start_date": "Start Date",
    "end_date": "End Date",
    "available_days": "Available Days",
    "adult": "Rate per Adult",
    "children": "Rate per Child",
    "code": "Code",
    "type": "Rate Type",
    "nights": "No of Nights",
    "taxes": "Taxes Applicable",
    "rooms": "Room types to apply",
    "date_prototype":"Rate prototype"
};

/* the main function which parses the id nd displays the proper table , theres a trick into it
To really make it fast it queries the database only first time nd stores the data in the page itself
This makes it real fast :)  :) */

function parse(id) {
    restore();
    img = null;
    header = [];
    parentnode = id;
    if (!isNaN(masterobj[pointerarray[id]])) {
        retrievedata(id, 0);
    }
    else {
        manipulateobj(id);
    }

}

function retrievedata(id, key) {
    if (key == 0) $('#loading').fadeIn();
    $.ajax({
        type: "post",
        url: "extractor.php",
        data: { b: id },
        success: function (data) {
            console.log(data);
            data = JSON.parse(data);
            masterobj[pointerarray[id]] = data;
            if (key == 0) {
                manipulateobj(id);
                $('#loading').fadeOut(100);
            }
            else if (key == 1) {
                add(1);
            }
            $('#resulttable_filter').children('label').children('input').focusin(function () {
                numlock = 1;
            });

            $('#resulttable_filter').children('label').children('input').focusout(function () {
                numlock = 0;
            });

        },
        error: function () {
            alert("failed");
        }

    });
}

function manipulateobj(id) {
    obj = masterobj[pointerarray[id]][0];
    columnarray = masterobj[pointerarray[id]][1];
    jugaad();
    generatetable(obj.length, obj[0].length, 10, 'table' + id, obj, header, img);
}

/* It may seem that this function increases execution time nd is not necessary .
   Bt try it , it speedens the process nd makes the code more flexible :) */

function jugaad() {

    for (i = 0; i < columnarray.length; i++) {
        header[i] = referencearray[columnarray[i]];
        if (header[i] == 'Status') img = i;
    }

}

$(document).ready(function () {
    $('#loading').hide();
    $('#form').hide();
    document.getElementById('rooms').click();

    $('#rul').click(function () {
        $('#rdrawer').slideToggle();
    });

    $('#kul').click(function () {
        $('#kdrawer').slideToggle();
    });

    $('#mul').click(function () {
        $('#mdrawer').slideToggle();
    });

    $('#jul').click(function () {
        $('#jdrawer').slideToggle();
    });
    $('#nul').click(function () {
        $('#ndrawer').slideToggle();
    });

    $('#hul').click(function () {
        $('#hdrawer').slideToggle();
    });

    $('#dul').click(function () {
        $('#ddrawer').slideToggle();
    });



});

/*this is inspired from games W,A,S,D . so here A is for add , R is refresh , E is edit , nd D is delete :) 
numlock set to 1 locks this functionality :) */

$(document).keypress(function (event) {
    if (numlock == 0) {
        if (event.which == 65 || event.which == 97) {
            document.getElementById('addkey').click();
        }
        else if (event.which == 69 || event.which == 101) {
            document.getElementById('editkey').click();
        }

        else if (event.which == 68 || event.which == 100) {
            document.getElementById('delkey').click();
        }

        else if (event.which == 82 || event.which == 114) {
            document.getElementById('refreshkey').click();
        }
    }
});

/* this function is for fading the background of the form */
function diffuse() {
    $('#header').css('opacity', '0.7');
    $('#holder').css('opacity', '0.7');
}


var imgpath = 'images/room.png';
var typecreated = '';

function processimage() {
    var imgform = document.getElementById('imageform');
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
            document.getElementById('descimg').src = data;
        },
        error: function () {
        }
    });
}

function jugaadcomplete() {
    document.getElementById('submitimage').click();
}

function imagejugaad() {
    document.getElementById('roomimage').click();
}

/* displays the appropriate add form according to parentnode */
function initialiseform(parentnode, header) {
    numlock = 1;
    formhtml = "";
    /* this is to overcome the overflowing problem of large form if u r good at css may be this is not required :) */
    if (parentnode == 'rooms' || parentnode == 'rtypes' || parentnode == 'mprototypes' || parentnode == 'mrates') {
        formhtml += "<span onclick='restore()' class='ico gray close'></span>";
        $('.close').hide();
        $('#form').css('overflow', 'auto');
    }
    else {
        $('.close').show();
        $('#form').css('overflow', '');
    }
    ///////////////////the preloader shows up , back diffuses ///////////////////////////////////////////////////////////// 
    $('#loading').show();
    formarray = formformarray(formarray);
    beg = "<div class='wrap'>";
    end = "</div>";
    for (i = 1; i < header.length; i++) {
        formhtml += beg + header[i] + end;
        formhtml += beg + formarray[header[i]] + end;
    }
    formhtml += beg + "<input type='button' onclick='processform()' value='Add'>" + end;
    document.getElementById('popup_content').innerHTML = formhtml;
    diffuse();
    $('#loading').hide();
    $('#form').show();
}
/* restores d background nd d form vanishes :) */
function restore() {
    numlock = 0;
    $('#header').css('opacity', '1');
    $('#holder').css('opacity', '1');
    $('#form').hide();
}

function renameimg() {
    typecreated = document.getElementById('Room Type').value;
    typecreated = typecreated.replace(' ', '');
    typecreated = typecreated + '.png';
    $.ajax({
        type: "post",
        url: "rename.php",
        data: { currentpath: imgpath, rewritepath: typecreated },
        success: function (data) {
            alert(data);
        },
        error: function () {
            console.log("failed renaming the object");
        }
    });

}

function processform() {
    if (parentnode == 'rtypes') renameimg();
    insertarray = [];
    insertarray = populatearray(insertarray, header);
    $.ajax({
        type: "post",
        url: "addanything.php",
        data: { b: parentnode, insertarray: insertarray },
        timeout: 2000,
        success: function (data) {
            alert(data);
            document.getElementById('refreshkey').click();
            restore();
        },
        error: function () {
            alert("failed");
        }
    });
}
