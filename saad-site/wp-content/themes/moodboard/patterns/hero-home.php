<?php
/**
 * Title: Home Hero
 * Slug: moodboard/hero-home
 * Categories: header, featured
 * Description: Editorial intro band for the homepage — eyebrow, big display headline, and a short warm dek.
 *
 * The two photographs behind the text cross-fade. Only the second one is
 * animated: the first sits under it permanently, so there is nothing to blend
 * on the very first frame and only one layer is ever being composited.
 *
 * aria-hidden, and both alt="" — they are decoration, and the headline already
 * says everything a screen reader needs. A scrim over them keeps the text
 * legible; its strength is a token, since light and dark need different
 * amounts (see .home-hero in main.css).
 */

$moodboard_hero = get_template_directory_uri() . '/assets/images/hero';
?>
<!-- wp:group {"tagName":"section","align":"wide","className":"home-hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignwide home-hero" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:html -->
<div class="home-hero__backdrop" aria-hidden="true">
	<img class="home-hero__slide home-hero__slide--a" src="<?php echo esc_url( $moodboard_hero . '/hero-1.jpg' ); ?>" alt="" width="1376" height="768" fetchpriority="high" decoding="async"/>
	<img class="home-hero__slide home-hero__slide--b" src="<?php echo esc_url( $moodboard_hero . '/hero-2.jpg' ); ?>" alt="" width="1376" height="768" loading="lazy" decoding="async"/>
</div>
<!-- /wp:html -->

<!-- wp:paragraph {"align":"center","className":"home-hero__eyebrow","style":{"typography":{"fontFamily":"var:preset|font-family|display","fontSize":"var:preset|font-size|meta","textTransform":"uppercase","letterSpacing":"0.14em","fontWeight":"500"}},"textColor":"accent"} -->
<p class="has-text-align-center home-hero__eyebrow has-accent-color has-text-color" style="font-family:var(--wp--preset--font-family--display);font-size:var(--wp--preset--font-size--meta);font-weight:500;letter-spacing:0.14em;text-transform:uppercase">The homeiliora moodboard</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"var:preset|font-size|display","lineHeight":"1.05"},"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
<h1 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--20);font-size:var(--wp--preset--font-size--display);line-height:1.05">Rooms worth pinning.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"var:preset|font-size|large","lineHeight":"1.5"},"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"textColor":"muted"} -->
<p class="has-text-align-center has-muted-color has-text-color" style="margin-top:var(--wp--preset--spacing--30);font-size:var(--wp--preset--font-size--large);line-height:1.5">Small-space wins, rental-friendly makeovers, and cozy corners — collected like a pinboard, made to save and try at home.</p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->
