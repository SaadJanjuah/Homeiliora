# Home Decor Micro-Niche Blog — Project Spec

## 1. Project Overview

**What this is:** A WordPress content site covering home-decor micro-niches (e.g. small-space living, rental-friendly DIY, nursery decor, boho balcony ideas, budget kitchen makeovers). Traffic is driven primarily from **Pinterest**, not Google search — so every design and technical decision should optimize for: fast load on mobile, strong visual presentation of images, and easy pin-ability of content.

**Business model:** Ad-supported content site. Traffic → pageviews → display ad revenue (Google AdSense initially, migrating to Ezoic/Mediavine/AdThrive once traffic thresholds are met). No e-commerce, no lead gen — the entire goal is pageviews and time-on-site.

**Non-goals:** This is not an SEO-first Google content site (at least initially), not a portfolio/agency site, not an online store. Don't over-engineer for search — optimize for Pinterest referral traffic and ad viewability.

---

## 2. Design System

### 2.1 Palette — sage-led, implemented 2026-08-15

Sage is the working accent: links, buttons, focus rings, eyebrows. Terracotta is held back for the logo and Pinterest-facing CTAs.

| Token | Hex | Use |
|---|---|---|
| `base` | `#F6F4F0` | Warm plaster — page background |
| `surface` | `#FFFFFF` | Card surfaces, whitespace |
| `ink` | `#26241F` | Charcoal — body text, headings |
| `accent` | `#63715B` | **Sage** — links, buttons, focus rings, eyebrows |
| `accent-soft` | `#E3E8DF` | Sage tint — newsletter panel and other soft fills |
| `terracotta` | `#D9643A` | Brand terracotta — **logo only**, and decoration that carries no text |
| `terracotta-deep` | `#B04D2A` | Terracotta for anything text-bearing: niche tags, "Pin it" CTA |
| `forest` | `#3F5D42` | Emerald — logo baseline, hover states, "Updated" meta |
| `gold` | `#C9A860` | Tertiary brand accent — **decorative only, never text** (2.1:1 on plaster) |
| `clay` | `#C4A998` | Dusty clay — soft hover / highlight tint |
| `stone` | `#DAD5C9` | Stone — borders, dividers, card outlines |
| `muted` | `#6E6A61` | Muted ink — captions, breadcrumbs, meta |

**Why two terracottas.** The brand terracotta `#D9643A` only reaches **3.28:1** on warm plaster and **3.6:1** behind white button text — both below the WCAG AA floor of 4.5:1. That was true of the previous build too, where terracotta was the link colour, so this was a pre-existing accessibility failure rather than something the redesign introduced. `#D9643A` is therefore kept strictly for the logo (brand marks are exempt) and `#B04D2A` does the work anywhere the colour carries text. Sage was likewise nudged from the specified `#6B7A63` (4.17:1, just short) to `#63715B` (4.73:1) — visually near-identical, and it passes.

**Discipline.** Keep the large areas calm (plaster / stone / white) so sage reads as considered and terracotta as a spark, not the whole room. Do not drift back toward cream + terracotta + high-contrast-serif everywhere — that is the generic AI look this palette exists to avoid.

Every pairing in use is verified at WCAG AA or better in both themes; dark-mode equivalents are in §9.

### 2.2 Typography
Three faces, each with a clear job — the split between logo/UI font and editorial headline font is deliberate, not an inconsistency.

- **Editorial headlines** (hero, post titles, H1–H3 in content): **Playfair Display**, bold — elegant, high-contrast serif. Self-hosted as a variable font (`400 700`, latin subset, 37.5 KB).
- **Logo, nav, buttons, H4, utility/meta** (dates, captions, tags): **Space Grotesk** — geometric, architectural. Keeps the UI chrome distinct from editorial content.
- **Body copy:** **Lora**, ~400–500 — humanist serif. Pairs with Playfair since both are serif at different registers (display-serif headline, text-serif body).
- Type scale: base 18px body (readability on mobile is critical for Pinterest traffic), h1 ~2.75rem, h2 ~2rem, h3 ~1.5rem. Line-height 1.6+ on body copy.

