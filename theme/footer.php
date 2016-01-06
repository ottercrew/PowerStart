		</div> <!-- /container -->
		<footer>
			<div class="row expanded callout secondary">
				<div class="large-4 columns">
					<?php if ( is_active_sidebar( 'ff-sidebar' ) ) : ?>
						<?php dynamic_sidebar( 'ff-sidebar' ); ?>
					<?php endif; ?>
				</div>
				<div class="large-4 columns">					
					<?php if ( is_active_sidebar( 'sf-sidebar' ) ) : ?>
						<?php dynamic_sidebar( 'sf-sidebar' ); ?>
					<?php endif; ?>
				</div>
				<div class="large-4 columns">
					<?php if ( is_active_sidebar( 'thf-sidebar' ) ) : ?>
						<?php dynamic_sidebar( 'thf-sidebar' ); ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="row expanded">
				<div class="medium-6 columns">
					<?php 
					   	/**
						* Displays a navigation menu
						* @param array $args Arguments
						*/
						$args = array(
							'theme_location' => 'footer',
							'container_id' => 'footer-menu',
						);
					
						wp_nav_menu( $args );
					?>
				</div>
				<div class="medium-6 columns">
					<ul class="menu align-right">
						<li class="menu-text">Copyright © 2015 OtterCrew</li>
					</ul>
				</div>
			</div>
		</footer> <!-- /footer -->

		<?php wp_footer(); ?>
	</body>
</html>