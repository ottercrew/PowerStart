<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
        <?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>
	<header>
		<div class="top-bar dark">
			<?php 
			   /**
				* Displays a navigation menu
				* @param array $args Arguments
				*/
				$args = array(
					'theme_location' => 'top',
					'container' => 'div',
					'container_class' => 'top-bar-left',
					'container_id' => 'top-menu',
					'menu_class' => 'menu',
				);
				wp_nav_menu( $args );
			?>
			<div class="top-bar-right">
				<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
					<ul class="menu">
						<li><input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'morph' ) ?>" /></li>
						<li><input type="submit" class="search-submit button" value="<?php echo esc_attr_x( 'Search', 'morph' ) ?>" /></li>
					</ul>
				</form>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="medium-4 columns">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="http://placehold.it/450x183&text=LOGO" alt="company logo"></a></h1>
			</div>
			<div class="medium-8 columns">
				<img src="http://placehold.it/900x175&text=Responsive Ads - ZURB Playground/333" alt="advertisement for deep fried Twinkies">
			</div>
		</div>
		<br>
		<div class="title-bar" data-responsive-toggle="primary-menu" data-hide-for="medium">
		  	<button class="menu-icon" type="button" data-toggle></button>
		  	<div class="title-bar-title">Menu</div>
		</div>
		<?php 
		   /**
			* Displays a navigation menu
			* @param array $args Arguments
			*/
			$args = array(
				'theme_location' => 'primary',
				'container_class' => 'top-bar',
				'container_id' => 'primary-menu',
				'menu_class' => 'vertical medium-horizontal menu',
				'fallback_cb' => false,
				'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
				'depth' => 3,
				'walker' => new Topbar_Walker()
			);
		
			wp_nav_menu( $args );
		?>
	</header> <!-- /header -->
	<div class="container">