All fonts are self-hosted in `assets/fonts/` — no Google Fonts CDN call, which keeps the request count and the privacy story clean.

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

### 2.6 Logo & Brand Assets

Mark: an open roofline with a pin-dot accent at the peak and an asymmetric grounding baseline. Wordmark: "home" in ink + "iliora" in terracotta, Space Grotesk Bold.

**As built.** The header lockup is *not* an image file. The mark is an inlined SVG painting with `currentColor` and the colour presets, and the wordmark is real HTML text in Space Grotesk — so it stays crisp at any size, adapts to light and dark on its own, and is selectable and translatable. See §9 for why an `<img>`-referenced SVG could not do this.

Existing file: `assets/images/logo-stacked.svg` (stacked mark, kept as a brand asset; no longer used in the header).

Planned, **not yet created** — these were listed as existing in an earlier draft of this spec but no `/assets/brand/` directory exists:
- `logo-horizontal.svg` — superseded by the inlined header lockup
- `logo-icon.svg` — favicon / app icon (favicon currently generated from the mark via WP site icon)
- `logo-mono-white.svg` / `logo-mono-dark.svg` — watermark stamps for photo overlays
- `pin-template.svg` — 1000×1500 reusable Pinterest pin layout with fixed branding bar
- `board-cover-*.svg` — one per launch micro-niche, for Pinterest board thumbnails

### 2.7 Image Sourcing — AI-Generated (Decided)

**Tool:** Midjourney (best for photorealistic interiors/architectural proportions) or Adobe Firefly (commercially safe licensing, integrates with Photoshop for touch-ups). Ideogram is a fallback option if AI-generated graphics/text are also needed for pin templates.

**Standard prompt template** — reuse this every time, changing only the room/subject, so all images share consistent visual DNA:

```
[room/subject], interior photography style, warm neutral palette with 
terracotta and sage green accents, natural window light, minimalist 
Scandinavian-meets-cozy styling, shot on 35mm lens, shallow depth of 
field, editorial home decor magazine quality, no text, no watermark
```

**Workflow:**
1. Generate at the highest resolution the tool allows.
2. Crop/generate toward the pin template's vertical ratio (2:3, ~1000×1500px) where possible.
3. Run a consistent color-grading pass (Lightroom/Photoshop preset, or a Photopea filter) across all images so the site reads as one cohesive brand rather than assembled from random sources.
4. Compress before upload (TinyPNG or similar) — directly affects Core Web Vitals (see Section 6).

**Disclosure rule (important — content-writing constraint, not just a technical note):**
- AI images are fine, unrestricted, for **inspiration/roundup posts** ("15 Small Balcony Ideas," "Boho Nursery Looks We Love") — no reasonable reader assumes these are photos of the site owner's actual home.
- AI images must **NOT** be used, or must carry a clear disclosure, on any post phrased as a first-person real project reveal ("Our Guest Bedroom Makeover," "How I Transformed My Balcony") — using an AI image there without disclosure misrepresents it as a real photo of a real project, which is both a trust issue with readers and a live area of FTC scrutiny for content marketing.
- When drafting posts, check the title framing against this rule before assigning an AI image vs. requiring a real photo.

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

**As built (2026-08-15)** — implemented as standard WordPress categories, two of them hierarchical:

| Parent | Children |
|---|---|
| *(flat, the original niches)* | Small-Space Living · Rental-Friendly DIY · Nursery & Kids Rooms · Balcony & Outdoor Nooks |
| **Home Decor** | Bathroom · Bedroom · Dining Room · Entryway · Garage · Hallway · Home Office · Kids' Room · Kitchen · Living Room · Mudroom & Laundry · Playroom |
| **Styles** | Coastal · Cottage · Farmhouse · French Country · Mid Century · Modern · Rustic · Spanish Revival · Traditional · Transitional |

Nesting the 22 new terms under two parents keeps the category list navigable and gives each dropdown a real parent archive. Recreate them on any other install with `wp eval-file dev/create-nav-categories.php` (idempotent).

