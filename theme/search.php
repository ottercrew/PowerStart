<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
?>

<?php get_header(); ?>

	<br>
	<div class="row">
	    <main class="large-8 columns" role="main">
	    	<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'morph' ), get_search_query() ); ?></h1>
				</header><!-- /page-header -->

				<?php
				// Start the loop.
				while ( have_posts() ) : the_post(); ?>

					<?php
					/*
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

				// End the loop.
				endwhile;
			?>
			<div class="pagination">
	            <?php echo paginate_links(); ?>
	        </div> <!-- /pagination -->
			
			<?php
			
			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'content', 'none' );

			endif;
			?>
	    </main>
	    
	   	<?php get_sidebar(); ?>
	    
	</div>

<?php get_footer(); ?>
