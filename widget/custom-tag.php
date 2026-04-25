<?php
class customTag extends WP_Widget {
	public function __construct() {
        $idwidget = 'customtag';
        $namewidget = '✔️ Custom Tag';
        $descwidget = 'Widget ini menampilkan data tag secara custom yang dapat diatur berdasarkan menu yang diinginkan';
		$widget_ops = array(
			'description'                 => $descwidget,
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( $idwidget, $namewidget, $widget_ops );
	}
	public function widget( $args, $instance ) {
		if($instance['mobile'] == 'yes'){
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
				$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
				if ( ! $nav_menu ) {
					return;
				}
				$default_title = __( 'Menu' );
				$title         = ! empty( $instance['title'] ) ? $instance['title'] : '';
				$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
				echo str_replace("widget", "widget custom-tag", $args['before_widget']);

				if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
					echo $args['before_title'] . $title . $args['after_title'];
				}elseif (wp_is_mobile()) {
					echo $args['before_title'] . $title . $args['after_title'];
				}
				
				if ( $title ) {
				}
				$format = current_theme_supports( 'html5', 'navigation-widgets' ) ? 'html5' : 'xhtml';
				$format = apply_filters( 'navigation_widgets_format', $format );

				if ( 'html5' === $format ) {
					$title      = trim( strip_tags( $title ) );
					$aria_label = $title ? $title : $default_title;

					$nav_menu_args = array(
						'fallback_cb'          => '',
						'menu'                 => $nav_menu,
						'container'            => 'nav',
						'container_aria_label' => $aria_label,
						'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					);
				} else {
					$nav_menu_args = array(
						'fallback_cb' => '',
						'menu'        => $nav_menu,
					);
				}
				wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );
				echo $args['after_widget'];
			}elseif (wp_is_mobile()) {
				$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
				if ( ! $nav_menu ) {
					return;
				}
				$default_title = __( 'Menu' );
				$title         = ! empty( $instance['title'] ) ? $instance['title'] : '';
				$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
				echo str_replace("widget", "widget custom-tag", $args['before_widget']);

				if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
					echo $args['before_title'] . $title . $args['after_title'];
				}elseif (wp_is_mobile()) {
					echo $args['before_title'] . $title . $args['after_title'];
				}
				
				if ( $title ) {
				}
				$format = current_theme_supports( 'html5', 'navigation-widgets' ) ? 'html5' : 'xhtml';
				$format = apply_filters( 'navigation_widgets_format', $format );

				if ( 'html5' === $format ) {
					$title      = trim( strip_tags( $title ) );
					$aria_label = $title ? $title : $default_title;

					$nav_menu_args = array(
						'fallback_cb'          => '',
						'menu'                 => $nav_menu,
						'container'            => 'nav',
						'container_aria_label' => $aria_label,
						'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					);
				} else {
					$nav_menu_args = array(
						'fallback_cb' => '',
						'menu'        => $nav_menu,
					);
				}
				wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );
				echo $args['after_widget'];
			}
		}
		if($instance['desktop'] == 'yes'){
			if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
			}elseif (wp_is_mobile()) {
			}else{
				$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
				if ( ! $nav_menu ) {
					return;
				}
				$default_title = __( 'Menu' );
				$title         = ! empty( $instance['title'] ) ? $instance['title'] : '';
				$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
				echo str_replace("widget", "widget custom-tag", $args['before_widget']);
				
				if ( $title ) {
				}
				$format = current_theme_supports( 'html5', 'navigation-widgets' ) ? 'html5' : 'xhtml';
				$format = apply_filters( 'navigation_widgets_format', $format );

				if ( 'html5' === $format ) {
					$title      = trim( strip_tags( $title ) );
					$aria_label = $title ? $title : $default_title;

					$nav_menu_args = array(
						'fallback_cb'          => '',
						'menu'                 => $nav_menu,
						'container'            => 'nav',
						'container_aria_label' => $aria_label,
						'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					);
				} else {
					$nav_menu_args = array(
						'fallback_cb' => '',
						'menu'        => $nav_menu,
					);
				}
				wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );
				echo $args['after_widget'];

			}
		}

	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}
		$instance['desktop'] = isset( $new_instance['desktop'] ) ? 'yes' : 'no';
		$instance['mobile'] = isset( $new_instance['mobile'] ) ? 'yes' : 'no';
		return $instance;
	}
	public function form( $instance ) {
		global $wp_customize;
		$defaults = array(
			'desktop' => 'yes',
			'mobile' => 'yes',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 

		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		$menus = wp_get_nav_menus();

		$empty_menus_style     = '';
		$not_empty_menus_style = '';
		if ( empty( $menus ) ) {
			$empty_menus_style = ' style="display:none" ';
		} else {
			$not_empty_menus_style = ' style="display:none" ';
		}

		$nav_menu_style = '';
		if ( ! $nav_menu ) {
			$nav_menu_style = 'display: none;';
		}
		?>
		<p class="nav-menu-widget-no-menus-message" <?php echo $not_empty_menus_style; ?>>
			<?php
			if ( $wp_customize instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}

			/* translators: %s: URL to create a new menu. */
			printf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) );
			?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php echo $empty_menus_style; ?>>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
					<option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			<?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
				<p class="edit-selected-nav-menu" style="<?php echo $nav_menu_style; ?>">
					<button type="button" class="button"><?php _e( 'Edit Menu' ); ?></button>
				</p>
			<?php endif; ?>
		</div>
			<hr>
			<h3>Pengaturan Tampilan</h3>
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'desktop' ); ?>" name="<?php echo $this->get_field_name( 'desktop' ); ?>" value="yes"<?php checked( 'yes', $instance['desktop'] ); ?>>
				<label for="<?php echo $this->get_field_id( 'desktop' ); ?>">Tampilkan dalam versi desktop</label><br>

				<input type="checkbox" id="<?php echo $this->get_field_id( 'mobile' ); ?>" name="<?php echo $this->get_field_name( 'mobile' ); ?>" value="yes"<?php checked( 'yes', $instance['mobile'] ); ?>>
				<label for="<?php echo $this->get_field_id( 'mobile' ); ?>">Tampilkan dalam versi mobile</label>
			</p>
		<?php
	}
}

function customTagload() {
    register_widget( 'customTag' );
}
add_action( 'widgets_init', 'customTagload' );