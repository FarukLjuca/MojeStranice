<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Faruk Chat</title>
	<link href="stil.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="slike/favicon.png">
</head>
<body>
	<main>
		<div id="poruke">

		</div>

		<div id="napisiPoruku">
		<textarea id="tekst" placeholder="Napišite poruku ovdje..."></textarea>
			<button onclick="posaljiPoruku()">
				<img src="slike/send.png" alt="Image on send button">
			</button>
		</div>
	</main>

	<footer>
		Faruk Chat by Ljuca Faruk &copy; 2015 - <?=date("Y");?>
	</footer>

	<script src="skripta.js"></script>
</body>
</html>