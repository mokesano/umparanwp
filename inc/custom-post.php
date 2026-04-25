<?php 
add_filter( 'wpseo_metabox_prio', 'yoast_metabox_down' );
function yoast_metabox_down( $priority ) {
    return 'low';
}
function tim_add_metabox() {
    add_meta_box(
        'tim_metabox_id',
        'Tampilan Tim Redaksi',
        'tim_metabox_form',
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'tim_add_metabox' );

function tim_metabox_form() {
    global $post;
    global $user_ID;
    $wp_user_search = new WP_User_Search($usersearch = '', $userspage = '');
    $authors = join( ', ', $wp_user_search->get_results() );
    $meta = get_post_meta( $post->ID, 'tim', true ); ?>

    <input type="hidden" name="tim_metabox" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
    <p>
    <label for="tim[editor]">Editor:</label>
    <?php
    if(empty($meta['editor'])){
        $valueeditor = "-1";
    }else{
        $valueeditor = $meta['editor'];
    }
    wp_dropdown_users( array(
        'include' => $authors,
        'show_option_none'   => 'Pilih Editor',
        'who' => 'authors',
        'name' => 'tim[editor]',
        'id' => 'tim[editor]',
        'selected' => $valueeditor,
        'include_selected' => true,
        'orderby'           => 'display_name',
        'order'             => 'ASC'
    ) );
    ?>
    </p>
    <p>
    <label for="tim[reporter]">Reporter:</label>
    <?php
    if(empty($meta['reporter'])){
        $valuereporter = "-1";
    }else{
        $valuereporter = $meta['reporter'];
    }
    wp_dropdown_users( array(
        'include' => $authors,
        'show_option_none'   => 'Pilih Reporter',
        'who' => 'authors',
        'name' => 'tim[reporter]',
        'id' => 'tim[reporter]',
        'selected' => $valuereporter,
        'include_selected' => true
    ) );
    ?>
    </p>
<?php
}

function tim_metabox_control( $post_id ) {
    if ( !wp_verify_nonce( $_POST['tim_metabox'], basename(__FILE__) )) {
        return $post_id;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    if ( 'page' === $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
    }

    $old_tim = get_post_meta( $post_id, 'tim', true );
    $new_tim = $_POST['tim'];

    if ( $new_tim && $new_tim !== $old_tim ) {
        update_post_meta( $post_id, 'tim', $new_tim );
    } elseif ( '' === $new_tim && $old_tim ) {
        delete_post_meta( $post_id, 'tim', $old_tim );
    }
}
add_action( 'save_post', 'tim_metabox_control' );

add_filter('manage_post_posts_columns', 'set_columns');
function set_columns( $column_array ) {
    $column_array['tim[editor]'] = 'Editor';
    $column_array['tim[reporter]'] = 'Reporter';
    return $column_array;
}

add_action('manage_posts_custom_column', 'set_value_columns', 10, 2);
function set_value_columns( $column_name, $post_id ) {
    switch( $column_name ) :
        case 'tim[editor]': {
            $keyeditor = get_post_meta( $post_id, 'tim', true );
            if (!empty($keyeditor['editor'])) {
                if(get_the_author_meta( 'ID', $keyeditor['editor']) != ""){
                echo '<a data-id="'. get_the_author_meta( 'ID', $keyeditor['editor']) .'" href="edit.php?post_type=post&amp;author='. get_the_author_meta( 'ID', $keyeditor['editor']) .'">' . get_the_author_meta( 'display_name', $keyeditor['editor']) . '</a>';
                }else{
                    echo '—';
                }
            }else{
                echo '—';
            }
            break;
        }

        case 'tim[reporter]': {
            $keyreporter = get_post_meta( $post_id, 'tim', true );
            if (!empty($keyreporter['reporter'])) {
                if(get_the_author_meta( 'ID', $keyreporter['reporter']) != ""){
                echo '<a data-id="'. get_the_author_meta( 'ID', $keyreporter['reporter']) .'" href="edit.php?post_type=post&amp;author='. get_the_author_meta( 'ID', $keyreporter['reporter']) .'">' . get_the_author_meta( 'display_name', $keyreporter['reporter']) . '</a>';
                }else{
                    echo '—';
                }
            }else{
                echo '—';
            }
            break;
        }
    endswitch;

}
?>