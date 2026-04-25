<?php 
if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
    require "custom-amp.php";
}elseif (wp_is_mobile()) {
    require "custom-mobile.php";
}else{
    require "custom-desktop.php";
}
?>