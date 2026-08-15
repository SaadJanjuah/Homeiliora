<?php
/**
 * Title: Brand Logo
 * Slug: moodboard/logo
 * Categories: header
 * Inserter: no
 *
 * A horizontal lockup for the nav bar: the mark sits beside the wordmark
 * rather than above it, which reads far better at header size and keeps the
 * (now sticky) header short.
 *
 * The mark is inlined rather than referenced with <img> on purpose. An SVG
 * loaded through <img> is an isolated document: it cannot see the page's
 * @font-face rules or its custom properties. That is why the old stacked
 * logo's wordmark fell back to Arial instead of Space Grotesk, and why it
 * needed a whole second file just to change colour in dark mode. Inlined,
 * the mark reads the theme's colour variables directly and the wordmark is
 * real text in the real brand font — so it stays crisp at any size, adapts
 * to both themes on its own, and is selectable and translatable.
 *
 * The wordmark is the link's accessible name, so no aria-label is needed.
 */

$moodboard_name = get_bloginfo( 'name' );

/*
 * The brand splits as "home" + "iliora", the second half in terracotta.
 * Guarded so a renamed site degrades to a plain wordmark rather than a
 * nonsense split.
 */
$moodboard_split = 4;
$moodboard_head  = $moodboard_name;
$moodboard_tail  = '';
if ( function_exists( 'mb_strlen' ) && mb_strlen( $moodboard_name ) > $moodboard_split ) {
	$moodboard_head = mb_substr( $moodboard_name, 0, $moodboard_split );
	$moodboard_tail = mb_substr( $moodboard_name, $moodboard_split );
}
?>
<!-- wp:html -->
<div class="brand-logo">
	<a class="brand-logo__link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<svg class="brand-logo__mark" viewBox="0 0 160 112" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
			<path d="M 22 90 L 80 28 L 138 90" fill="none" stroke="currentColor" stroke-width="11" stroke-linecap="round" stroke-linejoin="round"/>
			<circle cx="80" cy="26" r="10" fill="var(--wp--preset--color--terracotta)"/>
			<line x1="10" y1="104" x2="150" y2="104" stroke="var(--wp--preset--color--forest)" stroke-width="6" stroke-linecap="round"/>
		</svg>
		<span class="brand-logo__word"><?php echo esc_html( $moodboard_head ); ?><?php if ( '' !== $moodboard_tail ) : ?><span class="brand-logo__word-accent"><?php echo esc_html( $moodboard_tail ); ?></span><?php endif; ?></span>
	</a>
</div>
<!-- /wp:html -->
