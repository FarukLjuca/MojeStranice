var x1 = 1, y1 = 1, x2 = 1, y2 = -1;

setInterval(function(){
    var lopta1 = document.getElementById("lopta1");
    var pozicija1 = lopta1.getBoundingClientRect();
    var lopta2 = document.getElementById("lopta2");
    var pozicija2 = lopta2.getBoundingClientRect();

    if (pozicija1.top > window.innerHeight - 100 || pozicija1.top < 0) {
        y1 *= -1;
    }
    if (pozicija1.left > window.innerWidth - 100 || pozicija1.left < 0) {
        x1 *= -1;
    }
    if (pozicija2.top > window.innerHeight - 100 || pozicija2.top < 0) {
        y2 *= -1;
    }
    if (pozicija2.left > window.innerWidth - 100 || pozicija2.left < 0) {
        x2 *= -1;
    }

    lopta1.style.left = pozicija1.left+x1+"px";
    lopta1.style.top = pozicija1.top+y1+"px";
    lopta2.style.left = pozicija2.left+x2+"px";
    lopta2.style.top = pozicija2.top+y2+"px";
}, 1);