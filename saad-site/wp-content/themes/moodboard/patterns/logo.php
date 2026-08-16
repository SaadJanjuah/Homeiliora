<?php
/**
 * Title: Brand Logo
 * Slug: moodboard/logo
 * Categories: header
 * Inserter: no
 *
 * Horizontal lockup: the house mark with trailing vines, beside the wordmark.
 *
 * The mark is inlined rather than referenced with <img> on purpose. An SVG
 * loaded through <img> is an isolated document: it cannot see the page's
 * @font-face rules or its custom properties. Inlined, the mark reads the
 * theme's colour variables directly and the wordmark is real text in the real
 * brand font — crisp at any size, selectable and translatable.
 *
 * The foliage is deliberately irregular: four leaf shapes rather than one
 * repeated, sizes from 0.8x to 1.25x, scattered angles, clustered in places
 * and sparse in others, stems that wander and cross, plus aerial roots. Even
 * spacing and a single repeated leaf is what makes drawn plants read as
 * pattern instead of growth.
 *
 * Vine tails are cut shorter here than in the design study: the mark's height
 * drives the height of a sticky header, and the full-length version pushed it
 * past 90px. The ground rule sits at y=104 of a 168-tall viewBox, which is
 * where the 64/168 in the wordmark's margin (main.css) comes from — change one
 * and the two rules stop meeting.
 *
 * The wordmark is the link's accessible name, so no aria-label is needed.
 */

$moodboard_name = get_bloginfo( 'name' );

