<?php if (have_posts()): ?>
<div class="main">
	<div class="main-container">
		<?php 
		if (is_active_sidebar('billboard_area')) :?>
			<div class="billboard">
				<?php dynamic_sidebar('billboard_area'); ?>
			</div>
		<?php endif; ?>
		<div class="widget archive-grid">
			<div class="widget-header">
				<div class="widget-header-box">
					<div class="widget-title">
						<h1><?php echo single_tag_title(); ?></h1>
					</div>
				</div>
			</div>
			<div class="widget-content">
				<div class="archive-grid-box">
				<?php 
				while (have_posts()): the_post(); 
					$shareURL = get_permalink();
					$shareTitle = str_replace( '%', '%25', get_the_title());
					$socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
					?>
					<div class="archive-grid-item">
						<div class="archive-grid-wrap">
							<div class="archive-grid-content">
								<div class="archive-grid-image">
									<?php echo '<a href="' . get_permalink() . '">' . customthumbnail($post->ID, "image_320_180") . '</a>'; ?>				
								</div>
								<div class="archive-grid-title">
									<h3>
										<?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?>
									</h3>
									<div class="archive-grid-author">
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 16 ); ?>								<div class="archive-grid-author-name"><?php echo get_the_author(); ?></div>
										<i class="icon-verification"></i>
									</div>
								</div>
								<div class="archive-grid-more">
									<div class="archive-grid-button">
										<button class="btn-like <?php echo class_like(); ?>" data-id="<?php echo get_the_ID(); ?>">
											<i class="icon-like"></i>
											<span class="like-counter"><?php echo button_like(); ?></span>
										</button>
										<a href="<?php echo get_permalink() . '#respond'; ?>" class="btn-comment">
											<i class="icon-comment"></i>
											<span class="comment-counter"><?php echo get_comments_number(); ?></span>
										</a>
										<time class="timeago"><?php echo timeago(); ?></time>
									</div>
									<button aria-label="More" class="icon-share" data-url="<?php echo $shareURL; ?>" data-title="<?php echo $socialTitle; ?>" data-title2="<?php echo $shareTitle; ?>" data-snip="<?php echo $snip; ?>"></button>
								</div>
							</div>
						</div>
					</div>
						<?php endwhile; ?>
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
<?php endif; ?>