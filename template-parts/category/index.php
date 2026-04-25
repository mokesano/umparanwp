<?php 
if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
    require "category-amp.php";
}elseif (wp_is_mobile()) {
    require "category-mobile.php";
}else{
    require "category-desktop.php";
}
?>