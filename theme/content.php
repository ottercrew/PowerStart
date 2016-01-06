<?php
/**
 * The default template for displaying content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="row"> 
		<div class="<?php if (is_single()): ?>small-12<?php else: ?>large-6<?php endif ?> columns">
	        <?php 
	        	if (is_single()) {
	        		the_post_thumbnail('post');
	        	} else {
	        		the_post_thumbnail();
	        	}
	        ?>
	    </div>
	    <div class="<?php if (is_single()): ?>small-12<?php else: ?>large-6<?php endif ?> columns">
	    	<header class="entry-header">
				<?php
					if ( is_single() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( sprintf( '<h5 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
					endif;
				?>
			</header> <!-- /entry-header -->
	        <div class="entry-meta">
	            <span><?php _e('By ', 'Morph'); the_author(); ?> &nbsp;&nbsp;</span>
	            <span><?php echo get_the_date(); ?> &nbsp;&nbsp;</span>
	            <span><?php comments_number(); ?></span>
	        </div> <!-- /entry-meta -->
	        <br>
	        <div class="entry-content">
				<?php 
					if (is_single()) {
						the_content();
					} else {
						the_excerpt();
					} 
				?>
			</div> <!-- /entry-content -->
	    </div>
	</div>

</article> <!-- /post -->
<hr>
