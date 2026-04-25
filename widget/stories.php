<?php 
class stories extends WP_Widget {
  
function __construct() {
	parent::__construct(
		'stories', '✔️ Stories', 
		array( 'description' => __( 'Widget custom yang berisikan stories', 'themeslix' ), ) 
	);
}

public function widget( $args, $instance ) {
    if (isset( $instance[ 'desktop' ]) && $instance[ 'desktop' ] === 'yes' || $instance[ 'desktop' ] == "") {
        if(!wp_is_mobile()):
        // Get menu
        $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

        if ( ! $nav_menu ) {
            return;
        }

        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        echo "<div class='widget stories'>";

        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $nav_menu_args = array(
            'fallback_cb' => '',
            'menu'        => $nav_menu,
        );
        wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );

        echo "</div>";
        endif;
    }
    if (isset( $instance[ 'mobile' ]) && $instance[ 'mobile' ] === 'yes' || $instance[ 'mobile' ] == "") {
        if(wp_is_mobile()):
        // Get menu
        $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

        if ( ! $nav_menu ) {
            return;
        }

        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        echo "<div class='widget stories'>";

        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $nav_menu_args = array(
            'fallback_cb' => '',
            'menu'        => $nav_menu,
        );
        wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );

        echo "</div>";
        endif;
    }
}
public function form( $instance ) {
    $defaults = array(
        'nav_menu' => '',
        'desktop' => 'yes',
        'mobile' => 'yes',
    );
    $instance = wp_parse_args( (array) $instance, $defaults ); 


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
    <p class="alert"><b>PERHATIAN :</b> Widget ini hanya akan berjalan baik di <b>Area Beranda</b>.</p>
    <hr>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Judul Widget :'; ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"/>
    </p> 

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
        <label for="<?php echo $this->get_field_id( 'desktop' ); ?>">Desktop</label><br>

        <input type="checkbox" id="<?php echo $this->get_field_id( 'mobile' ); ?>" name="<?php echo $this->get_field_name( 'mobile' ); ?>" value="yes"<?php checked( 'yes', $instance['mobile'] ); ?>>
        <label for="<?php echo $this->get_field_id( 'mobile' ); ?>">Mobile</label>
    </p>
    <style type="text/css">
    p.alert {
    border-left: 5px solid #ffba00;
    padding: 10px;
    color: #311515;
    background: #f1f1f1;
    }
    </style>
<?php 
}
      
	public function update( $new_instance, $old_instance ) {
		$instance                  = $old_instance;
        $instance['title']  = sanitize_text_field( $new_instance['title'] );
        $instance['nav_menu'] = (int) $new_instance['nav_menu'];
        $instance['desktop'] = isset( $new_instance['desktop'] ) ? 'yes' : 'no';
        $instance['mobile'] = isset( $new_instance['mobile'] ) ? 'yes' : 'no';
		return $instance;
	}
 
} 
 
function loadstories() {
    register_widget( 'stories' );
}
add_action( 'widgets_init', 'loadstories' );