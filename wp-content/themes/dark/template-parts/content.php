<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dark
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php dark_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_front_page() or is_home() ) : ?>
	<a class="dark-img-effect" href="<?php echo esc_url(get_permalink( get_the_ID() )); ?>">	

		<div class='tumb-dark'><?php echo  get_the_post_thumbnail(); ?></div>

	</a>			
	<?php the_excerpt(); ?>
	
	<?php else : ?>
	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'dark' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

		?>
	</div><!-- .entry-content -->

	<?php endif; ?>
	<footer class="entry-footer">
		<?php dark_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
