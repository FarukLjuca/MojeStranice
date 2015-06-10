<?php
    $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
    $veza -> exec("set names utf8");

    $novosti = $veza -> query("SELECT idNovost, naslov, tekst, detaljnijiTekst, UNIX_TIMESTAMP(datumObjave) datum, autor, slika,
                                (
                                    SELECT count(*)
                                    FROM komentar as k
                                    WHERE k.idNovost = n.idNovost
                                ) as brojKomentara
                                FROM novost n
                                ORDER BY datumObjave asc");

    if (!$novosti) {
        $greska = $veza->errorInfo();
        echo "SQL greška: " . $greska[2];
        exit();
    }

    $novostiNiz = $novosti->fetchAll();
    $brojac = 0;
    foreach ($novostiNiz as $novost) :
?>
    <div class="novost">
        <div class="<?php if(true == is_null($novost['slika'])) echo 'novostiTekstBezSlike'; else echo 'novostiTekst'; ?>">
            <p class="maliParagraf"><?=htmlentities(date("d.m.Y. (h:i)", $novost['datum']))?><br>
            Autor: <?=htmlentities($novost['autor'])?></p>
            <a class="vise" style="cursor: pointer; visibility: <?php if(!is_null($novost['detaljnijiTekst'])) print "visible"; else print "hidden"; ?>" onclick="otvoriUrlAsinhrono('NovostDetalji.php?naslov=<?=urlencode(ucfirst(strtolower($novost['naslov'])))?>&tekst=<?=urlencode($novost['detaljnijiTekst'])?>&opis=<?=urlencode($novost['tekst'])?>&datum=<?=urlencode(date("d.m.Y. (h:i)", $novost['datum']))?>&autor=<?=urlencode($novost['autor'])?>&slika=<?=urlencode($novost['slika'])?>')">Detaljnije</a>
            <h3><?=ucfirst(strtolower(htmlentities($novost['naslov'])))?></h3>
            <p><?=$novost['tekst']?></p>
        </div>
        <?php if(false == is_null($novost['slika'])) : ?>
        <img src="<?=htmlentities($novost['slika'])?>" alt="Slika za novost kompanije Milenijum-Soft">
        <?php endif; ?>
        <form method="post" action="index.php?akcija=ostaviKomentar" onsubmit="return OstaviKomentar(<?=$brojac?>);">
            <div class="komentarWraper">
                <span>Ostavite komentar:</span><br><br>
                <input id="komentarAutor<?=$brojac?>" name="komentarAutor" class="inputKomentar" type="text" placeholder="Ovdje unesite ime autora *"><br><br>
                <input id="komentarMail<?=$brojac?>" name="komentarMail" class="inputKomentar" type="text" placeholder="Ovdje unesite mail"><br><br>
                <textarea id="komentarTekst<?=$brojac?>" name="komentarTekst" placeholder="Ovdje unesite komentar *"></textarea> <br><br>
                <input class="ostaviKomentar" type="submit" value="Ostavi komentar">
                <input type="hidden" name="idNovost" value="<?=$novost['idNovost']?>"<br><br>
                Ova novost ima <?=$novost['brojKomentara']?> komentara<br><a href="otvoriKomentareZaNovost.php?id=<?=$novost['idNovost']?>">Pogledajte ih</a>
            </div>
        </form>
        <div class="zlato"></div>
    </div>
<?php
    $brojac++;
    endforeach;
?>