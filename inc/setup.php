<?php 
if ( ! function_exists( 'setup' ) ) :
    function setup() {
        load_theme_textdomain( 'web' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'custom-logo', array(
            'height'      => 50,
            'width'       => 288,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'brand-title', 'brand-description' ),
        ) );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'image_322_238', 322, 238, array( 'center', 'center' ));
        add_image_size( 'image_272_153', 272, 153, array( 'center', 'center' ));
        add_image_size( 'image_640_360', 640, 360, array( 'center', 'center' ));
        add_image_size( 'image_140_196', 140, 196, array( 'center', 'center' ));
        add_image_size( 'image_187_261', 187, 261, array( 'center', 'center' ));
        add_image_size( 'image_320_451', 320, 451, array( 'center', 'center' ));
        add_image_size( 'image_80_80', 80, 80, array( 'center', 'center' ));
        add_image_size( 'image_192_108', 192, 108, array( 'center', 'center' ));
        add_image_size( 'image_320_180', 320, 180, array( 'center', 'center' ));

        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style', ) );
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat', ) );
        add_theme_support( 'editor-styles' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'customize-selective-refresh-widgets' );
    }
endif;
add_action( 'after_setup_theme', 'setup' );
?>