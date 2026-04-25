<header class="header">
	<div class="header-box">
		<div class="header-container">
			<div class="header-wrapper">
				<div class="header-top">
					<div class="header-left">
						<button on="tap:AMP.setState({sidebarmenu: !sidebarmenu}),AMP.setState({sidebarmenu-transparent: !sidebarmenu-transparent})" aria-label="menubar" class="menubar"><i class="icon-menubar"></i></button>
					</div>
					<div class="header-brand">
						<?php 
							if (function_exists('the_custom_logo')) :
								if(has_custom_logo()) :
									echo the_custom_logo();
								endif;
							endif;
							$blogInfo = get_bloginfo('name');
							if (!empty($blogInfo)) : 
								if (is_front_page() && is_home()) :
									brand_h1();
									else :
									brand_p();
								endif;
							endif;
							$description = get_bloginfo( 'description', 'display' );
							if ($description || is_customize_preview()) :
								brand_description($description);
							endif;
						?>
					</div>
					<div class="header-right">
						<div class="header-button">
								<button on="tap:AMP.setState({searchtransparent: !searchtransparent, headersearch: !headersearch})" class="icon-search" aria-label="search"></button>
						</div>
					</div>
				</div>
				<div class="header-bottom">
					<div class="header-bottom-box">
						<div class="header-menu">
							<?php mobile_menu(); ?>
						</div>
					</div>
				</div>
				    <div [class]="headersearch ? 'headersearch show' : 'headersearch hide'" class="headersearch hide">
					<form class="header-search-form" method="get" action="<?php echo home_url('/'); ?>">
						<div class="header-search-wrapper">
							<button type="submit" class="icon-search"></button>
							<input  class="header-input-search" type="text" name="s" placeholder="Cari di sini..." value="<?php the_search_query(); ?>" maxlength="50">
    						<input type="hidden" name="post_type" value="post" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</header>
<div [class]="searchtransparent ? 'searchtransparent show' : 'searchtransparent hide'" class="searchtransparent hide" on="tap:AMP.setState({searchtransparent: !searchtransparent, headersearch: !headersearch})"></div>