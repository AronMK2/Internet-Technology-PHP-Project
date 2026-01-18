<?php
require_once __DIR__ . '/functions.php';

$search = $_GET['q'] ?? null;
$category = $_GET['category'] ?? null;
$maxPrice = isset($_GET['max_price']) && $_GET['max_price'] !== '' ? (float)$_GET['max_price'] : null;
$offers = get_offers($search, $category, $maxPrice);
$categories = get_categories();
?>
<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termékek | PhoneX</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include __DIR__ . '/nav.php'; ?>

<section class="hero" style="padding-bottom:20px;">
    <div>
        <div class="badge">Keresés · Szűrés · Kategóriák</div>
        <h1>Termékek és kiegészítők</h1>
        <p>Telefonok, tokok, töltők, audio. Szűrj kategória, ár és név alapján.</p>
    </div>
    <div class="panel">
        <form method="get" class="filters">
            <div style="grid-column: 1 / -1; font-weight: 700;">Keresés és szűrés</div>
            <input type="text" name="q" placeholder="Keresés név, leírás vagy város" value="<?= h($search ?? '') ?>">
            <select name="category">
                <option value="">Összes kategória</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= h($cat) ?>" <?= $cat === ($category ?? '') ? 'selected' : '' ?>><?= h(ucfirst($cat)) ?></option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="max_price" step="0.01" placeholder="Max ár (HUF)" value="<?= h($maxPrice ?? '') ?>">
            <button class="btn" type="submit">Szűrés</button>
        </form>
    </div>
</section>

<section class="section" id="offers">
    <h2>Aktuális ajánlatok</h2>
    <div class="offers">
        <?php if (empty($offers)): ?>
            <p>Nincs találat a megadott feltételekre.</p>
        <?php endif; ?>
        <?php foreach ($offers as $offer): ?>
            <article class="card">
                <?php if (!empty($offer['image_url'])): ?>
                    <img src="<?= h($offer['image_url']) ?>" alt="<?= h($offer['title']) ?>">
                <?php endif; ?>
                <div>
                    <span class="pill"><?= h(ucfirst($offer['category'])) ?></span>
                    <?php if (!empty($offer['featured'])): ?><span class="pill" style="background: rgba(79, 209, 197, 0.18); color: #4fd1c5;">Kiemelt</span><?php endif; ?>
                    <h3><?= h($offer['title']) ?></h3>
                    <p style="color: #94a3b8; line-height: 1.5;">
                        <?= h($offer['description']) ?></p>
                    <div class="price"><?= number_format((float)$offer['price'], 0, '.', ' ') ?> Ft</div>
                    <div style="color: #94a3b8;">Elérhetőség: <?= h($offer['location'] ?: 'Online') ?> · Készlet: <?= (int)$offer['stock'] ?></div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<footer>
    © <?= date('Y') ?> PhoneX. Minden jog fenntartva.
</footer>
</body>
</html>
