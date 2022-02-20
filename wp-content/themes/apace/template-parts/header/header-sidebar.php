<?php

if ( ! is_active_sidebar( 'sidebar-apace-header' ) ) {
	return;
}

?>

<div class="apa-header-widget-area">
    <?php dynamic_sidebar( 'sidebar-apace-header' ); ?>
</div><!-- .apa-header-widget-area -->