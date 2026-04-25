<?php
function relatedView($judul,$berdasarkan,$jml){
if($berdasarkan == "category"):
	// $categories = get_the_category();
	// $catnam = "";
	// if ( ! empty( $categories ) ) {
	// 	$catnam = $categories[0]->slug;
	// }else{
	// 	$catnam = "";
	// }
	// $args = array(
 //        'category_name' => $catnam,
 //        'post__not_in'        => array( get_queried_object_id() ),
 //        'post_type' => 'post',
 //        'post_status' => 'publish',
 //        'orderby'   => 'date',
 //        'posts_per_page' => 1
 //    );
elseif($berdasarkan == "tag"):
	global $post;
    $tags = wp_get_post_tags( $post->ID );
    $tagIDs = array();

	if ( $tags ) {
		$tagcount = count( $tags );
        for ( $i = 0; $i < $tagcount; $i++ ) {
            $tagIDs[$i] = $tags[$i]->term_id;
        }
        $args = array(
            'tag__in' => $tagIDs,
			'post_type' => 'post',
			'post_status' => 'publish',
            'post__not_in' => array( $post->ID ),
            'posts_per_page'=> $jml
        );
        $my_query = new WP_Query( $args );
        if ( $my_query->have_posts() ) {
            ?>
            <div class="widget list">
            	<?php if(!empty($judul)): ?>
				<div class="widget-header">
					<div class="widget-header-box">
						<div class="widget-title">
							<h2><?php echo $judul; ?></h2>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="widget-content">
					<div class="list-wrap">
			            <?php
			            while ( $my_query->have_posts() ) {
			                $my_query->the_post();
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
			            <?php
			            }
			            ?>
					</div>
				</div>
			</div>
            <?php
        }
		wp_reset_postdata();
	}
endif;
?>
<?php
}
class relatedWidget extends WP_Widget {

    public function __construct() {
        $idwidget = 'related';
        $namewidget = '✔️ Related';
        $descwidget = 'Widget ini menampilan daftar pos terkait berdasarkan kategori dan tag serta hanya tampil di halaman pos';
        parent::__construct($idwidget, $namewidget, array('description'=> $descwidget));
    }
	public function widget( $args, $instance ) {
		if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
			relatedView($instance['title'], $instance['berdasarkan'], $instance['amount']);
		}elseif (wp_is_mobile()) {
			relatedView($instance['title'], $instance['berdasarkan'], $instance['amount']);
		}else{
			relatedView($instance['title'], $instance['berdasarkan'], $instance['amount']);
		}
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		// if ( ! empty( $new_instance['category'] ) ) {
		// 	$instance['category'] = sanitize_text_field( $new_instance['category'] );
		// }
		if ( ! empty( $new_instance['berdasarkan'] ) ) {
			$instance['berdasarkan'] = sanitize_text_field( $new_instance['berdasarkan'] );
		}
		if ( ! empty( $new_instance['amount'] ) ) {
			$instance['amount'] = sanitize_text_field( $new_instance['amount'] );
		}
        $instance['desktop'] = isset( $new_instance['desktop'] ) ? 'yes' : 'no';
        $instance['mobile'] = isset( $new_instance['mobile'] ) ? 'yes' : 'no';
		return $instance;
	}
	public function form( $instance ) {
		global $wp_customize;
	    $defaults = array(
	        'title' => '',
	        'berdasarkan' => 'random',
	        'amount' => '3',
	        'desktop' => 'yes',
	        'mobile' => 'yes',
	    );
	    $instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		<div class="related-form-controls">
			<p class="not-widget">
				<b>PERHATIAN!!</b> Widget ini akan berfungsi dengan baik jika berada di halaman pos.
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</p>
		    <hr>
		    <h3>Pengaturan Widget</h3>
		    <p>
		        <label for="<?php echo $this->get_field_id( 'berdasarkan' ); ?>"><?php echo 'Terkait berdasarkan :'; ?></label>
		        <select id="<?php echo $this->get_field_id('berdasarkan'); ?>" name="<?php echo $this->get_field_name('berdasarkan'); ?>" class="widefat" style="width:100%;" required>
		            <option <?php selected( $instance['berdasarkan'], 'random' ); ?> value="random">-- Pilih --</option>
		            <option <?php selected( $instance['berdasarkan'], 'category' ); ?> value="category">Kategori</option>
		            <option <?php selected( $instance['berdasarkan'], 'tag' ); ?> value="tag">Tag</option>
		        </select>
		    </p>
		    <p>
		        <label for="<?php echo $this->get_field_id( 'amount' ); ?>"><?php echo 'Jumlah Pos:'; ?></label>
		        <input type="number" class="widefat" id="<?php echo $this->get_field_id( 'amount' ); ?>" name="<?php echo $this->get_field_name( 'amount' ); ?>" min="1" max="10" value="<?php echo $instance['amount']; ?>" required/>
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

function relatedWidgetload() {
    register_widget( 'relatedWidget' );
}
add_action( 'widgets_init', 'relatedWidgetload' );