function prosiri(indeks) {
    var stablo = document.body.children[indeks];
    var podstablo = stablo.children[1];
    if (podstablo.style.display == "block") {
        podstablo.style.display = "none"
        stablo.style.listStyleImage = "url('http://www.gsd.harvard.edu/gis/manual/local/treeview_images/plus.gif')";
    }
    else {
        podstablo.style.display = "block";
        stablo.style.listStyleImage = "url('http://www.gsd.harvard.edu/gis/manual/local/treeview_images/minus.gif')";
    }
}