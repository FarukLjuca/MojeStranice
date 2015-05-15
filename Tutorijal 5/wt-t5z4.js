var sviID = [];
var studenti = [];

function osvjezi() {
    var tabela = document.getElementById("tabelaStudenata");

    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            var tekst = ajax.responseText;
            studenti = JSON.parse(tekst);

            var tabelaUnutrasnjost = "<tr><th>ID</th><th>Predmet</th><th>Ime</th><th>Prezime</th><th>Prisustvo</th><th>Zadaće</th><th>Prva parcijala</th><th>Druga parcijala</th><th>Ocjena</th></tr>";
            var i;
            for (i=0; i<studenti.length; i++) {
                tabelaUnutrasnjost +=
                    "<tr> <td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + studenti[i]["id"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + studenti[i]["predmet"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + studenti[i]["ime"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + studenti[i]["prezime"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + studenti[i]["prisustvo"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + studenti[i]["zadace"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + studenti[i]["1parc"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + studenti[i]["2parc"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + studenti[i]["ocjena"] + "</tr>";
                sviID.push(studenti[i]["id"]);
            }
            tabela.innerHTML = tabelaUnutrasnjost;

            // Osvjezi niz ID-ova

            var _idBrisanje = document.getElementById("idBrisanje");
            var _idPromjena = document.getElementById("idPromjena");

            _idBrisanje.innerHTML = " ";
            _idPromjena.innerHTML = " ";

            var i;
            for (i=0; i<sviID.length; i++) {
                _idBrisanje.innerHTML += "<option>" + sviID[i] + "</option>"
                _idPromjena.innerHTML += "<option>" + sviID[i] + "</option>"
            }
        }
    }
    ajax.open("POST", "http://zamger.etf.unsa.ba/studenti.php", true);
    ajax.send();
}
onload = osvjezi();

function promjenaAkcije() {
    var akcija = document.getElementById("akcija").value;

    if(akcija == "Dodavanje") {
        document.getElementById("dodavanje").style.display = "block";
        document.getElementById("promjena").style.display = "none";
        document.getElementById("brisanje").style.display = "none";
    }
    else if (akcija == "Promjena") {
        document.getElementById("dodavanje").style.display = "none";
        document.getElementById("promjena").style.display = "block";
        document.getElementById("brisanje").style.display = "none";
    }
    else if (akcija == "Brisanje") {
        document.getElementById("dodavanje").style.display = "none";
        document.getElementById("promjena").style.display = "none";
        document.getElementById("brisanje").style.display = "block";
    }
    else {
        alert("Neocekivano ponasanje.")
    }
}

function promjenaPromjene() {
    var _predmet = document.getElementById("predmetPromjena");
    var _ime = document.getElementById("imePromjena");
    var _prezime = document.getElementById("prezimePromjena");
    var _prisustvo = document.getElementById("prisustvoPromjena");
    var _zadace = document.getElementById("zadacePromjena");
    var _prvaParcijala = document.getElementById("prvaParcijalaPromjena");
    var _drugaParcijala = document.getElementById("drugaParcijalaPromjena");
    var _ocjena = document.getElementById("ocjenaPromjena");

    var indeks = parseInt(document.getElementById("idPromjena").options[document.getElementById("idPromjena").selectedIndex].text);

    var i;
    for(i=0; i<studenti.length; i++) {
        if ( indeks == studenti[i]["id"]) {
            _predmet.value = studenti[i]["predmet"];
            _ime.value = studenti[i]["ime"];
            _prezime.value = studenti[i]["prezime"];
            _prisustvo.value = studenti[i]["prisustvo"];
            _zadace.value = studenti[i]["zadace"];
            _prvaParcijala.value = studenti[i]["1parc"];
            _drugaParcijala.value = studenti[i]["2parc"];
            _ocjena.value = studenti[i]["ocjena"];
            break;
        }
    }
}

