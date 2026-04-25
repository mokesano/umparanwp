<?php
function videoViewMobile($judul,$category,$jml){
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
			<div class="widget video">
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
					<div class="video-wrap">
						<?php
						$no = 1;
						while ( $my_query->have_posts() ) {
							$my_query->the_post();
							$shareURL = get_permalink();
							$shareTitle = str_replace( '%', '%25', get_the_title());
							$socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
							$num = $no++;
							?>
							<?php if($num == 1): ?>
							<div class="video-item big">
								<div class="video-box">
									<div class="video-image">
										<?php echo '<a href="' . get_permalink() . '">' . customthumbnail($post->ID, "image_320_180") . '</a>'; ?>
									</div>
									<div class="video-content">
										<div class="video-title">
											<h3>
												<?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?>
											</h3>
											<div class="video-author">
												<?php echo get_avatar( get_the_author_meta( 'ID' ), 16 ); ?>
												<div class="video-author-name"><?php echo get_the_author(); ?></div>
												<i class="icon-verification"></i>
											</div>
										</div>
										<div class="video-more">
											<div class="video-button">
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
							<?php else: ?>
							<div class="video-item small">
								<div class="video-box">
									<div class="video-content">
										<div class="video-title">
											<h3>
												<?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?>
											</h3>
											<div class="video-author">
												<?php echo get_avatar( get_the_author_meta( 'ID' ), 16 ); ?>
												<div class="video-author-name"><?php echo get_the_author(); ?></div>
												<i class="icon-verification"></i>
											</div>
										</div>
										<div class="video-more">
											<div class="video-button">
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
									<div class="video-image">
										<?php echo '<a href="' . get_permalink() . '">' . customthumbnail($post->ID, "image_80_80") . '</a>'; ?>
									</div>
								</div>
							</div>
							<?php endif; ?>
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
function videoViewDesktop($judul,$category,$jml){
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
			<div class="widget video">
				<?php if(!empty($judul)): ?>
					<div class="widget-header">
						<div class="widget-header-box">
							<div class="widget-title">
								<a href="<?php echo esc_url( $category_link ); ?>"><?php echo $judul; ?></a>
							</div>
							<div class="widget-more">
								<a href="<?php echo esc_url( $category_link ); ?>">Lihat lainnya</a>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<div class="widget-content">
					<div class="video-box">
						<?php
						while ( $my_query->have_posts() ) {
							$my_query->the_post();
							$shareURL = get_permalink();
							$shareTitle = str_replace( '%', '%25', get_the_title());
							$socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
							?>
							<div class="video-item">
								<div class="video-wrap">
									<div class="video-content">
										<div class="video-image">
											<a href="#">
												<?php echo '<a href="' . get_permalink() . '">' . customthumbnail($post->ID, "image_192_108") . '</a>'; ?>
											</a>
										</div>
										<div class="video-title">
											<h3>
												<?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?>
											</h3>
											<div class="video-author">
												<?php echo get_avatar( get_the_author_meta( 'ID' ), 16 ); ?>
												<div class="video-author-name"><?php echo get_the_author(); ?></div>
												<i class="icon-verification"></i>
											</div>
										</div>
										<div class="video-more">
											<div class="video-button">
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
						?>
					</div>
				</div>
			</div>
			<?php
		endif;
		wp_reset_postdata();
	endif;
}
class videoWidget extends WP_Widget {
	public function __construct() {
		$idwidget = 'video';
		$namewidget = '✔️ Video';
		$descwidget = 'Widget ini menampilan daftar pos berdasarkan kategori yang dipilih dan ditampilkan dalam bentuk widget video';
		parent::__construct($idwidget, $namewidget, array('description'=> $descwidget));
	}
	public function widget( $args, $instance ) {
		if($instance['mobile'] == 'yes'){
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
				videoViewMobile($instance['title'], $instance['category'], $instance['amountmobile']);
			}elseif (wp_is_mobile()) {
				videoViewMobile($instance['title'], $instance['category'], $instance['amountmobile']);
			}
		}
		if($instance['desktop'] == 'yes'){
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
			}elseif (wp_is_mobile()) {
			}else{
				videoViewDesktop($instance['title'], $instance['category'], $instance['amountdesktop']);
			}
		}
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['category'] ) ) {
			$instance['category'] = sanitize_text_field( $new_instance['category'] );
		}
		if ( ! empty( $new_instance['amountdesktop'] ) ) {
			$instance['amountdesktop'] = sanitize_text_field( $new_instance['amountdesktop'] );
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
			'amountdesktop' => '3',
			'amountmobile' => '3',
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
				<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php echo 'Kategori :'; ?></label>
				<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" class="widefat" style="width:100%;" required>
					<option <?php selected( $instance['category'], "-1" ); ?> value="-1">Pilih Kategori</option>
					<?php foreach(get_terms('category','parent=0&hide_empty=0') as $term) { ?>
						<option <?php selected( $instance['category'], $term->slug ); ?> value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'amountdesktop' ); ?>"><?php echo 'Jumlah pos di desktop:'; ?></label>
				<input type="number" class="widefat" id="<?php echo $this->get_field_id( 'amountdesktop' ); ?>" name="<?php echo $this->get_field_name( 'amountdesktop' ); ?>" min="1" max="10" value="<?php echo $instance['amountdesktop']; ?>" required/>
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
function videoWidgetload() {
	register_widget( 'videoWidget' );
}
add_action( 'widgets_init', 'videoWidgetload' );