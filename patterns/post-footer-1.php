<?php
/**
 * Title: Single footer
 * Slug: biblio/main/single/footer/1
 * Categories: post-parts
 * inserter: false
 */
?>
<!-- wp:group {
  "tagName":"footer",
  "style":{
    "spacing":{
      "blockGap":"var:preset|spacing|90"
    }
  },
  "className":"t-post-footer",
  "layout":{"type":"constrained"}
} -->
<footer class="wp-block-group t-post-footer">

  <!-- wp:group {"layout":{"type":"constrained"}} -->
  <div class="wp-block-group">
    <!-- wp:columns {"style":{"spacing":{"blockGap":"1rem"}}} -->
    <div class="wp-block-columns">
      <!-- wp:column -->
      <div class="wp-block-column">
        <!-- wp:post-navigation-link {"label":"前へ","textAlign":"left","type":"previous","showTitle":true,"linkLabel":true,"arrow":"arrow","className":"is-style-biblio-simple"} /-->
      </div>
      <!-- /wp:column -->    
      <!-- wp:column -->
      <div class="wp-block-column">
        <!-- wp:post-navigation-link {"label":"次へ","textAlign":"right","showTitle":true,"linkLabel":true,"arrow":"arrow","className":"is-style-biblio-simple"} /-->
      </div>
      <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
  </div>
  <!-- /wp:group -->

  <!-- wp:comments -->
  <div class="wp-block-comments">
    
    <!-- wp:comments-title /-->
    <!-- wp:comment-template -->

      <!-- wp:group {"style":{"spacing":{"blockGap":"14px"}}} -->
      <div class="wp-block-group">

        <!-- wp:group {"style":{"spacing":{"blockGap":"0.5em"}},"layout":{"type":"flex"}} -->
        <div class="wp-block-group">
          <!-- wp:avatar {"size":32,"className":"is-style-biblio-squircle"} /-->

          <!-- wp:group {"layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"margin":{"top":"0px","bottom":"0px"},"blockGap":"0.2em"}}} -->
          <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px">
            <!-- wp:comment-author-name {"style":{"typography":{"fontSize":"14px"}}} /-->
            
            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"},"style":{"spacing":{"blockGap":"0.2em"}}} -->
            <div class="wp-block-group">
              <!-- wp:comment-date {"format":"Y/m/d"} /-->
              <!-- wp:comment-edit-link /-->
            </div>
            <!-- /wp:group -->
          </div>
          <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

        <!-- wp:group {"style":{"spacing":{"blockGap":"0.2em"}}} -->
        <div class="wp-block-group">
          <!-- wp:comment-content /-->
        <!-- wp:comment-reply-link {"textAlign":"right"} /-->
        </div>
        <!-- /wp:group -->
      </div>
      <!-- /wp:group -->

    <!-- /wp:comment-template -->
    
    <!-- wp:comments-pagination -->
      <!-- wp:comments-pagination-previous /-->
      <!-- wp:comments-pagination-numbers /-->
      <!-- wp:comments-pagination-next /-->
    <!-- /wp:comments-pagination -->
    
    <!-- wp:post-comments-form /-->
    
  </div>
  <!-- /wp:comments -->

</footer>
<!-- /wp:group -->