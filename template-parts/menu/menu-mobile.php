<div class="sidebarmenu">
	<div class="menu-header">
		<div class="menu-title">Menu</div>
		<button class="menuclose" aria-label="Close"></button>
	</div>
	<div class="menu-content">
	<?php 
	if (is_active_sidebar('sidebar_menu')) :
		dynamic_sidebar('sidebar_menu');
	endif;
	 ?>
	</div>
</div>
<div class="sidebarmenu-transparent"></div>