/*
 * The brand splits as "home" + "iliora", the second half in green.
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
		<svg class="brand-logo__mark" viewBox="0 0 182 168" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
			<defs>
				<g id="mdLeafHeart">
					<path d="M 0 0 C 4 -8 14 -13 26 -8 C 19 2 7 7 0 0 Z" fill="currentColor"/>
					<path d="M 1.5 -1 C 9 -4 17 -6.5 24 -8" fill="none" stroke="#FFF" stroke-opacity=".30" stroke-width="1.3" stroke-linecap="round"/>
				</g>
				<g id="mdLeafSplit">
					<path d="M 0 0 C 5 -10 17 -15 30 -10 L 23 -7.5 L 29 -5.5 C 28 -2.5 25.5 -0.5 22.5 1 L 17 -1 L 21 3 C 15 6.5 5 8 0 0 Z" fill="currentColor"/>
					<path d="M 1.5 -1 C 10 -4 20 -7 27 -9.5" fill="none" stroke="#FFF" stroke-opacity=".28" stroke-width="1.3" stroke-linecap="round"/>
				</g>
				<g id="mdLeafLance">
					<path d="M 0 0 C 7 -5 20 -7.5 32 -4 C 21 1 9 3.5 0 0 Z" fill="currentColor"/>
					<path d="M 2 -0.6 C 11 -2.6 22 -4.2 29 -4.2" fill="none" stroke="#FFF" stroke-opacity=".26" stroke-width="1.1" stroke-linecap="round"/>
				</g>
				<g id="mdLeafCurl">
					<path d="M 0 0 C 6 -7 15 -9.5 23 -6 C 17 -4.5 9 -1.5 0 0 Z" fill="currentColor"/>
				</g>
				<g id="mdLeafYoung">
					<path d="M 0 0 C 2.5 -4.5 8 -7.5 14 -4.5 C 10 0.5 4 3 0 0 Z" fill="currentColor"/>
				</g>
				<!-- Five-petal blossom. Brass rather than white: a pale flower
				     would vanish against the light header background. -->
				<g id="mdBloom">
					<g fill="currentColor">
						<ellipse cx="0" cy="-6.4" rx="3.6" ry="5.4"/>
						<ellipse cx="0" cy="-6.4" rx="3.6" ry="5.4" transform="rotate(72)"/>
						<ellipse cx="0" cy="-6.4" rx="3.6" ry="5.4" transform="rotate(144)"/>
						<ellipse cx="0" cy="-6.4" rx="3.6" ry="5.4" transform="rotate(216)"/>
						<ellipse cx="0" cy="-6.4" rx="3.6" ry="5.4" transform="rotate(288)"/>
					</g>
					<circle r="2.7" fill="var(--wp--preset--color--gold-deep)"/>
				</g>
				<g id="mdBud">
					<ellipse rx="3" ry="4.4" fill="currentColor"/>
				</g>
			</defs>

			<g fill="none" stroke-linecap="round">
				<path d="M 75 34 C 57 52 47 74 55 98" stroke="var(--wp--preset--color--forest)" stroke-width="4.6"/>
				<path d="M 55 98 C 62 118 47 134 56 158" stroke="var(--wp--preset--color--forest)" stroke-width="3"/>
				<path d="M 86 31 C 95 56 85 82 94 106" stroke="var(--wp--preset--color--accent)" stroke-width="5"/>
				<path d="M 94 106 C 101 130 86 148 96 166" stroke="var(--wp--preset--color--accent)" stroke-width="3.2"/>
				<path d="M 93 42 C 112 60 121 86 112 106" stroke="var(--wp--preset--color--forest)" stroke-width="4.3"/>
				<path d="M 112 106 C 105 126 117 142 109 160" stroke="var(--wp--preset--color--forest)" stroke-width="2.8"/>

				<g stroke="var(--wp--preset--color--accent)" stroke-width="1.5" stroke-opacity=".75">
					<path d="M 63 116 C 66 126 62 132 65 140"/>
					<path d="M 101 138 C 104 148 99 154 102 160"/>
				</g>

				<!-- One petiole per remaining leaf. -->
				<g stroke="var(--wp--preset--color--forest)" stroke-width="1.8">
					<path d="M 64 46 L 58 51"/><path d="M 55 92 L 49 95"/><path d="M 53 142 L 47 146"/>
				</g>
				<g stroke="var(--wp--preset--color--accent)" stroke-width="1.8">
					<path d="M 91 50 L 98 54"/><path d="M 88 78 L 82 82"/>
				</g>
				<g stroke="var(--wp--preset--color--forest)" stroke-width="1.8">
					<path d="M 105 64 L 112 67"/><path d="M 111 132 L 118 135"/>
				</g>
			</g>

			<!-- Seven leaves, not twelve. The dense version reads as a clump at
			     the 54x50px the header renders it at — the house stops being
			     legible. Thinned to keep all four leaf shapes and the scattered
			     angles, just fewer of them. The full drawing survives in
			     assets/images/logo-stacked.svg for large use. -->
			<g>
				<use href="#mdLeafSplit" color="var(--wp--preset--color--forest)" transform="translate(58,51) rotate(203) scale(1.15)"/>
				<use href="#mdLeafCurl"  color="var(--wp--preset--color--forest)" transform="translate(49,95) rotate(212) scale(1.05)"/>
				<use href="#mdLeafYoung" color="var(--wp--preset--color--forest)" transform="translate(47,146) rotate(196) scale(0.9)"/>

				<use href="#mdLeafHeart" color="var(--wp--preset--color--accent)" transform="translate(98,54) rotate(-16) scale(1.25)"/>
				<use href="#mdLeafSplit" color="var(--wp--preset--color--forest)" transform="translate(82,82) rotate(206) scale(1.05)"/>

				<use href="#mdLeafHeart" color="var(--wp--preset--color--forest)" transform="translate(112,67) rotate(-26) scale(1.1)"/>
				<use href="#mdLeafCurl"  color="var(--wp--preset--color--accent)" transform="translate(118,135) rotate(-34) scale(0.85)"/>
			</g>

			<!-- Blossoms last, so they sit on top of the foliage.
			     All below the ground rule, on the trailing stems: placed up in
			     the roof zone they crowded the house and it stopped reading as
			     a house at header size. Scattered sizes and tilts, as with the
			     leaves. -->
			<g>
				<use href="#mdBloom" color="var(--wp--preset--color--gold)" transform="translate(58,126) rotate(12) scale(1.0)"/>
				<use href="#mdBloom" color="var(--wp--preset--color--gold)" transform="translate(99,134) rotate(-18) scale(0.9)"/>
				<use href="#mdBud"   color="var(--wp--preset--color--gold)" transform="translate(94,160) rotate(-16) scale(0.82)"/>
			</g>

			<path d="M 22 90 L 82 28 L 142 90" fill="none" stroke="currentColor" stroke-width="11" stroke-linecap="round" stroke-linejoin="round"/>
			<circle cx="82" cy="26" r="10" fill="var(--wp--preset--color--gold)"/>
			<line x1="10" y1="104" x2="154" y2="104" stroke="currentColor" stroke-width="6" stroke-linecap="round"/>
		</svg>
		<span class="brand-logo__word"><?php echo esc_html( $moodboard_head ); ?><?php if ( '' !== $moodboard_tail ) : ?><span class="brand-logo__word-accent"><?php echo esc_html( $moodboard_tail ); ?></span><?php endif; ?></span>
	</a>
</div>
<!-- /wp:html -->
