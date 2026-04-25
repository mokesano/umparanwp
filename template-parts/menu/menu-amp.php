<div [class]="sidebarmenu ? 'sidebarmenu show' : 'sidebarmenu '" class="sidebarmenu hide">
	<div class="menu-header">
		<div class="menu-title">Menu</div>
		<button class="menuclose" aria-label="Close" on="tap:AMP.setState({sidebarmenu: !sidebarmenu})"></button>
	</div>
	<div class="menu-content">
	<?php 
	if (is_active_sidebar('sidebar_menu')) :
		dynamic_sidebar('sidebar_menu');
	endif;
	 ?>
	</div>
</div>
<div [class]="sidebarmenu-transparent ? 'sidebarmenu-transparent show' : 'sidebarmenu-transparent '" class="sidebarmenu-transparent" on="tap:AMP.setState({sidebarmenu: !sidebarmenu})"></div>