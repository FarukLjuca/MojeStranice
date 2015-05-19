<!DOCTYPE html>
<html>
<head>
	<title>Tutorijal 9, Zadatak 1</title>
	<meta charset="UTF-8">		
</head>
<body>
	<?php
		if (isset($_POST['tekst']) && isset($_POST['autor']) && isset($_POST['idVijesti'])) {
			$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
			$veza -> exec("set names utf8");
			$rezultat = $veza -> query("INSERT INTO komentar SET vijest=".$_POST['idVijesti'].", tekst='".$_POST['tekst']."', autor='".$_POST['autor']."', vrijeme=NOW()");

			if (!$rezultat) {
	        	$greska = $veza->errorInfo();
	          	echo "SQL greška: " . $greska[2];
	          	exit();
	     	}
	     	echo "<h1>Hvala vam na ostavljanju komentara!</h1><a href='wt-t9z1.php'>Nazad</a>";
	     	$veza = null;
		}
		else {
	?>

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
        	echo "<h1>".$vijest['naslov']."</h1><small>".$vijest['autor']."</small><p>".$vijest['tekst']."</p><small>".date("d.m.Y. (h:i)", $vijest['vrijeme2'])."</small><br><a href='wt-t9z1-vijest.php?idVijesti=".$vijest['id']."'>".$komentarTekst."</a><br><br>";
        	echo "<form method='post' action='wt-t9z1.php'><input type='text' name='autor' placeholder='Ime autora'><br><textarea name='tekst' placeholder='Ostavite komentar'></textarea><br><input type='hidden' name='idVijesti' value='".$vijest['id']."'><input type='submit' value='Potvrdi'></form><br>";
     	}
     	$veza = null;
 	}
	?>
</body>
</html>