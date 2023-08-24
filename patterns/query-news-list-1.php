<?php
/**
 * Title: News list
 * Slug: biblio/query/news/list/1
 * Categories: query
 * Keywords: biblio query news information notice list
 * Block Types: core/query
 */
?>

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:query {"queryId":165,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"grid","columnCount":1}} -->
<!-- wp:columns {"verticalAlignment":"center","style":{"border":{"bottom":{"color":"var:preset|color|biblio/support/text","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center" style="border-bottom-color:var(--wp--preset--color--biblio-support-text);border-bottom-width:1px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:column {"verticalAlignment":"center","width":"88px"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:88px"><!-- wp:post-date {"format":null,"isLink":true,"fontSize":"xs"} /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:post-title {"isLink":true,"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"xs"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button {"textColor":"biblio/text","style":{"spacing":{"padding":{"left":"8px","right":"8px","top":"4px","bottom":"4px"}},"border":{"width":"1px"},"color":{"background":"#ffffff00"}},"borderColor":"biblio/text","fontSize":"xs"} -->
<div class="wp-block-button has-custom-font-size has-xs-font-size"><a class="wp-block-button__link has-biblio-text-color has-text-color has-background has-border-color has-biblio-text-border-color wp-element-button" href="" style="border-width:1px;background-color:#ffffff00;padding-top:4px;padding-right:8px;padding-bottom:4px;padding-left:8px">All News →</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->