<?php
/**
 * Title: Get Inspired band
 * Slug: moodboard/get-inspired
 * Categories: featured
 * Description: Full-bleed room photograph with a centred card, heading, short pitch and a button through to the archives.
 *
 * Sits below the post grid on the homepage. The photograph is decoration, so
 * it is aria-hidden with alt="" — the card carries all the meaning.
 *
 * Unlike the hero this needs no scrim: the type sits on an opaque card, so
 * the room stays at full strength behind it.
 */

$moodboard_gi = get_template_directory_uri() . '/assets/images/hero/get-inspired.jpg';
?>
<!-- wp:group {"tagName":"section","align":"full","className":"get-inspired","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull get-inspired"><!-- wp:html -->
<div class="get-inspired__photo" aria-hidden="true">
	<img src="<?php echo esc_url( $moodboard_gi ); ?>" alt="" width="1376" height="768" loading="lazy" decoding="async"/>
</div>
<!-- /wp:html -->

<!-- wp:group {"className":"get-inspired__card","layout":{"type":"constrained"}} -->
<div class="wp-block-group get-inspired__card"><!-- wp:html -->
<span class="get-inspired__badge" aria-hidden="true">
	<!-- The compact mark, matching assets/images/mark.svg. Inline rather than
	     <img> so it can take its colours from the palette; the geometry is the
	     reduced one, because the full lockup's foliage does not read at badge
	     size. -->
	<svg viewBox="12 26 96 96" xmlns="http://www.w3.org/2000/svg" focusable="false">
		<g fill="none" stroke-linecap="round">
			<path d="M 41 88 C 37 96 42 102 38 110" stroke="var(--wp--preset--color--forest)" stroke-width="3.2"/>
			<path d="M 79 88 C 83 95 78 101 82 108" stroke="var(--wp--preset--color--accent)" stroke-width="3"/>
		</g>
		<path d="M 0 0 C 2.2 -4.4 7.7 -7.2 14.3 -4.4 C 10.5 1.1 3.9 3.9 0 0 Z" fill="var(--wp--preset--color--accent)" transform="translate(35,96) rotate(203)"/>
		<path d="M 0 0 C 2.2 -4.4 7.7 -7.2 14.3 -4.4 C 10.5 1.1 3.9 3.9 0 0 Z" fill="var(--wp--preset--color--forest)" transform="translate(85,97) rotate(-22)"/>
		<path d="M 0 0 C 1.8 -3.5 6.2 -5.8 11.4 -3.5 C 8.4 0.9 3.1 3.1 0 0 Z" fill="var(--wp--preset--color--forest)" transform="translate(43,107) rotate(-28)"/>
		<g transform="translate(78,100) scale(0.62)">
			<g fill="var(--wp--preset--color--gold)">
				<ellipse cx="0" cy="-6.4" rx="3.6" ry="5.4"/>
				<ellipse cx="0" cy="-6.4" rx="3.6" ry="5.4" transform="rotate(72)"/>
				<ellipse cx="0" cy="-6.4" rx="3.6" ry="5.4" transform="rotate(144)"/>
				<ellipse cx="0" cy="-6.4" rx="3.6" ry="5.4" transform="rotate(216)"/>
				<ellipse cx="0" cy="-6.4" rx="3.6" ry="5.4" transform="rotate(288)"/>
			</g>
			<circle r="2.7" fill="var(--wp--preset--color--gold-deep)"/>
		</g>
		<path d="M 34 78 L 60 42 L 86 78" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
		<circle cx="60" cy="41" r="6.5" fill="var(--wp--preset--color--gold)"/>
		<line x1="30" y1="88" x2="90" y2="88" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
	</svg>
</span>
<!-- /wp:html -->

<!-- wp:heading {"textAlign":"center","level":2,"className":"get-inspired__title"} -->
<h2 class="wp-block-heading has-text-align-center get-inspired__title">Get Inspired</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"get-inspired__text"} -->
<p class="has-text-align-center get-inspired__text">Practical tips, styling guides, and real room tours to help you make a space you love. No fluff — just ideas worth saving.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"get-inspired__cta","layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons get-inspired__cta"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/category/home-decor/">Browse All Ideas</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
