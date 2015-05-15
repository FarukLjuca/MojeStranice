document.getElementById("dugme").addEventListener("click", function() {
    var alphanumeric = document.getElementById("tekst").value;
    var alpha = "";
    var i;
    var broj = 0;

    for (i = 0; i < alphanumeric.length; i++) {
        if (alphanumeric[i] == parseInt(alphanumeric[i])) {
            broj += parseInt(alphanumeric[i]);
            broj *= 10;
            if (i == alphanumeric.length-1) {
                alpha += pretvori(broj);
            }
        }
        else if (broj != 0) {
            alpha += pretvori(broj);
            broj = 0;
        }
        else {
            alpha += alphanumeric[i];
        }
    }
    document.getElementById("tekst").value = alpha;
}, false);
function pretvori (broj) {
    var tekst = "";
    var jedinice = ["nula", "jedan", "dva", "tri", "četiri", "pet", "šest", "sedam", "osam", "devet"];
    var desetice = ["deset", "dvadeset", "trideset", "četrdeset", "pedeset", "šezdeset", "sedamdeset", "osamdeset", "devedeset"];
    var izuzeci = ["jedanaest", "dvanaest", "trinaest", "četrnaest", "petnaest", "šesnaest", "sedamnaest", "osamnaest", "devetnaest"];
    var stotice = ["stotinu", "dvije stotoine", "tri stotine", "četiri stotine", "pet stotina", "šest stotina", "sedam stotina", "osam stotina", "devet stotina"];
    var hiljade = ["jedna hiljada", "dvije hiljade", "tri hiljade", "četiri hiljade", "pet hiljada", "šest hiljada", "sedam hiljada", "osam hiljada", "devet hiljada"];
    var milioni = ["jedan milion", "dva miliona", "tri miliona", "četiri miliona", "pet miliona", "šest miliona", "sedam miliona", "osam miliona", "devet miliona"];

    broj /= 10;
    if (broj.toString().length == 1) {
        tekst = jedinice[broj];
    }
    else if (broj.toString().length == 2) {
        tekst = dvocifrenBroj(broj);
    }
    else if (broj.toString().length == 3) {
        tekst = trocifrenBroj(broj);
    }
    else if (broj.toString().length == 4) {
        var hilj = parseInt(broj.toString()[0]);
        broj = parseInt(broj.toString()[1] + broj.toString()[2] + broj.toString()[3]);
        if (hilj == 1) {
            tekst += "jedna hiljada ";
        }
        else if (hilj == 2) {
            tekst += "dvije hiljade ";
        }
        else if (hilj == 3 || hilj == 4) {
            tekst += jedinice[hilj];
            tekst += " hiljade ";
        }
        else {
            tekst += jedinice[hilj];
            tekst += " hiljada ";
        }
        tekst += trocifrenBroj(broj);
    }
    else if (broj.toString().length == 5) {
        var hilj = parseInt(broj.toString()[0] + broj.toString()[1]);
        broj = parseInt(broj.toString()[2] + broj.toString()[3] + broj.toString()[4]);
        tekst = dvocifrenBroj(hilj) + " hiljada " + trocifrenBroj(broj);
    }
    else if (broj.toString().length == 6) {
        var hilj = parseInt(broj.toString()[0] + broj.toString()[1] + broj.toString()[2]);
        broj = parseInt(broj.toString()[3] + broj.toString()[4] + broj.toString()[5]);
        tekst = trocifrenBroj(hilj) + " hiljada " + trocifrenBroj(broj);
    }
    else if (broj.toString().length == 7) {

    }
    else if (broj.toString().length == 8) {

    }
    else {
        alert("Unjeli ste broj većin ili jednak od jedne milijarde!");
    }

    return tekst;
}
function dvocifrenBroj (broj) {
    var jedinice = ["nula", "jedan", "dva", "tri", "četiri", "pet", "šest", "sedam", "osam", "devet"];
    var desetice = ["deset", "dvadeset", "trideset", "četrdeset", "pedeset", "šezdeset", "sedamdeset", "osamdeset", "devedeset"];
    var izuzeci = ["jedanaest", "dvanaest", "trinaest", "četrnaest", "petnaest", "šesnaest", "sedamnaest", "osamnaest", "devetnaest"];
    var tekst = "";

    if (broj < 19 && broj != 10) {
        tekst = izuzeci[broj - 11];
    }
    else {
        var jed = broj % 10;
        broj = Math.floor(broj / 10);

        if (jed == 0 && broj ==0) {
            tekst += "";
        }
        else if (jed == 0) {
            tekst = desetice[broj-1];
        }
        else {
            tekst = desetice[broj-1] + " i " + jedinice[jed];
        }
    }
    return tekst + " ";
}
function trocifrenBroj (broj) {
    var jedinice = ["nula", "jedan", "dva", "tri", "četiri", "pet", "šest", "sedam", "osam", "devet"];
    var desetice = ["deset", "dvadeset", "trideset", "četrdeset", "pedeset", "šezdeset", "sedamdeset", "osamdeset", "devedeset"];
    var izuzeci = ["jedanaest", "dvanaest", "trinaest", "četrnaest", "petnaest", "šesnaest", "sedamnaest", "osamnaest", "devetnaest"];
    var stotice = ["stotinu", "dvije stotine", "tri stotine", "četiri stotine", "pet stotina", "šest stotina", "sedam stotina", "osam stotina", "devet stotina"];
    var tekst = "";

    var izuz = broj % 100;
    var jed = broj % 10;
    broj = Math.floor(broj / 10);
    var des = broj % 10;
    broj = Math.floor(broj / 10);

    if (des == 0 && jed == 0 && broj == 0) {
        tekst += "";
    }
    else if (des == 0 && broj == 0) {
        tekst += "i " + jedinice [jed];
    }
    else if (des == 0 && jed == 0) {
        tekst += stotice[broj-1];
    }
    else if (des == 0) {
        tekst += stotice[broj-1] + " i " + jedinice[jed];
    }
    else if (jed == 0) {
        tekst += stotice[broj-1] + " i " + desetice[des];
    }
    else if (broj == 0) {
        tekst += desetice[des-1] + " i " + jedinice[jed];
    }
    else {
        if (izuz < 19) {
            tekst += stotice[broj-1] + " " + izuzeci[jed-1];
        }
        else {
            tekst += stotice[broj-1] + " " + desetice[des-1] + " i " + jedinice[jed];
        }
    }
    return tekst + " ";
}