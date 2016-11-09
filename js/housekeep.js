$(document).ready(function () {
    $('#loading').hide();
    var table = $('#example').dataTable({ bFilter: true, bInfo: false });

    $("#popup").dialog({
        autoOpen: false,
        maxWidth: 600,
        maxHeight: 500,
        width: 600,
        height: 500,
        modal: true,
        buttons: {
            "Submit": function () {
                var a = $('#name').val();
                var b = $('#message').val();
                $.ajax({
                    type: "POST",
                    url: "uploader.php",
                    data: { name: a, message: b },
                    timeout: 6000,
                    dialogclass: 'popup',
                    error: function () {
                        alert("failed");
                        $('#popup').dialog("close");

                    },
                    success: function () {
                        $('#popup').dialog("close");

                    }
                });
            },
            Cancel: function () {
                $('#popup').dialog("close");
            }
        },
        close: function () {
            $('#popup').dialog("close");
        }
    });

    $('#popup').hide();

});


function status(value, id) {
    var a = document.getElementsByClassName('a');
    var b = 0;
    var msg = "";
    while (b < a.length) {
        var c = a[b].id;
        if (document.getElementById(c).checked) {
            c = c.replace('check', '');
            msg += c + '.' + value + ',';
        }

        b++;
    }

    $.ajax({
        type: "POST",
        url: "updater.php",
        data: { sequence: msg },
        timeout: 6000,
        error: function () {
            alert("failed");
        },
        success: function () {
            $('#loading').show();
            window.location.reload();
            $('#loading').fadeOut(2000);
        }

    });

}

function priority(value, id) {
    var a = document.getElementsByClassName('a');
    var b = 0;
    var msg = "";
    while (b < a.length) {
        var c = a[b].id;
        if (document.getElementById(c).checked) {
            c = c.replace('check', '');
            msg += c + '.' + value + ',';
        }

        b++;
    }

    $.ajax({
        type: "POST",
        url: "updater.php",
        data: { priority: msg },
        timeout: 6000,
        error: function () {
            alert("failed");
        },
        success: function () {
            $('#loading').show();
            window.location.reload();
            $('#loading').fadeOut(2000);
            ;
        }

    });

}

function assignee(value, id) {
    var a = document.getElementsByClassName('a');
    var b = 0;
    var msg = "";
    while (b < a.length) {
        var c = a[b].id;
        if (document.getElementById(c).checked) {
            c = c.replace('check', '');
            msg += c + '.' + value + ',';
        }

        b++;
    }

    $.ajax({
        type: "POST",
        url: "updater.php",
        data: { keeper: msg },
        timeout: 6000,
        error: function () {
            alert("failed");
        },
        success: function () {
            $('#loading').show();
            window.location.reload();
            $('#loading').fadeOut(2000);
        }

    });

}


function feedback(id) {
    document.getElementById('name').value = id;
    $('#popup').dialog("open");
}

