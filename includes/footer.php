<?php require_once __DIR__ . '/config.php'; ?>
<footer class="site-footer">
  <div class="textile-band textile-band--weave" aria-hidden="true"></div>
  <div class="container site-footer__inner">
    <div class="site-footer__brand">
      <p class="site-footer__name"><?= e(setting('site_name')) ?></p>
      <p><?= e(setting('tagline')) ?>.</p>
    </div>
    <div class="site-footer__contact">
      <span><?= e(setting('phone')) ?></span>
      <span><?= e(setting('email')) ?></span>
      <span><?= e(setting('address')) ?></span>
    </div>
    <a href="enquiry.php" class="btn btn--light">Send an enquiry</a>
  </div>
  <div class="container site-footer__legal">
    © <?= date('Y') ?> <?= e(setting('site_name')) ?>
  </div>
</footer>
<script src="assets/js/main.js"></script>
</body>
</html>
