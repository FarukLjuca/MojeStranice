<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Tutorijal 6, Uvod</title>
</head>
<body>
<?php
if (isset($_REQUEST['vrijednost'])) {
    print "<p>Poslali ste: ".$_REQUEST['vrijednost']."</p>";
}
?>
<form action="wt-t6z2.php" method="get">
    <p>
        Vrijednost:
        <br />
        <input type="text" name="vrijednost" value="<?php if(isset($_REQUEST['vrijednost'])) print $_REQUEST['vrijednost']; else print "";?>">
    </p>
    <input type="submit" value="Pošalji">
</form>
</body>
</html>
