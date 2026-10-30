<?php
// Shared setup for every page: database, settings and helpers.

require_once __DIR__ . '/db.php';

// Escape text before printing it into HTML.
function e(?string $text): string
{
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
}

// Show a friendly page instead of a PHP error if the database is unreachable.
function fail_gracefully(Throwable $error): void
{
    error_log('iDesire site error: ' . $error->getMessage());
    http_response_code(503);
    echo '<!doctype html><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">'
       . '<title>iDesire Explorations</title>'
       . '<div style="font-family:system-ui,sans-serif;max-width:520px;margin:15vh auto;padding:0 24px;color:#262A27">'
       . '<h1 style="font-weight:500">We\'ll be right back</h1>'
       . '<p>The website is having a short technical break. Please try again in a few minutes.</p></div>';
    exit;
}

try {
    settings();
} catch (Throwable $error) {
    fail_gracefully($error);
}
