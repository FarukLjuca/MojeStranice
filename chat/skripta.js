var posljednjiId = 0;
var sviId = [];

onload = function() {
	setInterval(function() {
        var ajax = new XMLHttpRequest();
	    ajax.onreadystatechange = function () {
	        if (ajax.readyState == 4 && ajax.status == 200) {
	            var poruke = JSON.parse(ajax.responseText);
	            var porukeDiv = document.getElementById("poruke");

	            var i;
	            for (i=0; i<poruke.length; i++) {
	            	var j;
	            	var duplikat = false;
	            	for (j=0; j<sviId.length; j++)
	            		if (sviId[j] == poruke[i].id) { duplikat = true; break; }

	            	if (duplikat == false) {
	            		sviId.push(poruke[i].id);
		            	var div = document.createElement("div");
		            	div.style.backgroundColor = "yellow";
		            	div.style.color = "darkred";
		            	div.style.margin = "5px";
		            	div.style.padding = "5px";
		            	div.style.borderRadius = "10px";
		            	div.style.textAlign = "center";
		            	div.style.fontSize = "20px";
		            	div.style.fontFamily = "Arial";

		            	var span = document.createElement("span");
		            	span.style.wordWrap = "break-word";
		            	span.innerHTML = poruke[i].tekst;

		            	div.appendChild(span);
		            	porukeDiv.appendChild(div);

	            		posljednjiId = poruke[i].id;
	            	}
	            }
	        }
	    }
	    ajax.open("GET", "api.php?posljednjiId="+posljednjiId, true);
	    ajax.send();
    }, 1000);
}

function posaljiPoruku() {
	var tekst = document.getElementById("tekst");
	var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
        	tekst.value = "";
        }
    }
    ajax.open("POST", "api.php", true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send("tekst="+tekst.value);
}