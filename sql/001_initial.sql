-- iDesire Explorations – step 1: settings, tour categories and tours.
-- Import this once in cPanel > phpMyAdmin > (your database) > Import.

SET NAMES utf8mb4;

-- Site-wide texts and contact details, editable later from the admin panel.
CREATE TABLE IF NOT EXISTS settings (
  setting_key   VARCHAR(64)  NOT NULL PRIMARY KEY,
  setting_value TEXT         NOT NULL,
  updated_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS tour_categories (
  id         INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  slug       VARCHAR(64)  NOT NULL UNIQUE,
  name       VARCHAR(100) NOT NULL,
  sort_order INT          NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS tours (
  id            INT UNSIGNED  NOT NULL AUTO_INCREMENT PRIMARY KEY,
  slug          VARCHAR(120)  NOT NULL UNIQUE,
  name          VARCHAR(150)  NOT NULL,
  category_id   INT UNSIGNED  NULL,
  duration_days TINYINT UNSIGNED NOT NULL,
  route         VARCHAR(200)  NOT NULL DEFAULT '',
  summary       TEXT          NOT NULL,
  price_from    DECIMAL(10,2) NULL,
  currency      CHAR(3)       NOT NULL DEFAULT 'USD',
  best_months   VARCHAR(40)   NOT NULL DEFAULT '' COMMENT 'Comma-separated month numbers, e.g. 3,4,10,11',
  cover_image   VARCHAR(255)  NULL,
  cover_alt     VARCHAR(150)  NOT NULL DEFAULT '',
  is_featured   TINYINT(1)    NOT NULL DEFAULT 0,
  is_published  TINYINT(1)    NOT NULL DEFAULT 1,
  sort_order    INT           NOT NULL DEFAULT 0,
  created_at    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_tours_category FOREIGN KEY (category_id) REFERENCES tour_categories (id) ON DELETE SET NULL,
  KEY idx_tours_listing (is_published, is_featured, sort_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Starting content. Replace the [bracketed] values with real details.
INSERT INTO settings (setting_key, setting_value) VALUES
  ('site_name',    'iDesire Explorations'),
  ('tagline',      'Tours, treks and festivals across Bhutan'),
  ('phone',        '[Phone / WhatsApp]'),
  ('email',        '[Email]'),
  ('address',      '[Office address], Bhutan'),
  ('hero_eyebrow', 'Kuzuzangpo la · Welcome'),
  ('hero_title',   'Travel Bhutan the way it is lived'),
  ('hero_text',    'Monasteries, mountain trails and village festivals, with guides who call this place home.'),
  ('hero_image',   ''),
  ('hero_video',   ''),
  ('hero_alt',     'Prayer flags at Dochula'),
  ('about_title',  'A small team with a big love for Bhutan'),
  ('about_text',   '[Two or three sentences about iDesire Explorations: who you are, why you started, and how you look after your guests.]')
ON DUPLICATE KEY UPDATE setting_key = setting_key;

INSERT INTO tour_categories (slug, name, sort_order) VALUES
  ('cultural', 'Cultural tour', 1),
  ('trek',     'Trek',          2),
  ('festival', 'Festival',      3)
ON DUPLICATE KEY UPDATE slug = slug;

INSERT INTO tours (slug, name, category_id, duration_days, route, summary, price_from, best_months, cover_alt, is_featured, sort_order) VALUES
  ('cultural-western-bhutan', 'Cultural Western Bhutan',
     (SELECT id FROM tour_categories WHERE slug = 'cultural'), 7, 'Paro, Thimphu, Punakha',
     'Dzongs, monasteries and the hike to Tiger''s Nest.', NULL, '3,4,5,9,10,11', 'Punakha Dzong', 1, 1),
  ('druk-path-trek', 'Druk Path Trek',
     (SELECT id FROM tour_categories WHERE slug = 'trek'), 6, 'Paro to Thimphu',
     'High lakes and mountain views on a classic trek.', NULL, '4,5,9,10', 'High mountain lake', 1, 2),
  ('tshechu-festival-tour', 'Tshechu Festival Tour',
     (SELECT id FROM tour_categories WHERE slug = 'festival'), 8, 'Festival dates',
     'Masked dances and local life at a sacred festival.', NULL, '3,4,9,10', 'Masked dancers', 1, 3)
ON DUPLICATE KEY UPDATE slug = slug;
