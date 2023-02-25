<?php
/**
 * Title: Query card 1
 * Slug: biblio/query/card/1
 * Categories: query
 * Keywords: query card
 * Block Types: core/query
 */
?>
<!-- wp:query {
  "query":{
    "perPage":12,
    "pages":0,
    "offset":0,
    "postType":"post",
    "order":"desc",
    "orderBy":"date",
    "categoryIds":[],
    "tagIds":[],
    "author":"",
    "search":"",
    "sticky":"exclude",
    "exclude":[],
    "inherit":false
  },
  "displayLayout":{"type":"flex","columns":3}
} -->
<div class="wp-block-query">
  <!-- wp:post-template -->

    <!-- wp:group {"style":{"spacing":{"blockGap":"1rem"}}} -->
    <div class="wp-block-group">
      <!-- wp:post-featured-image {"isLink":true} /-->
      <!-- wp:post-title {"isLink":true} /-->

      <!-- wp:group {"style":{"spacing":{"blockGap":"2px"}}} -->
      <div class="wp-block-group">

        <!-- wp:group {"style":{"spacing":{"blockGap":"4px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
        <div class="wp-block-group">
          <!-- wp:avatar {"size":20,"isLink":true,"className":"is-style-biblio-squircle"} /-->
          <!-- wp:post-author-name {"isLink":true,"style":{"typography":{"fontSize":"14px"}}} /-->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"style":{"spacing":{"blockGap":"0.25em"}}, "layout":{"type":"flex","justifyContent":"left"} } -->
        <div class="wp-block-group">
          <!-- wp:post-date {"format":"Y/m/d", "className":"icon-publish-date" } /-->
          <!-- wp:post-terms {"term":"category", "className":"icon-category" } /-->
        </div>
        <!-- /wp:group -->
        
      </div>
      <!-- /wp:group -->
    </div>
    <!-- /wp:group -->

  <!-- /wp:post-template -->
  
  <!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"}} -->
    <!-- wp:query-pagination-previous /-->
    <!-- wp:query-pagination-numbers /-->
    <!-- wp:query-pagination-next /-->
  <!-- /wp:query-pagination -->
</div>
<!-- /wp:query -->