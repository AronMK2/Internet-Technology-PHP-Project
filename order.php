<?php
require_once __DIR__ . '/functions.php';

$feedback = null;
$errors = [];

$offers = get_offers();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_form'])) {
    $offerId = (int)($_POST['offer_id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($offerId <= 0) {
        $errors[] = 'Válassz terméket a listából.';
    }

    if ($name === '') {
        $errors[] = 'A név megadása kötelező.';
    }

    if ($email === '') {
        $errors[] = 'Az e-mail megadása kötelező.';
    }

    if (empty($errors)) {
        $ok = create_booking([
            'offer_id' => $offerId,
            'name'     => $name,
            'email'    => $email,
            'phone'    => $phone,
            'message'  => $message,
        ]);

        $feedback = $ok ? 'Köszönjük! Felvettük az igénylést, hamarosan jelentkezünk.' : 'Hiba történt mentés közben, próbáld meg később.';
    }
}
?>
<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Megrendelés | PhoneX</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include __DIR__ . '/nav.php'; ?>

<section class="section" id="order">
    <div class="panel" style="max-width:800px;margin:0 auto;">
        <h3>Megrendelési űrlap</h3>
        <?php if ($feedback): ?>
            <div class="alert <?= empty($errors) ? 'success' : 'error' ?>"><?= h($feedback) ?></div>
        <?php endif; ?>
        <?php foreach ($errors as $err): ?>
            <div class="alert error"><?= h($err) ?></div>
        <?php endforeach; ?>
        <form method="post">
            <input type="hidden" name="booking_form" value="1">
            <label for="offer_id">Termék</label>
            <select id="offer_id" name="offer_id" required>
                <option value="">Válassz terméket</option>
                <?php foreach ($offers as $offer): ?>
                    <option value="<?= (int)$offer['id'] ?>">[<?= h(ucfirst($offer['category'])) ?>] <?= h($offer['title']) ?> - <?= number_format((float)$offer['price'], 0, '.', ' ') ?> Ft</option>
                <?php endforeach; ?>
            </select>
            <label for="name">Név</label>
            <input type="text" id="name" name="name" required>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>
            <label for="phone">Telefon</label>
            <input type="text" id="phone" name="phone" placeholder="+36...">
            <label for="message">Megjegyzés</label>
            <textarea id="message" name="message" placeholder="Kívánt szín, tárhely, kiegészítők..."></textarea>
            <button class="btn" type="submit">Megrendelés elküldése</button>
        </form>
    </div>
</section>

<footer>
    © <?= date('Y') ?> PhoneX. Minden jog fenntartva.
</footer>
</body>
</html>