function dodaj() {
    var _predmet = parseInt(document.getElementById("predmetDodavanje").value);
    var _ime = document.getElementById("imeDodavanje").value;
    var _prezime = document.getElementById("prezimeDodavanje").value;
    var _prisustvo = parseInt(document.getElementById("prisustvoDodavanje").value);
    var _zadace = parseInt(document.getElementById("zadaceDodavanje").value);
    var _prvaParcijala = parseInt(document.getElementById("prvaParcijalaDodavanje").value);
    var _drugaParcijala = parseInt(document.getElementById("drugaParcijalaDodavanje").value);
    var _ocjena = parseInt(document.getElementById("ocjenaDodavanje").value);

    var student = {
        id: 0,
        predmet: _predmet,
        ime: _ime,
        prezime: _prezime,
        prisustvo: _prisustvo,
        zadace: _zadace,
        "1parc": _prvaParcijala,
        "2parc": _drugaParcijala,
        ocjena: _ocjena
    }

    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if (ajax.status == 200 && ajax.readyState == 4) {
            document.getElementById("errorDodaj").innerHTML = "Student je uspjesno unesen.";
            osvjezi();
            document.getElementById("predmetDodavanje").value = "";
            document.getElementById("imeDodavanje").value = "";
            document.getElementById("prezimeDodavanje").value = "";
            document.getElementById("prisustvoDodavanje").value = "";
            document.getElementById("zadaceDodavanje").value = "";
            document.getElementById("prvaParcijalaDodavanje").value = "";
            document.getElementById("drugaParcijalaDodavanje").value = "";
            document.getElementById("ocjenaDodavanje").value = "";
        }
        else if (ajax.status == 400 && ajax.readyState == 4) {
            alert("Neispravni podaci");
        }
        else if (ajax.status == 404 && ajax.readyState == 4) {
            alert("Nepostojeći student");
        }
    }
    ajax.open("POST", "http://zamger.etf.unsa.ba/studenti.php", true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send ("akcija=dodavanje&student=" + JSON.stringify(student));
}

function obrisi() {

    var student = {
        id: parseInt(document.getElementById("idBrisanje").options[document.getElementById("idBrisanje").selectedIndex].text),
        predmet: "",
        ime: "",
        prezime: "",
        prisustvo: "",
        zadace: "",
        "1parc": "",
        "2parc": "",
        ocjena: ""
    }

    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if (ajax.status == 200 && ajax.readyState == 4) {
            document.getElementById("errorObrisi").innerHTML = "Student je uspjesno obrisan.";
            osvjezi();
        }
        else if (ajax.status == 400 && ajax.readyState == 4) {
            alert("Neispravni podaci");
        }
        else if (ajax.status == 404 && ajax.readyState == 4) {
            alert("Nepostojeći student");
        }
    }
    ajax.open("POST", "http://zamger.etf.unsa.ba/studenti.php", true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send ("akcija=brisanje&student=" + JSON.stringify(student));
}

function promjeni() {
    var _predmet = parseInt(document.getElementById("predmetPromjena").value);
    var _ime = document.getElementById("imePromjena").value;
    var _prezime = document.getElementById("prezimePromjena").value;
    var _prisustvo = parseInt(document.getElementById("prisustvoPromjena").value);
    var _zadace = parseInt(document.getElementById("zadacePromjena").value);
    var _prvaParcijala = parseInt(document.getElementById("prvaParcijalaPromjena").value);
    var _drugaParcijala = parseInt(document.getElementById("drugaParcijalaPromjena").value);
    var _ocjena = parseInt(document.getElementById("ocjenaPromjena").value);

    var student = {
        id: parseInt(document.getElementById("idPromjena").options[document.getElementById("idPromjena").selectedIndex].text),
        predmet: _predmet,
        ime: _ime,
        prezime: _prezime,
        prisustvo: _prisustvo,
        zadace: _zadace,
        "1parc": _prvaParcijala,
        "2parc": _drugaParcijala,
        ocjena: _ocjena
    }

    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if (ajax.status == 200 && ajax.readyState == 4) {
            document.getElementById("errorPromjeni").innerHTML = "Student je uspjesno promjenjen.";
            osvjezi();
            document.getElementById("idPromjena").value = "";
            document.getElementById("predmetPromjena").value = "";
            document.getElementById("imePromjena").value = "";
            document.getElementById("prezimePromjena").value = "";
            document.getElementById("prisustvoPromjena").value = "";
            document.getElementById("zadacePromjena").value = "";
            document.getElementById("prvaParcijalaPromjena").value = "";
            document.getElementById("drugaParcijalaPromjena").value = "";
            document.getElementById("ocjenaPromjena").value = "";
        }
        else if (ajax.status == 400 && ajax.readyState == 4) {
            alert("Neispravni podaci");
        }
        else if (ajax.status == 404 && ajax.readyState == 4) {
            alert("Nepostojeći student");
        }
    }
    ajax.open("POST", "http://zamger.etf.unsa.ba/studenti.php", true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send ("akcija=promjena&student=" + JSON.stringify(student));
}