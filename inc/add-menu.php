<?php 
function desktop_menu(){
  $args = array(
    'theme_location'  => 'desktop_menu', // ID menu yang akan dipanggil
    'menu'            => 'Menu Utama (Desktop)', // Judul menu di saat pengaturan menu
    'container'       => 'nav', // tipe tag pembuka dari sebuah menu
    'container_class' => '', // class dari tag pembuka
    'container_id'    => '', // id dari tag pembuka
    'menu_class'      => 'widget LinkList', // class dari menu (ul)
    'menu_id'         => '', // id dari menu (ul)
    'echo'            => true, // pengaturan menu (tampil isinya true dan tidak tampil isinya false)
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '', // tag pembuka sebelum link menu (dalam html)
    'after'           => '', // tag penutup sesudah link menu (dalam html)
    'link_before'     => '', // html / tulisan sebelum teks link
    'link_after'      => '', // html / tulisan sesudah teks link
    'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>', // pengaturan widget menu di dalam ul
    'depth'           => 0,
    'walker'          => '', // merujuk ke fungsi walker baru
  );
  wp_nav_menu($args);
}
function mobile_menu(){
  $args = array(
    'theme_location'  => 'mobile_menu', // ID menu yang akan dipanggil
    'menu'            => 'Menu Utama (Mobile)', // Judul menu di saat pengaturan menu
    'container'       => 'nav', // tipe tag pembuka dari sebuah menu
    'container_class' => '', // class dari tag pembuka
    'container_id'    => '', // id dari tag pembuka
    'menu_class'      => 'widget LinkList', // class dari menu (ul)
    'menu_id'         => '', // id dari menu (ul)
    'echo'            => true, // pengaturan menu (tampil isinya true dan tidak tampil isinya false)
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '', // tag pembuka sebelum link menu (dalam html)
    'after'           => '', // tag penutup sesudah link menu (dalam html)
    'link_before'     => '', // html / tulisan sebelum teks link
    'link_after'      => '', // html / tulisan sesudah teks link
    'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>', // pengaturan widget menu di dalam ul
    'depth'           => 0,
    'walker'          => '', // merujuk ke fungsi walker baru
  );
  wp_nav_menu($args);
}
function header_submenu1(){
  $args = array(
    'theme_location'  => 'header_submenu1', // ID menu yang akan dipanggil
    'menu'            => 'Sub Menu Kiri', // Judul menu di saat pengaturan menu
    'container'       => 'nav', // tipe tag pembuka dari sebuah menu
    'container_class' => '', // class dari tag pembuka
    'container_id'    => '', // id dari tag pembuka
    'menu_class'      => 'widget LinkList', // class dari menu (ul)
    'menu_id'         => '', // id dari menu (ul)
    'echo'            => true, // pengaturan menu (tampil isinya true dan tidak tampil isinya false)
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '', // tag pembuka sebelum link menu (dalam html)
    'after'           => '', // tag penutup sesudah link menu (dalam html)
    'link_before'     => '', // html / tulisan sebelum teks link
    'link_after'      => '', // html / tulisan sesudah teks link
    'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>', // pengaturan widget menu di dalam ul
    'depth'           => 0,
    'walker'          => '', // merujuk ke fungsi walker baru
  );
  wp_nav_menu($args);
}
function header_submenu2(){
  $args = array(
    'theme_location'  => 'header_submenu2', // ID menu yang akan dipanggil
    'menu'            => 'Sub Menu Kanan', // Judul menu di saat pengaturan menu
    'container'       => 'nav', // tipe tag pembuka dari sebuah menu
    'container_class' => '', // class dari tag pembuka
    'container_id'    => '', // id dari tag pembuka
    'menu_class'      => 'widget LinkList', // class dari menu (ul)
    'menu_id'         => '', // id dari menu (ul)
    'echo'            => true, // pengaturan menu (tampil isinya true dan tidak tampil isinya false)
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '', // tag pembuka sebelum link menu (dalam html)
    'after'           => '', // tag penutup sesudah link menu (dalam html)
    'link_before'     => '', // html / tulisan sebelum teks link
    'link_after'      => '', // html / tulisan sesudah teks link
    'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>', // pengaturan widget menu di dalam ul
    'depth'           => 0,
    'walker'          => '', // merujuk ke fungsi walker baru
  );
  wp_nav_menu($args);
}
function trending_menu(){
  $args = array(
    'theme_location'  => 'trending_menu', // ID menu yang akan dipanggil
    'menu'            => 'Trending Menu', // Judul menu di saat pengaturan menu
    'container'       => 'nav', // tipe tag pembuka dari sebuah menu
    'container_class' => '', // class dari tag pembuka
    'container_id'    => '', // id dari tag pembuka
    'menu_class'      => 'widget LinkList', // class dari menu (ul)
    'menu_id'         => '', // id dari menu (ul)
    'echo'            => true, // pengaturan menu (tampil isinya true dan tidak tampil isinya false)
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '', // tag pembuka sebelum link menu (dalam html)
    'after'           => '', // tag penutup sesudah link menu (dalam html)
    'link_before'     => '', // html / tulisan sebelum teks link
    'link_after'      => '', // html / tulisan sesudah teks link
    'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>', // pengaturan widget menu di dalam ul
    'depth'           => 0,
    'walker'          => '', // merujuk ke fungsi walker baru
  );
  wp_nav_menu($args);
}
function terkini_menu(){
  $args = array(
    'theme_location'  => 'terkini_menu', // ID menu yang akan dipanggil
    'menu'            => 'Terkini Menu', // Judul menu di saat pengaturan menu
    'container'       => 'nav', // tipe tag pembuka dari sebuah menu
    'container_class' => '', // class dari tag pembuka
    'container_id'    => '', // id dari tag pembuka
    'menu_class'      => 'widget LinkList', // class dari menu (ul)
    'menu_id'         => '', // id dari menu (ul)
    'echo'            => true, // pengaturan menu (tampil isinya true dan tidak tampil isinya false)
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '', // tag pembuka sebelum link menu (dalam html)
    'after'           => '', // tag penutup sesudah link menu (dalam html)
    'link_before'     => '', // html / tulisan sebelum teks link
    'link_after'      => '', // html / tulisan sesudah teks link
    'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>', // pengaturan widget menu di dalam ul
    'depth'           => 0,
    'walker'          => '', // merujuk ke fungsi walker baru
  );
  wp_nav_menu($args);
}
$register_menu = array(
    'desktop_menu' => 'Menu Utama (Desktop)',
    'mobile_menu' => 'Menu Utama (Mobile)',
    'header_submenu1' => 'Sub Menu Kiri',
    'header_submenu2' => 'Sub Menu Kanan',
    'trending_menu' => 'Trending Menu',
    'terkini_menu' => 'Terkini Menu',
);
register_nav_menus($register_menu);

?>