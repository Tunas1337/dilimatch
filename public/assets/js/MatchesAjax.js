function loadDoc() {
    var counter = 0;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText !== 'no more users') {
                userJson = JSON.parse(this.responseText);
                $(".btn")[0].disabled = false;
                $(".btn")[1].disabled = false;
                document.getElementById('loading').style.display = "none";
                document.getElementById('user-info').style.display = "";
                document.getElementById('user-bio').innerHTML = userJson.bio;
                document.getElementById('user-preference').innerHTML = userJson.preference;
                document.getElementById('user-interests').innerHTML = userJson.interests;
            } else {
                if (counter > 15) {
                    counter = 0;
                    $('.user-info-body').html("<div class='alert alert-info'><strong>Sorry, all out!</strong><br/><p>Check back later.</p></div>");
                    $(".btn")[0].disabled = true;
                    $(".btn")[1].disabled = true;
                } else {
                    counter++;
                    xhttp.open("GET", "/users/next", true);
                    xhttp.send();
                }
            }
        }
    };
    xhttp.open("GET", "/users/next", true);
    xhttp.send();
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function SendResponse(action) {
    //Send yay or nay to server
    var params = '?action=' + action;
    $(".btn")[0].disabled = true;
    $(".btn")[1].disabled = true;
    $.ajaxSetup({
        headers: {
            'X-XSRF-TOKEN': getCookie("XSRF-TOKEN")
        }
    });
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "/users/" + userJson.uuid + params,
        success: function(data) {
            if (data.includes("MATCH!!!")) {
                match = data.slice(8, );
                match = JSON.parse(match);
                name = match.name;
                $('#matchModal').modal('show');
                $('.matchModal-body').html("<p>You matched with " + name + ".</p>");
                $(".btn")[0].disabled = false;
                $(".btn")[1].disabled = false;
                loadDoc();
            } else {
                $(".btn")[0].disabled = false;
                $(".btn")[1].disabled = false;
                loadDoc();
            }
        }
    });
}
loadDoc();