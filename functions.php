<?php 
require 'inc/index.php';
require 'widget/index.php';
add_filter( 'amp_pre_get_permalink', function( $pre, $post_id ) {
    return add_query_arg( amp_get_slug(), '', get_permalink( $post_id ) );
}, 10, 2 );

// add_filter( 'render_block', 'GutenGallery' , 10, 2 );

//   function GutenGallery( $block_content, $block )
//   {
//     if ( 'core/gallery' !== $block['blockName'] || ! isset( $block['attrs']['ids'] ) )
//     {
//       return $block_content;
//     }
//     $li = '';
//     $col = $block['attrs']['columns'];

//     foreach((array) $block['attrs']['ids'] as $id ) {
//       if( $col == "1" || !$col)
//       {
//         $li .= sprintf( '<div class="big"><a data-fslightbox="gallery" href="' . wp_get_attachment_url( $id, 'large') . '">%s</a></div>', wp_get_attachment_image( $id, 'large' ) );
//       }
//       elseif ($col == "2" )
//       {
//         $li .= sprintf( '<div class="small"><a data-fslightbox="gallery" href="' . wp_get_attachment_url( $id, 'large') . '">%s' . '</a></div>', wp_get_attachment_image( $id, 'large' ) );
//       }
//       elseif ($col == "3" )
//       {
//         $li .= sprintf( '<div class="small"><a data-fslightbox="gallery" href="' . wp_get_attachment_url( $id, 'large') . '">%s</a></div>', wp_get_attachment_image( $id, 'large' ) );
//       }

//     }
//     return sprintf( '<div class="grid-x gap-20">%s</div>', $li );

//   }
?>