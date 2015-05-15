<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tutorijal 6, Zadatak 4, Pod b)</title>
</head>
<body>
<?php
    if(!isset($_SESSION['randomBroj'])) $_SESSION['randomBroj'] = rand(1,100);
?>
<form action="wt-t6z4-b).php" method="get">
    <input type="text" name="broj" value="<?php if(isset($_REQUEST['broj'])) print $_REQUEST['broj']; else print ""?>">
    <br>
    <input type="submit" value="Provjeri">
</form>
<?php
if(isset($_REQUEST['broj'])) {
    $broj = intval($_REQUEST['broj']);
    if ($broj < $_SESSION['randomBroj']) {
        print "Veće";
    }
    else if ($broj == $_SESSION['randomBroj']) {
        print "Pogodili ste, Čestitamo :D";
        $_SESSION['randomBroj'] = rand(1,100);
    }
    else {
        print "Manje";
    }
}
?>
</body>
</html>