<?php
    session_start();
    if (isset($_GET['logout']) && $_GET['logout'] == "yes") {
        session_unset();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tutorijal 9, Zadatak 3</title>
	<meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
		    $('#logirajSe').click(function() {
		       $('#loginForma').slideToggle();
		    });
		});
	</script>	
</head>
<body>
	<div style='float:right;'>
		<?php
			if (isset($_POST['username'])) {
				$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
				$veza -> exec("set names utf8");

				$username = $_POST['username'];
				$password = $_POST['password'];

				$rezultat = $veza -> prepare("SELECT * FROM korisnici WHERE username=? && password=md5(?)");
				$rezultat->execute(array($username, $password));

				if (!$rezultat) {
		        	$greska = $veza->errorInfo();
		          	echo "SQL greška: " . $greska[2];
		          	exit();
		     	}
		     	
		     	if ($rezultat->rowCount() == 0) {
		     		echo "Pogresan username ili password<br>";
		     	}
		     	else {
		     		$_SESSION['username'] = $_POST['username'];
		     	}

		     	$veza = null;
			}
		?>
		<?php if(isset($_SESSION['username']) == false) : ?>
        <a id="logirajSe" style="cursor: pointer; color:blue; text-decoration: underline;">Logiraj se</a>
        <div id="loginForma" style="display: none">
            <form method="post" action="wt-t9z4.php">
                <input type="text" placeholder="Username" name="username" id="username"><br>
                <input type="password" placeholder="Password" name="password" id="password"><br>
                <input type="submit" value="OK">
            </form>
        </div>
    <?php else : ?>
        Dobrodošao,
    <?php
        echo " ".$_SESSION['username'];
    ?>
        <br>
        <a href="wt-t9z4.php?logout=yes">Logout</a>
<?php
        endif;
    ?>
	</div>
	<?php
		if (isset($_POST['tekst']) && isset($_POST['idVijesti'])) {
			$tekst = htmlentities($_POST['tekst']);
			$autor = "Anonimac";
			if (isset($_SESSION['username'])) {
				$autor = $_SESSION['username'];
			}
			$idVijesti = htmlentities($_POST['idVijesti']);

			$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
			$veza -> exec("set names utf8");
			$rezultat = $veza -> query("INSERT INTO komentar SET vijest=".$idVijesti.", tekst='".$tekst."', autor='".$autor."', vrijeme=NOW()");

			if (!$rezultat) {
	        	$greska = $veza->errorInfo();
	          	echo "SQL greška: " . $greska[2];
	          	exit();
	     	}
	     	echo "<h1>Hvala vam na ostavljanju komentara!</h1><a href='wt-t9z4.php'>Nazad</a>";
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
        	echo "<h1>".$vijest['naslov']."</h1><small>".$vijest['autor']."</small><p>".$vijest['tekst']."</p><small>".date("d.m.Y. (h:i)", $vijest['vrijeme2'])."</small><br><a href='wt-t9z4-vijest.php?idVijesti=".$vijest['id']."'>".$komentarTekst."</a><br><br>";
        	echo "<form method='post' action='wt-t9z4.php'><textarea name='tekst' placeholder='Ostavite komentar'></textarea><br><input type='hidden' name='idVijesti' value='".$vijest['id']."'><input type='submit' value='Potvrdi'></form><br>";
     	}
     	$veza = null;
 	}
	?>
</body>
</html>