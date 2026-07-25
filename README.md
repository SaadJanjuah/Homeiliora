# Homeiliora

A Pinterest-first, ad-supported **home-decor micro-niche blog** built on WordPress with a custom full-site-editing block theme (`moodboard`).

## Repository layout
- `saad-site/` — the WordPress install, including the custom theme at `wp-content/themes/moodboard/`
- `PROJECT.md` — living project spec + build status
- `WORK-LOG-2026-07-26.md` — dated log of work completed
- `backups/` — plugin manifest (database dumps are gitignored — kept private)
- `logo-stacked.svg` — brand logo

## The custom theme: `moodboard`
Full-site-editing block theme. Highlights:
- Logo-matched palette (charcoal / terracotta `#D9643A` / forest `#3F5D42` / warm plaster) in `theme.json`
- Self-hosted Space Grotesk + Lora fonts
- Signature asymmetric "moodboard" masonry grid
- Sticky header + nav, breadcrumbs, byline, related posts, comments
- Quick-answer / shop-this-look / newsletter patterns
- Pinterest "Pin it" hover button + client-side "Saved" bookmarks
- Ad slots (in-flow + site-wide left/right sticky rails)
- Open Graph / Twitter / Pinterest Rich-Pin meta

## Local setup
Requires PHP 8, MySQL 8, WP-CLI. `wp-config.php` is gitignored — copy `saad-site/wp-config-sample.php` and set your DB credentials. Restore content/settings with `wp db import` from a private database dump.

> Not committed to this repo (by design): `wp-config.php` (secrets) and `backups/*.sql` (database dumps contain a password hash).
