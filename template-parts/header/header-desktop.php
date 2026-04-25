<header class="header">
	<div class="header-box">
		<div class="header-container">
			<div class="header-wrapper">
				<div class="header-top">
					<div class="header-top-box">
						<div class="header-top-wrapper">
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
							<div class="header-search">
								<form class="header-search-form" method="get" action="<?php echo home_url('/'); ?>">
									<div class="header-search-wrapper">
										<button type="submit" class="icon-search" aria-label="Search"></button>
										<input  class="header-input-search" type="text" name="s" placeholder="Cari di sini..." value="<?php the_search_query(); ?>" maxlength="50">
    									<input type="hidden" name="post_type" value="post" />
									</div>
								</form>
							</div>
							<div class="header-more">
								<div class="header-button">
									<?php
								    if ( true == get_theme_mod( 'homepage', true )) :
										echo '<a class="icon-home" aria-label="Home" href="' . home_url() . '"></a>';
								    endif;
								    if ( true == get_theme_mod( 'darkmode', true )) :
										echo '<button aria-label="Dark Mode" class="mode icon-darkmode"></button>';
									endif; 
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="header-bottom">
					<div class="header-bottom-box">
						<div class="header-menu">
							<?php desktop_menu(); ?>
						</div>
						<div class="header-submenu">
							<?php header_submenu1(); ?>
							<?php header_submenu2(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<footer class="footer">
	<div class="footer-container">
		<div class="footer-box">
			<?php
			if (is_active_sidebar('footer_area')) :
				dynamic_sidebar('footer_area');
			endif;
			?>
		</div>
	</div>
</footer>
<div class="transparent-footer"></div>