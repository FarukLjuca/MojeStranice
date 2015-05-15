function pretvori() {
    var patern = /<[\w\/]+>/ig;
    var tekst = document.getElementById("tekst").value;
    var noviTekst = tekst.replace(patern, "").replace(/&amp;/g, "&").replace(/&nbsp;/g, " ").replace(/&quot;/g, '"');
    document.getElementById("tekst").value = noviTekst;
}