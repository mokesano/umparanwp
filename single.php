<?php 
postViews(get_the_ID());
get_header(); ?>
<div class="content">
	<?php get_template_part("template-parts/header/index"); ?>
    <?php get_template_part("template-parts/menu/index"); ?>
	<?php get_template_part("template-parts/single/index"); ?>
</div>
<?php get_footer(); ?>