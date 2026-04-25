<?php 
function lightboximage($content) {
    global $post;
    $pattern        = array('{<figure class="wp-block-image(.*?)"><img loading="(.*?)" width="(.*?)" height="(.*?)" src="(.*?)"(.*?) />}','{</figure>}');
    $replacement    = array('<figure class="wp-block-image$1"><a data-fslightbox="gallery" href="$5"><div class="btn-viewbox"><button class="btn-biew"><i class="icon-serch"></i><span class="text-view">Perbesar</span></button>
        </div><img loading="$2" width="$3" height="$4" src="$5"$6/></a>','</figure>');
    $content        = preg_replace($pattern,$replacement,$content);
    return $content;
 }
 add_filter('the_content','lightboximage');

function lightboxgallery($content) {
    global $post;
    $pattern        = array('{<li class="blocks-gallery-item"><figure><a href="(.*?)">}','{</a></figure></li>}');
    $replacement    = array('<li class="blocks-gallery-item"><figure><a data-fslightbox="gallery" href="$1">','</a></figure></li>');
    $content        = preg_replace($pattern,$replacement,$content);
    return $content;
 }
 add_filter('the_content','lightboxgallery');

function lightboxiframe($content) {
    global $post;
    $pattern        = array('{<iframe loading="(.*?)" title="(.*?)" width="(.*?)" height="(.*?)" src="(.*?)"(.*?)}','{</iframe>}');
    $replacement    = array('<a data-fslightbox="gallery" href="$5"><iframe loading="$1" title="$2" width="$3" height="$4" src="$5"$6','</iframe></a>');
    $content        = preg_replace($pattern,$replacement,$content);
    return $content;
 }
 add_filter('the_content','lightboxiframe');
 ?>