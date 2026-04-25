<?php 
add_shortcode( 'terkini', 'terkini_shortcode' );
function terkini_shortcode( $atts ) {
	global $post;
	$slug = $atts["category"];
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	if($slug == ""){
		$argsterkini = array(
			'post_type' => 'post',
			'post_status' => 'publish',
            'paged' => $paged
		);
	}else{
		$argsterkini = array(
			'category_name' => $slug,
			'post_type' => 'post',
			'post_status' => 'publish',
            'paged' => $paged
		);
	}
	$konten = "";
	$my_terkini = new WP_Query( $argsterkini );
	if ( $my_terkini->have_posts() ):
		$konten .= '<div class="widget-content">';
		while ( $my_terkini->have_posts() ) {
			$my_terkini->the_post();
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
        $total_pages = $my_terkini->max_num_pages;
        if ($total_pages > 1){
            $current_page = max(1, get_query_var('paged'));
			$konten .= '<div class="pagination"><div class="paginationNext">';
			$konten .= get_next_posts_link('Lihat lainnya', $my_terkini->max_num_pages );
			$konten .= '</div></div>';
        }
	endif;
	wp_reset_postdata();
	return '<div class="list-wrap">' . $konten . '</div>';
}
?>