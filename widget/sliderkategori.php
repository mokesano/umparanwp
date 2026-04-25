<?php
function sliderViewKategoriDesktop($category,$headline,$jml,$titletrending,$amounttrending,$rentang){
	global $post;
	if(!empty($category) && $category != ""):
		$category_link = get_category_link( get_cat_ID( $category ) );
		$args = array(
			'category_name' => $category,
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page'=> 1
		);
		$tot = intval($jml) * 3;
		$argsheadline = array(
			'category_name' => $category . '+' . $headline,
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page'=> $tot,
			'order' => 'DESC'
		);
		$argstrending = array(
			'category_name' => $category,
			'post_type' => 'post',
			'post_status' => 'publish',
			'meta_key' => 'post_views_count',
			'orderby'   => 'meta_value_num',
			'posts_per_page' => $amounttrending,
			'order' => 'DESC',
			'date_query' => array(
				array(
					'after' => $rentang,
				),
			)
		);
		$my_query = new WP_Query( $args );
		if ( $my_query->have_posts() ):
			?>
			<div class="widget slider">
				<div class="headline">
					<div id="sliderbox" class="carousel slide" data-ride="carousel">
						<ul class="carousel-indicators">
							<?php
							$indi = "";
							if($jml > 1){
								for ($i=0; $i < $jml; $i++) { 
									if($i == 0){
										$indi .= '<li data-target="#sliderbox" data-slide-to="'.$i.'" class="active"></li>';
									}else{
										$indi .= '<li data-target="#sliderbox" data-slide-to="'.$i.'"></li>';
									}
								}

							}
							echo $indi;
							?>
						</ul>
						<div class="carousel-inner">
							<?php
							$num = 0;
							$my_headline = new WP_Query( $argsheadline );
							if ( $my_headline->have_posts() ):
								while ( $my_headline->have_posts() ) {
									$my_headline->the_post();
									$no = $num++;
									$shareURL = get_permalink();
									$shareTitle = str_replace( '%', '%25', get_the_title());
									$socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
									$big = '
									<div class="headline-big">
									<div class="headline-item">
									<div class="headline-image">' . customthumbnail($post->ID, "image_640_360") . '</div>
									<div class="headline-content">
									<div class="headline-text">
									<div class="headline-title">
									<h3>
									<a href="' . get_permalink() . '">' . get_the_title() . '</a>
									</h3>
									<div class="headline-author">' . get_avatar( get_the_author_meta( 'ID' ), 14 ) . '
									<div class="headline-author-name">'. get_the_author() .'</div>
									<i class="icon-verification"></i>
									</div>
									</div>
									<div class="headline-more">
									<div class="headline-button">
									<button class="btn-like ' . class_like() . '" data-id="' . get_the_ID() . '">
									<i class="icon-like"></i>
									<span class="like-counter">' . button_like() . '</span>
									</button>
									<a href="' . get_permalink() . '#respond" class="btn-comment">
									<i class="icon-comment"></i>
									<span class="comment-counter">' . get_comments_number() . '</span>
									</a>
									<time class="timeago">' . timeago() . '</time>
									</div>
									<button aria-label="More" class="icon-share" data-url="' . $shareURL . '" data-title="' . $socialTitle . '" data-title2="' . $shareTitle . '" data-snip="' . $snip . '"></button>
									</div>
									</div>
									</div>
									</div>
									</div>';
									$small = '
									<div class="headline-small">
									<div class="headline-item">
									<div class="headline-image">' . customthumbnail($post->ID, "image_322_238") . '</div>
									<div class="headline-content">
									<div class="headline-text">
									<div class="headline-title">
									<h3>
									<a href="' . get_permalink() . '">' . get_the_title() . '</a>
									</h3>
									<div class="headline-author">' . get_avatar( get_the_author_meta( 'ID' ), 14 ) . '
									<div class="headline-author-name">'. get_the_author() .'</div>
									<i class="icon-verification"></i>
									</div>
									</div>
									<div class="headline-more">
									<div class="headline-button">
									<button class="btn-like ' . class_like() . '" data-id="' . get_the_ID() . '">
									<i class="icon-like"></i>
									<span class="like-counter">' . button_like() . '</span>
									</button>
									<a href="' . get_permalink() . '#respond" class="btn-comment">
									<i class="icon-comment"></i>
									<span class="comment-counter">' . get_comments_number() . '</span>
									</a>
									<time class="timeago">' . timeago() . '</time>
									</div>
									<button aria-label="More" class="icon-share" data-url="' . $shareURL . '" data-title="' . $socialTitle . '" data-title2="' . $shareTitle . '" data-snip="' . $snip . '"></button>
									</div>
									</div>
									</div>
									</div>
									</div>';
									$bigempty = '
									<div class="headline-big"><div class="headline-item"><div class="headline-image"></div></div></div>';
									$smallempty = '
									<div class="headline-small"><div class="headline-item"><div class="headline-image"></div></div></div>';
									if($num < 4){
										if($num == 1){
											$databig[] = $big;
										}
										if($num == 2){
											$datasml1[] = $small;
										}
										if($num == 3){
											$datasml2[] = $small;
										}
									}else{
										if($num % 3 == 1){
											$databig[] = $big;
										}
										if($num % 3 == 2){
											$datasml1[] = $small;
										}
										if($num % 3 == 0){
											$datasml2[] = $small;
										}
									}
								}
							endif;
							wp_reset_postdata();

							$item = "";
							for ($j=0; $j < $jml; $j++) { 
								if(empty($databig[$j])){
									$htmlbig = $bigempty;
								}else{
									$htmlbig = $databig[$j];
								}
								if(empty($datasml1[$j])){
									$htmlsmall1 = $smallempty;
								}else{
									$htmlsmall1 = $datasml1[$j];
								}
								if(empty($datasml2[$j])){
									$htmlsmall2 = $smallempty;
								}else{
									$htmlsmall2 = $datasml2[$j];
								}

								if($j == 0){
									$item .= '<div class="carousel-item active">' . $htmlbig . '<div class="headline-small-box">' . $htmlsmall1 . '' . $htmlsmall2 . '</div></div>';
								}else{
									$item .= '<div class="carousel-item">' . $htmlbig . '<div class="headline-small-box">' . $htmlsmall1 . '' . $htmlsmall2 . '</div></div>';
								}
							}
							echo $item;
							?>
						</div>

						<?php
						if($jml > 1){
							$control = '<a class="carousel-control-prev" href="#sliderbox" data-slide="prev" aria-label="Prev">
							<span class="carousel-control-prev-icon"></span>
							</a>
							<a class="carousel-control-next" href="#sliderbox" data-slide="next" aria-label="Next">
							<span class="carousel-control-next-icon"></span>
							</a>';
							echo $control;
						}
						?>
					</div>
				</div>
				<div class="trending">
					<div class="grid-box">
						<?php if(!empty($titletrending)): ?>
							<div class="grid-header">
								<div class="grid-header-box">
									<div class="grid-title">
										<h2><?php echo $titletrending; ?></h2>
									</div>
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
			</div>
			<?php 
		endif;
	endif;
}
function sliderViewKategoriMobile($category,$headline,$jml){
	global $post;
	if(!empty($category) && $category != ""):
		$category_link = get_category_link( get_cat_ID( $category ) );
		$args = array(
			'category_name' => $category . '+' . $headline,
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page'=> $jml
		);
		$my_query = new WP_Query( $args );
		if ( $my_query->have_posts() ):
			?>
			<div class="widget slider">
				<div class="headline">
					<div class="headline-scroll">
						<div class="headline-box">
							<?php
							while ( $my_query->have_posts() ) {
								$my_query->the_post();
								$shareURL = get_permalink();
								$shareTitle = str_replace( '%', '%25', get_the_title());
								$socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
								?>
								<div class="headline-item">
									<div class="headline-image">
										<?php echo customthumbnail($post->ID, "image_272_153"); ?>
									</div>
									<div class="headline-content">
										<div class="headline-text">
											<div class="headline-title">
												<h3>
													<?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?>
												</h3>
												<div class="headline-author">
													<?php echo  get_avatar( get_the_author_meta( 'ID' ), 14 ); ?>
													<div class="headline-author-name"><?php echo get_the_author(); ?></div>
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
				</div>
			</div>
			<?php 
		endif;
	endif;
}
class sliderKategori extends WP_Widget {

	public function __construct() {
		$idwidget = 'sliderkategori';
		$namewidget = '✔️ Slider Kategori';
		$descwidget = 'Widget ini menampilan daftar pos berdasarkan kategori yang dipilih dan ditampilkan dalam bentuk slider';
		parent::__construct($idwidget, $namewidget, array('description'=> $descwidget));
	}
	public function widget( $args, $instance ) {
		if(is_category($instance['category'])){
		if($instance['mobile'] == 'yes'){
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
				sliderViewKategoriMobile($instance['category'], $instance['headline'], $instance['amountheadlinemobile']);
			}elseif (wp_is_mobile()) {
				sliderViewKategoriMobile($instance['category'], $instance['headline'], $instance['amountheadlinemobile']);
			}
		}
		if($instance['desktop'] == 'yes'){
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
			}elseif (wp_is_mobile()) {
			}else{
				sliderViewKategoriDesktop($instance['category'], $instance['headline'], $instance['amountheadlinedesktop'], $instance['titletrending'], $instance['amounttrending'], $instance['rentang']);
			}
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
		if ( ! empty( $new_instance['headline'] ) ) {
			$instance['headline'] = sanitize_text_field( $new_instance['headline'] );
		}
		if ( ! empty( $new_instance['titletrending'] ) ) {
			$instance['titletrending'] = sanitize_text_field( $new_instance['titletrending'] );
		}
		if ( ! empty( $new_instance['amountheadlinedesktop'] ) ) {
			$instance['amountheadlinedesktop'] = sanitize_text_field( $new_instance['amountheadlinedesktop'] );
		}
		if ( ! empty( $new_instance['amountheadlinemobile'] ) ) {
			$instance['amountheadlinemobile'] = sanitize_text_field( $new_instance['amountheadlinemobile'] );
		}
		if ( ! empty( $new_instance['amounttrending'] ) ) {
			$instance['amounttrending'] = sanitize_text_field( $new_instance['amounttrending'] );
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
			'category' => '-1',
			'headline' => '-1',
			'titletrending' => 'Trending ...',
			'amountheadlinedesktop' => '3',
			'amountheadlinemobile' => '5',
			'amounttrending' => '5',
			'rentang' => '1 month ago',
			'desktop' => 'yes',
			'mobile' => 'yes',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		<div class="related-form-controls">
			<p class="not-widget">
				<b>PERHATIAN!!</b> Isi semua form widget ini agar widget dapat berfungsi dengan baik dan pastikan widget disisipkan dihalaman kategori.
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php echo 'Tampilkan dikategori:'; ?></label>
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
			<p>
				<label for="<?php echo $this->get_field_id( 'amountheadlinedesktop' ); ?>"><?php echo 'Jumlah slider di desktop:'; ?></label>
				<input type="number" class="widefat" id="<?php echo $this->get_field_id( 'amountheadlinedesktop' ); ?>" name="<?php echo $this->get_field_name( 'amountheadlinedesktop' ); ?>" min="1" max="10" value="<?php echo $instance['amountheadlinedesktop']; ?>" required/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'amountheadlinemobile' ); ?>"><?php echo 'Jumlah slider di mobile:'; ?></label>
				<input type="number" class="widefat" id="<?php echo $this->get_field_id( 'amountheadlinemobile' ); ?>" name="<?php echo $this->get_field_name( 'amountheadlinemobile' ); ?>" min="1" max="10" value="<?php echo $instance['amountheadlinemobile']; ?>" required/>
			</p>
			<hr>
			<h3>Pengaturan Trending</h3>
			<p>
				<label for="<?php echo $this->get_field_id( 'titletrending' ); ?>"><?php echo "Judul Trending" ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'titletrending' ); ?>" name="<?php echo $this->get_field_name( 'titletrending' ); ?>" value="<?php echo $instance['titletrending']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'amounttrending' ); ?>"><?php echo 'Jumlah pos trending:'; ?></label>
				<input type="number" class="widefat" id="<?php echo $this->get_field_id( 'amounttrending' ); ?>" name="<?php echo $this->get_field_name( 'amounttrending' ); ?>" min="1" max="10" value="<?php echo $instance['amounttrending']; ?>" required/>
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

function sliderkategoriload() {
	register_widget( 'sliderKategori' );
}
add_action( 'widgets_init', 'sliderkategoriload' );