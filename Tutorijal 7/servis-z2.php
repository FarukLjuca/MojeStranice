<?php
if(!isset($_REQUEST['akcija'])) {
    $niz = array();
    $imenik = file("imenik-z2.csv");
    for($i=0; $i<count($imenik); $i++) {
        $rijeci = str_getcsv($imenik[$i]);
        $podniz = array("ime" => $rijeci[0], "prezime" => $rijeci[1], "brojTelefona" => $rijeci[2]);

        array_push($niz, $podniz);
    }
    echo str_replace("\/", "/", json_encode($niz));
}
elseif($_REQUEST['akcija'] != "dodavanje" && $_REQUEST['akcija'] != "brisanje" && $_REQUEST['akcija'] != "promjena") {
    print "Greška: Nepostojeća akcija.";
}
elseif($_REQUEST['akcija'] == "dodavanje") {
    $sadrzaj = file_get_contents("imenik-z2.csv");
    $objekat = json_decode($_REQUEST['objekat']);
    file_put_contents("imenik-z2.csv", $sadrzaj.$objekat->{"ime"}.",".$objekat->{"prezime"}.",".$objekat->{"brojTelefona"}."\r\n");
    print "Uspješno dodana osoba u imenik.";
}
elseif($_REQUEST['akcija'] == "promjena") {
    $sadrzaj = file("imenik-z2.csv");
    $noviSadrzaj = "";
    for($i=0; $i<count($sadrzaj); $i++) {
        if($i != $_REQUEST['redniBroj']) {
            $noviSadrzaj .= $sadrzaj[$i];
        }
        else {
            $objekat = json_decode($_REQUEST['objekat']);
            $noviSadrzaj .= (string)($objekat->{"ime"}.",".$objekat->{"prezime"}.",".$objekat->{"brojTelefona"}."\r\n");
        }
    }
    file_put_contents("imenik-z2.csv", $noviSadrzaj);
    print "Uspješno promjenjena osoba u imenik.";
}
elseif($_REQUEST['akcija'] == "brisanje") {
    $sadrzaj = file("imenik-z2.csv");
    $noviSadrzaj = "";
    for($i=0; $i<count($sadrzaj); $i++) {
        if($i != $_REQUEST['redniBroj']) {
            $noviSadrzaj .= $sadrzaj[$i];
        }
    }
    file_put_contents("imenik-z2.csv", $noviSadrzaj);
    print "Uspješno obrisana osoba u imenik.";
}
else {
    print "Greška: Desila se neočekivana greška.";
}
?>