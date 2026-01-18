<?php
session_start();
session_destroy();
?>
<!doctype html>
<html lang="hu">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kijelentkezés | PhoneX Admin</title>
	<link rel="stylesheet" href="../admin.css">
	<meta http-equiv="refresh" content="2;url=../index.php">
	<script>setTimeout(function(){ window.location.href = '../index.php'; }, 2000);</script>
</head>
<body>
	<main style="max-width:520px;margin:60px auto;">
		<section class="card" style="text-align:center;">
			<h2>Kijelentkeztél</h2>
			<p>A böngésző elfelejti a belépési adatokat. Ha a kérdésre rákattintasz a <strong>Mégse</strong>-re, 2 másodperc múlva visszaviszünk a nyilvános oldalra.</p>
		</section>
	</main>
</body>
</html>
