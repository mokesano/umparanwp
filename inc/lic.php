<?php function add_this_script_footer(){
    if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
    }else{?>
        <script async="async">
        var modlic = '<?php echo get_theme_mod( 'lic' ); ?>';
        </script>
        <?php 
    }
} 
add_action('wp_footer', 'add_this_script_footer'); ?>