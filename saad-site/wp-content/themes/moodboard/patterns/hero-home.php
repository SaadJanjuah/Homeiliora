<?php
/**
 * Title: Home Hero
 * Slug: moodboard/hero-home
 * Categories: header, featured
 * Description: Photographic hero band — cross-fading room shots, left-aligned headline, dek, and an Explore Ideas call to action.
 *
 * The two photographs behind the text cross-fade. Only the second one is
 * animated: the first sits under it permanently, so there is nothing to blend
 * on the very first frame and only one layer is ever being composited.
 *
 * aria-hidden, and both alt="" — they are decoration, and the headline already
 * says everything a screen reader needs.
 *
 * Layout follows the reference: the type sits left over a gradient scrim that
 * is dense on that side and clears toward the right, so the room stays sharp
 * and visible instead of being flattened under a full-width wash.
 */

$moodboard_hero = get_template_directory_uri() . '/assets/images/hero';
?>
<!-- wp:group {"tagName":"section","align":"wide","className":"home-hero","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignwide home-hero"><!-- wp:html -->
<div class="home-hero__backdrop" aria-hidden="true">
	<img class="home-hero__slide home-hero__slide--a" src="<?php echo esc_url( $moodboard_hero . '/hero-1.jpg' ); ?>" alt="" width="1376" height="768" fetchpriority="high" decoding="async"/>
	<img class="home-hero__slide home-hero__slide--b" src="<?php echo esc_url( $moodboard_hero . '/hero-2.jpg' ); ?>" alt="" width="1376" height="768" loading="lazy" decoding="async"/>
</div>
<!-- /wp:html -->

<!-- wp:group {"className":"home-hero__content","layout":{"type":"constrained"}} -->
<div class="wp-block-group home-hero__content"><!-- wp:paragraph {"className":"home-hero__eyebrow","style":{"typography":{"fontFamily":"var:preset|font-family|display","fontSize":"var:preset|font-size|meta","textTransform":"uppercase","letterSpacing":"0.14em","fontWeight":"500"}},"textColor":"accent"} -->
<p class="home-hero__eyebrow has-accent-color has-text-color" style="font-family:var(--wp--preset--font-family--display);font-size:var(--wp--preset--font-size--meta);font-weight:500;letter-spacing:0.14em;text-transform:uppercase">The homeiliora moodboard</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"home-hero__title"} -->
<h1 class="wp-block-heading home-hero__title"><span class="home-hero__title-accent">Rooms</span> worth pinning.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"home-hero__dek"} -->
<p class="home-hero__dek">Small-space wins, rental-friendly makeovers, and cozy corners — collected like a pinboard, made to save and try at home.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"home-hero__cta"} -->
<div class="wp-block-buttons home-hero__cta"><!-- wp:button {"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" href="#ideas">Explore Ideas</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
