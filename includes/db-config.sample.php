<?php
// Database login details.
//
// On the hosting: copy this file to /home/idesireexplorati/idesire-config.php
// (OUTSIDE public_html, so it can't be opened in a browser and deploys never overwrite it)
// and fill in the details from cPanel > MySQL Databases.
//
// For local testing you may instead save it as includes/db-config.php.
// Never commit the real file – it is listed in .gitignore.

return [
    'host'     => 'localhost',
    'database' => 'idesireexplorati_site',
    'username' => 'idesireexplorati_web',
    'password' => 'CHANGE-ME',
];
