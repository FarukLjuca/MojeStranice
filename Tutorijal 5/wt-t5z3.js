var prosliUpdate = "";

$(document).ready(function() {
    setInterval(function(){
        $.ajax({
            url      : document.location.protocol + '//ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=10&callback=?&q=' + encodeURIComponent('http://stackoverflow.com/feeds'),
            dataType : 'json',
            success  : function (data) {
                if (data.responseData.feed && data.responseData.feed.entries) {
                    $.each(data.responseData.feed, function (i, e) {
                        var update = e.updated;
                        if(update != prosliUpdate) {
                            prosliUpdate = update;
                            osvjezi();
                        }
                    });
                }
            }
        });
    }, 1);
});

function osvjezi() {
    $.ajax({
        url      : document.location.protocol + '//ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=10&callback=?&q=' + encodeURIComponent('http://stackoverflow.com/feeds'),
        dataType : 'json',
        success  : function (data) {
            if (data.responseData.feed && data.responseData.feed.entries) {
                var tekst = "";
                $.each(data.responseData.feed.entries, function (i, e) {
                    tekst += "<p><h3>" + e.title + "</h3>";
                    tekst += "Pitanje se nalazi na <a href='" + e.id + "'>ovom</a> linku</p><br>";
                });
                document.getElementById("tekst").innerHTML = tekst;
            }
        }
    });
}