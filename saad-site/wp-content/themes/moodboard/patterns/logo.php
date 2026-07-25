<?php
/**
 * Title: Brand Logo
 * Slug: moodboard/logo
 * Categories: header
 * Inserter: no
 */
?>
<!-- wp:image {"width":"104px","sizeSlug":"full","linkDestination":"custom","className":"brand-logo"} -->
<figure class="wp-block-image is-resized brand-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-stacked.svg' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" style="width:104px"/></a></figure>
<!-- /wp:image -->
