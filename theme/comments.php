<?php if ( 'open' == $post->comment_status ) : ?>

<?php if ( have_comments() ) : ?>
	<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'morph' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s thought on &ldquo;%2$s&rdquo;',
							'%1$s thoughts on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'morph'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h2>

		<ol class="comment-list">
			<?php wp_list_comments( 'type=comment&callback=morph_list_comments' ); ?>
		</ol><!-- /comment-list -->
<?php endif; ?>


<div id="respond">

<h3><?php comment_form_title(); ?></h3>

<?php cancel_comment_reply_link(); ?>

<?php if ( get_option( 'comment_registration' ) && !$user_ID ) : ?>

<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option( 'siteurl' ); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>

<p>
<label for="author">Name <?php if ( $req ) echo "( required )"; ?></label>
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
</p>

<p>
<label for="email">Email ( <?php if ( $req ) echo "required, "; ?>never shared )</label>
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
</p>

<p>
<label for="url">Website</label>
<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
</p>

<?php endif; ?>

<p>
<label for="comment">Comment</label>
<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
</p>

<p><input name="submit" type="submit" id="submit" class="button" tabindex="5" value="Post Comment" /></p>
<?php do_action( 'comment_form', $post->ID ); comment_id_fields(); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // If comments are open: delete this and the sky will fall on your head ?>