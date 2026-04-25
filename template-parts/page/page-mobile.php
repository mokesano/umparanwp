<?php get_template_part("template-parts/custom/copylink"); ?>
<div class="main">
	<div class="main-container">
		<?php 
		if (have_posts()):
		while (have_posts()): the_post(); 
		?>
			<div class="content-box">
				<div class="article">
					<div class="article-box">
						<div class="header-post">
							<div class="title-post">
								<h1><?php the_title(); ?></h1>
							</div>
						</div>
						
						<div class="info-post">
							<div class="info-box">
								<div class="author-box">
									<div class="author-flex">
										<div class="author-avatar">
											<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
												<?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
											</a>
										</div>
										<div class="author-name-box">
											<div class="author-name-flex">
												<div class="author-name">
													<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a>
												</div>
												<i class="author-verified"></i>
											</div>
										<div class="prop-pos">
											<time class="timepost"><?php echo get_the_date( get_option('date_format') ); ?> <?php echo get_the_time( get_option('time_format') ); ?></time>
											<span class="dot"></span>
											<span class="readtime"><?php echo post_read_time(get_the_ID()); ?></span>
										</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="post-detail">
						<?php if ( true == get_theme_mod( 'featuredimageactivepage', false )) : ?>
							<?php if (has_post_thumbnail( get_the_ID() ) ): ?>
								<figure class="wp-block-image size-full">
								<?php 
								echo get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'featured-image' ) );
								$caption = get_post(get_post_thumbnail_id())->post_excerpt;
									if(!empty($caption)){ ?>
										<figcaption><?php echo $caption; ?></figcaption>
								<?php } ?>
								</figure>
							<?php endif; ?>
						<?php endif;  ?>
							<?php the_content(); ?>
						</div>
						<?php 
						comments_template();
						 ?>						
					</div>
				</div>
			</div>
		<?php
		endwhile;
		endif; ?>
	</div>
</div>
<?php get_template_part("template-parts/custom/share"); ?>