<?php 
if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
    require "sidebar-amp.php";
}elseif (wp_is_mobile()) {
    require "sidebar-mobile.php";
}else{
    require "sidebar-desktop.php";
}
?>