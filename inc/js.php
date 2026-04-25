<?php 
function addscript() {
        $versi = '1.0.0.67';
        if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
        wp_deregister_script('jquery');
        }else{
        wp_enqueue_script('jquery', get_stylesheet_directory_uri() . '/assets/js/jquery-3.6.0.min.js',  array(), $versi, true );
        wp_enqueue_script('darkmode', get_stylesheet_directory_uri() . '/assets/js/darkmode.js',  array(), $versi, true );
        if (wp_is_mobile()):
            wp_enqueue_script('js-mobile', get_stylesheet_directory_uri() . '/assets/js/js-mobile.js',  array(), $versi, true );
        else:
            wp_enqueue_script('js-desktop', get_stylesheet_directory_uri() . '/assets/js/js-desktop.js',  array(), $versi, true );
        endif;
        if(is_author()) :
            wp_enqueue_script('jsauthor', get_stylesheet_directory_uri() . '/assets/js/js-author.js',  array(), $versi, true );
        endif;
        if(is_category()) :
            wp_enqueue_script('jscategory', get_stylesheet_directory_uri() . '/assets/js/js-category.js',  array(), $versi, true );
            wp_enqueue_script('jsbootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js',  array(), $versi, true );
            wp_enqueue_script('jspopper', get_stylesheet_directory_uri() . '/assets/js/popper.min.js',  array(), $versi, true );
        endif;
        if(is_home()) :
            wp_enqueue_script('jshome', get_stylesheet_directory_uri() . '/assets/js/js-home.js',  array(), $versi, true );
            wp_enqueue_script('jsbootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js',  array(), $versi, true );
            wp_enqueue_script('jspopper', get_stylesheet_directory_uri() . '/assets/js/popper.min.js',  array(), $versi, true );
        endif;
        if(is_page()) :
            wp_enqueue_script('jspage', get_stylesheet_directory_uri() . '/assets/js/js-page.js',  array(), $versi, true );
        endif;
        if(is_page_template('trending.php')) :
            wp_enqueue_script('jstrending', get_stylesheet_directory_uri() . '/assets/js/js-trending.js',  array(), $versi, true );
        endif;
        if(is_page_template('terkini.php')) :
            wp_enqueue_script('jsterkini', get_stylesheet_directory_uri() . '/assets/js/js-terkini.js',  array(), $versi, true );
        endif;
        if(is_search()) :
            wp_enqueue_script('jssearch', get_stylesheet_directory_uri() . '/assets/js/js-search.js',  array(), $versi, true );
        endif;
        if(is_single()) :
            wp_enqueue_script('fslightbox', get_stylesheet_directory_uri() . '/assets/js/fslightbox.js',  array(), $versi, true );
            wp_enqueue_script('jssingle', get_stylesheet_directory_uri() . '/assets/js/js-single.js',  array(), $versi, true );
        endif;
        if(is_tag()) :
            wp_enqueue_script('jstag', get_stylesheet_directory_uri() . '/assets/js/js-tag.js',  array(), $versi, true );
        endif;
    }
}
add_action( 'wp_enqueue_scripts', 'addscript' );

function addattrscript( $tag, $handle, $src ) {
    if (
    'hoverintent-js' === $handle 
    ||'admin-bar' === $handle 
    ||'wp-embed' === $handle 
    ||'js-mobile' === $handle 
    ||'js-desktop' === $handle 
    ||'jsauthor' === $handle 
    ||'jscategory' === $handle 
    ||'jshome' === $handle 
    ||'jspage' === $handle 
    ||'jstrending' === $handle 
    ||'jsterkini' === $handle 
    ||'jssearch' === $handle 
    ||'jssingle' === $handle 
    ||'jstag' === $handle 
    ||'jsbootstrap' === $handle 
    ||'jspopper' === $handle 
    ):
    $tag = str_replace( "src=", "async='async' src=", $tag );
    endif;
    return $tag;
}
add_filter( 'script_loader_tag', 'addattrscript', 10, 3 );
function comments_reply() {
    if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
        wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
    }
}
add_action(  'wp_enqueue_scripts', 'comments_reply' );
?>