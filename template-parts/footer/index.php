<?php 
if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
    require "footer-amp.php";
}elseif (wp_is_mobile()) {
    require "footer-mobile.php";
}else{
    require "footer-desktop.php";
}
?>