<?php 
if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
    require "tag-amp.php";
}elseif (wp_is_mobile()) {
    require "tag-mobile.php";
}else{
    require "tag-desktop.php";
}
?>