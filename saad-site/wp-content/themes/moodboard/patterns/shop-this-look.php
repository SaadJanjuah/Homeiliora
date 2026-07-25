<?php
/**
 * Title: Shop this look
 * Slug: moodboard/shop-this-look
 * Categories: moodboard
 * Description: A consistent "shop this look" product row — three product cards with image, name, and a link. Swap in real (affiliate) links later.
 * Keywords: shop, products, affiliate, buy, look
 */
$img = esc_url( get_template_directory_uri() . '/assets/images/mark.svg' );
?>
<!-- wp:group {"className":"shop-look","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group shop-look" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:heading {"level":3,"className":"shop-look__title","style":{"typography":{"fontSize":"var:preset|font-size|large"}}} -->
<h3 class="wp-block-heading shop-look__title" style="font-size:var(--wp--preset--font-size--large)">Shop this look</h3>
<!-- /wp:heading -->

<!-- wp:columns {"className":"shop-look__grid","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} -->
<div class="wp-block-columns shop-look__grid" style="margin-top:var(--wp--preset--spacing--30)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"product-card","style":{"border":{"radius":"4px","width":"1px"}},"borderColor":"stone","backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group product-card has-border-color has-stone-border-color has-surface-background-color has-background" style="border-width:1px;border-radius:4px"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"product-card__img"} -->
<figure class="wp-block-image size-full product-card__img"><a href="#"><img src="<?php echo $img; ?>" alt="Product one"/></a></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"product-card__name","style":{"spacing":{"padding":{"left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"typography":{"fontFamily":"var:preset|font-family|display","fontWeight":"500"}}} -->
<p class="product-card__name" style="padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30);font-family:var(--wp--preset--font-family--display);font-weight:500">Product name</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"product-card__link","style":{"spacing":{"padding":{"left":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"typography":{"fontFamily":"var:preset|font-family|display","fontSize":"var:preset|font-size|meta","textTransform":"uppercase","letterSpacing":"0.06em"}},"textColor":"accent"} -->
<p class="product-card__link has-accent-color has-text-color" style="padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30);font-family:var(--wp--preset--font-family--display);font-size:var(--wp--preset--font-size--meta);letter-spacing:0.06em;text-transform:uppercase"><a href="#">View →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"product-card","style":{"border":{"radius":"4px","width":"1px"}},"borderColor":"stone","backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group product-card has-border-color has-stone-border-color has-surface-background-color has-background" style="border-width:1px;border-radius:4px"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"product-card__img"} -->
<figure class="wp-block-image size-full product-card__img"><a href="#"><img src="<?php echo $img; ?>" alt="Product two"/></a></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"product-card__name","style":{"spacing":{"padding":{"left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"typography":{"fontFamily":"var:preset|font-family|display","fontWeight":"500"}}} -->
<p class="product-card__name" style="padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30);font-family:var(--wp--preset--font-family--display);font-weight:500">Product name</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"product-card__link","style":{"spacing":{"padding":{"left":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"typography":{"fontFamily":"var:preset|font-family|display","fontSize":"var:preset|font-size|meta","textTransform":"uppercase","letterSpacing":"0.06em"}},"textColor":"accent"} -->
<p class="product-card__link has-accent-color has-text-color" style="padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30);font-family:var(--wp--preset--font-family--display);font-size:var(--wp--preset--font-size--meta);letter-spacing:0.06em;text-transform:uppercase"><a href="#">View →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"product-card","style":{"border":{"radius":"4px","width":"1px"}},"borderColor":"stone","backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group product-card has-border-color has-stone-border-color has-surface-background-color has-background" style="border-width:1px;border-radius:4px"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"product-card__img"} -->
<figure class="wp-block-image size-full product-card__img"><a href="#"><img src="<?php echo $img; ?>" alt="Product three"/></a></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"product-card__name","style":{"spacing":{"padding":{"left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"typography":{"fontFamily":"var:preset|font-family|display","fontWeight":"500"}}} -->
<p class="product-card__name" style="padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30);font-family:var(--wp--preset--font-family--display);font-weight:500">Product name</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"product-card__link","style":{"spacing":{"padding":{"left":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"typography":{"fontFamily":"var:preset|font-family|display","fontSize":"var:preset|font-size|meta","textTransform":"uppercase","letterSpacing":"0.06em"}},"textColor":"accent"} -->
<p class="product-card__link has-accent-color has-text-color" style="padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30);font-family:var(--wp--preset--font-family--display);font-size:var(--wp--preset--font-size--meta);letter-spacing:0.06em;text-transform:uppercase"><a href="#">View →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph {"className":"shop-look__disclosure","style":{"typography":{"fontSize":"var:preset|font-size|meta","fontStyle":"italic"},"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"textColor":"muted"} -->
<p class="shop-look__disclosure has-muted-color has-text-color" style="margin-top:var(--wp--preset--spacing--30);font-size:var(--wp--preset--font-size--meta);font-style:italic">Some links may be affiliate links — we may earn a small commission at no cost to you.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
