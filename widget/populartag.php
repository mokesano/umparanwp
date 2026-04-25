<?php
function populartagViewDesktop($judul, $rentang, $jml){
	global $wpdb;
	$interval = $rentang;
	$term_ids = $wpdb->get_col("
	    SELECT term_id FROM $wpdb->term_taxonomy
	    INNER JOIN $wpdb->term_relationships ON $wpdb->term_taxonomy.term_taxonomy_id=$wpdb->term_relationships.term_taxonomy_id
	    INNER JOIN $wpdb->posts ON $wpdb->posts.ID = $wpdb->term_relationships.object_id
	    WHERE DATE_SUB(CURDATE(), INTERVAL ". $interval .") <= $wpdb->posts.post_date");

	if(count($term_ids) > 0){
	  $tags = get_tags(array(
	    'orderby' => 'count',
	    'order'   => 'DESC',
	    'number'  => $jml,
	    'include' => $term_ids,
	  ));
	?>
	<div class="widget custom-tag">
		<?php // if(!empty($judul)): ?>
    		<!--<div class="widget-header">-->
    		<!--	<h2 class="widget-title"><?php //echo $judul; ?></h2>-->
    		<!--</div>-->
		<?php // endif; ?>
		<div class="widget-content">
		    <ul class="menu">
		        <?php
            	foreach ( (array) $tags as $tag ) {
            	    echo '<li><a href="' . get_tag_link ($tag->term_id) . '" class="media-link">' . $tag->name . '</a></li>';
            	}
            	?>
        	</ul>
        </div>				
    </div>
    <?php
	}
}
function populartagViewMobile($judul, $rentang, $jml){
	global $wpdb;
	$interval = $rentang;
	$term_ids = $wpdb->get_col("
	    SELECT term_id FROM $wpdb->term_taxonomy
	    INNER JOIN $wpdb->term_relationships ON $wpdb->term_taxonomy.term_taxonomy_id=$wpdb->term_relationships.term_taxonomy_id
	    INNER JOIN $wpdb->posts ON $wpdb->posts.ID = $wpdb->term_relationships.object_id
	    WHERE DATE_SUB(CURDATE(), INTERVAL ". $interval .") <= $wpdb->posts.post_date");

	if(count($term_ids) > 0){
	  $tags = get_tags(array(
	    'orderby' => 'count',
	    'order'   => 'DESC',
	    'number'  => $jml,
	    'include' => $term_ids,
	  ));
	?>
	<div class="widget custom-tag">
		<?php if(!empty($judul)): ?>
    		<div class="widget-header">
    			<h2 class="widget-title"><?php echo $judul; ?></h2>
    		</div>
		<?php endif; ?>
		<div class="widget-content">
		    <ul class="menu">
		        <?php
            	foreach ( (array) $tags as $tag ) {
            	    echo '<li><a href="' . get_tag_link ($tag->term_id) . '" class="media-link">' . $tag->name . '</a></li>';
            	}
            	?>
        	</ul>
        </div>				
    </div>
    <?php
	}
}
class populartagWidget extends WP_Widget {

	public function __construct() {
		$idwidget = 'populartag';
		$namewidget = '✔️ Popular Tag';
		$descwidget = 'Widget ini menampilan daftar tag terpopuler berdasarkan kategori yang dipilih serta ditampilkan dalam bentuk widget list';
		parent::__construct($idwidget, $namewidget, array('description'=> $descwidget));
	}
	public function widget( $args, $instance ) {
		if($instance['mobile'] == 'yes'){
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
				populartagViewMobile($instance['title'],$instance['rentang'], $instance['amountmobile']);
			}elseif (wp_is_mobile()) {
				populartagViewMobile($instance['title'],$instance['rentang'], $instance['amountmobile']);
			}
		}
		if($instance['desktop'] == 'yes'){
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
			}elseif (wp_is_mobile()) {
			}else{
				populartagViewDesktop($instance['title'],$instance['rentang'], $instance['amountdesktop']);
			}
		}
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['rentang'] ) ) {
			$instance['rentang'] = sanitize_text_field( $new_instance['rentang'] );
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
			'rentang' => '1 month',
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
				<label for="<?php echo $this->get_field_id( 'rentang' ); ?>"><?php echo 'Rentang :'; ?></label>
				<select id="<?php echo $this->get_field_id('rentang'); ?>" name="<?php echo $this->get_field_name('rentang'); ?>" class="widefat" style="width:100%;" required>
					<option <?php selected( $instance['rentang'], '10 year' ); ?> value="10 year">-- Pilih --</option>
					<option <?php selected( $instance['rentang'], '1 day' ); ?> value="1 day">1 Hari</option>
					<option <?php selected( $instance['rentang'], '7 day' ); ?> value="7 day">7 Hari</option>
					<option <?php selected( $instance['rentang'], '1 month' ); ?> value="1 month">1 Bulan</option>
					<option <?php selected( $instance['rentang'], '1 years' ); ?> value="1 years">1 Tahun</option>
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

function populartagWidgetload() {
	register_widget( 'populartagWidget' );
}
add_action( 'widgets_init', 'populartagWidgetload' );