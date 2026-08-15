<?php
/**
 * Emit a WordPress import file (WXR) containing just the Home Decor and
 * Styles category trees.
 *
 * Built from the live terms rather than a hard-coded list, so slugs and
 * names match this install exactly. Lets the categories be recreated on a
 * server with no WP-CLI or SSH — Tools > Import > WordPress is enough.
 */

$parents = array( 'home-decor', 'styles' );
$out     = '';

function moodboard_wxr_term( $term, $parent_slug ) {
	return "\t<wp:category>\n"
		. "\t\t<wp:term_id>" . (int) $term->term_id . "</wp:term_id>\n"
		. "\t\t<wp:category_nicename>" . htmlspecialchars( $term->slug, ENT_XML1 ) . "</wp:category_nicename>\n"
		. "\t\t<wp:category_parent>" . htmlspecialchars( $parent_slug, ENT_XML1 ) . "</wp:category_parent>\n"
		. "\t\t<wp:cat_name><![CDATA[" . $term->name . "]]></wp:cat_name>\n"
		. "\t</wp:category>\n";
}

$count = 0;
foreach ( $parents as $pslug ) {
	$parent = get_term_by( 'slug', $pslug, 'category' );
	if ( ! $parent ) {
		fwrite( STDERR, "missing parent: $pslug\n" );
		continue;
	}
	$out .= moodboard_wxr_term( $parent, '' );
	$count++;

	$children = get_terms( array(
		'taxonomy'   => 'category',
		'parent'     => $parent->term_id,
		'hide_empty' => false,
		'orderby'    => 'name',
	) );
	foreach ( $children as $child ) {
		$out .= moodboard_wxr_term( $child, $parent->slug );
		$count++;
	}
}

$home = home_url();
$xml  = '<?xml version="1.0" encoding="UTF-8" ?>' . "\n"
	. "<!-- homeiliora: Home Decor + Styles category trees only. No posts. -->\n"
	. "<!-- Import with Tools > Import > WordPress. Safe to run twice: the -->\n"
	. "<!-- importer skips categories whose slug already exists.           -->\n"
	. '<rss version="2.0"' . "\n"
	. "\txmlns:excerpt=\"http://wordpress.org/export/1.2/excerpt/\"\n"
	. "\txmlns:content=\"http://purl.org/rss/1.0/modules/content/\"\n"
	. "\txmlns:wfw=\"http://wellformedweb.org/CommentAPI/\"\n"
	. "\txmlns:dc=\"http://purl.org/dc/elements/1.1/\"\n"
	. "\txmlns:wp=\"http://wordpress.org/export/1.2/\">\n"
	. "<channel>\n"
	. "\t<title>homeiliora — nav categories</title>\n"
	. "\t<link>" . htmlspecialchars( $home, ENT_XML1 ) . "</link>\n"
	. "\t<description>Home Decor and Styles category trees</description>\n"
	. "\t<language>en-US</language>\n"
	. "\t<wp:wxr_version>1.2</wp:wxr_version>\n"
	. "\t<wp:base_site_url>" . htmlspecialchars( $home, ENT_XML1 ) . "</wp:base_site_url>\n"
	. "\t<wp:base_blog_url>" . htmlspecialchars( $home, ENT_XML1 ) . "</wp:base_blog_url>\n"
	. $out
	. "</channel>\n</rss>\n";

file_put_contents( ABSPATH . '../dev/nav-categories.wxr', $xml );
echo "wrote dev/nav-categories.wxr with $count categories\n";
