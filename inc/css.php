<?php 
function addcss() { 
    $versi = '1.0.0.0.0.0.35';
    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/css/normalize.css', '', $versi );
    wp_enqueue_style( 'heebo-font', get_template_directory_uri() . '/assets/css/font.css', '', $versi );
  if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
    wp_enqueue_style( 'cssmobile', get_template_directory_uri() . '/assets/css/style-amp.css', '', $versi );
	}elseif(wp_is_mobile()) {
    wp_enqueue_style( 'cssmobile', get_template_directory_uri() . '/assets/css/style-mobile.css', '', $versi );
  }else {
    wp_enqueue_style( 'cssdesktop', get_template_directory_uri() . '/assets/css/style-desktop.css', '', $versi );
  }
}
add_action( 'wp_enqueue_scripts', 'addcss' );

function addattrcss( $html, $handle ) {
    if ('cssmobile' === $handle 
        || 'normalize' === $handle 
        || 'dashicons' === $handle 
        || 'admin-bar' === $handle 
        || 'wp-block-library' === $handle 
        || 'menu-image' === $handle 
        || 'cssdesktop' === $handle 
    ) :
        return str_replace( "media='all'", "media='all' async='async'", $html );
    endif;
    return $html;
}
add_filter( 'style_loader_tag', 'addattrcss', 10, 2 );

add_action( 'admin_enqueue_scripts', 'load_admin_styles' );
function load_admin_styles() {
    $versi = '1.0.0';
    wp_enqueue_style( 'admin_css_foo', get_template_directory_uri() . '/assets/css/admin.css', false, $versi );
}
function customcss()
{
?>
<style type="text/css" id="custom-theme-css">
:root {
<?php if(!empty(get_theme_mod( 'color1' ))):?>
  --color1: <?php echo get_theme_mod( 'color1' ); ?>;
<?php endif; ?>
<?php if(!empty(get_theme_mod( 'color2' ))):?>
  --color2: <?php echo get_theme_mod( 'color2' ); ?>;
<?php endif; ?>
<?php if(!empty(get_theme_mod( 'color3' ))):?>
  --color3: <?php echo get_theme_mod( 'color3' ); ?>;
<?php endif; ?>
<?php if(!empty(get_theme_mod( 'color4' ))):?>
  --color4: <?php echo get_theme_mod( 'color4' ); ?>;
<?php endif; ?>
<?php if(!empty(get_theme_mod( 'color5' ))):?>
  --color5: <?php echo get_theme_mod( 'color5' ); ?>;
<?php endif; ?>
<?php if(!empty(get_theme_mod( 'color6' ))):?>
  --color6: <?php echo get_theme_mod( 'color6' ); ?>;
<?php endif; ?>
<?php if(!empty(get_theme_mod( 'menu1' ))):?>
  --menu1: <?php echo get_theme_mod( 'menu1' ); ?>;
<?php endif; ?>
<?php if(!empty(get_theme_mod( 'menu2' ))):?>
  --menu2: <?php echo get_theme_mod( 'menu2' ); ?>;
<?php endif; ?>
<?php if(!empty(get_theme_mod( 'menu3' ))):?>
  --menu3: <?php echo get_theme_mod( 'menu3' ); ?>;
<?php endif; ?>
<?php if(!empty(get_theme_mod( 'menu4' ))):?>
  --menu4: <?php echo get_theme_mod( 'menu4' ); ?>;
<?php endif; ?>
<?php if(!empty(get_theme_mod( 'menu5' ))):?>
  --menu5: <?php echo get_theme_mod( 'menu5' ); ?>;
<?php endif; ?>
<?php if(!empty(get_theme_mod( 'menu6' ))):?>
  --menu6: <?php echo get_theme_mod( 'menu6' ); ?>;
<?php endif; ?>
}
</style>
<?php
}
add_action( 'wp_head', 'customcss');