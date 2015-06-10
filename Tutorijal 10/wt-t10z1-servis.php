<?php

$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
$veza -> exec("set names utf8");

if (isset($_GET['idVijesti'])) {
	$idVijesti = $_GET['idVijesti'];

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

?>