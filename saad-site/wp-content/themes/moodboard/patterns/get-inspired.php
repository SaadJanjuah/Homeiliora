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
	<svg viewBox="0 0 160 112" xmlns="http://www.w3.org/2000/svg" focusable="false">
		<path d="M 22 90 L 80 28 L 138 90" fill="none" stroke="currentColor" stroke-width="11" stroke-linecap="round" stroke-linejoin="round"/>
		<circle cx="80" cy="26" r="10" fill="var(--wp--preset--color--terracotta)"/>
		<line x1="10" y1="104" x2="150" y2="104" stroke="var(--wp--preset--color--forest)" stroke-width="6" stroke-linecap="round"/>
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
