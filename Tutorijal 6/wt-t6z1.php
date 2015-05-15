<!DOCTYPE html>
<html>
<head lang="ba">
    <meta charset="UTF-8">
    <title>Tutorijal 6, Zadatak 1</title>
</head>
<body>
<form action="wt-t6z1.php">
    <input type="text" name="broj1" value="<?php if(isset($_REQUEST['broj1'])) print $_REQUEST['broj1']; else print "";?>">
    +
    <input type="text" name="broj2" value="<?php if(isset($_REQUEST['broj2'])) print $_REQUEST['broj2']; else print "";?>">
    =
    <?php
    if(isset($_REQUEST['broj1']) && isset($_REQUEST['broj2'])) {
        print ($_REQUEST['broj1'] + $_REQUEST['broj2']);
    }
    ?>
    <br><br>
    <input type="submit" value="Izračunaj">
</form>
</body>
</html>

