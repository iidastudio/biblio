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
	"queryId":0,
	"query":{
	"perPage":12,
	"pages":0,
	"offset":0,
	"postType":"post",
	"order":"desc",
	"orderBy":"date",
	"author":"",
	"search":"",
	"sticky":"exclude",
	"exclude":[],
	"inherit":false
	},
	"align":"wide"
} -->
<div class="wp-block-query alignwide">

	<!-- wp:group {
	"style":{
		"spacing":{
		"blockGap":"var:preset|spacing|80"
		}
	},
	"layout":{"type":"default"}
	} -->
	<div class="wp-block-group">

	<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->

		<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"19.5/9"} /-->
		<!-- wp:post-title {"isLink":true,"fontSize":"biblio-lg"} /-->

		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group">

			<!-- wp:group {"style":{"spacing":{"blockGap":"0.25em"}},"layout":{"type":"flex","justifyContent":"left"}} -->
			<div class="wp-block-group">
			<!-- wp:post-date {"format":"Y/m/d","className":"icon-publish-date","fontSize":"biblio-2xs"} /-->
			<!-- wp:post-date {"displayType":"modified","format":"Y/m/d","className":"icon-modified-date","fontSize":"biblio-2xs"} /-->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"style":{"spacing":{"blockGap":"0.25em"}},"layout":{"type":"flex","justifyContent":"left"}} -->
			<div class="wp-block-group">
			<!-- wp:post-terms {"term":"category","className":"icon-category"} /-->
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
	<!-- /wp:group -->
  
</div>
<!-- /wp:query -->