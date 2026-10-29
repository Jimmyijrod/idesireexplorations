<?php
// Shared page header. Set $pageTitle and $heroHeader before including.
// $heroHeader = true draws the menu on top of the hero photo (home page).
require_once __DIR__ . '/config.php';

$pageTitle  = $pageTitle ?? SITE_NAME;
$heroHeader = $heroHeader ?? false;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle) ?></title>
  <meta name="description" content="<?= e(SITE_NAME . ' – ' . SITE_TAGLINE) ?>">
  <link rel="icon" href="assets/images/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500&family=Nunito+Sans:wght@400;600;700&display=swap">
  <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
</head>
<body>
<header class="site-header<?= $heroHeader ? ' site-header--over-hero' : '' ?>">
  <div class="container site-header__inner">
    <a href="index.php" class="site-header__logo">
      <img src="assets/images/logo.png" alt="<?= e(SITE_NAME) ?> home" width="68" height="68">
    </a>
    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="main-nav" aria-label="Open menu">
      <span></span><span></span><span></span>
    </button>
    <nav id="main-nav" class="main-nav" aria-label="Main">
      <a href="tours.php">Journeys</a>
      <a href="tours.php?type=festival">Festivals</a>
      <a href="gallery.php">Gallery</a>
      <a href="about.php">About</a>
      <a href="enquiry.php" class="btn btn--light">Enquire</a>
    </nav>
  </div>
</header>
