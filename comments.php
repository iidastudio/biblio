<?php
/**
 * for comments list and form 
 *
 * @package Biblio
 * @since 1.0.0
 */
use biblio\inc\Custom_Walker_Comment;
use biblio\functions;

$comments_num = get_comments_number();
?>
<aside id="comments" class="c-comments">
  <h2 class="c-comments__title">
    <?php esc_html_e( 'Comments' ); ?>
    <?php if ( $comments_num ) : ?>
      <span class="c-comments__num">(<?php echo esc_html( $comments_num ); ?>)</span>
    <?php endif; ?>
  </h2>
  <div class="c-comments__body">
    <?php if ( have_comments() ) : ?>
      <ul class="c-comments__list">
        <?php
        // comments list. load from Custom_Walker_Comment.php
          wp_list_comments(array(
            'walker'      => new Custom_Walker_Comment(),
            'avatar_size' => 64,
            'format'      => 'html5'
          )); 
        ?>
      </ul>
    <?php else : ?>
      <p class="c-comments__none">
        <?php esc_html_e( 'No comments to show.'); ?>
      </p>
    <?php endif; ?>
    <?php if ( get_comment_pages_count() > 1 ) : ?>
      <nav class="pagination" role="navigation">
        <?php
          paginate_comments_links(array(
            'mid_size'  => 1,
          ));
        ?>
      </nav>
    <?php endif; ?>
    <div class="c-comments__form c-comment-form">
    <?php
      // comment form
      $commenter = wp_get_current_commenter();
      $req = get_option( 'require_name_email' );
      $aria_req = ( $req ? " aria-required='true'" : '' );
      comment_form(array(
        // 'title_reply' => __('Leave a Reply'),
        'label_submit' => __('Submit'),
        // 'comment_notes_before' => '<p class="comment-notes">'. __('Your email address will not be published.'). '</p>',
        // 'comment_notes_after'  => '',
        'title_reply_before' => '<h3 class="comment-reply-title icon-comment">',
        'title_reply_after'  => '</h3>',
        // 'comment_field'      => '<p class="comment-form-comment">'.
        //                           '<label for="comment">'. _x( 'Comment', 'noun' ). '</label>'.
        //                           '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>'.
        //                         '</p>',
        // 'fields'             => apply_filters( 'comment_form_default_fields', array(
        //                           'author' => '<p class="comment-form-author">'.
        //                                         '<label for="author">'. __( 'Name' ).( $req ? '<span class="required">*</span>' : '' ). '</label> '.
        //                                         '<input id="author" name="author" type="text" value="'. esc_attr( $commenter['comment_author'] ). '" size="30"' . $aria_req . ' />'.
        //                                       '</p>',
        //                           'email'  => '<p class="comment-form-email">'.
        //                                         '<label for="email">'. __( 'Email' ).( $req ? '<span class="required">*</span>' : '' ). '</label> '.
        //                                         '<input id="email" name="email" type="text" value="'. esc_attr(  $commenter['comment_author_email'] ). '" size="30"' . $aria_req . ' />'.
        //                                       '</p>',
        //                           'url'    => '<p class="comment-form-url">'.
        //                                         '<label for="url">'. __( 'Website' ). '</label>'.
        //                                         '<input id="url" name="url" type="text" value="'. esc_attr( $commenter['comment_author_url'] ). '" size="30" />'.
        //                                       '</p>'
        //                         )),
      ));
    ?>
    </div>
  </div>
</aside>
