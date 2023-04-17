<?php
/**
 * Title: Single header 1
 * Slug: biblio/main/single/header/1
 * Categories: post-parts
 * inserter: false
 */
?>
<!-- wp:group {
  "tagName":"header",
  "style":{
    "spacing":{
      "blockGap":"var:preset|spacing|60"
    }
  },
  "className":"t-post-header",
  "layout":{"type":"constrained"}
} -->
<header class="wp-block-group t-post-header">

  <!-- wp:post-featured-image /-->
  <!-- wp:post-title {"level":1} /-->

  <!-- wp:group {"style":{"spacing":{"blockGap":"4px"}}} -->
  <div class="wp-block-group">

    <!-- wp:group {"style":{"spacing":{"blockGap":"4px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
    <div class="wp-block-group">
      <!-- wp:avatar {"size":16,"isLink":true,"className":"is-style-biblio-squircle"} /-->
      <!-- wp:post-author-name {"isLink":true,"style":{"typography":{"fontSize":"14px"}}} /-->
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"style":{"spacing":{"blockGap":"0.25em"}},"layout":{"type":"flex","justifyContent":"left"}} -->
    <div class="wp-block-group">
      <!-- wp:post-date {"format":"Y/m/d","className":"icon-publish-date"} /-->
      <!-- wp:post-terms {"term":"category","className":"icon-category"} /-->
    </div>
    <!-- /wp:group -->

  </div>
  <!-- /wp:group -->

</header>
<!-- /wp:group -->

