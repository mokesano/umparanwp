<?php get_template_part("template-parts/custom/copylink"); ?>
<div class="main">
	<div class="main-container">
		<?php 
		if (is_active_sidebar('billboard_area')) :?>
			<div class="billboard">
				<?php dynamic_sidebar('billboard_area'); ?>
			</div>
		<?php endif; ?>
		<?php
		if (is_active_sidebar('homepage_area')) :
			dynamic_sidebar('homepage_area');
		endif;
		?>
	</div>
</div>
<?php get_template_part("template-parts/custom/share"); ?>
<?php get_template_part("template-parts/custom/sticky-ads"); ?>