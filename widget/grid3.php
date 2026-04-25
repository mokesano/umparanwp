<?php
function grid3ViewMobile($judul,$category,$judulpopuler,$judulterbaru,$rentang){
	global $post;
	if(!empty($category) && $category != ""):
		$category_link = get_category_link( get_cat_ID( $category ) );
		$idheadline = "";
		if(is_single()):
			$argstrending = array(
				'category_name' => $category,
				'post_type' => 'post',
				'post_status' => 'publish',
				'meta_key' => 'post_views_count',
				'orderby'   => 'meta_value_num',
				'posts_per_page' => 1,
				'order' => 'DESC',
				'date_query' => array(
					array(
						'after' => $rentang,
					),
				)
			);
		else:
			$argstrending = array(
				'category_name' => $category,
				'post_type' => 'post',
				'post_status' => 'publish',
				'meta_key' => 'post_views_count',
				'orderby'   => 'meta_value_num',
				'posts_per_page' => 1,
				'order' => 'DESC',
				'date_query' => array(
					array(
						'after' => $rentang,
					),
				)
			);
		endif;
		$my_query2 = new WP_Query( $argstrending );
		if ( $my_query2->have_posts() ):
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
						while ( $my_query2->have_posts() ) {
							$my_query2->the_post();
						    $idheadline .= $post->ID;
							$shareURL = get_permalink();
							$shareTitle = str_replace( '%', '%25', get_the_title());
							$socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
							?>
							<div class="grid-item">
								<div class="grid-box">
									<div class="grid-content">
										<div class="grid-title">
											<?php if(!empty($judulpopuler)): ?>
											<div class="grid-label"><?php echo $judulpopuler; ?></div>
											<?php endif; ?>
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
						<?php
                		if(is_single()):
                			$args = array(
                				'category_name' => $category,
                				'post_type' => 'post',
                				'post_status' => 'publish',
                				'post__not_in' => array( $post->ID ),
                				'posts_per_page'=> 1
                			);
                		else:
                			$args = array(
                				'category_name' => $category,
                				'post_type' => 'post',
                				'post_status' => 'publish',
            				    'post__not_in' => array($idheadline),
                				'posts_per_page'=> 1
                			);
                		endif;
                
                		$my_query = new WP_Query( $args );
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
											<?php if(!empty($judulterbaru)): ?>
											<div class="grid-label"><?php echo $judulterbaru; ?></div>
											<?php endif; ?>
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
function grid3ViewDesktop($judul,$category,$judulpopuler,$judulterbaru,$rentang){
	global $post;
	if(!empty($category) && $category != ""):
		$category_link = get_category_link( get_cat_ID( $category ) );
		$idheadline = "";
		if(is_single()):
			$argstrending = array(
				'category_name' => $category,
				'post_type' => 'post',
				'post_status' => 'publish',
				'meta_key' => 'post_views_count',
				'orderby'   => 'meta_value_num',
				'posts_per_page' => 1,
				'order' => 'DESC',
				'date_query' => array(
					array(
						'after' => $rentang,
					),
				)
			);
		else:
			$argstrending = array(
				'category_name' => $category,
				'post_type' => 'post',
				'post_status' => 'publish',
				'meta_key' => 'post_views_count',
				'orderby'   => 'meta_value_num',
				'posts_per_page' => 1,
				'order' => 'DESC',
				'date_query' => array(
					array(
						'after' => $rentang,
					),
				)
			);
		endif;

		$my_query2 = new WP_Query( $argstrending );
		if ( $my_query2->have_posts() ):
			?>
				<div class="widget grid3">
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
					<div class="widget-content">
						<div class="grid3-box">
						<?php
						while ( $my_query2->have_posts() ) {
							$my_query2->the_post();
						    $idheadline .= $post->ID;
							$shareURL = get_permalink();
							$shareTitle = str_replace( '%', '%25', get_the_title());
							$socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
							?>
							<div class="grid3-item">
								<div class="grid-item-box">
									<div class="grid-text">
										<div class="grid-title">
											<?php if(!empty($judulpopuler)): ?>
											<div class="grid-label"><?php echo $judulpopuler; ?></div>
											<?php endif; ?>
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
						wp_reset_postdata();
						?>
						<?php
                		if(is_single()):
                			$args = array(
                				'category_name' => $category,
                				'post_type' => 'post',
                				'post_status' => 'publish',
                				'post__not_in' => array( $post->ID ),
                				'posts_per_page'=> 1
                			);
                		else:
                			$args = array(
                				'category_name' => $category,
                				'post_type' => 'post',
                				'post_status' => 'publish',
            				    'post__not_in' => array($idheadline),
                				'posts_per_page'=> 1
                			);
                		endif;
                
                		$my_query = new WP_Query( $args );
						while ( $my_query->have_posts() ) {
							$my_query->the_post();
							$shareURL = get_permalink();
							$shareTitle = str_replace( '%', '%25', get_the_title());
							$socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
							?>
							<div class="grid3-item">
								<div class="grid-item-box">
									<div class="grid-text">
										<div class="grid-title">
											<?php if(!empty($judulterbaru)): ?>
											<div class="grid-label"><?php echo $judulterbaru; ?></div>
											<?php endif; ?>
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
						wp_reset_postdata();
						?>
						</div>
					</div>
				</div>
			<?php
		endif;
	endif;
}
class grid3Widget extends WP_Widget {
	public function __construct() {
		$idwidget = 'grid3';
		$namewidget = '✔️ Grid3';
		$descwidget = 'Widget ini menampilan daftar pos berdasarkan kategori yang dipilih dan ditampilkan dalam bentuk widget grid3';
		parent::__construct($idwidget, $namewidget, array('description'=> $descwidget));
	}
	public function widget( $args, $instance ) {
		if($instance['mobile'] == 'yes'){
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
				grid3ViewMobile($instance['title'], $instance['category'],$instance['titlepopular'],$instance['titlerecent'],$instance['rentang']);
			}elseif (wp_is_mobile()) {
				grid3ViewMobile($instance['title'], $instance['category'],$instance['titlepopular'],$instance['titlerecent'],$instance['rentang']);
			}
		}
		if($instance['desktop'] == 'yes'){
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
			}elseif (wp_is_mobile()) {
			}else{
				grid3ViewDesktop($instance['title'], $instance['category'],$instance['titlepopular'],$instance['titlerecent'],$instance['rentang']);
			}
		}
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['titlepopular'] ) ) {
			$instance['titlepopular'] = sanitize_text_field( $new_instance['titlepopular'] );
		}
		if ( ! empty( $new_instance['titlerecent'] ) ) {
			$instance['titlerecent'] = sanitize_text_field( $new_instance['titlerecent'] );
		}
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['category'] ) ) {
			$instance['category'] = sanitize_text_field( $new_instance['category'] );
		}
		if ( ! empty( $new_instance['rentang'] ) ) {
			$instance['rentang'] = sanitize_text_field( $new_instance['rentang'] );
		}
		$instance['desktop'] = isset( $new_instance['desktop'] ) ? 'yes' : 'no';
		$instance['mobile'] = isset( $new_instance['mobile'] ) ? 'yes' : 'no';
		return $instance;
	}
	public function form( $instance ) {
		$defaults = array(
			'title' => '',
			'titlepopular' => 'Terpopuler',
			'titlerecent' => 'Terbaru',
			'category' => '-1',
			'rentang' => '1 month ago',
			'desktop' => 'yes',
			'mobile' => 'yes',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<div class="related-form-controls">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</p>
			<hr>
			<h3>Pengaturan Widget</h3>
			<p>
				<label for="<?php echo $this->get_field_id( 'titlepopular' ); ?>">Sub Judul Populer</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'titlepopular' ); ?>" name="<?php echo $this->get_field_name( 'titlepopular' ); ?>" value="<?php echo $instance['titlepopular']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'titlerecent' ); ?>">Sub Judul Terbaru</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'titlerecent' ); ?>" name="<?php echo $this->get_field_name( 'titlerecent' ); ?>" value="<?php echo $instance['titlerecent']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php echo 'Kategori :'; ?></label>
				<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" class="widefat" style="width:100%;" required>
					<option <?php selected( $instance['category'], "-1" ); ?> value="-1">Pilih Kategori</option>
					<?php foreach(get_terms('category','parent=0&hide_empty=0') as $term) { ?>
						<option <?php selected( $instance['category'], $term->slug ); ?> value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'rentang' ); ?>"><?php echo 'Rentang Populer:'; ?></label>
				<select id="<?php echo $this->get_field_id('rentang'); ?>" name="<?php echo $this->get_field_name('rentang'); ?>" class="widefat" style="width:100%;" required>
					<option <?php selected( $instance['rentang'], '10 years ago' ); ?> value="10 years ago">-- Pilih --</option>
					<option <?php selected( $instance['rentang'], '1 day ago' ); ?> value="1 day ago">1 Hari</option>
					<option <?php selected( $instance['rentang'], '7 day ago' ); ?> value="7 day ago">7 Hari</option>
					<option <?php selected( $instance['rentang'], '1 month ago' ); ?> value="1 month ago">1 Bulan</option>
					<option <?php selected( $instance['rentang'], '1 years ago' ); ?> value="1 years ago">1 Tahun</option>
				</select>
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
function grid3Widgetload() {
	register_widget( 'grid3Widget' );
}
add_action( 'widgets_init', 'grid3Widgetload' );