# Home Decor Micro-Niche Blog — Project Spec

## 1. Project Overview

**What this is:** A WordPress content site covering home-decor micro-niches (e.g. small-space living, rental-friendly DIY, nursery decor, boho balcony ideas, budget kitchen makeovers). Traffic is driven primarily from **Pinterest**, not Google search — so every design and technical decision should optimize for: fast load on mobile, strong visual presentation of images, and easy pin-ability of content.

**Business model:** Ad-supported content site. Traffic → pageviews → display ad revenue (Google AdSense initially, migrating to Ezoic/Mediavine/AdThrive once traffic thresholds are met). No e-commerce, no lead gen — the entire goal is pageviews and time-on-site.

**Non-goals:** This is not an SEO-first Google content site (at least initially), not a portfolio/agency site, not an online store. Don't over-engineer for search — optimize for Pinterest referral traffic and ad viewability.

---

## 2. Design System

### 2.1 Palette — updated 2026-07-25 to match the brand logo (`logo-stacked.svg`)
| Token | Hex | Use |
|---|---|---|
| `base` | `#F6F4F0` | Warm plaster — page background |
| `ink` | `#26241F` | Charcoal — body text, headings (matches logo) |
| `accent` | `#D9643A` | Terracotta — primary pop: links, buttons, "pins", eyebrows (matches logo) |
| `forest` | `#3F5D42` | Forest green — secondary accent: niche tags, rules (matches logo) |
| `clay` | `#C4A998` | Dusty clay — soft hover / highlight tint |
| `stone` | `#DAD5C9` | Stone — borders, dividers, card outlines |
| `surface` | `#FFFFFF` | Card surfaces, whitespace |

**Palette decision (revised):** the original spec called for a muted sage + clay palette and warned against terracotta. The actual brand **logo leads with terracotta (`#D9643A`) + forest green (`#3F5D42`)**, so the theme now matches the logo — this was a deliberate, approved override. Discipline still applies: terracotta is a *pop* accent (buttons, pins, eyebrows, links), never a fill. Keep the large areas calm (plaster / stone / white) so the terracotta reads as a spark, not the whole room. Avoid high-contrast-serif clichés; body stays Lora at a restrained weight.

### 2.2 Typography
- **Display / headings:** Space Grotesk (or General Sans as fallback) — bold, geometric, architectural. Google Fonts.
- **Body copy:** Lora (or Fraunces, restrained weight ~400–500) — humanist serif, editorial feel.
- **Utility/meta (dates, captions, tags):** Space Grotesk, smaller size, uppercase, letter-spaced.
- Type scale: base 18px body (readability on mobile is critical for Pinterest traffic), h1 ~2.75rem, h2 ~2rem, h3 ~1.5rem. Line-height 1.6+ on body copy.

### 2.3 Layout — "The Moodboard Grid"
This is the signature element. Homepage and category/archive pages use an **asymmetric masonry grid** (mixed card heights, like a pinboard), NOT a uniform 3-column blog list.

- Subtle hairline grid pattern in the page background (very low opacity, like graph paper) — barely visible texture, not decoration for its own sake.
- Post cards: white surface, no heavy rounded corners (max 4px radius), soft drop shadow on hover only (feels like lifting a pinned photo off a board), image-forward (image takes ~70-80% of card).
- No numbered markers, no "01/02/03" step decoration anywhere unless content is a genuine sequence (e.g. a real step-by-step DIY tutorial).

### 2.4 Motion
Minimal and purposeful only:
- Cards lift slightly (translateY + shadow) on hover — desktop only.
- Images lazy-load with a simple fade-in.
- No scroll-jacking, no gratuitous animation. Respect `prefers-reduced-motion`.

### 2.5 Voice / Copy
- Plain, warm, specific — never salesy or filler ("Discover the BEST ideas!!"). Write like a knowledgeable friend, not a listicle machine.
- Buttons/CTAs say exactly what happens: "Save this idea," "See the full room," not "Click here" or "Learn more."

---

## 3. Site Structure

### 3.1 Taxonomy
- Custom taxonomy: **Micro-Niche** (hierarchical, like categories) — e.g.:
  - Small-Space Living
  - Rental-Friendly DIY
  - Nursery & Kids Rooms
  - Balcony & Outdoor Nooks
  - Budget Kitchen Refresh
  - Cozy Minimalism
- Standard tags for cross-cutting themes (color, style, budget level) — e.g. `neutral-palette`, `under-$100`, `boho`, `scandi`.

### 3.2 Navigation
- **Primary nav (header):** sticky bar — logo left, links right: **Home · Ideas ▾ · About · Contact**. "Ideas" is a dropdown listing the micro-niche archives. Collapses to a mobile overlay menu.
- **Footer nav:** Home · About · Contact · Privacy Policy.

