<?php 
if ( post_password_required() ) {
    return;
}
comment_form();
?>
<div id="comments" class="commentsArea">
<?php
if ( have_comments() ) :
?>
<h2 class="comments_title">
    <?php
        $comments_number = get_comments_number();
        if ( '1' === $comments_number ) {
            printf(
                _nx(
                '%1$s Komentar',
                '%1$s Komentar',
                $comments_number,
                'comments title'
            ),
            number_format_i18n( $comments_number ),
            get_the_title()
        );
        } else {
            printf(
                _nx(
                '%1$s Komentar',
                '%1$s Komentar',
                $comments_number,
                'comments title'
            ),
            number_format_i18n( $comments_number ),
            get_the_title()
        );
    }
    ?>
</h2>
<ol>
    <?php 
    wp_list_comments( array(
        'avatar_size' => 32,
        'short_ping'  => true,
        'walker'      => new Themes_Comment_Walker(),
    ));
    ?>
</ol>
<div class="comments-pagination">
    <div class="endLoadMore"><div class="iconCheck"></div><div class="labelCheck">Sudah ditampilkan semua</div></div>
</div>
<?php
endif;
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php _e( 'Comments are closed.'); ?></p>
    <?php
    endif;
?>
</div>