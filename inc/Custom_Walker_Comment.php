<?php
/**
 * comment list
 * load from comments.php wp_list_comments(array('walker' => new WalkerCommentList()));
 *
 * @package Biblio
 * @since 1.0.0
 */
namespace biblio\inc;
use Walker_Comment;

defined( 'ABSPATH' ) || exit;

class Custom_Walker_Comment extends Walker_Comment {

  protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

		$commenter          = wp_get_current_commenter();
		$show_pending_links = ! empty( $commenter['comment_author'] );

		if ( $commenter['comment_author_email'] ) {
			$moderation_note = __( 'Your comment is awaiting moderation.' );
		} else {
			$moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.' );
		}
		?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="c-comment">
				<div class="c-comment__meta">
          <figure class="c-comment__avatar">
            <?php
              if ( 0 != $args['avatar_size'] ) {
                echo get_avatar( $comment, $args['avatar_size'] );
              }
            ?>
          </figure>
          <div class="c-comment__meta-text">
            <div class="c-comment__author">
              <?php
              $comment_author = get_comment_author_link( $comment );

              if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
                $comment_author = get_comment_author( $comment );
              }

              echo $comment_author;
              ?>
            </div>

            <div class="c-comment__date">
              <?php
              printf(
                '<a href="%s"><time datetime="%s">%s</time></a>',
                esc_url( get_comment_link( $comment, $args ) ),
                get_comment_time( 'c' ),
                sprintf(
                  /* translators: 1: Comment date, 2: Comment time. */
                  __( '%1$s at %2$s' ),
                  get_comment_date( '', $comment ),
                  get_comment_time()
                )
              );
              // edit link
              edit_comment_link( __( 'Edit' ), ' <span class="c-comment__edit-link">', '</span>' );
              ?>
            </div>
          </div>
        </div>
        <?php if ( '0' == $comment->comment_approved ) : ?>
					<em class="c-comment__awaiting-moderation"><?php echo $moderation_note; ?></em>
				<?php endif; ?>

				<div class="c-comment__content">
					<?php comment_text(); ?>
				</div>

				<?php
				if ( '1' == $comment->comment_approved || $show_pending_links ) {
					comment_reply_link(
						array_merge(
							$args,
							array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<div class="c-comment__reply">',
								'after'     => '</div>',
							)
						)
					);
				}
				?>
			</article>
		<?php
	}

}