function foo () {
    var can = document.getElementById("slika");
    var ctx = can.getContext("2d");
    ctx.beginPath();
    ctx.lineTo(0,100);
    ctx.lineTo(200,100);
    ctx.closePath();
    ctx.stroke();
    ctx.beginPath();
    ctx.lineTo(100,0);
    ctx.lineTo(100,200);
    ctx.closePath();
    ctx.stroke();
}
var boja = 0;
var moguceBoje = ["red", "green", "blue", "brown", "orange"];
onload = foo();
document.getElementById("dugme").addEventListener("click", function() {
    var can = document.getElementById("slika");
    var ctx = can.getContext("2d");
    var fija = document.getElementById("funkcija").value;
    var i = 0;
    var niz = [];
    var slobodniClan = 0, temp = null;
    var negativan = null, prijeEksponenta = true, imaExp = false;

    while (i < fija.toString().length) {
        if (fija[i] == parseInt(fija[i]) && true == prijeEksponenta) {
            if (temp == null) {
                temp = 0;
            }
            temp *= 10;
            temp += parseInt(fija[i]);
            if (i == fija.toString().length-1) {
                if (true == negativan) {
                    temp *= -1;
                }
                slobodniClan = temp;
            }
        }
        else if (fija[i] == "-" && negativan == null) {
            negativan = true;
        }
        else if (fija[i] == "+" && negativan == null) {
            negativan = false;
        }
        else if (fija[i] == "x") {
            if (temp == null) {
                temp = 1;
            }
            if (negativan == null) {
                negativan = false;
            }
            if (true == negativan) {
                temp *= -1;
            }
            niz[niz.length] = parseInt(temp);
            if (i == fija.toString().length-1) {
                niz[niz.length] = parseInt(1);
            }
            temp = 0;
        }
        else if (fija[i] == "^") {
            imaExp = true;
            prijeEksponenta = false;
            negativan = false;
        }
        else if (fija[i] == parseInt(fija[i]) && false == prijeEksponenta) {
            temp *= 10;
            temp += parseInt(fija[i]);
            if (negativan == null) {
                negativan = false;
            }
            if (i == fija.toString().length-1) {
                if (true == negativan) {
                    temp *= -1;
                }
                niz[niz.length] = parseInt(temp);
            }
        }
        else if ((fija[i] == "+" || fija[i] == "-") && negativan != null) {
            if (true == negativan) {
                temp *= -1;
            }
            if (imaExp == false) {
                temp = 1;
            }
            niz[niz.length] = parseInt(temp);
            temp = null;
            negativan = null;
            prijeEksponenta = true;
            i--;
            imaExp = false;
        }
        else {
            alert("pogrešan unos!");
        }

        i++;
    }

    ctx.beginPath();
    for (i = 0; i < 200; i++) {
        var y = 0, j;
        for (j = 0; j < niz.length / 2; j++ ) {
            y += niz[j*2]*Math.pow(((i-100)/20), niz[j*2+1]);
        }
        y += slobodniClan;
        y = y*(-20) + 100;
        ctx.lineTo(i, y);
    }
    ctx.closePath();
    ctx.strokeStyle = moguceBoje[boja%5];
    boja++;
    ctx.stroke();
}, false);

// Dodao sam i dugme ocisti koje cisti canvas (korsino)
document.getElementById("ocisti").addEventListener("click", function() {
    var can = document.getElementById("slika");
    var ctx = can.getContext("2d");
    context.clearRect (0 , 0 , 200, 200);
}, false);