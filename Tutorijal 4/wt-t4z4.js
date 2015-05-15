function pretvori() {
    var patern = /for(i=(\d+); i<(\d+); i++)) {(.*)}/g;
    var tekst = document.getElementById("tekst").value;
    var noviTekst = tekst.replace(patern, "i=$1;\nwhile(i<$2) {\n$2\ni++;\n}");
    document.getElementById("tekst").value = noviTekst;
}