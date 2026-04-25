<?php get_template_part("template-parts/custom/copylink"); ?>
<div class="main">
	<div class="main-container">
		<div class="search-wrapper">
			<div class="search-header">
				<h1>Hasil Pencarian</h1>
			</div>
			<div class="search-content">
				<div class="search-box">
					<div class="search-article">
					<div class="widget list">
						<div class="widget-content">
							<div class="list-wrap">
							<?php 
						    if (have_posts()):
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
								<?php endwhile; 
							endif;?>
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
		</div>
	</div>
</div>
<?php get_template_part("template-parts/custom/share"); ?>