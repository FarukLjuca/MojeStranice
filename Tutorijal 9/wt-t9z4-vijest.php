<!DOCTYPE html>
<html>
<head>
	<title>Tutorijal 9, Zadatak 3</title>
	<meta charset="UTF-8">		
</head>
<body>
	<h1>Vijest</h1>
	<?php
		$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
		$veza -> exec("set names utf8");

		$idVijesti = $_GET['idVijesti'];

		$vijesti = $veza -> prepare("SELECT naslov, tekst, UNIX_TIMESTAMP(vrijeme) vrijeme2, autor
									FROM vijest
									WHERE id=?");
		$vijesti->bindValue(1, $idVijesti, PDO::PARAM_INT);
		$vijesti->execute();

		$komentari = $veza -> prepare("SELECT tekst, UNIX_TIMESTAMP(vrijeme) vrijeme2, autor
									FROM komentar
									WHERE vijest=?
									ORDER BY vrijeme desc");
		$komentari->bindValue(1, $idVijesti, PDO::PARAM_INT);
		$komentari->execute();

		if (!$vijesti || !$komentari) {
        	$greska = $veza->errorInfo();
          	echo "SQL greška: " . $greska[2];
          	exit();
     	}

     	$vijestiNiz = $vijesti->fetchAll();
		$komentariNiz = $komentari->fetchAll();

     	foreach ($vijestiNiz as $vijest) {
     		echo "<h1>".$vijest['naslov']."</h1><small>".$vijest['autor']."</small><p>".$vijest['tekst']."</p><small>".date("d.m.Y. (h:i)", $vijest['vrijeme2'])."</small><br><br>";
     	}

     	foreach ($komentariNiz as $komentar) {
        	echo "<h1>Komentar</h1><small>".$komentar['autor']."</small><p>".$komentar['tekst']."</p><small>".date("d.m.Y. (h:i)", $komentar['vrijeme2'])."</small><br>";
     	}
	?>
</body>
</html>