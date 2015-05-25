<?php
    $veza = new PDO("mysql:dbname=milenijumsoft;host=localhost;charset=utf8", "Faruk", "tajna");
    $veza -> exec("set names utf8");

    $novosti = $veza -> query("SELECT naslov, tekst, detaljnijiTekst, UNIX_TIMESTAMP(datumObjave) datum, autor, slika
                                FROM novosti
                                ORDER BY datumObjave desc");

    if (!$novosti) {
        $greska = $veza->errorInfo();
        echo "SQL greška: " . $greska[2];
        exit();
    }

    $novostiNiz = $novosti->fetchAll();

    foreach ($novostiNiz as $vijest) :
?>
    <div class="novost">
        <div class="<?php if(true == is_null($vijest['slika'])) echo 'novostiTekstBezSlike'; else echo 'novostiTekst'; ?>">
            <p class="maliParagraf"><?=htmlentities(date("d.m.Y. (h:i)", $vijest['datum']))?><br>
            Autor: <?=htmlentities($vijest['autor'])?></p>
            <a class="vise" style="cursor: pointer; visibility: <?php if(!is_null($vijest['detaljnijiTekst'])) print "visible"; else print "hidden"; ?>" onclick="otvoriUrlAsinhrono('NovostDetalji.php?naslov=<?=urlencode(ucfirst(strtolower($vijest['naslov'])))?>&tekst=<?=urlencode($vijest['detaljnijiTekst'])?>&opis=<?=urlencode($vijest['tekst'])?>&datum=<?=urlencode(date("d.m.Y. (h:i)", $vijest['datum']))?>&autor=<?=urlencode($vijest['autor'])?>&slika=<?=urlencode($vijest['slika'])?>')">Detaljnije</a>
            <h3><?=ucfirst(strtolower(htmlentities($vijest['naslov'])))?></h3>
            <p><?=$vijest['tekst']?></p>
        </div>
        <?php if(false == is_null($vijest['slika'])) : ?>
        <img src="<?=htmlentities($vijest['slika'])?>" alt="Slika za novost kompanije Milenijum-Soft">
        <?php endif; ?>
        <div class="zlato"></div>
    </div>
<?php 
    endforeach;
?>