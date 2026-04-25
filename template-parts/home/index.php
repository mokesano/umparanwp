<?php 
if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
    require "home-amp.php";
}elseif (wp_is_mobile()) {
    require "home-mobile.php";
}else{
    require "home-desktop.php";
}
?>