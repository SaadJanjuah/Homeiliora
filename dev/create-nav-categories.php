<?php
/**
 * Create the "Home Decor" and "Styles" category trees.
 *
 * Idempotent: run it twice and nothing is duplicated. Written as PHP rather
 * than a string of wp-cli calls so the curly apostrophe in "Kids' Room" and
 * the ampersand in "Mudroom & Laundry" survive intact — passing those through
 * PowerShell to a native binary mangles them.
 */

$groups = array(
	'Home Decor' => array(
		'Bathroom', 'Bedroom', 'Dining Room', 'Entryway', 'Garage', 'Hallway',
		'Home Office', "Kids\xE2\x80\x99 Room", 'Kitchen', 'Living Room',
		'Mudroom & Laundry', 'Playroom',
	),
	'Styles' => array(
		'Coastal', 'Cottage', 'Farmhouse', 'French Country', 'Mid Century',
		'Modern', 'Rustic', 'Spanish Revival', 'Traditional', 'Transitional',
	),
);

/**
 * Return an existing category by name under a given parent, or create it.
 */
function moodboard_ensure_term( $name, $parent = 0 ) {
	$existing = get_terms( array(
		'taxonomy'   => 'category',
		'name'       => $name,
		'parent'     => $parent,
		'hide_empty' => false,
	) );
	if ( ! is_wp_error( $existing ) && ! empty( $existing ) ) {
		return array( (int) $existing[0]->term_id, 'existing' );
	}
	$made = wp_insert_term( $name, 'category', array( 'parent' => $parent ) );
	if ( is_wp_error( $made ) ) {
		return array( 0, 'ERROR: ' . $made->get_error_message() );
	}
	return array( (int) $made['term_id'], 'created' );
}

$out = array();
foreach ( $groups as $parent_name => $children ) {
	list( $parent_id, $pstate ) = moodboard_ensure_term( $parent_name );
	$out[] = sprintf( '%-22s %-9s id=%-4d %s', $parent_name, $pstate, $parent_id, get_term_link( $parent_id, 'category' ) );
	foreach ( $children as $child ) {
		list( $cid, $cstate ) = moodboard_ensure_term( $child, $parent_id );
		$out[] = sprintf( '   %-19s %-9s id=%-4d %s', $child, $cstate, $cid, get_term_link( $cid, 'category' ) );
	}
}
echo implode( "\n", $out ) . "\n";
