<?php

session_start();

function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}

function rest_get($request, $data) {
	$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
	$veza -> exec("set names utf8");

	$idVijesti = $data['idVijesti'];

	$komentari = $veza -> prepare("SELECT tekst, UNIX_TIMESTAMP(vrijeme) vrijeme2, autor
								FROM komentar
								WHERE vijest=?
								ORDER BY vrijeme desc");
	$komentari->bindValue(1, $idVijesti, PDO::PARAM_INT);
	$komentari->execute();

	if (!$komentari) {
	$greska = $veza->errorInfo();
		echo "SQL greška: " . $greska[2];
		exit();
	}

	echo json_encode($komentari->fetchAll());
}

function rest_post($request, $data) {
	$tekst = htmlentities($data['tekst']);
	$autor = "Anonimac";
	if (isset($_SESSION['username'])) {
		$autor = $_SESSION['username'];
	}
	$idVijesti = htmlentities($data['idVijesti']);

	$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
	$veza -> exec("set names utf8");
	$rezultat = $veza -> query("INSERT INTO komentar SET vijest=".$idVijesti.", tekst='".$tekst."', autor='".$autor."', vrijeme=NOW()");

	if (!$rezultat) {
    	$greska = $veza->errorInfo();
      	echo "SQL greška: " . $greska[2];
      	exit();
 	}
 	echo "<h1>Hvala vam na ostavljanju komentara!";
 	$veza = null;
}

function rest_delete($request) { }
function rest_put($request, $data) { }
function rest_error($request) { }

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