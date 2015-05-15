function dodavanje() {

    var objekat = {
        ime: document.getElementById("ime").value,
        prezime: document.getElementById("prezime").value,
        brojTelefona: document.getElementById("brojTelefona").value
    };

    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            document.getElementById("status").innerHTML = ajax.responseText;
            osvjezi();
        }
    }

    ajax.open("post", "servis-z1.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("akcija=dodavanje&objekat=" + JSON.stringify(objekat));
}

function promjena(i) {
    var objekat = {
        ime: document.getElementById("ime").value,
        prezime: document.getElementById("prezime").value,
        brojTelefona: document.getElementById("brojTelefona").value
    };

    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            document.getElementById("status").innerHTML = ajax.responseText;
            osvjezi();
        }
    }

    ajax.open("post", "servis-z1.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("akcija=promjena&redniBroj=" + i + "&objekat=" + JSON.stringify(objekat));
}

function brisanje(i) {
    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            document.getElementById("status").innerHTML = ajax.responseText;
            osvjezi();
        }
    }

    ajax.open("post", "servis-z1.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("akcija=brisanje&redniBroj=" + i);
}

function osvjezi() {
    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            var unutrasnjostTabele = "<tr><th>Ime</th><th>Prezime</th><th>Broj telefona</th><th>Promjena</th><th>Brisanje</th></tr>";
            var objekti = JSON.parse(ajax.responseText);

            var i;
            for(i=0; i<objekti.length; i++) {
                unutrasnjostTabele += "<tr><td style='border: 1px solid red'>" +
                    objekti[i].ime + "</td><td style='border: 1px solid blue'>" +
                    objekti[i].prezime + "</td><td style='border: 1px solid green'>" +
                    objekti[i].brojTelefona + "</td><td style='border: 1px solid orange'>" +
                    "<button onclick='promjena("+i+")'>Promjeni</button></td><td style='border: 1px solid black'>" +
                    "<button onclick='brisanje("+i+")'>Obrisi</button></td>";
            }
            document.getElementById("imenik").innerHTML = unutrasnjostTabele;
        }
    }

    ajax.open("post", "servis-z1.php", true);
    ajax.send();
}

onload = osvjezi();