### 3.2 Pages
- **Homepage** — moodboard grid of latest/featured posts across all micro-niches, brief intro, category nav.
- **Micro-niche archive pages** — one per niche, same moodboard grid filtered to that niche, with a short intro paragraph (helps establish topical relevance).
- **Single post template** — see 3.3.
- **About** — short, human, builds trust (helps with ad network approval too).
- **Privacy Policy / Cookie Policy / Disclosure** — required for AdSense and affiliate disclosure compliance. Use a compliance plugin to generate, don't hand-write legal text.
- **Contact**

### 3.3 Single Post Template
Structure every post consistently (helps both Pinterest re-pinning and reader retention):
1. Hero image (vertical-friendly, this becomes the pinnable image)
2. Title + short dek (1-2 sentence summary)
3. Meta row: micro-niche tag, read time, save/pin button
4. Body content, broken into clear H2 sections (skimmable)
5. Image gallery / "shop this look" block where relevant
6. Ad slot placements (see section 5)
7. Related posts (same micro-niche) — moodboard-style mini grid
8. Newsletter signup (optional, for future email list building)

---

## 4. Technical Stack

- **Theme approach:** Custom **block theme (Full Site Editing)** built on the WordPress `theme.json` system, OR a lightweight base (GeneratePress/Kadence) with a child theme layer — recommend **custom block theme** for full control over the moodboard grid layout, since page-builder plugins add bloat that hurts Core Web Vitals (which matters directly for ad RPM).
- Build with native WordPress **block editor + custom blocks** (via ACF Blocks or native block.json) rather than Elementor/Divi.
- **Custom post type:** consider a `roomidea` CPT if posts need structured fields (e.g. budget level, style tags, shoppable links) beyond standard posts — decide once first micro-niche content is drafted.

### 4.1 Core Plugins
| Purpose | Plugin |
|---|---|
| SEO | Rank Math |
| Caching/speed | WP Rocket or LiteSpeed Cache |
| Image compression | ShortPixel or Imagify |
| Cookie/privacy compliance | CookieYes or Complianz |
| Ad management | Ad Inserter (until approved for a managed network) |
| Forms (contact) | Fluent Forms (lightweight) |
| Custom fields (if needed) | Advanced Custom Fields (ACF) |

Keep plugin count minimal — every plugin is a speed and security cost, and speed directly affects ad revenue.

---

## 5. Ad Placement Zones (design must accommodate these from the start)

Design cards/spacing so these slots can be inserted without breaking layout:
- Below-hero banner (homepage)
- In-content (after 2nd H2 section in single posts)
- Sidebar/sticky unit (desktop only)
- Below-post, above related-posts

Ads must not overlap the moodboard grid cards or break masonry layout — reserve fixed-height containers to avoid layout shift (CLS).

---

## 6. Performance & Pinterest-Optimization Requirements

- All post hero images must support **vertical aspect ratio (2:3, ideally 1000×1500px)** — this is the shape Pinterest favors.
- Every image needs descriptive alt text (keyword-rich, natural language) — critical for Pinterest's own image search/SEO.
- Enable **Open Graph + Pinterest Rich Pins** meta tags (Rank Math handles this).
- Lazy-load all images below the fold.
- Target Core Web Vitals: LCP < 2.5s, CLS < 0.1 — this affects both Pinterest distribution and ad network approval/RPM.
- Mobile-first: assume 80%+ of traffic is mobile (typical for Pinterest referral traffic).

---

## 7. Build Roadmap (suggested order for Claude Code sessions)

1. Scaffold block theme: `theme.json` with the design tokens above (colors, type, spacing scale).
2. Build homepage template: header/nav, hero/intro, moodboard grid block, footer.
3. Build single post template.
4. Build micro-niche archive template (reuses moodboard grid).
5. Build About, Contact, Privacy/Disclosure pages.
6. Implement ad-slot placeholder blocks (empty containers, real ad code added after network approval).
7. Performance pass: image handling, lazy load, caching config notes.
8. QA pass: mobile responsiveness, reduced-motion, keyboard focus states.

---

## 8. Open Questions to Resolve Before/During Build
- Final list of launch micro-niches (recommend starting with 3–4, not all 6+, to keep content focused).
- Whether to use a custom post type for structured "idea" posts or keep it simple with standard posts + taxonomy.
- Hosting provider (affects caching plugin choice).

---

## 9. Build Status — as of 2026-07-25

**Theme:** `moodboard` (custom FSE block theme, active). Brand: **homeiliora**. Local dev at http://localhost:8080.

Done:
- [x] Step 1 — Block theme scaffold: `theme.json` with the (logo-matched) palette, Space Grotesk + Lora self-hosted fonts, spacing scale.
- [x] Step 2 — Homepage: sticky header + navbar, hero band, ad banner, moodboard masonry grid, footer.
- [x] Step 3 — Single post template (niche tag, title, dek, meta + "Save this idea", capped hero image, in-content-ready, related grid).
- [x] Step 4 — Micro-niche archive template (reuses the moodboard loop) + search + 404 + page templates.
- [x] Step 5 — About, Contact, Privacy Policy pages (Privacy designated in WP settings).
- [x] Step 6 — Ad-slot placeholder blocks: `moodboard/ad-banner` (below hero) + `moodboard/ad-slot` (below post). Reserved fixed heights to avoid CLS. Insert real code once a network is approved.
- [x] Navigation: primary (Home · Ideas ▾ · About · Contact) + footer nav.
- [x] Demo content: 8 posts across 4 niche categories with placeholder featured images.

