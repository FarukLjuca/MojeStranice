// Deklaracija funkcija:
var otvoriKomentare;

$(document).ready(function() {
    $('#logirajSe').click(function() {
       $('#loginForma').slideToggle();
    });

    otvoriKomentare = function (idVijesti) {
		var ajax = new XMLHttpRequest();

	    ajax.onreadystatechange = function() {
	        if(ajax.readyState == 4 && ajax.status == 200) {
	            var tekst = ajax.responseText;
	            var komentari = JSON.parse(tekst);
	            var div = document.getElementById("komentariDiv" + idVijesti);
	            var zaUpis = "";

	            var i;
	            for (i = 0; i < komentari.length; i++) {
	            	zaUpis += "<h4>Komentar</h4>";
	            	zaUpis += "<small>"+komentari[i]["autor"]+"</small>";
	            	zaUpis += "<p>"+komentari[i]["tekst"]+"</p>";
	            	zaUpis += "<small>"+timeConverter(komentari[i]["vrijeme2"])+"</small><br>";
	            }
	            div.innerHTML = zaUpis;

	            $('#komentariDiv' + idVijesti).slideToggle("slow");
	        }
	    }
	    ajax.open("GET", "wt-t10z1-servis.php?idVijesti="+idVijesti, true);
	    ajax.send();
	}

	function timeConverter(UNIX_timestamp) {
	    var a = new Date(UNIX_timestamp*1000);
		var months = ['Januar','Februar','Mart','April','Maj','Juni','Juli','August','Septembar','Oktobar','Novembar','Decembar'];
		var year = a.getFullYear();
		var month = months[a.getMonth()];
		var date = a.getDate();
		var hour = a.getHours();
		var min = a.getMinutes();
		var time = date + '. ' + month + ' ' + year + '. ' + hour + ':' + min;
		return time;
	}
});