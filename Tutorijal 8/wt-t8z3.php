<!DOCTYPE html>
<html>
<head>
	<title>Tutorijal 8, Zadatak 3</title>
	<meta charset="UTF-8">		
</head>
<body>
	<h1>Vijesti</h1>
	<?php
		$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
		$veza -> exec("set names utf8");
		$rezultat = $veza -> query("SELECT id, naslov, tekst, UNIX_TIMESTAMP(vrijeme) vrijeme2, autor,
									(
										SELECT count(*)
										FROM komentar as k
										WHERE k.vijest = v.id
									) as brojKomentara
									FROM vijest as v
									ORDER BY vrijeme desc");

		if (!$rezultat) {
        	$greska = $veza->errorInfo();
          	echo "SQL greška: " . $greska[2];
          	exit();
     	}

     	foreach ($rezultat as $vijest) {
     		$komentarTekst = "";
     		if ($vijest['brojKomentara'] != 0) {
     			$komentarTekst = $vijest['brojKomentara']." komentara";
     		}
     		else {
     			$komentarTekst = "Nema komentara";
     		}
        	echo "<h1>".$vijest['naslov']."</h1><small>".$vijest['autor']."</small><p>".$vijest['tekst']."</p><small>".date("d.m.Y. (h:i)", $vijest['vrijeme2'])."</small><br><a href='wt-t8z3-vijest.php?idVijesti=".$vijest['id']."'>".$komentarTekst."</a><br>";
     	}
	?>
</body>
</html>