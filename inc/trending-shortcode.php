<?php 
add_shortcode( 'trending', 'trending_shortcode' );
function trending_shortcode( $atts ) {
	global $post;
	$slug = $atts["category"];
	$rentang = $atts["rentang"];
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	if($slug == ""){
		$argstrending = array(
			'post_type' => 'post',
			'meta_key' => 'post_views_count',
			'orderby'   => 'meta_value_num',
			'post_status' => 'publish',
            'paged' => $paged,
			'order' => 'DESC',
			'date_query' => array(
				array(
					'after' => $rentang,
				),
			)
		);
	}else{
		$argstrending = array(
			'category_name' => $slug,
			'post_type' => 'post',
			'meta_key' => 'post_views_count',
			'orderby'   => 'meta_value_num',
			'post_status' => 'publish',
            'paged' => $paged,
			'order' => 'DESC',
			'date_query' => array(
				array(
					'after' => $rentang,
				),
			)
		);
	}
	$konten = "";
	$my_trending = new WP_Query( $argstrending );
	if ( $my_trending->have_posts() ):
		$konten .= '<div class="widget-content">';
		while ( $my_trending->have_posts() ) {
			$my_trending->the_post();
			$shareURL = get_permalink();
			$shareTitle = str_replace( '%', '%25', get_the_title());
			$socialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
			$konten .= '<div class="list-item">
							<div class="list-box">
								<div class="list-content">
									<div class="list-title">
					    				<h3>
					    					<a href="' . get_permalink() . '">' . get_the_title() . '</a>
					    				</h3>
					    				<div class="list-author">' . get_avatar( get_the_author_meta('ID'), 14 ) . '						    <div class="list-author-name">'. get_the_author() .'</div>
					    					<i class="icon-verification"></i>
					    				</div>
					    			</div>
					    			<div class="list-more">
					    				<div class="list-button">
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
								<div class="list-image">
								<a href="' . get_permalink() . '">' . customthumbnail($post->ID, "image_80_80") . '</a>
								</div>
							</div>
						</div>';
		}
		$konten .= '</div>';
        $total_pages = $my_trending->max_num_pages;
        if ($total_pages > 1){
            $current_page = max(1, get_query_var('paged'));
			$konten .= '<div class="pagination"><div class="paginationNext">';
			$konten .= get_next_posts_link('Lihat lainnya', $my_trending->max_num_pages );
			$konten .= '</div></div>';
        }
	endif;
	wp_reset_postdata();
	return '<div class="list-wrap">' . $konten . '</div>';
}
?>