### 3.2 Navigation
- **Primary nav (header):** sticky bar — logo left, links right: **Home · Ideas ▾ · Home Decor ▾ · Styles ▾ · About · Contact · ♥ Saved**, plus the theme toggle and search. Three dropdowns list their category archives. Collapses to a mobile overlay menu.
- **Footer nav:** Home · About · Contact · Privacy Policy.

> Six top-level items is close to the ceiling. The bar needs ~820px, and below that WordPress's overlay menu carries it — adding another top-level item means raising that threshold again (see §9).

### 3.3 Pages
- **Homepage** — moodboard grid of latest/featured posts across all micro-niches, brief intro, category nav.
- **Micro-niche archive pages** — one per niche, same moodboard grid filtered to that niche, with a short intro paragraph (helps establish topical relevance).
- **Single post template** — see 3.4.
- **About** — short, human, builds trust (helps with ad network approval too).
- **Privacy Policy / Cookie Policy / Disclosure** — required for AdSense and affiliate disclosure compliance. Use a compliance plugin to generate, don't hand-write legal text.
- **Contact**

### 3.4 Single Post Template
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

## 6.5 Professionalism & Polish Features

These are the elements that separate a site that "looks like a real publication" from a generic blog template. Grouped by what they buy you, with a flag on anything that needs input from the site owner rather than being purely a build decision. Items already built are marked ✅ — see §9 for detail.

### A. Trust signals (also matters for ad-network approval)
- **About page** — real, specific, not generic "I'm passionate about home decor" copy.
  🔲 **NEEDS FROM YOU:** who's behind the site (name/persona, even if a pen name), a short bio angle (why this niche, what makes the POV credible), and a photo or illustrated avatar to use.
- Author byline + small avatar on every post. ✅ built (placeholder persona)
  🔲 **NEEDS FROM YOU:** the author name/persona and avatar image (can reuse the About page one).
- Visible "last updated" date on posts. ✅ built
- On-brand custom 404 page. ✅ built
- Comment section, lightly moderated. ✅ built (native WP comments, held for approval)

### B. Navigation & structure
- Top nav limited to the launch micro-niches. ✅ built — now three dropdowns (Ideas, Home Decor, Styles); see the ceiling note in §3.2.
- Breadcrumbs on posts (Home > Niche > Post Title). ✅ built (self-contained, not Rank Math)
- Site search tuned to prioritize post titles/niche tags. ✅ header search built; tuning not done
- Related-posts block at the end of every post. ✅ built

### C. Content polish
- "Quick answer" callout box near the top of longer posts. ✅ built as a pattern
- "Shop this look" / product-link block, styled consistently even before affiliate links are live. ✅ built
  🔲 **NEEDS FROM YOU (later, per post):** actual product links/affiliate IDs once you're ready to monetize that way.
- **Image source: AI-generated** (decided). Used for inspiration/mood-board style posts — NOT for posts phrased as "our"/"my" real project reveals. See §2.7 for the full workflow, prompt template, and disclosure rule.
- Pinterest "Pin It" hover button on every content image. ✅ built (lightweight script, no social-share plugin suite)

### D. Technical polish (mostly invisible, reads as "professional")
- Fast load time — single biggest lever. Partly done; the performance pass is still open (§9).
- Favicon + browser tab title format. ✅ built (site icon from the mark)
- Open Graph tags for clean link previews everywhere, not just Pinterest. ✅ built as a theme fallback that defers to Rank Math once its wizard runs
- XML sitemap + clean permalink structure (`/niche-slug/post-slug/`). ✅ built

### E. Email capture
- Inline newsletter signup block (after 2nd–3rd post on a page, or sidebar) — not a blocking popup. ✅ built visually, not wired to anything.
  🔲 **NEEDS FROM YOU:** which email service to use (e.g. MailerLite, ConvertKit, Brevo — MailerLite/Brevo have generous free tiers, good for a new site) so the right plugin/integration gets set up. This is the site's only owned channel independent of the Pinterest algorithm — worth setting up even before traffic is significant, so it's collecting from day one.

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

## 8. Open Questions / Checklist of Things Needed From You

