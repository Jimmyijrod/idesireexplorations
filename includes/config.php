<?php
// Site-wide settings. Replace the [bracketed] values with real details.

define('SITE_NAME', 'iDesire Explorations');
define('SITE_TAGLINE', 'Tours, treks and festivals across Bhutan');

define('CONTACT_PHONE', '[Phone / WhatsApp]');
define('CONTACT_EMAIL', '[Email]');
define('CONTACT_ADDRESS', '[Office address], Bhutan');

// Escape text before printing it into HTML.
function e(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
