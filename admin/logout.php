<?php
// Force the browser to drop cached Basic Auth credentials by challenging with a new realm.
header('HTTP/1.0 401 Unauthorized');
header('WWW-Authenticate: Basic realm="PhoneX Logout"');
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
			<div style="margin-top:14px;display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
				<a class="btn" href="../index.php" style="text-decoration:none;display:inline-block;">Nyilvános oldal</a>
				<a class="btn" href="index.php" style="text-decoration:none;display:inline-block;">Admin újbóli belépés</a>
			</div>
		</section>
	</main>
</body>
</html>
