<?php
/**
 * Title: Newsletter signup (inline)
 * Slug: moodboard/newsletter
 * Categories: moodboard, cta
 * Description: A calm, inline email-capture block — not a popup. Wire the form to Fluent Forms / your email provider to make it live.
 * Keywords: newsletter, email, subscribe, signup, cta
 */
?>
<!-- wp:group {"className":"newsletter","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","right":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50"}},"border":{"radius":"4px","width":"1px"}},"borderColor":"clay","backgroundColor":"accent-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group newsletter has-border-color has-clay-border-color has-accent-soft-background-color has-background" style="border-width:1px;border-radius:4px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"var:preset|font-size|large"}}} -->
<h3 class="wp-block-heading has-text-align-center" style="font-size:var(--wp--preset--font-size--large)">Get one good idea a week</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.55"},"spacing":{"margin":{"top":"var:preset|spacing|20"}}},"textColor":"ink"} -->
<p class="has-text-align-center has-ink-color has-text-color" style="margin-top:var(--wp--preset--spacing--20);line-height:1.55">Save-worthy home-decor finds in your inbox. No spam, unsubscribe anytime.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<form class="newsletter__form" method="post" action="#" novalidate>
	<label class="screen-reader-text" for="nl-email">Your email address</label>
	<input class="newsletter__input" id="nl-email" type="email" name="email" placeholder="you@example.com" required />
	<button class="newsletter__button" type="submit">Subscribe</button>
</form>
<!-- /wp:html --></div>
<!-- /wp:group -->