Build-blocking (needed before the relevant roadmap step):
- [ ] **Hosting access** — homeiliora.com is on Hostinger but the login is unavailable, which blocks every form of publishing. Nothing can be uploaded to a domain without it.
- [ ] Author/site persona name + bio angle + photo or avatar (About page, byline).
- [ ] Email service provider for newsletter signup — e.g. MailerLite, ConvertKit, Brevo.
- [x] Final list of launch micro-niches — resolved: 4 original niches plus the Home Decor and Styles trees (§3.1).

Not build-blocking, decide later:
- [ ] Whether to use a custom post type for structured "idea" posts vs. standard posts + taxonomy.
- [ ] Affiliate program(s) for "shop this look" links, once ready to monetize that way.
- [ ] Caching plugin choice — depends on the host (LiteSpeed Cache is installed on the assumption of LiteSpeed hosting).

---

## 9. Build Status — as of 2026-08-15

**Theme:** `moodboard` (custom FSE block theme, active). Brand: **homeiliora**. Local dev at http://localhost:8080.

Done:
- [x] Step 1 — Block theme scaffold: `theme.json` with the (logo-matched) palette, Space Grotesk + Lora self-hosted fonts, spacing scale.
- [x] Step 2 — Homepage: sticky header + navbar, hero band, ad banner, moodboard masonry grid, footer. (The stick sits on WordPress's template-part wrapper, not on `.site-header`. The wrapper is exactly as tall as the header, and a sticky child can only travel inside its parent's box — so styling `.site-header` alone made it stick for zero pixels and scroll away. Fixed 2026-07-27; verified on 5 templates × 5 widths.)
- [x] Step 3 — Single post template (niche tag, title, dek, meta + "Save this idea", capped hero image, in-content-ready, related grid).
- [x] Step 4 — Micro-niche archive template (reuses the moodboard loop) + search + 404 + page templates.
- [x] Step 5 — About, Contact, Privacy Policy pages (Privacy designated in WP settings).
- [x] Step 6 — Ad-slot placeholder blocks: `moodboard/ad-banner` (below hero) + `moodboard/ad-slot` (below post). Reserved fixed heights to avoid CLS. Insert real code once a network is approved.
- [x] Navigation: primary (Home · Ideas ▾ · About · Contact) + footer nav.
- [x] Brand lockup, horizontal (2026-07-27): mark beside wordmark rather than stacked above it. Wordmark went 12px → 24px **and** the header shrank 120px → 70px, which matters now that it is sticky. The mark is inlined SVG (`currentColor` + colour presets) and the wordmark is real text in Space Grotesk — so it is crisp at any size, adapts to both themes with no second asset, and is selectable. Previously an `<img>`-referenced SVG, which is an isolated document: it could not reach the page's `@font-face` rules (the wordmark was silently falling back to Arial, not the brand font) or its custom properties. One knob, `--md-mark-h`, scales the whole lockup; the wordmark's rule is positioned from it so both rules stay on one line. Three size bands keep the header a single row from 360px up — 600–700px is tightest, where core has swapped back to the full nav but the nav still needs ~640px.
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
- [x] Site-wide left + right sticky skyscraper rails (160x600) — injected globally via `wp_footer` (`moodboard_ad_rails()` in functions.php), so they appear on EVERY page incl. 404. Each rail is centred in the gutter beside the content column rather than pinned to the viewport edge, so clearance grows with the screen and can never creep over the text. Two standard IAB widths, since ad markup is a fixed size: 120x600 from ≥1200px, stepping up to 160x600 from ≥1620px. Fixed position = no CLS.

To make that possible on ordinary laptops, the **wide column caps at `min(1200px, 100vw - 320px)`** — a single override of WordPress's `--wp--style--global--wide-size`, which drives every alignwide block. From 1520px up it changes nothing; below that the column gives back exactly the width the rails need (e.g. 960px at a 1280px viewport) and no more. The 720px reading column is untouched at every width, so body copy never narrows — only alignwide blocks (chiefly the banner ad slot, which still clears a 728x90 at the narrowest setting). Verified 1152→2560px on home and single: clearance never below 20px, no overlap, no horizontal scroll.

