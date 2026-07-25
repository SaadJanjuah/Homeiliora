<?php
/**
 * Moodboard theme functions.
 *
 * @package Moodboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'moodboard_setup' ) ) {
	/**
	 * Theme supports.
	 */
	function moodboard_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
		add_theme_support( 'wp-block-styles' );
		add_editor_style( 'assets/css/main.css' );
	}
}
add_action( 'after_setup_theme', 'moodboard_setup' );

/**
 * Front-end styles. theme.json handles design tokens; this layers on
 * the masonry grid, card interactions, and texture that JSON can't express.
 */
function moodboard_enqueue_assets() {
	$main = get_theme_file_path( 'assets/css/main.css' );
	wp_enqueue_style(
		'moodboard-main',
		get_theme_file_uri( 'assets/css/main.css' ),
		array(),
		file_exists( $main ) ? (string) filemtime( $main ) : '0.1.0'
	);

	// Pinterest "Save" hover button on images.
	$pin = get_theme_file_path( 'assets/js/pinit.js' );
	wp_enqueue_script(
		'moodboard-pinit',
		get_theme_file_uri( 'assets/js/pinit.js' ),
		array(),
		file_exists( $pin ) ? (string) filemtime( $pin ) : '0.1.0',
		true
	);

	// Client-side bookmarks ("Saved").
	$bm = get_theme_file_path( 'assets/js/bookmarks.js' );
	wp_enqueue_script(
		'moodboard-bookmarks',
		get_theme_file_uri( 'assets/js/bookmarks.js' ),
		array(),
		file_exists( $bm ) ? (string) filemtime( $bm ) : '0.1.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'moodboard_enqueue_assets' );

/**
 * Site-wide left + right sticky ad rails.
 * Output in the footer so they appear on EVERY front-end page automatically,
 * without editing each template. CSS reveals them only on screens wide enough
 * to hold a 160x600 unit outside the 1200px content column (no overlap, no CLS).
 */
function moodboard_ad_rails() {
	if ( is_admin() || is_embed() ) {
		return;
	}
	$rail = '<aside class="ad-rail ad-rail--%1$s" aria-label="Advertisement"><div class="ad-slot ad-slot--rail"><span class="ad-slot__label">Advertisement</span></div></aside>';
	printf( $rail, 'left' );  // phpcs:ignore WordPress.Security.EscapeOutput -- static markup.
	printf( $rail, 'right' ); // phpcs:ignore WordPress.Security.EscapeOutput -- static markup.
}
add_action( 'wp_footer', 'moodboard_ad_rails' );

/**
 * Register the theme's block pattern categories so patterns file under
 * friendly headings in the inserter.
 */
function moodboard_register_pattern_categories() {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'moodboard',
			array( 'label' => __( 'Moodboard', 'moodboard' ) )
		);
	}
}
add_action( 'init', 'moodboard_register_pattern_categories' );

/**
 * Open Graph / Twitter / Rich-Pin meta — so shared links look good everywhere,
 * not just on Pinterest. This is a FALLBACK: the moment the Rank Math setup
 * wizard is completed, Rank Math takes over social meta and this bails out,
 * so there are never duplicate tags.
 */
function moodboard_social_meta() {
	if ( class_exists( '\RankMath\Helper' ) && \RankMath\Helper::is_configured() ) {
		return; // Rank Math is configured — let it own social meta.
	}

	$site = get_bloginfo( 'name' );
	$is_single = is_singular();
	$title = $is_single ? get_the_title() : wp_get_document_title();
	$url   = $is_single ? get_permalink() : home_url( add_query_arg( array() ) );

	if ( $is_single && has_excerpt() ) {
		$desc = get_the_excerpt();
	} else {
		$desc = get_bloginfo( 'description' );
	}
	$desc = wp_trim_words( wp_strip_all_tags( (string) $desc ), 40, '…' );

	// Prefer the featured image (vertical, pinnable); fall back to the site icon.
	$image = '';
	if ( $is_single && has_post_thumbnail() ) {
		$image = get_the_post_thumbnail_url( null, 'large' );
	} elseif ( function_exists( 'get_site_icon_url' ) && get_site_icon_url() ) {
		$image = get_site_icon_url( 512 );
	}

	$type = is_singular( 'post' ) ? 'article' : 'website';

	$tags = array(
		array( 'property', 'og:site_name', $site ),
		array( 'property', 'og:type', $type ),
		array( 'property', 'og:title', $title ),
		array( 'property', 'og:description', $desc ),
		array( 'property', 'og:url', $url ),
		array( 'name', 'twitter:card', $image ? 'summary_large_image' : 'summary' ),
		array( 'name', 'twitter:title', $title ),
		array( 'name', 'twitter:description', $desc ),
	);
	if ( $image ) {
		$tags[] = array( 'property', 'og:image', $image );
		$tags[] = array( 'name', 'twitter:image', $image );
	}
	if ( is_singular( 'post' ) ) {
		$tags[] = array( 'property', 'article:published_time', get_the_date( 'c' ) );
		$tags[] = array( 'property', 'article:modified_time', get_the_modified_date( 'c' ) );
	}

	echo "\n";
	foreach ( $tags as $t ) {
		if ( '' === (string) $t[2] ) {
			continue;
		}
		printf(
			'<meta %1$s="%2$s" content="%3$s" />' . "\n",
			esc_attr( $t[0] ),
			esc_attr( $t[1] ),
			esc_attr( $t[2] )
		);
	}
	// Canonical (Rank Math removed core's; restore it here while RM is unconfigured).
	if ( $url ) {
		printf( '<link rel="canonical" href="%s" />' . "\n", esc_url( $url ) );
	}
}
add_action( 'wp_head', 'moodboard_social_meta', 5 );

/**
 * Rough reading-time estimate, exposed for future single-post meta.
 *
 * @param int $post_id Post ID (defaults to current).
 * @return int Minutes to read (minimum 1).
 */
function moodboard_reading_time( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$content = get_post_field( 'post_content', $post_id );
	$words   = str_word_count( wp_strip_all_tags( (string) $content ) );
	return max( 1, (int) ceil( $words / 220 ) );
}
