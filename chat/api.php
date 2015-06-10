<?php

function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}

function rest_get($request, $data) {
	//$veza = new PDO("mysql:dbname=a7285466_chat;host=mysql6.000webhost.com;charset=utf8", "a7285466_faruk", "bahaha20.2.");
	$veza = new PDO("mysql:dbname=chat;host=localhost;charset=utf8", "faruk", "baha");
	$veza -> exec("set names utf8");

	$rezultat = $veza->prepare("SELECT id, tekst, autor FROM poruka WHERE id>?");
	$rezultat->execute(array($data['posljednjiId']));

	if (!$rezultat) {
	$greska = $veza->errorInfo();
		echo "SQL greška: " . $greska[2];
		exit();
	}

	echo json_encode($rezultat->fetchAll());
}

function rest_post($request, $data) {
	//$veza = new PDO("mysql:dbname=a7285466_chat;host=mysql6.000webhost.com;charset=utf8", "a7285466_faruk", "bahaha20.2.");
	$veza = new PDO("mysql:dbname=chat;host=localhost;charset=utf8", "faruk", "baha");
	$veza -> exec("set names utf8");
	
	$rezultat = $veza->prepare("INSERT INTO poruka SET tekst=?, autor=?");
	$rezultat->execute(array($data['tekst'], 0));

	if (!$rezultat) {
	$greska = $veza->errorInfo();
		echo "SQL greška: " . $greska[2];
		exit();
	}
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