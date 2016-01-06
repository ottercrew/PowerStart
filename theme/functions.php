<?php 
	if ( ! function_exists( 'morph_setup' ) ) :
		function morph_setup() {

			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * If you're building a theme based on morph, use a find and replace
			 * to change 'morph' to the name of your theme in all the template files
			 */
			load_theme_textdomain( 'morph', get_template_directory() . '/languages' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
			 */
			add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size( 370, 250, true );

			add_image_size( 'post', 769, 350, true );

			// This theme uses wp_nav_menu() in two locations.
			register_nav_menus( array(
				'top' =>     __('Top Menu', 'morph'),
				'primary' => __( 'Primary Menu', 'morph' ),
				'footer'  => __( 'Footer Menu', 'morph' ),
			) );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
			) );

			/*
			 * Enable support for Post Formats.
			 *
			 * See: https://codex.wordpress.org/Post_Formats
			 */
			add_theme_support( 'post-formats', array(
				'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
			) );

			// Setup the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( 'morph_custom_background_args', array(
				'default-color'      => '#ffffff',
				'default-attachment' => 'fixed',
			) ) );

		}
		endif; // morph_setup
	add_action( 'after_setup_theme', 'morph_setup' );

	/**
	 * Register widget area.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	function morph_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Sidebar', 'morph' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="lead">',
			'after_title'   => '</h5>',
		) );
		register_sidebar( array(
			'name'          => __( 'First Footer Sidebar', 'morph' ),
			'id'            => 'ff-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>',
		) );
		register_sidebar( array(
			'name'          => __( 'Second Footer Sidebar', 'morph' ),
			'id'            => 'sf-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>',
		) );
		register_sidebar( array(
			'name'          => __( 'Third Footer Sidebar', 'morph' ),
			'id'            => 'thf-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>',
		) );
	}
	add_action( 'widgets_init', 'morph_widgets_init' );

	/**
	 * Enqueue scripts and styles.
	 */
	function morph_scripts() {

		// Enqueue styles
		wp_enqueue_style( 'morph-style', get_stylesheet_uri() );
		wp_enqueue_style( 'foundation', get_template_directory_uri() . '/css/foundation.css', array(), '6.0.5' );
		wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css', array(), '1.0.0' );

		// Enqueue scripts
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/foundation.js', array(), '6.0.5', true );
		wp_enqueue_script( 'what-input', get_template_directory_uri() . '/js/what-input.js', array(), '1.0.0', true );
		wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}
	add_action( 'wp_enqueue_scripts', 'morph_scripts' );

	/**
	 * Topbar Walker
	 */
	class Topbar_Walker extends Walker_Nav_Menu {
	    function start_lvl(&$output, $depth = 0, $args = Array() ) {
	        $indent = str_repeat("\t", $depth);
	        $output .= "\n$indent<ul class=\"menu\">\n";
	    }
	}

	/**
	 * Custom List Comments
	 */
	function morph_list_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
	?>
		<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		<?php printf( __( '<span class="fn">%s</span> <span class="says">on</span>' ), get_comment_author_link() ); ?>
		<span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
			?>
		</span>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
		<?php endif; ?>
		<br>
		<br>
		<?php comment_text(); ?>
		</div>
		<div class="reply">
		<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
		<br>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
	<?php
	}

?>