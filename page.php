<?php
/**
 * The template for displaying all pages
 */

get_header(); ?>

<div class="container container-content py-20">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header mb-10">
				<?php the_title( '<h1 class="entry-title text-5xl">', '</h1>' ); ?>
			</header>

			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pawhaven' ),
					'after'  => '</div>',
				) );
				?>
			</div>
		</article>
		<?php
	endwhile;
	?>
</div>

<?php
get_footer();
