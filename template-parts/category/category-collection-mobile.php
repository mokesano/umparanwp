<?php if (have_posts()): ?>
<div class="main">
	<div class="main-container">
		<?php 
		if (is_active_sidebar('billboard_area')) :?>
			<div class="billboard">
				<?php dynamic_sidebar('billboard_area'); ?>
			</div>
		<?php endif; ?>
		<div class="archive-title">
			<h1><?php echo single_tag_title(); ?></h1>
		</div>
		<div class="widget collection">
			<div class="widget-content">
				<div class="collection-scroll">
					<div class="collection-box">
		            <?php
					while (have_posts()): the_post(); ?>
					<div class="collection-item">
						<a href="<?php echo get_permalink(); ?>">
							<div class="collection-card">
								<div class="collection-image">
									<?php echo customthumbnail($post->ID, "image_187_261"); ?>
								</div>
								<h3 class="collection-title"><?php echo get_the_title(); ?></h3>
								<div class="collection-subtitle"><?php echo timeago(); ?></div>
							</div>
						</a>
					</div>
		            <?php
		        	endwhile;
		        	?>
					</div>
					<div class="pagination">
						<div class="paginationNext">
							<?php echo get_next_posts_link("Lihat Lainnya"); ?>
						</div>
					</div>
			</div>
		</div>
	</div>
	</div>
</div>
<?php endif; ?>