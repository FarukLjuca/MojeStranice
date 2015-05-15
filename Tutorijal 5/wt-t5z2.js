function provjeri() {
    var ajax =  new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.getElementById("ispis").innerHTML = ajax.responseText;
            if (ajax.responseText == "NOT OK") {
                document.getElementById("grad").style.borderColor = "red";
            }
            else {
                document.getElementById("grad").style.backgroundColor = "lightGreen";
                document.getElementById("grad").style.borderColor = "lightBlue";
            }
        }
    }

    var grad = document.getElementById("grad").value;
    ajax.open("GET", "http://zamger.etf.unsa.ba/provjeriGrad.php?grad=" + grad, true);
    ajax.send();
}