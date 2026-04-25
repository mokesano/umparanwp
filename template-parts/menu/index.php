<?php 
if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
    require "menu-amp.php";
}elseif (wp_is_mobile()) {
    require "menu-mobile.php";
}
?>