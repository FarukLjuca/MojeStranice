function ucitajAsinhrono(broj) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.getElementById("podaci").innerHTML = ajax.responseText;
        }
    }
    ajax.open("GET", "http://localhost:63342/WT2015/Tutorijal%205/stranica" + broj + ".html", true);
    ajax.send();
}