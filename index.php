<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhoneX | Telefonok és kiegészítők</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="phonex.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include __DIR__ . '/nav.php'; ?>

<section class="hero">
    <div>
        <div class="badge">5G készülékek · Gamer mobilok · Prémium kiegészítők</div>
        <h1>Telefonok és kiegészítők egy helyen</h1>
        <p>Friss flagship modellek, tartós tokok, vezeték nélküli töltők és audio kiegészítők.</p>
        <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:18px;">
            <a class="btn" style="width:auto;padding:12px 18px;" href="offers.php">Termékek megtekintése</a>
            <a class="btn" style="width:auto;padding:12px 18px;" href="order.php">Megrendelés</a>
        </div>
    </div>
    <div class="panel">
        <h3>Miért mi?</h3>
        <ul style="list-style:none;padding:0;margin:0;display:grid;gap:10px;">
            <li class="pill" style="background:rgba(79,209,197,0.12);color:#4fd1c5;">Gyors szállítás és hazai garancia</li>
            <li class="pill">Kiemelt gaming és fotós modellek</li>
            <li class="pill">MagSafe és Qi kiegészítők széles választéka</li>
            <li class="pill">Személyes átvétel Budapesten</li>
        </ul>
    </div>
</section>

<section class="section">
    <div class="two-col">
        <div class="panel">
            <h3>Rólunk</h3>
            <p>Specializált telefonos csapat vagyunk, akik gamer, üzleti és fotós igényekre is testre szabott ajánlatokat készítenek. Válogatott gyártók, magyar garancia, helyben kipróbálható modellek.</p>
            <p><a href="about.php" style="color:#4fd1c5;text-decoration:none;font-weight:700;">Részletek</a></p>
        </div>
        <div class="panel">
            <h3>Kapcsolat</h3>
            <p>Bolt: 1132 Budapest, Visegrádi u. 5.<br>Telefon: +36 1 555 5555<br>E-mail: hello@phonex.hu</p>
            <p>Nyitvatartás: H–P 10:00–19:00, Sz 10:00–14:00</p>
            <p><a href="contact.php" style="color:#4fd1c5;text-decoration:none;font-weight:700;">További elérhetőségek</a></p>
        </div>
    </div>
</section>

<footer>
    © <?php echo date('Y'); ?> PhoneX. Minden jog fenntartva.
</footer>
</body>
</html>
