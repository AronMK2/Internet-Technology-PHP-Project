<?php
require_once __DIR__ . '/db.php';

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function get_offers(?string $search = null, ?string $category = null, ?float $maxPrice = null): array
{
    global $pdo;
    $where = [];
    $params = [];

    if ($search !== null && $search !== '') {
        $where[] = "(title LIKE :q_title OR description LIKE :q_desc OR location LIKE :q_loc)";
        $params[':q_title'] = "%{$search}%";
        $params[':q_desc']  = "%{$search}%";
        $params[':q_loc']   = "%{$search}%";
    }

    if ($category !== null && $category !== '') {
        $where[] = "category = :category";
        $params[':category'] = $category;
    }

    if ($maxPrice !== null) {
        $where[] = "price <= :maxPrice";
        $params[':maxPrice'] = $maxPrice;
    }

    $query = 'SELECT * FROM offers';

    if (!empty($where)) {
        $query .= ' WHERE ' . implode(' AND ', $where);
    }

    $query .= ' ORDER BY featured DESC, start_date ASC, created_at DESC';

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);

    return $stmt->fetchAll();
}

function get_offer(int $id): ?array
{
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM offers WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $offer = $stmt->fetch();

    return $offer ?: null;
}

function create_offer(array $data): bool
{
    global $pdo;
    $sql = 'INSERT INTO offers (title, description, price, category, location, start_date, end_date, image_url, featured, stock) VALUES (:title, :description, :price, :category, :location, :start_date, :end_date, :image_url, :featured, :stock)';
    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        ':title'       => $data['title'] ?? '',
        ':description' => $data['description'] ?? '',
        ':price'       => $data['price'] ?? 0,
        ':category'    => $data['category'] ?? 'phone',
        ':location'    => $data['location'] ?? '',
        ':start_date'  => $data['start_date'] ?? null,
        ':end_date'    => $data['end_date'] ?? null,
        ':image_url'   => $data['image_url'] ?? '',
        ':featured'    => isset($data['featured']) ? 1 : 0,
        ':stock'       => $data['stock'] ?? 0,
    ]);
}

function update_offer(int $id, array $data): bool
{
    global $pdo;
    $sql = 'UPDATE offers SET title = :title, description = :description, price = :price, category = :category, location = :location, start_date = :start_date, end_date = :end_date, image_url = :image_url, featured = :featured, stock = :stock WHERE id = :id';
    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        ':id'          => $id,
        ':title'       => $data['title'] ?? '',
        ':description' => $data['description'] ?? '',
        ':price'       => $data['price'] ?? 0,
        ':category'    => $data['category'] ?? 'phone',
        ':location'    => $data['location'] ?? '',
        ':start_date'  => $data['start_date'] ?? null,
        ':end_date'    => $data['end_date'] ?? null,
        ':image_url'   => $data['image_url'] ?? '',
        ':featured'    => isset($data['featured']) ? 1 : 0,
        ':stock'       => $data['stock'] ?? 0,
    ]);
}

function delete_offer(int $id): bool
{
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM offers WHERE id = :id');

    return $stmt->execute([':id' => $id]);
}

function create_booking(array $data): bool
{
    global $pdo;
    $sql = 'INSERT INTO bookings (offer_id, name, email, phone, message) VALUES (:offer_id, :name, :email, :phone, :message)';
    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        ':offer_id' => $data['offer_id'] ?? null,
        ':name'     => $data['name'] ?? '',
        ':email'    => $data['email'] ?? '',
        ':phone'    => $data['phone'] ?? '',
        ':message'  => $data['message'] ?? '',
    ]);
}

function get_categories(): array
{
    global $pdo;
    $stmt = $pdo->query('SELECT DISTINCT category FROM offers ORDER BY category ASC');
    $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);

    return array_values(array_filter($rows));
}
