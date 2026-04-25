<?php 
if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
    require "search-amp.php";
}elseif (wp_is_mobile()) {
    require "search-mobile.php";
}else{
    require "search-desktop.php";
}
?>