<?php
    session_start();
    if (isset($_GET['logout']) && $_GET['logout'] == "yes") {
        session_unset();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tutorijal 7, Zadatak 2</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
<?php
if (isset($_REQUEST['username'])) {
    if ($_REQUEST['username'] === "admin" && $_REQUEST['password'] === "tajna")
        $_SESSION['username'] = $_REQUEST['username'];
    else
        echo "Pogresan username ili password.";
}
?>
<p>
    <?php if(isset($_SESSION['username']) == false) : ?>
        <a id="logirajSe" style="cursor: pointer; color:blue; text-decoration: underline;">Logiraj se</a>
        <div id="loginForma" style="display: none">
            <form method="post" action="wt-t7z2.php">
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
        <a href="wt-t7z2.php?logout=yes">Logout</a>
<?php
        endif;
    ?>
</p>
<?php if (isset($_SESSION['username'])) : ?>
    <table id="imenikLogiran" style="border-collapse: collapse"></table>
<?php else : ?>
    <table id="imenik" style="border-collapse: collapse"></table>
<?php endif; ?>
<?php
    if (isset($_SESSION['username'])) :
?>
<form>
    <table style="border: 5px solid lawngreen">
        <tr>
            <td>Ime:</td>
            <td><input type="text" name="ime" id="ime"></td>
        </tr>
        <tr>
            <td>Prezime:</td>
            <td><input type="text" name="prezime" id="prezime"></td>
        </tr>
        <tr>
            <td>Broj telefona:</td>
            <td><input type="text" name="brojTelefona" id="brojTelefona"></td>
        </tr>
        <tr>
            <td><input type="button" value="Dodaj" onclick="dodavanje()"></td>
            <td><span id="status" style="color:lawngreen"></span></td>
        </tr>
    </table>
</form>
<?php
    endif;
?>

<script src="funkcije-z2.js"></script>
</body>
</html>