Credibility & publication layer (added 2026-07-26):
- [x] Core plugins installed & active: Rank Math, LiteSpeed Cache, ShortPixel, CookieYes, Ad Inserter, Fluent Forms, ACF. (Fixed PHP CA bundle in php.ini so installs work.)
- [x] Trust: author byline "By homeiliora" + brand avatar mark, published + "Updated" dates, moderated comments, on-brand 404.
- [x] Structure: niche-prefixed permalinks (/niche/post-name/), self-contained breadcrumbs, header search, related grid.
- [x] Content patterns: Quick Answer callout, Shop this look (w/ affiliate disclosure), inline Newsletter signup. All in the inserter under "Moodboard".
- [x] Pinterest "Save" hover button on content/hero/card images (assets/js/pinit.js).
- [x] Technical: favicon/site icon (from logo mark), Open Graph + Twitter Card + article:published/modified (Pinterest Rich Pins) via theme fallback that auto-defers to Rank Math once its wizard is run, canonical, working sitemap (core /wp-sitemap.xml interim; Rank Math's after wizard).

Ad slots & Saved feature (added 2026-07-26):
- [x] Multiple ad placeholder slots: Home ×2 (below hero, below grid), Single ×3 (top-of-content, below content, below related), Archive ×1 (above grid), Page/Search ×1. Reserved heights = no CLS. Ad Inserter handles automatic in-content (after 2nd H2) site-wide.
- [x] Site-wide left + right sticky skyscraper rails (160x600) — injected globally via `wp_footer` (`moodboard_ad_rails()` in functions.php), so they appear on EVERY page incl. 404. CSS shows them only ≥1560px viewport (room in the gutters beside the 1200px column; hidden below to avoid overlap). Fixed position = no CLS.
- [x] "Saved" bookmarks — client-side (localStorage, key `homeiliora_saved_v1`, no account). Nav "♥ Saved" tab with live count badge; "+ Save / ✓ Saved" button on every card; "Save this idea" toggle on posts; `/saved/` page (id 42) that lists saved items as moodboard cards with Remove. JS: `assets/js/bookmarks.js`. Disambiguated from the Pinterest "Pin it" hover button.

Dark mode (added 2026-07-27):
- [x] Light/dark theming with a header toggle beside the search icon. Defaults to the reader's OS setting (`prefers-color-scheme`); clicking stores an explicit choice in localStorage (`homeiliora_theme_v1`) that overrides the OS in both directions and syncs across tabs.
- [x] No flash of light on load — a tiny inline script in `wp_head` (`moodboard_theme_no_flash_script`) applies the stored choice before first paint.
- [x] Implemented by re-pointing the `--wp--preset--color--*` variables in `assets/css/dark.css`, so theme.json presets, block markup and `main.css` all follow from one place. dark.css contains no layout or component rules — if it fails to load the site is exactly as it was.
- [x] Dark palette is warm charcoal, not neutral grey; terracotta and forest are lifted (`#D9643A`→`#E4764C`, `#3F5D42`→`#86A98A`) because the originals were chosen against warm plaster. Every text pairing verified at WCAG AA or better (lowest is 5.3:1).
- [x] The logo has charcoal baked into the SVG, so a dark variant (`logo-stacked-dark.svg`) is swapped in by CSS. Both variants ship in the markup and CSS shows one — no flash, no JS.
- [x] The footer stays a dark band in both themes (it is painted with the very presets dark mode flips, so its colours are pinned to their own tokens).

Needs the user / real assets:
- [ ] Real About-page voice (specific story) + a founder photo/illustration.
- [ ] Replace placeholder featured images + shop-this-look images with real photography.
- [ ] Run the Rank Math setup wizard (unlocks its OG/sitemap/schema — theme fallback steps aside automatically).
- [ ] Wire the newsletter form + Contact form to Fluent Forms / an email provider (currently visual).
- [ ] Brand the CookieYes banner (still default blue) to the terracotta/charcoal palette — it is also the one element that stays bright white in dark mode, since the plugin renders it outside the theme's styles.
- [ ] ShortPixel API key; real ad code for the ad slots + in-content (Ad Inserter after 2nd H2); affiliate links in Shop-this-look.

Not yet done:
- [ ] Step 7 — Performance pass (image compression plugin, caching config, real vertical 2:3 hero images).
- [ ] Step 8 — Full QA pass (cross-device, focus states audit).
- [ ] In-content ad (after 2nd H2) — to be handled by Ad Inserter plugin.
- [ ] Core plugins from §4.1 (Rank Math, caching, ShortPixel, CookieYes, Ad Inserter, Fluent Forms, ACF).
- [ ] Contact form (Fluent Forms) — Contact page currently uses an email CTA placeholder.
- [ ] Replace placeholder featured images with real photography.
