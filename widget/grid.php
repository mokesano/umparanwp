<?php
function gridViewDesktop($judul,$titletrending,$titleterbaru,$category,$headline,$rentang,$jmltrending,$jmlterbaru){
	global $post;
	if(!empty($category) && $category != ""):
		$category_link = get_category_link( get_cat_ID( $category ) );

		$argsgrid = array(
			'category_name' => $headline.'+'.$category,
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page'=> 1
		);
		$argstrending = array(
			'category_name' => $category,
			'post_type' => 'post',
			'post_status' => 'publish',
			'meta_key' => 'post_views_count',
			'orderby'   => 'meta_value_num',
			'posts_per_page' => $jmltrending,
			'order' => 'DESC',
			'date_query' => array(
				array(
					'after' => $rentang,
				),
			)
		);
		$argsterbaru = array(
			'category_name' => $category,
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page'=> $jmlterbaru
		);
		$my_grid = new WP_Query( $argsgrid );
		if ( $my_grid->have_posts() ):
			?>
			<div class="widget grid">
				<?php if(!empty($judul)): ?>
					<div class="widget-header">
						<div class="widget-header-box">
							<div class="widget-title">
								<a href="<?php echo esc_url( $category_link ); ?>"><?php echo $judul; ?></a>
							</div>
							<div class="widget-more">
								<a href="<?php echo esc_url( $category_link ); ?>">Lainnya</a>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<div class="grid-flex">
					<div class="grid-1">
						<div class="headline-box">
							<?php
							while ( $my_grid->have_posts() ) {
								$my_grid->the_post();
								$shareURL = get_permalink();
								$shareTitle = str_replace( '%', '%25', get_the_title());
								$socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));?>
								<div class="headline-item">
									<div class="headline-image">
										<?php echo customthumbnail($post->ID, "image_320_451"); ?>
									</div>
									<div class="headline-content">
										<div class="headline-text">
											<div class="headline-title">
												<h3>
													<?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?>
												</h3>
												<div class="headline-author">
													<?php echo get_avatar( get_the_author_meta( 'ID' ), 16 ); ?>					    					<div class="headline-author-name"><?php echo get_the_author(); ?></div>
													<i class="icon-verification"></i>
												</div>
											</div>
											<div class="headline-more">
												<div class="headline-button">
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
								<?php 
							}
							wp_reset_postdata();
							?>
						</div>
					</div>
					<div class="grid-2">
						<div class="grid-box">
							<?php if(!empty($titletrending)): ?>
								<div class="grid-header">
									<div class="grid-header-box">
										<div class="grid-title"><?php echo $titletrending; ?></div>
									</div>
								</div>
							<?php endif; ?>
							<div class="grid-content">
								<div class="grid-scroll">
									<?php
									$my_trending = new WP_Query( $argstrending );
									if ( $my_trending->have_posts() ):
										while ( $my_trending->have_posts() ) {
											$my_trending->the_post();
											$shareURL = get_permalink();
											$shareTitle = str_replace( '%', '%25', get_the_title());
											$socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));?>
											<div class="grid-item">
												<div class="grid-item-box">
													<div class="grid-text">
														<div class="grid-title">
															<h3>
																<?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?>
															</h3>
															<div class="grid-author">
																<?php echo get_avatar( get_the_author_meta( 'ID' ), 16 ); ?>					    	<div class="grid-author-name"><?php echo get_the_author(); ?></div>
																<i class="icon-verification"></i>
															</div>
														</div>
														<div class="grid-more">
															<div class="grid-button">
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
													<div class="grid-image">
															<?php echo '<a href="' . get_permalink() . '">' . customthumbnail($post->ID, "image_80_80") . '</a>'; ?>
													</div>
												</div>
											</div>
											<?php
										}
									endif;
									wp_reset_postdata();
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="grid-3">
						<div class="grid-box">
							<?php if(!empty($titleterbaru)): ?>
								<div class="grid-header">
									<div class="grid-header-box">
										<div class="grid-title"><?php echo $titleterbaru; ?></div>
									</div>
								</div>
							<?php endif; ?>
							<div class="grid-content">
								<div class="grid-scroll">
									<?php
									$my_terbaru = new WP_Query( $argsterbaru );
									if ( $my_terbaru->have_posts() ):
										while ( $my_terbaru->have_posts() ) {
											$my_terbaru->the_post();
											$shareURL = get_permalink();
											$shareTitle = str_replace( '%', '%25', get_the_title());
											$socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));?>
											<div class="grid-item">
												<div class="grid-item-box">
													<div class="grid-text">
														<div class="grid-title">
															<h3>
																<?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?>
															</h3>
															<div class="grid-author">
																<?php echo get_avatar( get_the_author_meta( 'ID' ), 16 ); ?>					    	<div class="grid-author-name"><?php echo get_the_author(); ?></div>
																<i class="icon-verification"></i>
															</div>
														</div>
														<div class="grid-more">
															<div class="grid-button">
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
													<div class="grid-image">
														<?php echo '<a href="' . get_permalink() . '">' . customthumbnail($post->ID, "image_80_80") . '</a>'; ?>
													</div>
												</div>
											</div>
											<?php
										}
									endif;
									wp_reset_postdata();
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
			wp_reset_postdata();
		endif;
	endif;
}
function gridViewMobile($judul,$category,$jml){
	global $post;
	if(!empty($category) && $category != ""):
		$category_link = get_category_link( get_cat_ID( $category ) );
		if(is_single()):
			$args = array(
				'category_name' => $category,
    			'post_type' => 'post',
    			'post_status' => 'publish',
				'post__not_in' => array( $post->ID ),
				'posts_per_page'=> $jml
			);
		else:
			$args = array(
				'category_name' => $category,
    			'post_type' => 'post',
    			'post_status' => 'publish',
				'posts_per_page'=> $jml
			);
		endif;
		$my_query = new WP_Query( $args );
		if ( $my_query->have_posts() ):
			?>
			<div class="widget grid">
				<?php if(!empty($judul)): ?>
					<div class="widget-header">
						<div class="widget-header-box">
							<div class="widget-title">
								<a href="<?php echo esc_url( $category_link ); ?>"><?php echo $judul; ?></a>
							</div>
							<div class="widget-more">
								<a aria-label="More" href="<?php echo esc_url( $category_link ); ?>"></a>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<div class="widget-content">
					<div class="grid-wrap">
						<?php
						while ( $my_query->have_posts() ) {
							$my_query->the_post();
							$shareURL = get_permalink();
							$shareTitle = str_replace( '%', '%25', get_the_title());
							$socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
							?>
							<div class="grid-item">
								<div class="grid-box">
									<div class="grid-content">
										<div class="grid-title">
											<h3>
												<?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?>
											</h3>
											<div class="grid-author">
												<?php echo get_avatar( get_the_author_meta( 'ID' ), 16 ); ?>
												<div class="grid-author-name"><?php echo get_the_author(); ?></div>
												<i class="icon-verification"></i>
											</div>
										</div>
										<div class="grid-more">
											<div class="grid-button">
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
									<div class="grid-image">
										<?php echo '<a href="' . get_permalink() . '">' . customthumbnail($post->ID, "image_80_80") . '</a>'; ?>
									</div>
								</div>
							</div>
							<?php
						}
						wp_reset_postdata();
						?>
					</div>
					<div class="readmore">
						<div class="readmore-blok">
							<a href="<?php echo esc_url( $category_link ); ?>"><i class="icon-right-more"></i>Lihat lebih banyak</a>
						</div>
					</div>
				</div>
			</div>
			<?php 
		endif;
	endif;
}
class gridWidget extends WP_Widget {
	public function __construct() {
		$idwidget = 'grid';
		$namewidget = '✔️ Grid';
		$descwidget = 'Widget ini menampilan daftar pos berdasarkan kategori yang dipilih dan ditampilkan dalam bentuk widget grid';
		parent::__construct($idwidget, $namewidget, array('description'=> $descwidget));
	}
	public function widget( $args, $instance ) {
		if($instance['mobile'] == 'yes'){
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
				gridViewMobile($instance['title'], $instance['category'], $instance['amountmobile']);
			}elseif (wp_is_mobile()) {
				gridViewMobile($instance['title'], $instance['category'], $instance['amountmobile']);
			}
		}
		if($instance['desktop'] == 'yes'){
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
			}elseif (wp_is_mobile()) {
			}else{
				gridViewDesktop($instance['title'],$instance['titletrending'],$instance['titleterbaru'],$instance['category'],$instance['headline'],$instance['rentang'],$instance['amounttrending'],$instance['amountterbaru']);
			}
		}
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['titletrending'] ) ) {
			$instance['titletrending'] = sanitize_text_field( $new_instance['titletrending'] );
		}
		if ( ! empty( $new_instance['titleterbaru'] ) ) {
			$instance['titleterbaru'] = sanitize_text_field( $new_instance['titleterbaru'] );
		}
		if ( ! empty( $new_instance['category'] ) ) {
			$instance['category'] = sanitize_text_field( $new_instance['category'] );
		}
		if ( ! empty( $new_instance['headline'] ) ) {
			$instance['headline'] = sanitize_text_field( $new_instance['headline'] );
		}
		if ( ! empty( $new_instance['rentang'] ) ) {
			$instance['rentang'] = sanitize_text_field( $new_instance['rentang'] );
		}
		if ( ! empty( $new_instance['amounttrending'] ) ) {
			$instance['amounttrending'] = sanitize_text_field( $new_instance['amounttrending'] );
		}
		if ( ! empty( $new_instance['amountterbaru'] ) ) {
			$instance['amountterbaru'] = sanitize_text_field( $new_instance['amountterbaru'] );
		}
		if ( ! empty( $new_instance['amountmobile'] ) ) {
			$instance['amountmobile'] = sanitize_text_field( $new_instance['amountmobile'] );
		}
		$instance['desktop'] = isset( $new_instance['desktop'] ) ? 'yes' : 'no';
		$instance['mobile'] = isset( $new_instance['mobile'] ) ? 'yes' : 'no';
		return $instance;
	}
	public function form( $instance ) {
		$defaults = array(
			'title' => '',
			'category' => '-1',
			'headline' => '-1',
			'titletrending' => 'Trending di ...',
			'titleterbaru' => 'Terbaru di ...',
			'amounttrending' => '5',
			'amountterbaru' => '5',
			'amountmobile' => '3',
			'rentang' => '1 month ago',
			'desktop' => 'yes',
			'mobile' => 'yes',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		<div class="related-form-controls">
			<p class="not-widget">
				<b>PERHATIAN!!</b> Isi semua form widget ini agar widget dapat berfungsi dengan baik dan pastikan widget disisipkan dihalaman home.
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php echo 'Kategori Utama :'; ?></label>
				<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" class="widefat" style="width:100%;" required>
					<option <?php selected( $instance['category'], "-1" ); ?> value="-1">Pilih Kategori</option>
					<?php foreach(get_terms('category','parent=0&hide_empty=0') as $term) { ?>
						<option <?php selected( $instance['category'], $term->slug ); ?> value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
					<?php } ?>      
				</select>
			</p>
			<hr>
			<h3>Pengaturan Headline</h3>
			<p>
				<label for="<?php echo $this->get_field_id( 'headline' ); ?>"><?php echo 'Kategori Headline:'; ?></label>
				<select id="<?php echo $this->get_field_id('headline'); ?>" name="<?php echo $this->get_field_name('headline'); ?>" class="widefat" style="width:100%;" required>
					<option <?php selected( $instance['headline'], "-1" ); ?> value="-1">Pilih Headline</option>
					<?php foreach(get_terms('category','parent=0&hide_empty=0') as $term) { ?>
						<option <?php selected( $instance['headline'], $term->slug ); ?> value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
					<?php } ?>      
				</select>
			</p>
			<hr>
			<h3>Pengaturan Trending</h3>
			<p>
				<label for="<?php echo $this->get_field_id( 'titletrending' ); ?>"><?php echo "Judul Trending" ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'titletrending' ); ?>" name="<?php echo $this->get_field_name( 'titletrending' ); ?>" value="<?php echo $instance['titletrending']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'rentang' ); ?>"><?php echo 'Rentang :'; ?></label>
				<select id="<?php echo $this->get_field_id('rentang'); ?>" name="<?php echo $this->get_field_name('rentang'); ?>" class="widefat" style="width:100%;" required>
					<option <?php selected( $instance['rentang'], '10 years ago' ); ?> value="10 years ago">-- Pilih --</option>
					<option <?php selected( $instance['rentang'], '1 day ago' ); ?> value="1 day ago">1 Hari</option>
					<option <?php selected( $instance['rentang'], '7 day ago' ); ?> value="7 day ago">7 Hari</option>
					<option <?php selected( $instance['rentang'], '1 month ago' ); ?> value="1 month ago">1 Bulan</option>
					<option <?php selected( $instance['rentang'], '1 years ago' ); ?> value="1 years ago">1 Tahun</option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'amounttrending' ); ?>"><?php echo 'Jumlah Pos:'; ?></label>
				<input type="number" class="widefat" id="<?php echo $this->get_field_id( 'amounttrending' ); ?>" name="<?php echo $this->get_field_name( 'amounttrending' ); ?>" min="1" max="10" value="<?php echo $instance['amounttrending']; ?>" required/>
			</p>
			<hr>
			<h3>Pengaturan Terbaru</h3>
			<p>
				<label for="<?php echo $this->get_field_id( 'titleterbaru' ); ?>"><?php echo "Judul Terbaru" ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'titleterbaru' ); ?>" name="<?php echo $this->get_field_name( 'titleterbaru' ); ?>" value="<?php echo $instance['titleterbaru']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'amountterbaru' ); ?>"><?php echo 'Jumlah pos di desktop:'; ?></label>
				<input type="number" class="widefat" id="<?php echo $this->get_field_id( 'amountterbaru' ); ?>" name="<?php echo $this->get_field_name( 'amountterbaru' ); ?>" min="1" max="10" value="<?php echo $instance['amountterbaru']; ?>" required/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'amountmobile' ); ?>"><?php echo 'Jumlah pos di mobile:'; ?></label>
				<input type="number" class="widefat" id="<?php echo $this->get_field_id( 'amountmobile' ); ?>" name="<?php echo $this->get_field_name( 'amountmobile' ); ?>" min="1" max="10" value="<?php echo $instance['amountmobile']; ?>" required/>
			</p>
			<hr>
			<h3>Pengaturan Tampilan</h3>
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'desktop' ); ?>" name="<?php echo $this->get_field_name( 'desktop' ); ?>" value="yes"<?php checked( 'yes', $instance['desktop'] ); ?>>
				<label for="<?php echo $this->get_field_id( 'desktop' ); ?>">Tampilkan dalam versi desktop</label><br>

				<input type="checkbox" id="<?php echo $this->get_field_id( 'mobile' ); ?>" name="<?php echo $this->get_field_name( 'mobile' ); ?>" value="yes"<?php checked( 'yes', $instance['mobile'] ); ?>>
				<label for="<?php echo $this->get_field_id( 'mobile' ); ?>">Tampilkan dalam versi mobile</label>
			</p>
		</div>
		<?php
	}
}

function gridWidgetload() {
	register_widget( 'gridWidget' );
}
add_action( 'widgets_init', 'gridWidgetload' );