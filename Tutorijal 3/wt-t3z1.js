function foo(){
    var tekst = prompt("Unesite tekst koji želite da vam se napiše obrnutim redosljedom:");
    if (tekst!=null && tekst!="") {
        var obrnutiTekst = "";
        for (i = 0; i < tekst.length; i++) {
            obrnutiTekst += tekst[tekst.length-i-1];
        }
        alert(obrnutiTekst);
    }
}
onload = foo();