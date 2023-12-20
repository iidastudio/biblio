<?php
/**
 * Title: Single header 1
 * Slug: biblio/main/single/header/1
 * Categories: post-parts
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

  <!-- wp:post-featured-image {"aspectRatio":"19.5/9"} /-->
  <!-- wp:post-title {"level":1} /-->

  <!-- wp:group {"style":{"spacing":{"blockGap":"4px"}}} -->
  <div class="wp-block-group">

    <!-- wp:group {"style":{"spacing":{"blockGap":"0.25em"}},"layout":{"type":"flex","justifyContent":"left"}} -->
    <div class="wp-block-group">
      <!-- wp:post-date {"format":"Y/m/d","className":"icon-publish-date", "fontSize":"biblio-2-xs"} /-->
      <!-- wp:post-date {"displayType":"modified","format":"Y/m/d","className":"icon-modified-date", "fontSize":"biblio-2-xs"} /-->
    </div>
    <!-- /wp:group -->

  </div>
  <!-- /wp:group -->

</header>
<!-- /wp:group -->

