<?php 
function timeago(){
    $code = '';
	$setDate = intval(get_the_date('Ymd'));
	$setRentang = intval($setDate) + 1;
	$setToday = intval(date('Ymd'));
	if($setToday > $setRentang):
		$time = get_the_date('j/m/Y');
		$code = '<time class="timeago" datetime="' . get_the_date('c') . '" title="' . $time . '">' . $time . '</time>';
	else:
		$dateFormat = human_time_diff( get_the_time('U'), current_time('timestamp') ) . '';
		$code = '<time class="timeago" datetime="' . get_the_date('c') .'">' . $dateFormat . '</time>';
	endif;
	return $code;
}
?>