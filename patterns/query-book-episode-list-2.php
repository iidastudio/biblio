<?php
/**
 * Title: Episode list
 * Slug: biblio/query/book/episode/list/2
 * Categories: book-list
 * Keywords: book episode list
 * Block Types: core/query
 */
?>
<!-- wp:query {
  "query":{
    "perPage":"100",
    "pages":0,
    "offset":0,
    "postType":"writing",
    "order":"asc",
    "orderBy":"menu_order",
    "author":"",
    "search":"",
    "sticky":"",
    "exclude":[],
    "inherit":false,
    "parents":[]
  },
  "displayLayout":{
    "type":"list"
  },
  "layout":{
    "type":"default"
  }
} -->
<div class="wp-block-query">

    <!-- wp:post-template -->
    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
    <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
      <div class="wp-block-group"><!-- wp:post-title {"isLink":true,"fontSize":"md"} /-->

        <!-- wp:post-excerpt {"moreText":"","excerptLength":80,"fontSize":"xxs"} /-->
      </div>
      <!-- /wp:group -->

      <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
      <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"0.25em"}},"layout":{"type":"flex","justifyContent":"left"}} -->
        <div class="wp-block-group">
          <!-- wp:post-date {"format":"Y/m/d","className":"icon-publish-date","fontSize":"xxs"} /-->
          <!-- wp:post-date {"format":"Y/m/d","displayType":"modified","className":"icon-modified-date","fontSize":"xxs"} /-->
        </div>
        <!-- /wp:group -->
      </div>
      <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
    <!-- /wp:post-template -->

</div>
<!-- /wp:query -->