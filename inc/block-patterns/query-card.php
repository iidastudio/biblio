<!-- wp:query {
  "query":{
    "pages":"100",
    "offset":0,
    "postType":"post",
    "categoryIds":[],
    "tagIds":[],
    "order":"desc",
    "orderBy":"date",
    "author":"",
    "search":"",
    "sticky":"",
    "exclude":[],
    "perPage":12,
    "inherit":true
  },
  "className":"bp-query-card",
  "displayLayout":{"type":"flex","columns":3}
} -->
<div class="wp-block-query bp-query-card">
  <!-- wp:post-template -->
    <!-- wp:post-featured-image {"isLink":true} /-->
    <!-- wp:post-terms {"term":"category"} /-->
    <!-- wp:post-title {"isLink":true, "style":{"spacing":{"margin":{"top":"8px"}}}} /-->

    <!-- wp:group -->
    <div class="wp-block-group">
      <!-- wp:post-author {"showAvatar":true} /-->
      <!-- wp:post-date {"className":"icon-publish-date"} /-->
    </div>
    <!-- /wp:group -->

  <!-- /wp:post-template -->
  
  <!-- wp:query-pagination -->
  <div class="wp-block-query-pagination">
    <!-- wp:query-pagination-previous /-->
    <!-- wp:query-pagination-numbers /-->
    <!-- wp:query-pagination-next /-->
  </div>
  <!-- /wp:query-pagination -->
</div>
<!-- /wp:query -->