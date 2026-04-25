<?php 
/* 
Template Name: Trending
*/
get_header(); ?>
<div class="content">
<?php get_template_part("template-parts/header/index"); ?>
<?php get_template_part("template-parts/menu/index"); ?>
<?php get_template_part("template-parts/custom/copylink"); ?>
<div class="main">
	<div class="main-container">
		<?php 
		if (have_posts()):
		while (have_posts()): the_post(); 
		?>
		<div class="trending-wrapper">
			<?php 
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
			}elseif (wp_is_mobile()) {
			}else{
				echo '
					<div class="trending-header">
						<h1>' . get_the_title() .'</h1>
					</div>';
			}
			?>
			<div class="trending-content">
				<div class="trending-box">
					<div class="trending-menu">
						<?php trending_menu(); ?>
					</div>
					<div class="trending-article">
						<div class="widget list">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		endwhile;
		endif; ?>
	</div>
</div>
<?php get_template_part("template-parts/custom/share"); ?>
</div>
<?php get_footer(); ?>