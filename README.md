# Homeiliora

A Pinterest-first, ad-supported **home-decor micro-niche blog** built on WordPress with a custom full-site-editing block theme (`moodboard`).

## Repository layout
- `saad-site/` — the WordPress install, including the custom theme at `wp-content/themes/moodboard/`
- `PROJECT.md` — living project spec + build status
- `WORK-LOG-*.md` — dated logs of work completed (most recent: `WORK-LOG-2026-08-04.md`)
- `dev/` — local dev server config and helper scripts
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

### Running the site locally

```powershell
powershell -ExecutionPolicy Bypass -File dev\start-local.ps1   # http://localhost:8080
powershell -ExecutionPolicy Bypass -File dev\stop-local.ps1
```

`dev/start-local.ps1` starts MySQL and Apache from Laragon's binaries and confirms the site answers. It is safe to run twice — anything already running is left alone.

Apache uses `dev/apache-homeiliora.conf` rather than Laragon's own configuration, which stays untouched. Laragon's `httpd.conf` is stock and only receives its settings when the Laragon GUI starts, so Apache launched on its own would load neither `mod_php` nor any vhost. The config also carries the WordPress permalink rewrite rules, because the site's `.htaccess` has no `# BEGIN WordPress` block — without them every URL except the homepage 404s.

Paths are absolute. If Laragon updates its bundled Apache, PHP or MySQL, correct the version numbers in the three `Define` lines at the top of the config and in the two `$mysqld` / `$httpd` variables in `start-local.ps1`.

### Building an installable theme zip

```powershell
powershell -ExecutionPolicy Bypass -File dev\build-theme-zip.ps1   # -> moodboard-theme.zip
```

Produces `moodboard-theme.zip` in the project root, ready for **Appearance → Themes → Add New → Upload Theme**. Rebuild it after any theme change — the zip is gitignored precisely because a committed copy goes stale.

It deliberately does not use `Compress-Archive`: on Windows PowerShell 5.1 that writes entry paths with backslashes, which the ZIP spec forbids and WordPress's unzip mishandles. The script writes entries explicitly and verifies the result before finishing.

> A theme zip carries the **design only**. Moving the whole site to a server also needs the database (posts, pages, menus, settings), `wp-content/uploads`, and the plugin set — use a migration plugin such as Duplicator for that, not this zip.

> Not committed to this repo (by design): `wp-config.php` (secrets) and `backups/*.sql` (database dumps contain a password hash).
