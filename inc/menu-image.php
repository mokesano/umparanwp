<?php
class Menu_Image_Plugin {

	private $image_size_1 = '';
	private $image_size_2 = '';
	private $image_size_3 = '';

	protected $image_sizes = array();
	public $mi_fs;
	private $used_attachments = array();
	private $additionalDisplayableImageExtensions = array( 'ico' );
	private $processed = array();
	public function __construct() {

		$this->image_size_1 = get_option( 'menu_image_size_1', '24x24' );
		$this->image_size_2 = get_option( 'menu_image_size_2', '36x36' );
		$this->image_size_3 = get_option( 'menu_image_size_3', '48x48' );

		$image_parts_1 = explode('x', $this->image_size_1);
		$image_parts_2 = explode('x', $this->image_size_2);
		$image_parts_3 = explode('x', $this->image_size_3);
		$this->image_sizes = array(
			'menu-' . $this->image_size_1 => array( $image_parts_1[0], $image_parts_1[1], false ),
			'menu-' . $this->image_size_2 => array( $image_parts_2[0], $image_parts_2[1], false ),
			'menu-' . $this->image_size_3 => array( $image_parts_3[0], $image_parts_3[1], false ),
		);

		// Add new admin menu options page for Menu image.
		add_action( 'admin_menu', array( $this, 'create_menu_image_options_page' ) );
		// Register Menu Image settings.
		add_action( 'admin_init', array( $this, 'register_mysettings' ) );

		// Actions.
		add_action( 'init', array( $this, 'menu_image_init' ) );
		add_action( 'save_post_nav_menu_item', array( $this, 'menu_image_save_post_action' ), 10, 3 );
		add_action( 'admin_head-nav-menus.php', array( $this, 'menu_image_admin_head_nav_menus_action' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'menu_image_add_inline_style_action' ) );
		add_action( 'admin_action_delete-menu-item-image', array( $this, 'menu_image_delete_menu_item_image_action' ) );
		add_action( 'wp_ajax_set-menu-item-thumbnail', array( $this, 'wp_ajax_set_menu_item_thumbnail' ) );

		// Add support of WPML menus sync.
		add_action( 'wp_update_nav_menu_item', array( $this, 'wp_update_nav_menu_item_action' ), 10, 2 );
		add_action( 'admin_init', array( $this, 'admin_init' ), 99 );

		// Filters.
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'menu_image_wp_setup_nav_menu_item' ) );
		add_filter( 'nav_menu_link_attributes', array( $this, 'menu_image_nav_menu_link_attributes_filter' ), 10, 4 );
		add_filter( 'manage_nav-menus_columns', array( $this, 'menu_image_nav_menu_manage_columns' ), 11 );
		add_filter( 'nav_menu_item_title', array( $this, 'menu_image_nav_menu_item_title_filter' ), 10, 4 );
		add_filter( 'the_title', array( $this, 'menu_image_nav_menu_item_title_filter' ), 10, 4 );

		// Add support for additional image types.
		add_filter( 'file_is_displayable_image', array( $this, 'file_is_displayable_image' ), 10, 2 );
		add_filter( 'jetpack_photon_override_image_downsize', array( $this, 'jetpack_photon_override_image_downsize_filter' ), 10, 2 );
		add_filter( 'wp_get_attachment_image_attributes', array( $this, 'wp_get_attachment_image_attributes' ), 99, 3 );

		// Add support for Max Megamenu.
		if ( function_exists( 'max_mega_menu_is_enabled' ) ) {
			add_filter( 'megamenu_nav_menu_link_attributes', array( $this, 'menu_image_nav_menu_link_attributes_filter' ), 10, 3 );
			add_filter( 'megamenu_the_title', array( $this, 'menu_image_nav_menu_item_title_filter' ), 10, 2 );
		}
	}

	public function admin_init() {
		// Add custom field for menu edit walker
		if ( ! has_action( 'wp_nav_menu_item_custom_fields' ) ) {
			add_filter( 'wp_edit_nav_menu_walker', array( $this, 'menu_image_edit_nav_menu_walker_filter' ) );
		}
		add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'menu_item_custom_fields' ), 10, 4 );
	}

	public function file_is_displayable_image( $result, $path ) {
		if ( $result ) {
			return true;
		}
		$fileExtension = pathinfo( $path, PATHINFO_EXTENSION );

		return in_array( $fileExtension, $this->additionalDisplayableImageExtensions );
	}

	public function create_menu_image_options_page() {
		add_submenu_page(
			'themes.php',
			'Gambar Menu',
			'Gambar Menu',
			'manage_options',
			'menu-image-options',
			array( $this, 'menu_image_options_page_html' ) ,
			150
		);
	}
	public function handle_options_form(){
		if( ! isset( $_POST['menu_image_form'] ) || ! wp_verify_nonce( $_POST['menu_image_form'], 'menu_image_options_update' ) ) { ?>
			<div class="error">
			   <p><?php _e( 'Maaf, terjadi kesalahan. Silakan coba lagi.', 'menu-image' );?></p>
			</div> 
			<?php
		} else {

			// Handle our form data.
			$enable_menu_image_hover    = '0';

			// If the value of the Menu Image Hover is set.
			if ( isset( $_POST['menu_image_hover'] ) ) {
				$enable_menu_image_hover   = $_POST['menu_image_hover'];
			}

			$menu_image_size_1         = $_POST['menu_image_size_1'];
			$menu_image_size_2         = $_POST['menu_image_size_2'];
			$menu_image_size_3         = $_POST['menu_image_size_3'];
			$image_parts_1             = explode('x', $menu_image_size_1);
			$image_parts_2             = explode('x', $menu_image_size_2);
			$image_parts_3             = explode('x', $menu_image_size_3);

			// Validate the menu image size format.
			if ( 2 === count( $image_parts_1 ) &&  2 === count( $image_parts_2 ) &&  2 === count( $image_parts_3 )) {
				update_option( 'menu_image_size_1', $menu_image_size_1 );
				update_option( 'menu_image_size_2', $menu_image_size_2 );
				update_option( 'menu_image_size_3', $menu_image_size_3 );
				update_option( 'menu_image_hover', $enable_menu_image_hover );
				?>
				<div class="updated">
					<p><?php _e( 'Pengaturan Gambar Menu Tersimpan!', 'menu-image' );?></p>
				</div>
				<?php
			} else { ?>
				<div class="error">
					<p><?php _e( 'Maaf, format ukuran gambar Anda tidak benar. Silakan coba lagi.', 'menu-image' );?></p>
				</div> 
				<?php
			}
		}
	}

	public function menu_image_options_page_html() {

		// check user capabilities.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// check if we are updating the options.
		if ( isset( $_POST['updated'] ) && 'true' === $_POST['updated'] ) {
			$this->handle_options_form();
		}

		?>
		<div class="wrap">
		<h1><?php _e( 'Pengaturan Gambar Menu', 'menu-image' ); ?></h1>
		<form method="POST">
			<?php wp_nonce_field( 'menu_image_options_update', 'menu_image_form' ); ?>
			<?php settings_fields( 'menu-image-settings-group' ); ?>
			<?php do_settings_sections( 'menu-image-settings-group' ); ?>
			<input type="hidden" name="updated" value="true" />
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e( 'Gambar menu saat diarahkan', 'menu-image' );?></th>
					<td><input name="menu_image_hover" type="checkbox" value="1" <?php checked( '1', get_option( 'menu_image_hover', '1' ) ); ?> /><span class="helper"><?php _e( 'Aktifkan gambar saat diarahkan', 'menu-image' ); ?></span></td>
				</tr>
				<tr valign="top">
					<th><h3><?php _e( 'Ukuran gambar menu ', 'menu-image' );?></h3></th>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e( 'Ukuran gambar menu 1 ', 'menu-image' );?></th>
					<td><input name="menu_image_size_1" type="text" value="<?php echo get_option( 'menu_image_size_1', '24x24' ) ; ?>" /><span class="helper"> <?php _e( 'Gunakan format ini (24x24), lebar dan tinggi.', 'menu-image' ); ?></span></td>
				</tr>
				<tr>
					<th scope="row"><?php _e( 'Ukuran gambar menu 2 ', 'menu-image' );?></th>
					<td><input name="menu_image_size_2" type="text" value="<?php echo get_option( 'menu_image_size_2', '36x36' ) ; ?>" /><span class="helper"> <?php _e( 'Gunakan format ini (36x36), lebar dan tinggi.', 'menu-image' ); ?></span></td>
				</tr>
				<tr>
					<th scope="row"><?php _e( 'Ukuran gambar menu 3 ', 'menu-image' );?></th>
					<td><input name="menu_image_size_3" type="text" value="<?php echo get_option( 'menu_image_size_3', '48x48' ) ; ?>" /><span class="helper"> <?php _e( 'Gunakan format ini (48x48), lebar dan tinggi.', 'menu-image' ); ?></span></td>
				</tr>
				<tr>
					<th scope="row"><?php _e( 'Perhatian:', 'menu-image' );?></th>
					<td><span class="helper"> Jika Anda mengubah ukuran gambar setelah mengunggah gambar, Anda harus membuat ulang semua thumbnail dengan menggunakan form ini.<p>Anda juga perlu memilih gambar ikon lagi di item menu jika Anda mengganti ukuran gambar khusus yang digunakan.</p></td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
		</div>
		<?php
	}

	public function register_mysettings() {
		register_setting( 'menu-image-settings-group', 'menu_image_hover' );
		register_setting( 'menu-image-settings-group', 'menu_image_size_1' );
		register_setting( 'menu-image-settings-group', 'menu_image_size_2' );
		register_setting( 'menu-image-settings-group', 'menu_image_size_3' );
	}

	public function menu_image_init() {
		add_post_type_support( 'nav_menu_item', array( 'thumbnail' ) );
		$this->image_sizes = apply_filters( 'menu_image_default_sizes', $this->image_sizes );
		if ( is_array( $this->image_sizes ) ) {
			foreach ( $this->image_sizes as $name => $params ) {
				add_image_size( $name, $params[0], $params[1], ( array_key_exists( 2, $params ) ? $params[2] : false ) );
			}
		}

	}

	public function menu_image_nav_menu_manage_columns( $columns ) {
		return $columns + array( 'image' => __( 'Image', 'menu-image' ) );
	}
	public function menu_image_save_post_action( $post_id, $post ) {
		$menu_image_settings = array(
			'menu_item_image_size',
			'menu_item_image_title_position',
		);
		foreach ( $menu_image_settings as $setting_name ) {
			if ( isset( $_POST[ $setting_name ][ $post_id ] ) && ! empty( $_POST[ $setting_name ][ $post_id ] ) ) {
				if ( $post->{"_$setting_name"} != $_POST[ $setting_name ][ $post_id ] ) {
					update_post_meta( $post_id, "_$setting_name", esc_sql( $_POST[ $setting_name ][ $post_id ] ) );
				}
			}
		}
	}
	public function wp_update_nav_menu_item_action( $item_menu_id, $menu_item_db_id ) {
		global $sitepress, $icl_menus_sync;
		if ( class_exists( 'SitePress' ) && $sitepress instanceof SitePress && class_exists( 'ICLMenusSync' ) && $icl_menus_sync instanceof ICLMenusSync ) {
			static $run_times = array();
			$menu_image_settings = array(
				'menu_item_image_size',
				'menu_item_image_title_position',
				'thumbnail_id',
				'thumbnail_hover_id',
			);

			foreach ( $icl_menus_sync->menus as $menu_id => $menu_data ) {
				if ( ! isset( $_POST[ 'sync' ][ 'add' ][ $menu_id ] ) ) {
					continue;
				}
				$cache_key   = md5( serialize( array( $item_menu_id, 'tax_nav_menu' ) ) );
				$cache_group = 'get_language_for_element';
				wp_cache_delete( $cache_key, $cache_group );
				$lang = $sitepress->get_language_for_element( $item_menu_id, 'tax_nav_menu' );

				if ( ! isset( $run_times[ $menu_id ][ $lang ] ) ) {
					$run_times[ $menu_id ][ $lang ] = 0;
				}
				$post_item_ids = array();
				foreach ( $_POST['sync']['add'][ $menu_id ] as $id => $lang_array ) {
					if ( array_key_exists( $lang, $lang_array ) ) {
						$post_item_ids[ ] = $id;
					}
				}
				if ( ! array_key_exists( $run_times[ $menu_id ][ $lang ], $post_item_ids ) ) {
					continue;
				}
				$orig_item_id = $post_item_ids[ $run_times[ $menu_id ][ $lang ] ];

				// iterate all item settings and save it for new item.
				$orig_item_meta = get_metadata( 'post', $orig_item_id );
				foreach ( $menu_image_settings as $meta ) {
					if ( isset( $orig_item_meta[ "_$meta" ] ) && isset( $orig_item_meta[ "_$meta" ][0] ) ) {
						update_post_meta( $menu_item_db_id, "_$meta", $orig_item_meta[ "_$meta" ][0] );
					}
				}
				$run_times[ $menu_id ][ $lang ] ++;
				break;
			}
		}
	}

	public function menu_image_edit_nav_menu_walker_filter() {
		return 'Menu_Image_Walker_Nav_Menu_Edit';
	}
	public function menu_image_wp_setup_nav_menu_item( $item ) {
		if ( ! isset( $item->thumbnail_id ) ) {
			$item->thumbnail_id = get_post_thumbnail_id( $item->ID );
		}
		if ( ! isset( $item->thumbnail_hover_id ) ) {
			$item->thumbnail_hover_id = get_post_meta( $item->ID, '_thumbnail_hover_id', true );
		}
		if ( ! isset( $item->image_size ) ) {
			$item->image_size = get_post_meta( $item->ID, '_menu_item_image_size', true );
		}
		if ( ! isset( $item->title_position ) ) {
			$item->title_position = get_post_meta( $item->ID, '_menu_item_image_title_position', true );
		}

		return $item;
	}

	public function menu_image_nav_menu_link_attributes_filter( $atts, $item, $args, $depth = null ) {

		if ( '' !== $item->thumbnail_id ) {
			$this->setProcessed( $item->ID );
			$position = $item->title_position ? $item->title_position : apply_filters( 'menu_image_default_title_position', 'after' );
			$class    = ! empty( $atts['class'] ) ? $atts['class'] : '';
			$class    .= " menu-image-title-{$position}";
			if ( $item->thumbnail_hover_id ) {
				$class .= ' menu-image-hovered';
			} elseif ( $item->thumbnail_id ) {
				$class .= ' menu-image-not-hovered';
			}
			// Fix dropdown menu for Flatsome theme.
			if ( ! empty( $args->walker ) && class_exists( 'FlatsomeNavDropdown' ) && $args->walker instanceof FlatsomeNavDropdown && ! is_null( $depth ) && $depth === 0 ) {
				$class .= ' nav-top-link';
			}
			$atts['class'] = trim( $class );
		}

		return $atts;
	}

	public function menu_image_nav_menu_item_title_filter( $title, $item = null, $depth = null, $args = null ) {

		if ( strpos( $title, 'menu-image' ) > 0 || ! is_nav_menu_item( $item ) || ! isset( $item ) ) {
			return $title;
		}

		if ( is_numeric( $item ) && $item < 0 ) {
			return $title;
		}

		if ( is_numeric( $item ) && $item > 0 ) {
			$item = wp_setup_nav_menu_item( get_post( $item ) );
		}

		// Process only if there is an menu image associated with the menu item.
		if ( '' !== $item->thumbnail_id ) {

			$image_size = $item->image_size ? $item->image_size : apply_filters( 'menu_image_default_size', 'menu-36x36' );
			$position   = $item->title_position ? $item->title_position : apply_filters( 'menu_image_default_title_position', 'after' );
			$class      = "menu-image-title-{$position}";
			$this->setUsedAttachments( $image_size, $item->thumbnail_id );
			$image = '';
			if ( $item->thumbnail_hover_id ) {
				$this->setUsedAttachments( $image_size, $item->thumbnail_hover_id );
				$hover_image_src = wp_get_attachment_image_src( $item->thumbnail_hover_id, $image_size );
				$margin_size     = $hover_image_src[1];
				$image           = "<span class='menu-image-hover-wrapper'>";
				$image .= wp_get_attachment_image( $item->thumbnail_id, $image_size, false, "class=menu-image {$class}" );
				$image .= wp_get_attachment_image(
					$item->thumbnail_hover_id, $image_size, false, array(
						'class' => "hovered-image {$class}",
						'style' => "margin-left: -{$margin_size}px;",
					)
				);
				$image .= '</span>';
			} elseif ( $item->thumbnail_id ) {
				$image = wp_get_attachment_image( $item->thumbnail_id, $image_size, false, "class=menu-image {$class}" );
			}
			$none  = ''; // Sugar.
			$image = apply_filters( 'menu_image_img_html', $image );
			$class .= ' menu-image-title'; 

			switch ( $position ) {
				case 'hide':
				case 'before':
				case 'above':
					$item_args = array( $none, $class, $title, $image );
					break;
				case 'after':
				default:
					$item_args = array( $image, $class, $title, $none );
					break;
			}

			$title = vsprintf( '%s<span class="%s">%s</span>%s', $item_args );

		}

		return $title;
	}

	public function menu_image_nav_menu_item_filter( $item_output, $item, $depth, $args ) {
		if ( $this->isProcessed( $item->ID ) ) {
			return $item_output;
		}
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes_array = shortcode_parse_atts( $attributes );

		$image_size = $item->image_size ? $item->image_size : apply_filters( 'menu_image_default_size', 'menu-36x36' );
		$position   = $item->title_position ? $item->title_position : apply_filters( 'menu_image_default_title_position', 'after' );
		$class      = "menu-image-title-{$position}";
		$this->setUsedAttachments( $image_size, $item->thumbnail_id );
		$image = '';
		if ( $item->thumbnail_hover_id ) {
			$this->setUsedAttachments( $image_size, $item->thumbnail_hover_id );
			$hover_image_src = wp_get_attachment_image_src( $item->thumbnail_hover_id, $image_size );
			$margin_size     = $hover_image_src[1];
			$image           = "<span class='menu-image-hover-wrapper'>";
			$image .= wp_get_attachment_image( $item->thumbnail_id, $image_size, false, "class=menu-image {$class}" );
			$image .= wp_get_attachment_image(
				$item->thumbnail_hover_id, $image_size, false, array(
					'class' => "hovered-image {$class}",
					'style' => "margin-left: -{$margin_size}px;",
				)
			);
			$image .= '</span>';
			$class .= ' menu-image-hovered';
		} elseif ( $item->thumbnail_id ) {
			$image = wp_get_attachment_image( $item->thumbnail_id, $image_size, false, "class=menu-image {$class}" );
			$class .= ' menu-image-not-hovered';
		}
		$attributes_array['class'] = $class;

		$attributes_array = apply_filters( 'menu_image_link_attributes', $attributes_array, $item, $depth, $args );
		$attributes = '';
		foreach ( $attributes_array as $attr_name => $attr_value ) {
			$attributes .= "{$attr_name}=\"$attr_value\" ";
		}
		$attributes = trim( $attributes );

		$item_output = "{$args->before}<a {$attributes}>";
		$link        = $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$none		 = ''; // Sugar.
		$image = apply_filters( 'menu_image_img_html', $image );

		switch ( $position ) {
			case 'hide':
			case 'before':
			case 'above':
				$item_args = array( $none, $link, $image );
				break;
			case 'after':
			default:
				$item_args = array( $image, $link, $none );
				break;
		}
		$item_output .= vsprintf( '%s<span class="menu-image-title">%s</span>%s', $item_args );
		$item_output .= "</a>{$args->after}";

		return $item_output;
	}

	public function menu_image_add_inline_style_action() {
		wp_register_style( 'menu-image', get_template_directory_uri() . '/assets/css/menu-image.css', array(), '2.9.5' );
		wp_enqueue_style( 'menu-image' );
	}

	public function menu_image_admin_head_nav_menus_action() {
		wp_enqueue_script( 'menu-image-admin', get_template_directory_uri() . '/assets/js/menu-image-admin.js', array( 'jquery' ), '2.9.5' );
		wp_localize_script(
			'menu-image-admin', 'menuImage', array(
				'l10n'     => array(
					'uploaderTitle'      => __( 'Chose menu image', 'menu-image' ),
					'uploaderButtonText' => __( 'Select', 'menu-image' ),
				),
				'settings' => array(
					'nonce' => wp_create_nonce( 'update-menu-item' ),
				),
			)
		);
		wp_enqueue_media();
		wp_enqueue_style( 'editor-buttons' );
	}

	public function menu_image_delete_menu_item_image_action() {

		$menu_item_id = (int) $_REQUEST['menu-item'];

		check_admin_referer( 'delete-menu_item_image_' . $menu_item_id );

		if ( is_nav_menu_item( $menu_item_id ) && has_post_thumbnail( $menu_item_id ) ) {
			delete_post_thumbnail( $menu_item_id );
			delete_post_meta( $menu_item_id, '_thumbnail_hover_id' );
			delete_post_meta( $menu_item_id, '_menu_item_image_size' );
			delete_post_meta( $menu_item_id, '_menu_item_image_title_position' );
		}
	}

	public function wp_post_thumbnail_only_html( $item_id ) {
		$default_size = apply_filters( 'menu_image_default_size', 'menu-36x36' );
		$markup       = '<p class="description description-thin" ><label>%s<br /><a title="%s" href="#" class="set-post-thumbnail button%s" data-item-id="%s" style="height: auto;">%s</a>%s</label></p>';

		$thumbnail_id = get_post_thumbnail_id( $item_id );
		$content      = sprintf(
			$markup,
			esc_html__( 'Gambar menu', 'menu-image' ),
			$thumbnail_id ? esc_attr__( 'Ubah gambar item menu', 'menu-image' ) : esc_attr__( 'Atur gambar item menu', 'menu-image' ),
			'',
			$item_id,
			$thumbnail_id ? wp_get_attachment_image( $thumbnail_id, $default_size ) : esc_html__( 'Atur gambar', 'menu-image' ),
			$thumbnail_id ? '<a href="#" class="remove-post-thumbnail">' . __( 'Hapus', 'menu-image' ) . '</a>' : ''
		);

		// Menu image on hover if enabled.
		if ( '1' == get_option( 'menu_image_hover', '1' ) ) {
			$hover_id = get_post_meta( $item_id, '_thumbnail_hover_id', true );
			$content .= sprintf(
				$markup,
				esc_html__( 'Gambar saat diarahkan', 'menu-image' ),
				$hover_id ? esc_attr__( 'Ubah gambar item menu pada hover', 'menu-image' ) : esc_attr__( 'Atur gambar item menu pada hover', 'menu-image' ),
				' hover-image',
				$item_id,
				$hover_id ? wp_get_attachment_image( $hover_id, $default_size ) : esc_html__( 'Setel gambar saat diarahkan', 'menu-image' ),
				$hover_id ? '<a href="#" class="remove-post-thumbnail hover-image">' . __( 'Hapus', 'menu-image' ) . '</a>' : ''
			);
		}

		return $content;
	}
	public function wp_post_thumbnail_html( $item_id ) {
		$default_size = apply_filters( 'menu_image_default_size', 'menu-36x36' );
		$content      = $this->wp_post_thumbnail_only_html( $item_id );

		$image_size = get_post_meta( $item_id, '_menu_item_image_size', true );
		if ( ! $image_size ) {
			$image_size = $default_size;
		}
		$title_position = get_post_meta( $item_id, '_menu_item_image_title_position', true );
		if ( ! $title_position ) {
			$title_position = apply_filters( 'menu_image_default_title_position', 'after' );
		}

		ob_start();
		?>

		<div class="menu-item-image-options">
			<p class="description description-wide">
				<label for="edit-menu-item-image-size-<?php echo $item_id; ?>"><?php _e( 'Ukuran gambar', 'menu-image' ); ?>
					<br />
					<select id="edit-menu-item-image-size-<?php echo $item_id; ?>"
							class="widefat edit-menu-item-image-size"
							name="menu_item_image_size[<?php echo $item_id; ?>]">
						<option value='full' <?php echo $image_size == 'full' ? ' selected="selected"' : '' ?>><?php _e( 'Original Size', 'menu-image' ); ?></option>
						<?php 
						foreach ( get_intermediate_image_sizes() as $size ) :
							printf(
								"<option value='%s'%s>%s</option>\n",
								esc_attr( $size ),
								$image_size == $size ? ' selected="selected"' : '',
								ucfirst( $size )
							); ?>
						<?php endforeach; ?>
					</select>
				</label>
			</p>
			<p class="description description-wide">
				<label><?php _e( 'Posisi judul', 'menu-image' ); ?></label><br />
				<?php
				$positions = array(
					'hide'   => __( 'Sembunyi', 'menu-image' ),
					'above'  => __( 'Atas', 'menu-image' ),
					'below'  => __( 'Bawah', 'menu-image' ),
					'before' => __( 'Setelah', 'menu-image' ),
					'after'  => __( 'Sebelum', 'menu-image' ),
				);
				foreach ( $positions as $position => $label ) :
					printf(
						"<label><input type='radio' name='menu_item_image_title_position[%s]' value='%s'%s/> %s</label>%s",
						$item_id,
						esc_attr( $position ),
						$title_position == $position ? ' checked="checked"' : '',
						$label,
						$position != 'after' ? ' | ' : ''
					);
				endforeach;
				?>

			</p>
		</div>

		<?php
		$content = "<div class='menu-item-images' style='min-height:70px'>$content</div>" . ob_get_clean();

		return apply_filters( 'admin_menu_item_thumbnail_html', $content, $item_id );
	}

	public function wp_ajax_set_menu_item_thumbnail() {
		$json = ! empty( $_REQUEST['json'] );

		$post_ID = intval( $_POST['post_id'] );
		if ( ! current_user_can( 'edit_post', $post_ID ) ) {
			wp_die( - 1 );
		}

		$thumbnail_id = intval( $_POST['thumbnail_id'] );
		$is_hovered   = (bool) $_POST['is_hover'];

		check_ajax_referer( 'update-menu-item' );

		if ( $thumbnail_id == '-1' ) {
			if ( $is_hovered ) {
				$success = delete_post_meta( $post_ID, '_thumbnail_hover_id' );
			} else {
				$success = delete_post_thumbnail( $post_ID );
			}
		} else {
			if ( $is_hovered ) {
				$success = update_post_meta( $post_ID, '_thumbnail_hover_id', $thumbnail_id );
			} else {
				$success = set_post_thumbnail( $post_ID, $thumbnail_id );
			}
		}

		if ( $success ) {
			$return = $this->wp_post_thumbnail_only_html( $post_ID );
			$json ? wp_send_json_success( $return ) : wp_die( $return );
		}

		wp_die( 0 );
	}

	public function menu_item_custom_fields( $item_id, $item, $depth, $args ) {
		if ( ! $item_id && isset( $item->ID ) ) {
			$item_id = $item->ID;
		}
		?>
		<div class="field-image hide-if-no-js wp-media-buttons">
			<?php echo $this->wp_post_thumbnail_html( $item_id ); ?>
		</div>
	<?php
	}

	public function jetpack_photon_override_image_downsize_filter( $prevent, $data ) {
		return $this->isAttachmentUsed( $data[ 'attachment_id' ], $data[ 'size' ] );
	}

	public function setUsedAttachments( $size, $id ) {
		$this->used_attachments[ $size ][ ] = $id;
	}

	public function isAttachmentUsed( $id, $size = null ) {
		if ( ! is_null( $size ) ) {
			return is_string( $size ) && isset( $this->used_attachments[ $size ] ) && in_array( $id, $this->used_attachments[ $size ] );
		} else {
			foreach ( $this->used_attachments as $used_attachment ) {
				if ( in_array( $id, $used_attachment ) ) {
					return true;
				}
			}
			return false;
		}
	}

	public function wp_get_attachment_image_attributes( $attr, $attachment, $size ) {
		if ( $this->isAttachmentUsed( $attachment->ID, $size ) ) {
			unset( $attr['sizes'], $attr['srcset'] );
		}

		return $attr;
	}

	protected function setProcessed( $id ) {
		$this->processed[] = $id;
	}
	protected function isProcessed( $id ) {
		return in_array( $id, $this->processed );
	}
}

