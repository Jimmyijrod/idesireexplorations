<?php
require_once __DIR__ . '/includes/config.php';

try {
    $featuredTours = featured_tours(3);
    $categories    = tour_categories();
} catch (Throwable $error) {
    fail_gracefully($error);
}

$pageTitle  = setting('site_name') . ' – ' . setting('tagline');
$heroHeader = true;
$heroImage  = setting('hero_image');
$heroVideo  = setting('hero_video');
$months     = ['January', 'February', 'March', 'April', 'May', 'June',
               'July', 'August', 'September', 'October', 'November', 'December'];

require __DIR__ . '/includes/header.php';
?>

<main>
  <section class="hero">
    <div class="hero__media"<?= $heroImage || $heroVideo ? '' : ' aria-hidden="true"' ?>>
      <?php if ($heroVideo): ?>
        <video src="<?= e($heroVideo) ?>" autoplay muted loop playsinline<?= $heroImage ? ' poster="' . e($heroImage) . '"' : '' ?>></video>
      <?php elseif ($heroImage): ?>
        <img src="<?= e($heroImage) ?>" alt="<?= e(setting('hero_alt')) ?>">
      <?php else: ?>
        <span class="placeholder-label">Full-screen photo or video · <?= e(setting('hero_alt')) ?></span>
      <?php endif; ?>
    </div>
    <div class="container hero__content">
      <p class="eyebrow"><?= e(setting('hero_eyebrow')) ?></p>
      <h1><?= e(setting('hero_title')) ?></h1>
      <p class="hero__lead"><?= e(setting('hero_text')) ?></p>
    </div>
  </section>

  <div class="textile-band" aria-hidden="true"></div>

  <!-- Trip finder -->
  <section class="container container--narrow trip-finder-wrap">
    <form class="trip-finder" action="tours.php" method="get">
      <label>Type of trip
        <select name="type">
          <option value="">Any</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?= e($category['slug']) ?>"><?= e($category['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </label>
      <label>Month
        <select name="month">
          <option value="">Any month</option>
          <?php foreach ($months as $i => $month): ?>
            <option value="<?= $i + 1 ?>"><?= $month ?></option>
          <?php endforeach; ?>
        </select>
      </label>
      <label>Travellers
        <select name="travellers">
          <option value="2">2</option>
          <option value="1">1</option>
          <option value="3-5">3–5</option>
          <option value="6+">6+</option>
        </select>
      </label>
      <button type="submit" class="btn">Find trips</button>
    </form>
  </section>

  <!-- Journeys -->
  <section class="container section">
    <h2 class="section__title">Our journeys</h2>
    <?php if ($featuredTours): ?>
      <div class="tour-grid">
        <?php foreach ($featuredTours as $tour): ?>
          <a class="tour-card" href="tour.php?slug=<?= e($tour['slug']) ?>">
            <?php if ($tour['cover_image']): ?>
              <img class="tour-card__img" src="<?= e($tour['cover_image']) ?>" alt="<?= e($tour['cover_alt']) ?>" loading="lazy">
            <?php else: ?>
              <span class="placeholder-label">Photo · <?= e($tour['cover_alt']) ?></span>
            <?php endif; ?>
            <div class="tour-card__info">
              <p class="tour-card__days"><?= e(tour_meta($tour)) ?></p>
              <h3><?= e($tour['name']) ?></h3>
              <p class="tour-card__price"><?= e(tour_price($tour)) ?> →</p>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="empty-note">New journeys are coming soon. <a href="enquiry.php">Ask us</a> about a trip.</p>
    <?php endif; ?>
  </section>

  <!-- About intro -->
  <section class="intro">
    <div class="container container--text">
      <img src="assets/images/logo.png" alt="" width="72" height="72">
      <h2><?= e(setting('about_title')) ?></h2>
      <p><?= nl2br(e(setting('about_text'))) ?></p>
      <a href="about.php" class="link">Read our story</a>
    </div>
  </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