(Previously ≥1560px with a 160px unit pinned at left:24px. That missed every laptop below 1560px — including the very common 1536px and 1366px viewports — which is why the rails only appeared when the page was zoomed out; and at exactly 1560px the rail overlapped the column by 4px.)
- [x] "Saved" bookmarks — client-side (localStorage, key `homeiliora_saved_v1`, no account). Nav "♥ Saved" tab with live count badge; "+ Save / ✓ Saved" button on every card; "Save this idea" toggle on posts; `/saved/` page (id 42) that lists saved items as moodboard cards with Remove. JS: `assets/js/bookmarks.js`. Disambiguated from the Pinterest "Pin it" hover button.

Dark mode (added 2026-07-27):
- [x] Light/dark theming with a header toggle beside the search icon. **The site always starts light** (changed 2026-08-15); dark is strictly opt-in, stored in localStorage (`homeiliora_theme_v1`) and remembered per browser. The OS preference is deliberately not consulted — following it meant anyone on a dark-themed machine landed on the dark site without asking. Removing the media query also meant fixing the toggle's own "which theme is showing" check, which consulted the OS and would otherwise have reported dark on a dark machine while the page was light.
- [x] No flash of light on load — a tiny inline script in `wp_head` (`moodboard_theme_no_flash_script`) applies the stored choice before first paint.
- [x] Implemented by re-pointing the `--wp--preset--color--*` variables in `assets/css/dark.css`, so theme.json presets, block markup and `main.css` all follow from one place. dark.css contains no layout or component rules — if it fails to load the site is exactly as it was.
- [x] Dark palette is warm charcoal, not neutral grey; accents are lifted because the originals were chosen against warm plaster — sage `#63715B`→`#9DB394`, terracotta `#D9643A`→`#E4764C`, emerald `#3F5D42`→`#86A98A`, gold `#C9A860`→`#D9BC7A`. Both terracottas resolve to the lifted shade in dark, since the deep variant exists only to pass contrast on light plaster and goes muddy on a dark ground. Every text pairing verified at WCAG AA or better (lowest is 5.8:1).
- [x] The brand lockup needs no dark asset: its mark is an inlined SVG painting with `currentColor` and the colour presets, so it follows the theme on its own. (It briefly shipped as a second `logo-stacked-dark.svg` swapped by CSS; the horizontal lockup below made that unnecessary and the file was removed.)
- [x] The footer stays a dark band in both themes (it is painted with the very presets dark mode flips, so its colours are pinned to their own tokens).

Nav expansion + sage/Playfair redesign (2026-08-15):
- [x] **Home Decor** and **Styles** dropdowns added, backed by real category trees (§3.1). All 22 archives verified returning 200.
- [x] The header row was capped at 720px on every screen — a plain group inside the constrained layout inherits `contentSize`, not `wideSize`, so the nav was stuck at 420px wide even on a 1920px display. It had simply been narrow enough never to matter. Marked `alignwide`; the bar now fits one row from 1000px up.
- [x] Core swaps its hamburger for the horizontal bar at exactly 600px, but the fuller bar needs ~820px, so it wrapped to two rows across 600–816px. Core's two mobile rules are re-asserted over that gap. **Raise the 819px bound if another top-level item is added.**
- [x] **Palette moved to sage-led** (§2.1). Sage is the working accent; terracotta is reserved for the logo and text-bearing CTAs, in two shades because the brand hex fails AA on plaster.
- [x] **Headlines moved to Playfair Display** (§2.2), self-hosted as a variable font. Space Grotesk keeps the logo, nav, buttons, H4 and meta.
- [x] Niche tags are links, so they took the theme link colour and ignored the colour set on their `post-terms` wrapper — invisible while links and tags were both terracotta, obvious once links went sage. Fixed with `color: inherit` on the tag links.

Docs (2026-08-15):
- [x] This file is the merge of two divergent specs. A second copy (`PROJECT (1).md`) carried §2.6, §2.7 and §6.5 but had **no build status at all** and described a sage + Playfair site that did not exist; this file had the full build record but the older terracotta/Space Grotesk design. Both were folded together and the design direction from the newer draft was actually implemented rather than just documented.

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
