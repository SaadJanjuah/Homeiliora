<?php
/**
 * Title: Breadcrumbs
 * Slug: moodboard/breadcrumbs
 * Inserter: no
 * Description: Self-contained Home > Niche > Title breadcrumb trail for single posts (no plugin dependency).
 */

if ( ! is_singular() ) {
	return;
}

$sep = '<span class="breadcrumbs__sep" aria-hidden="true">/</span>';
$out = '<nav class="breadcrumbs" aria-label="Breadcrumb"><a href="' . esc_url( home_url( '/' ) ) . '">Home</a>';

if ( is_singular( 'post' ) ) {
	$cats = get_the_category();
	if ( ! empty( $cats ) ) {
		$c    = $cats[0];
		$out .= $sep . '<a href="' . esc_url( get_category_link( $c->term_id ) ) . '">' . esc_html( $c->name ) . '</a>';
	}
}

$out .= $sep . '<span class="breadcrumbs__current" aria-current="page">' . esc_html( get_the_title() ) . '</span></nav>';

echo $out; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built with esc_* above.
