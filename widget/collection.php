<?php
function collectionViewMobile($judul,$category,$jml){
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
		$no = 1;
	?>
	<div class="widget collection">
		<?php if(!empty($judul)): ?>
			<div class="widget-header">
				<div class="widget-header-box">
					<div class="widget-title">
						<a href="<?php echo esc_url( $category_link ); ?>"><?php echo $judul; ?></a>
					</div>
					<div class="widget-more">
						<a href="<?php echo esc_url( $category_link ); ?>"></a>
					</div>
				</div>
			</div>
		<?php endif; ?>
			<div class="widget-content">
				<div class="collection-scroll">
					<div class="collection-box">
		            <?php
		            while ( $my_query->have_posts() ) {
		            $my_query->the_post();
		            $num = $no++;?>
					<div class="collection-item">
						<a href="<?php echo get_permalink(); ?>">
							<div class="collection-card">
								<div class="collection-image">
									<?php echo customthumbnail($post->ID, "image_187_261"); ?>
						            <?php if($num == 1): ?>
									<i class="pin"></i>
									<?php endif; ?>
								</div>
								<?php if($num == 1): ?>
								<div class="collection-label">BARU</div>
								<?php endif; ?>
								<h3 class="collection-title"><?php echo get_the_title(); ?></h3>
								<div class="collection-subtitle"><?php echo timeago(); ?></div>
							</div>
						</a>
					</div>
		            <?php
		        	}
		        	?>
				</div>
			</div>
		</div>
	</div>
	<?php 
		endif;
		wp_reset_postdata();
	endif;
}
function collectionViewDesktop($judul,$category,$jml){
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
		$no = 1;
	?>
	<div class="widget collection">
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
				<div class="collection-scroll">
					<div class="collection-box">
		            <?php
		            while ( $my_query->have_posts() ) {
		            $my_query->the_post();
		            $num = $no++;?>
					<div class="collection-item">
						<a href="<?php echo get_permalink(); ?>">
							<div class="collection-card">
								<div class="collection-image">
									<?php echo customthumbnail($post->ID, "image_187_261"); ?>
						            <?php if($num == 1): ?>
									<i class="pin"></i>
									<?php endif; ?>
								</div>
								<?php if($num == 1): ?>
								<div class="collection-label">BARU</div>
								<?php endif; ?>
								<h3 class="collection-title"><?php echo get_the_title(); ?></h3>
								<div class="collection-subtitle"><?php echo timeago(); ?></div>
							</div>
						</a>
					</div>
		            <?php
		        	}
		        	?>
				</div>
			</div>
		</div>
	</div>
	<?php 
		endif;
		wp_reset_postdata();
	endif;
}
class collectionWidget extends WP_Widget {

    public function __construct() {
        $idwidget = 'collection';
        $namewidget = '✔️ Collection';
        $descwidget = 'Widget ini menampilan daftar pos berdasarkan kategori yang dipilih dan ditampilkan dalam bentuk widget collection';
        parent::__construct($idwidget, $namewidget, array('description'=> $descwidget));
    }
	public function widget( $args, $instance ) {
		if($instance['mobile'] == 'yes'){
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
				collectionViewMobile($instance['title'], $instance['category'], $instance['amount']);
			}elseif (wp_is_mobile()) {
				collectionViewMobile($instance['title'], $instance['category'], $instance['amount']);
			}
		}
		if($instance['desktop'] == 'yes'){
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
			}elseif (wp_is_mobile()) {
			}else{
				collectionViewDesktop($instance['title'], $instance['category'], $instance['amount']);
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
		if ( ! empty( $new_instance['amount'] ) ) {
			$instance['amount'] = sanitize_text_field( $new_instance['amount'] );
		}
        $instance['desktop'] = isset( $new_instance['desktop'] ) ? 'yes' : 'no';
        $instance['mobile'] = isset( $new_instance['mobile'] ) ? 'yes' : 'no';
		return $instance;
	}
	public function form( $instance ) {
	    $defaults = array(
	        'title' => '',
	        'category' => '-1',
	        'amount' => '5',
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
		        <label for="<?php echo $this->get_field_id( 'amount' ); ?>"><?php echo 'Jumlah Pos:'; ?></label>
		        <input type="number" class="widefat" id="<?php echo $this->get_field_id( 'amount' ); ?>" name="<?php echo $this->get_field_name( 'amount' ); ?>" min="1" max="5" value="<?php echo $instance['amount']; ?>" required/>
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

function collectionWidgetload() {
    register_widget( 'collectionWidget' );
}
add_action( 'widgets_init', 'collectionWidgetload' );