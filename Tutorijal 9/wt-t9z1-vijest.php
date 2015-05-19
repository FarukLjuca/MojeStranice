<!DOCTYPE html>
<html>
<head>
	<title>Tutorijal 9, Zadatak 1</title>
	<meta charset="UTF-8">		
</head>
<body>
	<h1>Vijest</h1>
	<?php
		$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
		$veza -> exec("set names utf8");
		$vijesti = $veza -> query("SELECT naslov, tekst, UNIX_TIMESTAMP(vrijeme) vrijeme2, autor
									FROM vijest
									WHERE id = ".$_GET['idVijesti']."
									ORDER BY vrijeme desc");
		$komentari = $veza -> query("SELECT tekst, UNIX_TIMESTAMP(vrijeme) vrijeme2, autor
									FROM komentar
									WHERE vijest = ".$_GET['idVijesti']."
									ORDER BY vrijeme desc");
		if (!$vijesti || !$komentari) {
        	$greska = $veza->errorInfo();
          	echo "SQL greška: " . $greska[2];
          	exit();
     	}

     	foreach ($vijesti as $vijest) {
     		echo "<h1>".$vijest['naslov']."</h1><small>".$vijest['autor']."</small><p>".$vijest['tekst']."</p><small>".date("d.m.Y. (h:i)", $vijest['vrijeme2'])."</small><br><br>";
     	}

     	foreach ($komentari as $komentar) {
        	echo "<h1>Komentar</h1><small>".$komentar['autor']."</small><p>".$komentar['tekst']."</p><small>".date("d.m.Y. (h:i)", $komentar['vrijeme2'])."</small><br>";
     	}
	?>
</body>
</html>