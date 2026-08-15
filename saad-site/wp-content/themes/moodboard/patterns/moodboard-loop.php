<?php
/**
 * Title: Moodboard Loop (main query)
 * Slug: moodboard/moodboard-loop
 * Categories: query, posts
 * Description: The moodboard masonry grid bound to the main query — for the blog index, category/niche archives, and search results.
 * Inserter: no
 * Block Types: core/query
 */
?>
<!-- wp:query {"queryId":0,"query":{"perPage":12,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":true},"className":"moodboard-query","layout":{"type":"default"},"anchor":"ideas"} -->
<div id="ideas" class="wp-block-query moodboard-query"><!-- wp:post-template {"className":"moodboard-grid","layout":{"type":"default"}} -->
<!-- wp:group {"className":"moodboard-card","style":{"spacing":{"blockGap":"0"}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group moodboard-card has-surface-background-color has-background"><!-- wp:post-featured-image {"isLink":true,"className":"moodboard-card__image"} /-->

<!-- wp:group {"className":"moodboard-card__body","style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group moodboard-card__body" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)"><!-- wp:post-terms {"term":"category","className":"moodboard-card__niche","style":{"typography":{"fontFamily":"var:preset|font-family|display","fontSize":"var:preset|font-size|meta","textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"500"}},"textColor":"terracotta-deep"} /-->

<!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontSize":"var:preset|font-size|large","lineHeight":"1.2"},"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} /-->

<!-- wp:post-excerpt {"moreText":"","showMoreOnNewLine":false,"excerptLength":18,"className":"moodboard-card__excerpt","style":{"typography":{"fontSize":"var:preset|font-size|small","lineHeight":"1.55"},"spacing":{"margin":{"top":"var:preset|spacing|20"}}},"textColor":"muted"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}}} -->
<p class="has-text-align-center" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">No ideas here yet — new inspiration is on the way.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"center"},"style":{"typography":{"fontFamily":"var:preset|font-family|display","fontSize":"var:preset|font-size|small"}}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:group --></div>
<!-- /wp:query -->
