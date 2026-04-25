<?php 
function post_read_time($id) {
	$content = get_post_field( 'post_content', $id );
	$word_count = str_word_count( strip_tags( $content ) );
	$readingtime = ceil($word_count / 200);
		if ($readingtime == 1) {
		 $timer = " menit";
		} else {
		 $timer = " menit";
		}
	$totalreadingtime = "waktu baca " . $readingtime . $timer;
	return $totalreadingtime;
}
?>