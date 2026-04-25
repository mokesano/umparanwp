<?php 
function like_script() {
wp_enqueue_script( 'jslike', get_template_directory_uri() . '/assets/js/like.js', array('jquery'), '1.0.0', true );
    wp_localize_script( 'jslike', 'MyAjax', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'security' => wp_create_nonce( 'my-special-string' )
    ));
}
add_action( 'wp_enqueue_scripts', 'like_script' );

function get_client_ip() {
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
    $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function table_like() {
    global $wpdb;
    $table_name = $wpdb->prefix. "post_like_table";
    global $charset_collate;
    $charset_collate = $wpdb->get_charset_collate();
    global $db_version;

    if( $wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name){ 
        $create_sql = "CREATE TABLE " . $table_name . " (
        id INT(11) NOT NULL auto_increment,
        postid INT(11) NOT NULL ,
        clientip VARCHAR(40) NOT NULL ,
        PRIMARY KEY (id))$charset_collate;";
        require_once(ABSPATH . "wp-admin/includes/upgrade.php");
        dbDelta( $create_sql );
    }

    //register the new table with the wpdb object
    if (!isset($wpdb->post_like_table)){
        $wpdb->post_like_table = $table_name;
        //add the shortcut so you can use $wpdb->stats
        $wpdb->tables[] = str_replace($wpdb->prefix, '', $table_name);
    }
}
add_action( 'init', 'table_like');
function my_action_callback() {
    check_ajax_referer( 'my-special-string', 'security' );
    $postid = intval( $_POST['postid'] );
    $clientip=get_client_ip();
    $like=0;
    $dislike=0;
    $like_count=0;
        global $wpdb;
        $row = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid' AND clientip = '$clientip'");
        if(empty($row)){
            $wpdb->insert( $wpdb->post_like_table, array( 'postid' => $postid, 'clientip' => $clientip ), array( '%d', '%s' ) );
            $like=1;
        }
        if(!empty($row)){
            $wpdb->delete( $wpdb->post_like_table, array( 'postid' => $postid, 'clientip'=> $clientip ), array( '%d','%s' ) );
            $dislike=1;
        }
    $totalrow = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid'");
    $total_like=$wpdb->num_rows;
    $data=array( 'postid'=>$postid,'likecount'=>$total_like,'clientip'=>$clientip,'like'=>$like,'dislike'=>$dislike);
    echo json_encode($data);
    die();
}
add_action( 'wp_ajax_my_action', 'my_action_callback' );
add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );

function class_like(){
    global $wpdb;
    $code = '';
    $l=0;
    $postid=get_the_id();
    $clientip=get_client_ip();
    $row1 = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid' AND clientip = '$clientip'");

    if(!empty($row1)){
        $l=1;
    }

    $totalrow1 = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid'");
    if($l==1) {
        $code = 'liked';
    }
    return $code;
}

function button_like(){
    global $wpdb;
    $l=0;
    $postid=get_the_id();
    $clientip=get_client_ip();
    $row = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid' AND clientip = '$clientip'");

    if(!empty($row)){
        $l=1;
    }

    $totalrow = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid'");
    $total_like = $wpdb->num_rows;

     if($total_like > 99){$count = "99+";}else if($total_like > 1000){$count = "1K+";}else if($total_like > 2000){$count = "2K+";}else if($total_like > 3000){$count = "3K+";}else if($total_like > 4000){$count = "4K+";}else if($total_like > 5000){$count = "5K+";}else if($total_like > 6000){$count = "6K+";}else if($total_like > 7000){$count = "7K+";}else if($total_like > 8000){$count = "8K+";}else if($total_like > 9000){$count = "9K+";}else if($total_like > 10000){$count = "10K+";}else if($total_like > 20000){$count = "20K+";}else if($total_like > 30000){$count = "30K+";}else if($total_like > 40000){$count = "40K+";}else if($total_like > 50000){$count = "50K+";}else if($total_like > 60000){$count = "60K+";}else if($total_like > 70000){$count = "70K+";}else if($total_like > 80000){$count = "80K+";}else if($total_like > 90000){$count = "90K+";}else if($total_like > 100000){$count = "100K+";}else{$count = $total_like;}
     
    $code = $count;
    return $code;
}
function comment_count(){
    $number = get_comments_number();
     if($number > 99){$count = "99+";}else if($number > 1000){$count = "1K+";}else if($number > 2000){$count = "2K+";}else if($number > 3000){$count = "3K+";}else if($number > 4000){$count = "4K+";}else if($number > 5000){$count = "5K+";}else if($number > 6000){$count = "6K+";}else if($number > 7000){$count = "7K+";}else if($number > 8000){$count = "8K+";}else if($number > 9000){$count = "9K+";}else if($number > 10000){$count = "10K+";}else if($number > 20000){$count = "20K+";}else if($number > 30000){$count = "30K+";}else if($number > 40000){$count = "40K+";}else if($number > 50000){$count = "50K+";}else if($number > 60000){$count = "60K+";}else if($number > 70000){$count = "70K+";}else if($number > 80000){$count = "80K+";}else if($number > 90000){$count = "90K+";}else if($number > 100000){$count = "100K+";}else{$count = $number;}

    $code = $count;
    return $code;
}
function format_kmbt($num) {
    if( $num > 1000 ) {
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('K+', 'M+', 'B+', 'T+');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];
        return $x_display;
    }

    return $num;
}
?>