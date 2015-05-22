<?php
//Popunjavanje

    $veza = new PDO("mysql:dbname=milenijumsoft;host=localhost;charset=utf8", "Faruk", "tajna");
    $veza -> exec("set names utf8");

    $novosti = $veza -> query("SELECT naslov, tekst, detaljnijiTekst UNIX_TIMESTAMP(vrijeme) vrijeme2, autor
                                FROM novosti
                                ORDER BY vrijeme desc");

    if (!$novosti) {
        $greska = $veza->errorInfo();
        echo "SQL greška: " . $greska[2];
        exit();
    }

    $novostiNiz = $novosti->fetchAll();

    foreach ($vijestiNiz as $vijest) :

        $opis = "";
        $detaljnije = "";
        $imaDetaljnije = false;

        for ($j=4; $j<count($sadrzajFajla);$j++) {
            if($sadrzajFajla[$j] == "--\r\n" || (strpos($sadrzajFajla[$j], "--") && strlen($sadrzajFajla[$j]) == 3)) {
                $imaDetaljnije = true;
                continue;
            }
            if ($vijest['detaljnijiTekst'] == false) {
                $opis .= " ".$sadrzajFajla[$j];
            }
            else {
                $detaljnije .= " ".$sadrzajFajla[$j];
            }
        }
    ?>
    <div class="novost">
        <div class="<?php if($sadrzajFajla[3] == "\r\n") echo "novostiTekstBezSlike"; else echo "novostiTekst"; ?>">
            <p class="maliParagraf"><?=htmlentities($sadrzajFajla[0])?><br>
            Autor: <?=htmlentities($sadrzajFajla[1])?></p>
            <a class="vise" style="cursor: pointer; visibility: <?php if($imaDetaljnije == true) print "visible"; else print "hidden"; ?>" onclick="otvoriUrlAsinhrono('NovostDetalji.php?naslov=<?=urlencode(ucfirst(strtolower($sadrzajFajla[2])))?>&tekst=<?=urlencode($detaljnije)?>&opis=<?=urlencode($opis)?>&datum=<?=urlencode($sadrzajFajla[0])?>&autor=<?=urlencode($sadrzajFajla[1])?>&slika=<?=urlencode($sadrzajFajla[3])?>')">Detaljnije</a>
            <h3><?=ucfirst(strtolower(htmlentities($sadrzajFajla[2])))?></h3>
            <p><?=$opis?></p>
        </div>
        <?php if($sadrzajFajla[3] != "\r\n"): ?>
        <img src="<?=htmlentities($sadrzajFajla[3])?>" alt="Slika za novost kompanije Milenijum-Soft">
        <?php endif; ?>
        <div class="zlato"></div>
    </div>
<?php 
    endforeach;
?>