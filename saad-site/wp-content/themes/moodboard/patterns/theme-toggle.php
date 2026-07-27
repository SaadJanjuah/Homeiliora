<?php
/**
 * Title: Theme Toggle
 * Slug: moodboard/theme-toggle
 * Categories: header
 * Inserter: no
 *
 * A pattern rather than a shortcode: shortcode-block output goes through
 * wpautop, which wraps the button in a <p> and turns every newline into a
 * <br> — both of which break the flex header. Pattern output is block markup
 * and is left alone.
 *
 * Both icons ship in the HTML and CSS reveals one (via --md-icon-*, set in
 * main.css and flipped in dark.css), so the right icon is on screen from the
 * first frame rather than being corrected once JavaScript runs.
 */
?>
<!-- wp:html -->
<button type="button" class="theme-toggle" aria-label="<?php esc_attr_e( 'Dark theme', 'moodboard' ); ?>" aria-pressed="false" title="<?php esc_attr_e( 'Switch to dark theme', 'moodboard' ); ?>">
	<span class="theme-toggle__icon theme-toggle__icon--moon" aria-hidden="true">
		<svg viewBox="0 0 24 24" focusable="false"><path d="M20 14.2A8.2 8.2 0 0 1 9.8 4 8.2 8.2 0 1 0 20 14.2Z"/></svg>
	</span>
	<span class="theme-toggle__icon theme-toggle__icon--sun" aria-hidden="true">
		<svg viewBox="0 0 24 24" focusable="false"><circle cx="12" cy="12" r="4.2"/><path d="M12 2.6v2.2M12 19.2v2.2M4.5 4.5l1.6 1.6M17.9 17.9l1.6 1.6M2.6 12h2.2M19.2 12h2.2M4.5 19.5l1.6-1.6M17.9 6.1l1.6-1.6"/></svg>
	</span>
</button>
<!-- /wp:html -->
