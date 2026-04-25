<?php 
if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
    require "single-amp.php";
}elseif (wp_is_mobile()) {
    require "single-mobile.php";
}else{
    require "single-desktop.php";
}
?>