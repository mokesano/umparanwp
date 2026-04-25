<?php
get_template_part("template-parts/custom/copylink"); 
$tim = get_post_meta(get_the_ID(), 'tim', true );
?>
<div class="main">
	<div class="main-container">
		<?php 
		if (is_active_sidebar('billboard_area')) :?> 
			<div class="billboard">
				<?php dynamic_sidebar('billboard_area'); ?>
			</div>
		<?php endif; ?>
		<?php 
		if (have_posts()):
		while (have_posts()): the_post(); 
		?>
			<div class="content-box">
				<div class="article">
					<div class="article-box">
						<div class="header-post">
							<div class="subheader-post">
								<div class="category-post">
								    <?php 
                                        $category = get_the_category();
                                        $useCatLink = true;
                                        // If post has a category assigned.
                                        if ($category){
                                            $category_display = '';
                                            $category_link = '';
                                            if ( class_exists('WPSEO_Primary_Term') ){
                                            // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
                                            $wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
                                            $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
                                            $term = get_term( $wpseo_primary_term );
                                            if (is_wp_error($term)) { 
                                                // Default to first category (not Yoast) if an error is returned
                                                $category_display = $category[0]->name;
                                                $category_link = get_category_link( $category[0]->term_id );
                                            } else { 
                                                // Yoast Primary category
                                                $category_display = $term->name;
                                                $category_link = get_category_link( $term->term_id );
                                            }
                                        } 
                                        else {
                                            // Default, display the first category in WP's list of assigned categories
                                            $category_display = $category[0]->name;
                                            $category_link = get_category_link( $category[0]->term_id );
                                        }
                                        // Display category
                                        if ( !empty($category_display) ){
                                            if ( $useCatLink == true && !empty($category_link) ){
                                                echo '<span class="post-category">';
                                                echo '<a href="'.$category_link.'">'.htmlspecialchars($category_display).'</a>';
                                                echo '</span>';
                                            } else {
                                                echo '<span class="post-category">'.htmlspecialchars($category_display).'</span>';
                                            }
                                        }
                                        
                                        }
                                    ?>
								</div>
							</div>
							<div class="title-post">
								<h1><?php the_title(); ?></h1>
							</div>
						</div>
						<div class="info-post">
							<div class="info-box">
								<div class="author-box">
									<div class="author-flex">
										<div class="author-avatar">
											<a aria-label="Author" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
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
								<div class="share-box">
									<div class="likecomment">
										<div class="like-box">
											<button aria-label="Like" class="like-btn <?php echo class_like(); ?>" data-id="<?php echo get_the_ID(); ?>"></button>
											<div class="like-count"><?php echo button_like(); ?></div>
										</div>
										<div class="comment-box">
											<a href="#respond" aria-label="Komentar" class="comment-btn"></a>
											<div class="comment-count"><?php echo get_comments_number(); ?></div>
										</div>
									</div>
									<div class="share-wrapper">
								<?php 
								    $shareURL = get_permalink();
								    $snip = get_the_excerpt();
								    $shareTitle = str_replace( '%', '%25', get_the_title());
								    $socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
								 ?>
								<?php  if ( true == get_theme_mod( 'tombolwhatsapp', true )) : ?>
									<a rel="noopener" href="https://api.whatsapp.com/send/?text=<?php echo $socialTitle; ?> | <?php echo $shareURL; ?>" class="share-btn whatsapp" aria-label="WhatsApp" target="_blank" rel="_nofollow"></a>
								<?php endif; ?>
								<?php  if ( true == get_theme_mod( 'tombolcopylink', true )) : ?>
									<a class="share-btn copylink" href="#" data-url="<?php echo $shareURL; ?>" aria-label="Copylink"></a>
								<?php endif; ?>
									<button aria-label="More" class="share-btn more" data-url="<?php echo $shareURL; ?>" data-title="<?php echo $socialTitle; ?>" data-title2="<?php echo $shareTitle; ?>" data-snip="<?php echo $snip; ?>"></button>
									</div>
								</div>
							</div>
						</div>
						<div class="post-detail">
						<?php if ( true == get_theme_mod( 'featuredimageactivepos', false )) : 
							if ( "" != (get_theme_mod( 'categoryfeaturedimagea' ))) :
							else:
							endif;
							$textcat = get_theme_mod( 'categoryfeaturedimagea' );
							$splittedcat = explode(",", $textcat);
							$arrcat = "'" . implode("', '", $splittedcat) ."'";
							$category_detail=get_the_category($post_id);
							$datafeaturedimage = "array(". $arrcat .")";
							$parsed = eval("return " . $datafeaturedimage . ";");
							$arrcount = count($parsed);

							$ck = 0;
							$hasil = 0;
							foreach($category_detail as $cd){
								$aprseslug = strval($cd->slug);
								for ($i=0; $i < $arrcount; $i++) { 
									$hasparse = strval($parsed[$i]);
									if($aprseslug == $hasparse){
										$ck = 1;
										break;
									}else{
										$ck = 0;
									}
								}
								if($ck == 1){
									$hasil = 1 ;
								}else{
									$hasil = "";
								}
							}
							if(empty($hasil) || $hasil == ""){
								if (has_post_thumbnail( get_the_ID() ) ): ?>
									<figure class="wp-block-image size-full">
										<div class="wp-image-box">
										<a data-fslightbox="gallery" href="<?php echo get_the_post_thumbnail_url($post_id,'full'); ?>" data-caption="<?php echo get_post(get_post_thumbnail_id())->post_excerpt ?>" data-thumb="<?php echo get_the_post_thumbnail_url($post_id,'thumbnail'); ?>">
											<?php 
											echo get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'featured-image' ) );
											$caption = get_post(get_post_thumbnail_id())->post_excerpt;
											?>
											<div class="btn-viewbox">
												<button class="btn-biew">
													<i class="icon-serch"></i>
													<span class="text-view">Perbesar</span>
												</button>
											</div>
											</a>	
										</div>
									<?php 
										if(!empty($caption)){ ?>
											<figcaption><?php echo $caption; ?></figcaption>
									<?php } ?>
									</figure>
								<?php endif;
							}
						endif;  ?>

							<?php the_content(); ?>
						</div>
						<div class="tag-post">
							<?php the_tags( '<ul><li>', '</li><li>', '</li></ul>' ); ?>
						</div>

						<?php if ( true == get_theme_mod( 'timredaksiactive', true )) : ?>
						<div class="redaksi">
							<div class="redaksi-header">
								<div class="redaksi-avatar">
									<div class="redaksi-avatar-box">
										<?php if ( true == get_theme_mod( 'timredaksipenulis', true )) : ?>
											<div class="image-ava"><?php echo get_avatar( get_the_author_meta( 'ID' ), 24 ); ?></div>
									    <?php endif;  ?>
										<?php if ( true == get_theme_mod( 'timredaksieditor', true )) : ?>
											<?php if(!empty($tim['editor']) && $tim['editor'] != "-1"): ?>
												<div class="image-ava">
													<?php echo get_avatar( $tim['editor'], 24 ); ?></div>
											<?php endif; ?>
									    <?php endif;  ?>
										<?php if ( true == get_theme_mod( 'timredaksireporter', true )) : ?>
											<?php if(!empty($tim['reporter']) && $tim['reporter'] != "-1"): ?>
												<div class="image-ava">
													<?php echo get_avatar( $tim['reporter'], 24 ); ?></div>
											<?php endif; ?>
									    <?php endif;  ?>
									</div>
								</div>
								<button class="btn-redaksi"><i class="icon-arrow"></i><span class="label-btn">
									<?php 
									if ( "" != (get_theme_mod( 'tombolredaksititle' ))) :
										echo get_theme_mod( 'tombolredaksititle' );
									else:
										echo 'Tim Redaksi';
									endif;
									?>
								</span></button>
							</div>
							<div class="redaksi-content hide">
								<div class="redaksi-content-box">
									<?php if ( true == get_theme_mod( 'timredaksipenulis', true )) : ?>
									<div class="author-item">
										<div class="author-image">
											<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
												<?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
											</a>
										</div>
											<div class="author-text">
											<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
												<div class="author-name"><?php echo get_the_author(); ?> <i class="icon-verification2"></i></div>
												<div class="author-role">Penulis</div>
											</a>
											</div>
									</div>
								    <?php endif;  ?>
									<?php if ( true == get_theme_mod( 'timredaksieditor', true )) : ?>
										<?php if(!empty($tim['editor']) && $tim['editor'] != "-1"): ?>
										<div class="author-item">
											<div class="author-image">
												<a href="<?php echo get_author_posts_url(get_the_author_meta( $tim['editor'] )); ?>">
													<?php echo get_avatar( $tim['editor'], 48 ); ?>
												</a>
											</div>
											<div class="author-text">
												<a href="<?php echo get_author_posts_url(get_the_author_meta( $tim['editor'] )); ?>">
													<div class="author-name"><?php echo get_the_author_meta('display_name', $tim['editor']); ?> <i class="icon-verification2"></i></div>
													<div class="author-role">Editor</div>
												</a>
											</div>
										</div>
										<?php endif; ?>
								    <?php endif;  ?>
									<?php if ( true == get_theme_mod( 'timredaksireporter', true )) : ?>
										<?php if(!empty($tim['reporter']) && $tim['reporter'] != "-1"): ?>
										<div class="author-item">
											<div class="author-image"><?php echo get_avatar( $tim['reporter'], 48 ); ?></div>
											<div class="author-text">
												<div class="author-name"><?php echo get_the_author_meta('display_name', $tim['reporter']); ?> <i class="icon-verification2"></i></div>
												<div class="author-role">Reporter</div>
											</div>
										</div>
										<?php endif; ?>
								    <?php endif;  ?>
								</div>
							</div>
						</div>
						<?php endif;  ?>
						<?php 
						if (is_active_sidebar('afterpos_area')) :
							dynamic_sidebar('afterpos_area');
						endif;
						comments_template();
						 ?>						
					</div>
				</div>
				<?php get_template_part("template-parts/sidebar/index"); ?>
			</div>
		<?php
		endwhile;
		endif; ?>
	</div>
</div>
<?php get_template_part("template-parts/custom/share"); ?>
<?php get_template_part("template-parts/custom/sticky-ads"); ?>