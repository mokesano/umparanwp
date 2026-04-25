<?php 
if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
    require "author-amp.php";
}elseif (wp_is_mobile()) {
    require "author-mobile.php";
}else{
    require "author-desktop.php";
}
?>