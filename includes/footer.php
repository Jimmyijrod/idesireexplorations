<?php require_once __DIR__ . '/config.php'; ?>
<footer class="site-footer">
  <div class="textile-band" aria-hidden="true"></div>
  <div class="container site-footer__inner">
    <div class="site-footer__brand">
      <p class="site-footer__name"><?= e(SITE_NAME) ?></p>
      <p><?= e(SITE_TAGLINE) ?>.</p>
    </div>
    <div class="site-footer__contact">
      <span><?= e(CONTACT_PHONE) ?></span>
      <span><?= e(CONTACT_EMAIL) ?></span>
      <span><?= e(CONTACT_ADDRESS) ?></span>
    </div>
    <a href="enquiry.php" class="btn btn--light">Send an enquiry</a>
  </div>
  <div class="container site-footer__legal">
    © <?= date('Y') ?> <?= e(SITE_NAME) ?>
  </div>
</footer>
<script src="assets/js/main.js"></script>
</body>
</html>
