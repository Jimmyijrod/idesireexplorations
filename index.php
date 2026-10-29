<?php
$pageTitle  = 'iDesire Explorations – Tours, treks and festivals in Bhutan';
$heroHeader = true;
require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/header.php';
?>

<main>
  <!-- Hero: replace the placeholder with a photo or video later -->
  <section class="hero">
    <div class="hero__media" aria-hidden="true">
      <span class="placeholder-label">Full-screen photo or video · prayer flags at Dochula</span>
    </div>
    <div class="container hero__content">
      <p class="eyebrow">Kuzuzangpo la · Welcome</p>
      <h1>Travel Bhutan the way it is lived</h1>
      <p class="hero__lead">Monasteries, mountain trails and village festivals, with guides who call this place home.</p>
    </div>
  </section>

  <div class="textile-band" aria-hidden="true"></div>

  <!-- Trip finder -->
  <section class="container container--narrow trip-finder-wrap">
    <form class="trip-finder" action="tours.php" method="get">
      <label>Type of trip
        <select name="type">
          <option value="">Any</option>
          <option value="cultural">Cultural tour</option>
          <option value="trek">Trek</option>
          <option value="festival">Festival</option>
        </select>
      </label>
      <label>Month
        <select name="month">
          <option value="">Any month</option>
          <?php foreach (['January','February','March','April','May','June','July','August','September','October','November','December'] as $m): ?>
            <option value="<?= strtolower($m) ?>"><?= $m ?></option>
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
    <div class="tour-grid">
      <?php foreach ($featuredTours as $tour): ?>
        <a class="tour-card" href="tour.php?slug=<?= e($tour['slug']) ?>">
          <?php if ($tour['image']): ?>
            <img class="tour-card__img" src="<?= e($tour['image']) ?>" alt="" loading="lazy">
          <?php else: ?>
            <span class="placeholder-label">Photo · <?= e($tour['photo']) ?></span>
          <?php endif; ?>
          <div class="tour-card__info">
            <p class="tour-card__days"><?= e($tour['days']) ?></p>
            <h3><?= e($tour['name']) ?></h3>
            <p class="tour-card__price">From <?= e($tour['price']) ?> →</p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- About intro -->
  <section class="intro">
    <div class="container container--text">
      <img src="assets/images/logo.png" alt="" width="72" height="72">
      <h2>A small team with a big love for Bhutan</h2>
      <p>[Two or three sentences about iDesire Explorations: who you are, why you started, and how you look after your guests.]</p>
      <a href="about.php" class="link">Read our story</a>
    </div>
  </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
