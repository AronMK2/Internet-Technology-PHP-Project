<?php
require_once __DIR__ . '/../functions.php';

$editingId = isset($_GET['edit']) ? (int)$_GET['edit'] : null;
$deleteId = isset($_GET['delete']) ? (int)$_GET['delete'] : null;
$notice = null;
$errors = [];

if ($deleteId) {
    delete_offer($deleteId);
    $notice = 'A termék törlésre került.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payload = [
        'title'       => trim($_POST['title'] ?? ''),
        'description' => trim($_POST['description'] ?? ''),
        'price'       => (float)($_POST['price'] ?? 0),
        'category'    => trim($_POST['category'] ?? 'phone'),
        'location'    => trim($_POST['location'] ?? ''),
        'start_date'  => $_POST['start_date'] ?: null,
        'end_date'    => $_POST['end_date'] ?: null,
        'image_url'   => trim($_POST['image_url'] ?? ''),
        'featured'    => isset($_POST['featured']) ? 1 : 0,
        'stock'       => (int)($_POST['stock'] ?? 0),
    ];

    if ($payload['title'] === '') {
        $errors[] = 'A cím kötelező.';
    }

    if ($payload['price'] <= 0) {
        $errors[] = 'Az ár legyen pozitív.';
    }

    if (empty($errors)) {
        if ($editingId) {
            update_offer($editingId, $payload);
            $notice = 'Termék frissítve.';
        } else {
            create_offer($payload);
            $notice = 'Új termék létrehozva.';
        }
        $editingId = null;
    }
}

$offers = get_offers();
$editOffer = $editingId ? get_offer($editingId) : null;
?>
<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | PhoneX</title>
    <link rel="stylesheet" href="../admin.css">
</head>
<body>
    <header>
        <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;">
            <div class="brand"><span>PhoneX</span></div>
            <div>
                <a href="../index.php">Nyilvános oldal</a> |
                <a href="logout.php">Kijelentkezés</a>
            </div>
        </div>
    </header>
    <main>
        <section class="card">
            <h2><?= $editingId ? 'Termék szerkesztése' : 'Új termék' ?></h2>
            <?php if ($notice): ?><div class="notice"><?= h($notice) ?></div><?php endif; ?>
            <?php foreach ($errors as $err): ?><div class="error"><?= h($err) ?></div><?php endforeach; ?>
            <form method="post">
                <label>Cím</label>
                <input type="text" name="title" value="<?= h($editOffer['title'] ?? '') ?>" required>
                <label>Leírás</label>
                <textarea name="description" required><?= h($editOffer['description'] ?? '') ?></textarea>
                <label>Ár (HUF)</label>
                <input type="number" step="0.01" name="price" value="<?= h($editOffer['price'] ?? '') ?>" required>
                <label>Kategória</label>
                <select name="category">
                    <?php foreach (['phone' => 'Telefon', 'accessory' => 'Kiegészítő'] as $key => $label): ?>
                        <option value="<?= $key ?>" <?= ($editOffer['category'] ?? '') === $key ? 'selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Helyszín / átvétel</label>
                <input type="text" name="location" value="<?= h($editOffer['location'] ?? '') ?>" placeholder="Online, Budapest, stb.">
                <label>Kép URL</label>
                <input type="text" name="image_url" value="<?= h($editOffer['image_url'] ?? '') ?>" placeholder="https://...">
                <label>Készlet</label>
                <input type="number" name="stock" value="<?= h($editOffer['stock'] ?? 0) ?>">
                <label>Kezdő dátum</label>
                <input type="date" name="start_date" value="<?= h($editOffer['start_date'] ?? '') ?>">
                <label>Záró dátum</label>
                <input type="date" name="end_date" value="<?= h($editOffer['end_date'] ?? '') ?>">
                <label><input type="checkbox" name="featured" <?= !empty($editOffer['featured']) ? 'checked' : '' ?>> Kiemelt</label>
                <button class="btn" type="submit">Mentés</button>
            </form>
        </section>
        <section class="card">
            <h2>Terméklista</h2>
            <table>
                <thead>
                    <tr>
                        <th>Cím</th>
                        <th>Kategória</th>
                        <th>Ár</th>
                        <th>Készlet</th>
                        <th>Művelet</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($offers as $offer): ?>
                        <tr>
                            <td><?= h($offer['title']) ?></td>
                            <td><?= h($offer['category']) ?></td>
                            <td><?= number_format((float)$offer['price'], 0, '.', ' ') ?> Ft</td>
                            <td><?= (int)$offer['stock'] ?></td>
                            <td>
                                <a href="?edit=<?= (int)$offer['id'] ?>">Szerkesztés</a> | 
                                <a href="?delete=<?= (int)$offer['id'] ?>" onclick="return confirm('Biztosan törlöd?');">Törlés</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
