<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
?>

<?php get_header(); ?>

	<br>
	<div class="row">
	    <main class="large-8 columns" role="main">
	    	<header class="page-header">
				<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'morph' ); ?></h1>
			</header><!-- /page-header -->

			<div class="page-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'morph' ); ?></p>

				<?php get_search_form(); ?>
			</div><!-- /page-content -->
	    </main>
	    
	    <?php get_sidebar(); ?>
	    
	</div>

<?php get_footer(); ?>
