<?php
// Database connection and the queries the public pages use.

function db(): PDO
{
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    // Look for the config next to this file (local testing), then outside
    // public_html (hosting) – works for both public_html/ and public_html/preview/.
    $candidates = [
        __DIR__ . '/db-config.php',
        dirname(__DIR__, 2) . '/idesire-config.php',
        dirname(__DIR__, 3) . '/idesire-config.php',
    ];
    $config = null;
    foreach ($candidates as $file) {
        if (is_file($file)) {
            $config = require $file;
            break;
        }
    }
    if (!is_array($config)) {
        throw new RuntimeException('Database config file not found.');
    }

    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $config['host'], $config['database']);
    $pdo = new PDO($dsn, $config['username'], $config['password'], [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
    return $pdo;
}

// All settings as key => value, loaded once per request.
function settings(): array
{
    static $settings = null;
    if ($settings === null) {
        $settings = db()->query('SELECT setting_key, setting_value FROM settings')
                        ->fetchAll(PDO::FETCH_KEY_PAIR);
    }
    return $settings;
}

function setting(string $key, string $default = ''): string
{
    return settings()[$key] ?? $default;
}

function tour_categories(): array
{
    return db()->query('SELECT id, slug, name FROM tour_categories ORDER BY sort_order, name')->fetchAll();
}

function featured_tours(int $limit = 3): array
{
    $stmt = db()->prepare(
        'SELECT t.*, c.slug AS category_slug, c.name AS category_name
           FROM tours t
           LEFT JOIN tour_categories c ON c.id = t.category_id
          WHERE t.is_published = 1 AND t.is_featured = 1
          ORDER BY t.sort_order, t.name
          LIMIT :limit'
    );
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

// "From USD 1,250" or "Price on request" when no price is set.
function tour_price(array $tour): string
{
    if ($tour['price_from'] === null) {
        return 'Price on request';
    }
    return 'From ' . $tour['currency'] . ' ' . number_format((float) $tour['price_from']);
}

// "7 days · Paro, Thimphu, Punakha"
function tour_meta(array $tour): string
{
    $days = (int) $tour['duration_days'];
    $text = $days . ($days === 1 ? ' day' : ' days');
    return $tour['route'] !== '' ? $text . ' · ' . $tour['route'] : $text;
}
