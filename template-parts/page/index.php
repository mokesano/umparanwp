<?php 
if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
    require "page-amp.php";
}elseif (wp_is_mobile()) {
    require "page-mobile.php";
}else{
    require "page-desktop.php";
}
?>