<?php 
if (is_active_sidebar('sticky_ads_left')) :?>
	<div class="sticky-ads-left">
		<?php dynamic_sidebar('sticky_ads_left'); ?>
	</div>
<?php endif; ?>
<?php 
if (is_active_sidebar('sticky_ads_right')) :?>
	<div class="sticky-ads-right">
		<?php dynamic_sidebar('sticky_ads_right'); ?>
	</div>
<?php endif; ?>