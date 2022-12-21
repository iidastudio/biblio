<?php
/**
 * Title: Footer 2
 * Slug: biblio/footer/2
 * Categories: footer
 * Keywords: footer
 * Block Types: core/template-part/footer
 */
?>

<!-- wp:group {
  "align":"full",
  "style":{
    "spacing":{
      "padding":"16px"
    }
  },
  "layout":{
    "inherit":true,
    "type":"constrained"
  }
} -->
<div class="wp-block-group alignfull" style="padding:16px">

  <!-- wp:columns {"align":"wide"} -->
  <div class="wp-block-columns alignwide">

    <!-- wp:column {"width":"33.3%","style":{"spacing":{"blockGap":"1.5rem"}}} -->
    <div class="wp-block-column" style="flex-basis:33.3%">

      <!-- wp:site-logo {"width":121} /-->

      <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem","lineHeight":"1.5"}}} -->
      <p style="font-size:0.875rem;line-height:1.5">
      読みやすく書きやすいをコンセプトに開発したテーマです。<br>
      よりよいテーマになるようサポーターフォーラムでご意見いただけると嬉しいです。
      </p>
      <!-- /wp:paragraph -->

    </div>
    <!-- /wp:column -->

    <!-- wp:column {"width":"66.6%","style":{"spacing":{"blockGap":"1.5rem"}}} -->
    <div class="wp-block-column" style="flex-basis:66.6%">

      <!-- wp:navigation {
        "overlayMenu":"never",
        "className":"is-style-default",
        "layout":{
          "type":"flex",
          "flexWrap":"wrap",
          "orientation":"horizontal",
          "justifyContent":"right"
        },
        "style":{
          "spacing":{
            "blockGap":"2rem"
          }
        }
      } /-->

      <!-- wp:search {"label":"検索",
        "showLabel":false,
        "width":300,
        "widthUnit":"px",
        "buttonText":"検索",
        "buttonUseIcon":true,
        "align":"right"
      } /-->

    </div>
    <!-- /wp:column -->

  </div>
  <!-- /wp:columns -->

  <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"}}} -->
  <p class="has-text-align-center" style="font-size:0.875rem">
    Proudly powered by <a href="https://wordpress.org/">WordPress</a>.
  </p>
  <!-- /wp:paragraph -->

</div>
<!-- /wp:group -->