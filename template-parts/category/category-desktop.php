<?php if (have_posts()): ?>
	<?php get_template_part("template-parts/custom/copylink"); ?>
	<?php
	if ( "" == (get_theme_mod( 'stylearchivegrid' )) &&  "" == (get_theme_mod( 'stylearchivecollection' )) &&  "" == (get_theme_mod( 'stylearchivepoprecent' ))):
		get_template_part("template-parts/category/category-list-desktop");
	else:
		$textcat1 = get_theme_mod( 'stylearchivegrid' );
		$splittedcat1 = explode(",", $textcat1);
		$arrcat1 = "'" . implode("', '", $splittedcat1) ."'";
		$stylearchivegrid1 = "array(". $arrcat1 .")";
		$parsed1 = eval("return " . $stylearchivegrid1 . ";");

		$textcat2 = get_theme_mod( 'stylearchivecollection' );
		$splittedcat2 = explode(",", $textcat2);
		$arrcat2 = "'" . implode("', '", $splittedcat2) ."'";
		$stylearchivecollection2 = "array(". $arrcat2 .")";
		$parsed2 = eval("return " . $stylearchivecollection2 . ";");

		$textcat3 = get_theme_mod( 'stylearchivepoprecent' );
		$splittedcat3 = explode(",", $textcat3);
		$arrcat3 = "'" . implode("', '", $splittedcat3) ."'";
		$stylearchivecollection3 = "array(". $arrcat3 .")";
		$parsed3 = eval("return " . $stylearchivecollection3 . ";");

		if ( "" != (get_theme_mod( 'stylearchivegrid' )) &&  "" == (get_theme_mod( 'stylearchivecollection' )) &&  "" == (get_theme_mod( 'stylearchivepoprecent' ))){
			if (has_category($parsed1)) {
				get_template_part("template-parts/category/category-grid-desktop");
			}else{
				get_template_part("template-parts/category/category-list-desktop");
			}
		}
		 elseif ( "" != (get_theme_mod( 'stylearchivegrid' )) &&  "" != (get_theme_mod( 'stylearchivecollection' )) &&  "" == (get_theme_mod( 'stylearchivepoprecent' ))){
			if (has_category($parsed1)) {
				get_template_part("template-parts/category/category-grid-desktop");
			}else{
				if (has_category($parsed2)) {
					get_template_part("template-parts/category/category-collection-desktop");
				}else{
					get_template_part("template-parts/category/category-list-desktop");
				}
			}
		} elseif ( "" != (get_theme_mod( 'stylearchivegrid' )) &&  "" != (get_theme_mod( 'stylearchivecollection' )) &&  "" != (get_theme_mod( 'stylearchivepoprecent' ))){
			if (has_category($parsed1)) {
				get_template_part("template-parts/category/category-grid-desktop");
			}else{
				if (has_category($parsed2)) {
					get_template_part("template-parts/category/category-collection-desktop");
				}else{
					if (has_category($parsed3)) {
						get_template_part("template-parts/category/category-poprecent-desktop");
					}else{
						get_template_part("template-parts/category/category-list-desktop");
					}
				}
			}
		}
	endif;

	?>
<?php get_template_part("template-parts/custom/share"); ?>
<?php get_template_part("template-parts/custom/sticky-ads"); ?>
<?php else :?>
<?php get_template_part("template-parts/404/index"); ?>
<?php endif; ?>