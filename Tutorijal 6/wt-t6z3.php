<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tutorijal 6, Zadatak 3</title>
</head>
<body>
Unesi rečenicu:
<form method="get" action="wt-t6z3.php">
    <input type="text" name="recenica" style="width: 300px;">
    <br>
    <input type="submit" value="Nadji najvecu">
</form>
<br>
Najduža riječ je:
&nbsp;
<?php
    if(isset($_REQUEST['recenica'])) {
        $rijeci = explode(" ", htmlentities($_REQUEST['recenica'], ENT_QUOTES));
        $najveca = "";
        foreach ($rijeci as $rijec) {
            if (strlen($rijec) > strlen($najveca)) {
                $najveca = $rijec;
            }
        }
        print $najveca;
    }
?>
</body>
</html>