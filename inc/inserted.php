<?php
//Insert ads after second paragraph of single post content.
add_filter( 'the_content', 'prefix_insert_post_ads' );
function prefix_insert_post_ads( $content ) {
    $category = get_the_category();
    $useCatLink = true;
    if ($category){
        $category_display = '';
        $category_link = '';
        if ( class_exists('WPSEO_Primary_Term') ){
        $wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
        $term = get_term( $wpseo_primary_term );
        if (is_wp_error($term)) { 
            $category_display = $category[0]->name;
            $category_link = $category[0]->slug;
        } else { 
            $category_display = $term->name;
            $category_link = $term->slug;
        }
    } 
    else {
        // Default, display the first category in WP's list of assigned categories
        $category_display = $category[0]->name;
        $category_link = $category[0]->slug;
    }
    // Display category
    $cek = "";
    if ( !empty($category_display) ){
        if ( $useCatLink == true && !empty($category_link) ){
            $cek .= $category_link;
        } else {
            $cek .= "";
        }
    }
    
    }
	if ( ! empty( $cek ) || $cek == "" ) {
		$args = array(
			'category_name' => $cek,
			'post__not_in'        => array( get_queried_object_id() ),
			'post_type' => 'post',
			'post_status' => 'publish',
			'orderby'   => 'date',
			'posts_per_page' => 1
		);
		
    	$ad_code = "";
		$my_query = new wp_query($args);
		if($my_query->have_posts()) {
			while ($my_query->have_posts()) {
				$my_query->the_post();
				if ( "" != (get_theme_mod( 'bacajugatitle' ))) :
					$titleheader = '<div class="related-label">' . get_theme_mod( 'bacajugatitle' ) . '</div>';
				else:
					$titleheader = '<div class="related-label">Baca Juga</div>';
				endif;
				$ad_code .=  
				'<div class="related-item">
				<div class="related-box">
				<div class="related-content">
				' . $titleheader . '
				<div class="related-title">
				<h3>
				<a href="' . get_permalink() . '">' . get_the_title() . '</a>
				</h3>
				<div class="related-author">
				' . get_avatar( get_the_author_meta( 'ID' ), 16 ) . '
				<div class="related-author-name">' . get_the_author() . '</div>
				<i class="icon-verification"></i>
				<span class="dot"></span>
				' . timeago() . '
				</div>
				</div>
				</div>
				<div class="related-image">
				' . customthumbnail($post->ID, "image_80_80") . '
				</div>
				</div>
				</div>';
			}
			wp_reset_postdata();

    		if ( "" != (get_theme_mod( 'bacajugaafter' ))) :
    			$val = get_theme_mod( 'bacajugaafter' );
    		else:
    			$val = 3;
    		endif;
    		
    		if ( is_single() && ! is_admin() ) {
    			if ( true == get_theme_mod( 'bacajugaactive', true )) : 
    				return prefix_insert_after_paragraph( $ad_code, $val, $content );
    			endif;
    		}
return $content;
		}
	}
    
}
 
// Parent Function that makes the magic happen
function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
	$closing_p = '</p>';
	$paragraphs = explode( $closing_p, $content );
	foreach ($paragraphs as $index => $paragraph) {

		if ( trim( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
		}

		if ( $paragraph_id == $index + 1 ) {
			$paragraphs[$index] .= $insertion;
		}
	}
	
	return implode( '', $paragraphs );
}