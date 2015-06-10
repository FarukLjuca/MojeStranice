<?php

function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}

function rest_get($request, $data) {
    $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
    $veza -> exec("set names utf8");

    $rezultat = null;

	if ($sta == "novost") {
        if (isset($data['idNovosti'])) {
            $rezultat = $veza -> prepare("SELECT idNovosti, naslov, tekst, detaljnijiTekst, UNIX_TIMESTAMP(vrijemeObjave) vrijeme, autor, slika
                                           FROM novost
                                           WHERE idNovost=?");
            $rezultat->bindValue(1, $data['idNovost'], PDO::PARAM_INT);
            $rezultat->execute();
        }
        else {
            $rezultat = $veza -> prepare("SELECT idNovosti, naslov, tekst, detaljnijiTekst, UNIX_TIMESTAMP(vrijemeObjave) vrijeme, autor, slika
                                          FROM novost
                                          ORDER BY vrijeme desc");
        }
	}

    if ($sta == "komentar") {
        if (isset($data[idKomentar])) {
            $rezultat = $veza -> prepare("SELECT idKomentar, idNovost, autor, UNIX_TIMESTAMP(vrijemeObjavljivanja) vrijeme, mail, tekst
                                            (
                                                SELECT naslov
                                                FROM novost
                                                WHERE idNovost = komentar.idNovost
                                            ) naslov
                                           FROM komentar
                                           WHERE idKomentar=?");
            $rezultat->bindValue(1, $data['idKomentar'], PDO::PARAM_INT);
            $rezultat->execute();
        }
        else {
            $rezultat = $veza -> query("SELECT idKomentar, idNovost, autor, UNIX_TIMESTAMP(vrijemeObjavljivanja) vrijeme, mail, tekst
                                          (
                                                SELECT naslov
                                                FROM novost
                                                WHERE idNovost = komentar.idNovost
                                          ) naslov
                                          FROM komentar
                                          ORDER BY vrijeme asc");
        }
    }

    if ($sta == "administrator") {
        if (isset($data['idAdministrator'])) {
            $rezultat = $veza -> prepare("SELECT idAdministrator, alias, username, password
                                          FROM administrator
                                          WHERE idAdministrator=?");
            $rezultat->bindValue(1, $data['idAdministrator'], PDO::PARAM_INT);
            $rezultat->execute();
        }
        else {
            $rezultat = $veza -> query("SELECT idAdministrator, alias, username, password
                                        FROM administrator
                                        ORDER BY username desc");
        }
    }

    if (!$rezultat) {
        $greska = $veza->errorInfo();
        echo "Greška: " . $greska[2];
        exit();
    }

    echo json_encode($rezultat->fetchAll());
}

function rest_post($request, $data) {
	$veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
    $veza -> exec("set names utf8");

    $rezultat = null;

    if ($sta == "novost") {
        $rezultat = $veza->prepare("INSERT INTO novost SET naslov=?, tekst=?, autor=?, detaljnijiTekst=?, slika=?, datumObjave=NOW()");
        $rezultat->execute(array(htmlentities($data['naslov']), htmlentities($data['autor']), htmlentities($data['tekst']), htmlentities($data['detaljnijiTekst']), htmlentities($data['slika'])));
    }

    if ($sta == "komentar") {
        $rezultat = $veza->prepare("INSERT INTO komentar SET idNovost=?, tekst=?, autor=?, mail=?, vrijemeObjave=NOW()");
        $rezultat->execute(array(htmlentities($data['idNovost']), htmlentities($data['tekst']), htmlentities($data['autor']), htmlentities($data['mail'])));
    }

    if ($sta == "administrator") {
        $rezultat = $veza->prepare("INSERT INTO administrator SET username=?, password=md5(?), alias=?, mail=?");
        $rezultat->execute(array(htmlentities($data['username']), htmlentities($data['password']), htmlentities($data['alias']), htmlentities($data['mail'])));
    }

    if (!$rezultat) {
        $greska = $veza->errorInfo();
        echo "Greška: " . $greska[2];
        exit();
    }
}

function rest_delete($request) {
    $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
    $veza -> exec("set names utf8");

    $rezultat = null;

    if ($sta == "novost") {
        $rezultat = $veza->prepare("DELETE FROM novost WHERE idNovost=?");
        $rezultat->execute(array(htmlentities($data['idNovost'])));
    }

    if ($sta == "komentar") {
        $rezultat = $veza->prepare("DELETE FROM komentar WHERE idKomentar=?");
        $rezultat->execute(array(htmlentities($data['idKomentar'])));
    }

    if ($sta == "administrator") {
        $rezultat = $veza->prepare("DELETE FROM administrator WHERE idAdministrator=?");
        $rezultat->execute(array(htmlentities($data['idAdministrator'])));
    }

    if (!$rezultat) {
        $greska = $veza->errorInfo();
        echo "Greška: " . $greska[2];
        exit();
    }
}

function rest_put($request, $data) {
    $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
    $veza -> exec("set names utf8");

    $rezultat = null;

    if ($sta == "novost") {
        $rezultat = $veza->prepare("UPDATE novost SET naslov=?, tekst=?, autor=?, detaljnijiTekst=?, slika=?, datumObjave=NOW()");
        $rezultat->execute(array(htmlentities($data['naslov']), htmlentities($data['autor']), htmlentities($data['tekst']), htmlentities($data['detaljnijiTekst']), htmlentities($data['slika']), htmlentities($data['idNovost'])));
    }

    if ($sta == "komentar") {
        $rezultat = $veza->prepare("UPDATE komentar SET idNovost=?, tekst=?, autor=?, mail=?, vrijemeObjave=NOW()");
        $rezultat->execute(array(htmlentities($data['idNovost']), htmlentities($data['tekst']), htmlentities($data['autor']), htmlentities($data['mail']), htmlentities($data['idKomentar'])));
    }

    if ($sta == "administrator") {
        $rezultat = $veza->prepare("UPDATE administrator SET username=?, password=md5(?), alias=?, mail=? WHERE idAdministrator=?");
        $rezultat->execute(array(htmlentities($data['username']), htmlentities($data['password']), htmlentities($data['alias']), htmlentities($data['mail']), htmlentities($data['idAdministrator'])));
    }

    if (!$rezultat) {
        $greska = $veza->errorInfo();
        echo "Greška: " . $greska[2];
        exit();
    }
}

function rest_error($request) {
    echo "Greška";
}

$method  = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

switch($method) {
    case 'PUT':
        parse_str(file_get_contents('php://input'), $put_vars);
        zag(); $data = $put_vars; rest_put($request, $data); break;
    case 'POST':
        zag(); $data = $_POST; rest_post($request, $data); break;
    case 'GET':
        zag(); $data = $_GET; rest_get($request, $data); break;
    case 'DELETE':
        zag(); rest_delete($request); break;
    default:
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        rest_error($request); break;
}

?>