$menu_image = new Menu_Image_Plugin();

require_once( ABSPATH . 'wp-admin/includes/nav-menu.php' );

class Menu_Image_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = false;
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) ) {
				$original_title = false;
			}
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = get_the_title( $original_object->ID );
		} elseif ( 'post_type_archive' == $item->type ) {
			$original_object = get_post_type_object( $item->object );
			if ( $original_object ) {
				$original_title = $original_object->labels->archives;
			}
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( __( '%s (Invalid)' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __( '%s (Pending)' ), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		?>
		<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode( ' ', $classes ); ?>">
			<div class="menu-item-bar">
				<div class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up" aria-label="<?php esc_attr_e( 'Move up' ); ?>">&#8593;</a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down" aria-label="<?php esc_attr_e( 'Move down' ) ?>">&#8595;</a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>" aria-label="<?php esc_attr_e( 'Edit menu item' ); ?>"><span class="screen-reader-text"><?php _e( 'Edit' ); ?></span></a>
					</span>
				</div>
			</div>

			<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo $item_id; ?>">
				<?php if ( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo $item_id; ?>">
							<?php _e( 'URL' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-wide">
					<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<?php _e( 'Navigation Label' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="field-title-attribute field-attr-title description description-wide">
					<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
						<?php _e( 'Title Attribute' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php _e( 'Open link in a new tab' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
						<?php _e( 'CSS Classes (optional)' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
						<?php _e( 'Link Relationship (XFN)' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>

				<?php
				// This is the added section
				do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );
				// end added section
				?>

				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo $item_id; ?>">
						<?php _e( 'Description' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.'); ?></span>
					</label>
				</p>

				<fieldset class="field-move hide-if-no-js description description-wide">
					<span class="field-move-visual-label" aria-hidden="true"><?php _e( 'Move' ); ?></span>
					<button type="button" class="button-link menus-move menus-move-up" data-dir="up"><?php _e( 'Up one' ); ?></button>
					<button type="button" class="button-link menus-move menus-move-down" data-dir="down"><?php _e( 'Down one' ); ?></button>
					<button type="button" class="button-link menus-move menus-move-left" data-dir="left"></button>
					<button type="button" class="button-link menus-move menus-move-right" data-dir="right"></button>
					<button type="button" class="button-link menus-move menus-move-top" data-dir="top"><?php _e( 'To the top' ); ?></button>
				</fieldset>

				<div class="menu-item-actions description-wide submitbox">
					<?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( __('Original: %s'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php _e( 'Remove' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e( 'Cancel' ); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}
}
?>