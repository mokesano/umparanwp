<?php 
function sidebar_menu() {
$args = array(
  'name'          => 'Sidebar Menu (Mobile)', 
  'id'            => 'sidebar_menu',
  'description'   => '',
  'before_widget' => '<div class="widget">',
  'after_widget'  => '</div>',
  'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
  'after_title'   => '</h2></div>',
);
register_sidebar( $args );
}
add_action( 'widgets_init', 'sidebar_menu' );

function billboard_area() {
    $args = array(
      'name'          => 'Billboard', 
      'id'            => 'billboard_area',
      'description'   => 'Menampilkan ADS Billboard ukuran 970x250px atau iklan responsif',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
      'after_title'   => '</h2></div>',

    );
register_sidebar( $args );
}
add_action( 'widgets_init', 'billboard_area' );

function homepage_area() {
    $args = array(
      'name'          => 'Beranda', 
      'id'            => 'homepage_area',
      'description'   => 'Menampilkan widget di dihalaman beranda.',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
      'after_title'   => '</h2></div>',

    );
register_sidebar( $args );
}
add_action( 'widgets_init', 'homepage_area' );

function category_area() {
    $args = array(
      'name'          => 'Kategori', 
      'id'            => 'category_area',
      'description'   => 'Menampilkan widget di dihalaman beranda.',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
      'after_title'   => '</h2></div>',

    );
register_sidebar( $args );
}
add_action( 'widgets_init', 'category_area' );

function afterpos_area() {
    $args = array(
      'name'          => 'Setelah Pos', 
      'id'            => 'afterpos_area',
      'description'   => 'Menampilkan widget di bagian bawah setelah artikel',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
      'after_title'   => '</h2></div>',

    );
register_sidebar( $args );
}
add_action( 'widgets_init', 'afterpos_area' );

function sidebar_area() {
    $args = array(
      'name'          => 'Sidebar', 
      'id'            => 'sidebar_area',
      'description'   => 'Menampilkan widget di dibagian sidebar.',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
      'after_title'   => '</h2></div>',

    );
register_sidebar( $args );
}
add_action( 'widgets_init', 'sidebar_area' );

function footer_area() {
    $args = array(
      'name'          => 'Footer', 
      'id'            => 'footer_area',
      'description'   => 'Menampilkan widget di dibagian footer dan hanya ditampilkan dalam versi desktop',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
      'after_title'   => '</h2></div>',

    );
register_sidebar( $args );
}
add_action( 'widgets_init', 'footer_area' );


function sticky_ads_left() {
    $args = array(
      'name'          => 'Iklan Sticky Kiri', 
      'id'            => 'sticky_ads_left',
      'description'   => 'Menampilkan widget ads secara sticky dibagian kiri.',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
      'after_title'   => '</h2></div>',

    );
register_sidebar( $args );
}
add_action( 'widgets_init', 'sticky_ads_left' );

function sticky_ads_right() {
    $args = array(
      'name'          => 'Iklan Sticky Kanan', 
      'id'            => 'sticky_ads_right',
      'description'   => 'Menampilkan widget ads secara sticky dibagian kiri.',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<div class="widget-header"><h2 class="widget-title">',
      'after_title'   => '</h2></div>',

    );
register_sidebar( $args );
}
add_action( 'widgets_init', 'sticky_ads_right' );

?>