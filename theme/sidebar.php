<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */
?>

<div class="large-4 columns" role="complementary">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<aside class="widget-area">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</aside>
	<?php endif; ?>
</div>