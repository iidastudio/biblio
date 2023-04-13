<?php
/**
 * Title: Query book list 1
 * Slug: biblio/query/book/list/1
 * Categories: query
 * Keywords: query book list
 * Block Types: core/query
 */
?>
<!-- wp:query {
  "query":{
    "perPage":12,
    "pages":0,
    "offset":0,
    "postType":"writing",
    "order":"desc",
    "orderBy":"date",
    "author":"",
    "search":"",
    "sticky":"exclude",
    "exclude":[],
    "inherit":false
  },
  "displayLayout":{
    "type":"flex",
    "columns":2
  },
  "align":"wide"
} -->
<div class="wp-block-query alignwide"><!-- wp:post-template -->
  <!-- wp:columns {"isStackedOnMobile":false} -->
  <div class="wp-block-columns is-not-stacked-on-mobile"><!-- wp:column {"width":"30%"} -->
    <div class="wp-block-column" style="flex-basis:30%"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/4"} /--></div>
    <!-- /wp:column -->

    <!-- wp:column {"width":"70%","layout":{"type":"constrained"}} -->
    <div class="wp-block-column" style="flex-basis:70%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
      <div class="wp-block-group"><!-- wp:post-title {"isLink":true,"fontSize":"lg"} /-->

        <!-- wp:post-excerpt {"moreText":"","excerptLength":80,"fontSize":"xxs"} /-->
      </div>
      <!-- /wp:group -->

      <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
      <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"4px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
        <div class="wp-block-group"><!-- wp:avatar {"size":20,"isLink":true,"className":"is-style-biblio-squircle"} /-->

          <!-- wp:post-author-name {"isLink":true,"style":{"typography":{"fontSize":"14px"}}} /-->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"style":{"spacing":{"blockGap":"0.25em"}},"layout":{"type":"flex","justifyContent":"left"}} -->
        <div class="wp-block-group"><!-- wp:post-date {"format":"Y/m/d","className":"icon-publish-date"} /-->

          <!-- wp:post-terms {"term":"category","className":"icon-category"} /-->
        </div>
        <!-- /wp:group -->
      </div>
      <!-- /wp:group -->
    </div>
    <!-- /wp:column -->
  </div>
  <!-- /wp:columns -->
  <!-- /wp:post-template -->

  <!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"}} -->
  <!-- wp:query-pagination-previous /-->

  <!-- wp:query-pagination-numbers /-->

  <!-- wp:query-pagination-next /-->
  <!-- /wp:query-pagination -->
</div>
<!-- /wp:query -->