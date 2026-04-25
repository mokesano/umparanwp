<?php 
function customthumbnail($id, $size){
	$code = "";
	if ( has_post_thumbnail($id) ) {
		$code .= get_the_post_thumbnail( $id, $size );
	}
	return $code;
}
?>