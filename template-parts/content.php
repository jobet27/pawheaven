<?php
/**
 * Template part for displaying posts
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card mb-12 animate-on-scroll' ); ?>>
	<header class="entry-header mb-4">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta color-text-muted text-sm mt-2">
				<?php echo get_the_date(); ?> • <?php the_author(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail mb-6 rounded-lg overflow-hidden">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		if ( is_singular() ) :
			the_content();
		else :
			the_excerpt();
			?>
			<a href="<?php the_permalink(); ?>" class="btn btn-outline mt-4"><?php _e('Read More →', 'pawhaven'); ?></a>
			<?php
		endif;
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
