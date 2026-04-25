<?php
remove_filter('comment_text', 'make_clickable', 9);
add_filter('pre_comment_content', 'strip_comment_links');

function strip_comment_links($content) {

    global $allowedtags;
    $tags = $allowedtags;
    unset($tags['a']);
    $content = addslashes(wp_kses(stripslashes($content), $tags));

    return $content;
}
add_filter(
    'wpum_get_comments_for_profile',
    function ( $args ) {
        $args['number'] = 1;
        return $args;
    }
);
add_filter( 'comment_form_fields', 'mo_comment_fields_custom_order' );
function mo_comment_fields_custom_order( $fields ) {
    global $commenter;
    global $aria_req;
    global $html5;
    global $html_req;
    $comment_field = $fields['comment'];
    $author_field = $fields['author'];
    $email_field = $fields['email'];
    $url_field = $fields['url'];
    unset( $fields['comment'] );
    unset( $fields['author'] );
    unset( $fields['email'] );
    unset( $fields['url'] );
    // the order of fields is the order below, change it as needed:
$fields = [
        'author' => '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . '  placeholder="Tulis nama... *"/>',
        'email'  => '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . '  placeholder="Tulis email... *"/>',
        'comment' => '<textarea id="comment" name="comment" cols="45" rows="3" maxlength="65525" aria-required="true" required="required" placeholder="Tulis komentar... *"></textarea>',
    ];
    return $fields;
}
class Themes_Comment_Walker extends Walker_Comment {
protected function html5_comment( $comment, $depth, $args ) {
?>
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
        <div class="commentBox">
            <div class="commentAvatar">
                <?php if ( 0 != $args['avatar_size'] ): ?>
                <a href="<?php echo get_comment_author_url(); ?>" class="commentAvatarLink"><?php echo get_avatar( $comment, $args['avatar_size'] ); ?></a>
                <?php endif; ?>
            </div>
            <div class="commentBody">
                <div class="commentAuthorName">
                    <?php printf( '%s', get_comment_author_link() ); ?>
                </div>
                <div class="commentBodyText">
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="commentBodyModeration"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
                    <?php endif; ?>
                    <?php 
                        if( $comment->comment_parent ) :
                        ?>
                            <span class="commentReplyTo">
                            <?php            
                            comment_author( $comment->comment_parent );
                            ?>
                            </span>
                        <?php            
                        endif;
                    ?>
                    <?php comment_text(); ?>
                </div>
                <div class="commentBodyFooter">
                            <time datetime="<?php comment_time( 'c' ); ?>">
                                <?php printf( _x( '%s yang lalu', '%s = human-readable time difference'), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ) ?>
                            </time>
                            <?php edit_comment_link( __( 'Edit' ), '', '' ); ?>
                        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
            </div>
        </div>
    </li>
<?php
}   
}
?>