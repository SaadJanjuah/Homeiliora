<?php
/**
 * Title: Brand Logo
 * Slug: moodboard/logo
 * Categories: header
 * Inserter: no
 *
 * Both theme variants are emitted and CSS shows one, so the right mark is
 * painted on the first frame with no JavaScript and no flash. The accessible
 * name lives on the link, and both images are alt="" — otherwise the name
 * would come and go with whichever variant happens to be displayed.
 */

$moodboard_name = get_bloginfo( 'name' );
?>
<!-- wp:image {"width":"104px","sizeSlug":"full","linkDestination":"custom","className":"brand-logo"} -->
<figure class="wp-block-image is-resized brand-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( $moodboard_name ); ?>"><img class="brand-logo__img brand-logo__img--light" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-stacked.svg' ); ?>" alt="" style="width:104px"/><img class="brand-logo__img brand-logo__img--dark" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-stacked-dark.svg' ); ?>" alt="" style="width:104px"/></a></figure>
<!-- /wp:image -->
