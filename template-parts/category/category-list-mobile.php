<?php if (have_posts()): ?>
<div class="main">
	<div class="main-container">
		<?php 
		if (is_active_sidebar('billboard_area')) :?>
			<div class="billboard">
				<?php dynamic_sidebar('billboard_area'); ?>
			</div>
		<?php endif; ?>
		<?php
		if (is_active_sidebar('category_area')) :
			dynamic_sidebar('category_area');
		endif;
		?>
		<div class="archive-main">
			<div class="archive-article">
				<div class="archive-box">
					<div class="widget list">
						<div class="widget-header">
							<div class="widget-header-box">
								<div class="widget-title">
									<h2>Feed</h2>
								</div>
							</div>
						</div>
						<div class="widget-content">
							<div class="list-wrap">
								<?php 
									while (have_posts()): the_post(); 
										$shareURL = get_permalink();
										$shareTitle = str_replace( '%', '%25', get_the_title());
										$socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
										?>
										<div class="list-item">
											<div class="list-box">
												<div class="list-content">
													<div class="list-title">
														<h3>
															<?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?>
														</h3>
														<div class="list-author">
															<?php echo get_avatar( get_the_author_meta( 'ID' ), 16 ); ?>
															<div class="list-author-name"><?php echo get_the_author(); ?></div>
															<i class="icon-verification"></i>
														</div>
													</div>
													<div class="list-more">
														<div class="list-button">
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
												<div class="list-image">
													<?php echo '<a href="' . get_permalink() . '">' . customthumbnail($post->ID, "image_80_80") . '</a>'; ?>
												</div>
											</div>
										</div>
									<?php endwhile;?>
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
			<?php get_template_part("template-parts/sidebar/index"); ?>
		</div>
	</div>
</div>
<?php endif; ?>