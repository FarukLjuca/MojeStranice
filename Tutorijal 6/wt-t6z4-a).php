<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tutorijal 6, Zadatak 4, Pod a)</title>
</head>
<body>
    <form action="wt-t6z4-a).php" method="get">
        <input type="hidden" name="sakriveniBroj" value="<?php if(isset($_REQUEST['broj']) && ($_REQUEST['sakriveniBroj'] == "" || $_REQUEST['sakriveniBroj'] == $_REQUEST['broj'])) print rand(1,100); else if(isset($_REQUEST['sakriveniBroj'])) print $_REQUEST['sakriveniBroj']?>">
        <input type="text" name="broj" value="<?php if(isset($_REQUEST['broj'])) print $_REQUEST['broj']; else print "";?>">
        <br>
        <input type="submit" value="Provjeri">
    </form>
    <?php
    if(isset($_REQUEST['broj'])) {
        $broj = intval($_REQUEST['broj']);
        if ($broj < $_REQUEST['sakriveniBroj']) {
            print "Veće";
        }
        else if ($broj == $_REQUEST['sakriveniBroj']) {
            print "Pogodili ste, Čestitamo :D";
        }
        else {
            print "Manje";
        }
    }
    ?>
</body>
</html>