<?php 
function brand_h1(){
	echo '<h1 class="brand-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">'; bloginfo( 'name' ); echo '</a></h1>';
}
function brand_p(){
	echo '<p class="brand-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">'; bloginfo( 'name' ); echo '</a></p>';
}
function brand_description($description){
	if(!empty($description)):
	echo '<p class="brand-description">' . $description . '</p>';
endif;
}

function changeLogoClass($html){
    $html = str_replace( 'custom-logo-link', 'brand-link', $html );
    $html = str_replace( 'custom-logo', 'brand-logo', $html );

    return $html;
}
add_filter( 'get_custom_logo', 'changeLogoClass' );
?>