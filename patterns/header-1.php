<?php
/**
 * Title: Header 1 Simple
 * Slug: biblio/header/1
 * Categories: header
 * Keywords: header simple
 * Block Types: core/template-part/header
 */
?>

<!-- wp:group {
  "layout":{"type":"constrained"},
  "style":{
    "spacing":{
      "blockGap": "16px",
      "padding": {
        "top": "16px",
        "bottom": "16px"
      }
    }
  }
} -->
<div class="wp-block-group" style="padding-top:16px; padding-bottom:16px;">

  <!-- wp:group {
    "layout":{
      "type":"flex",
      "justifyContent":"space-between",
      "orientation":"horizontal"
    },
    "style":{
      "spacing":{
        "blockGap": "16px"
      }
    }
  } -->
  <div class="wp-block-group">

    <!-- wp:group {"className":"c-site-branding", "layout":{"type":"flex","justifyContent":"left"}, "style":{"spacing":{"blockGap":"0.5em"}}} -->
    <div class="wp-block-group c-site-branding">
      <!-- wp:site-logo {"className":"c-site-logo", "width":135 } /-->
    </div>
    <!-- /wp:group -->

    <!-- wp:navigation {
      "className":"c-nav-header is-style-biblio",
      "style": {
        "spacing": {
          "blockGap": "0 1.5rem"
        }
      }
    } /-->

  </div>
  <!-- /wp:group -->

</div>
<!-- /wp:group -->