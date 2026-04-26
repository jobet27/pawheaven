<?php
/**
 * Template part for displaying an animal in a grid
 */

$id     = get_the_ID();
$status = get_post_meta( $id, '_animal_status', true ) ?: 'available';
$age    = wp_get_post_terms( $id, 'age_range', array( 'fields' => 'names' ) )[0] ?? '';
$size   = wp_get_post_terms( $id, 'animal_size', array( 'fields' => 'names' ) )[0] ?? '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'animal-card animate-on-scroll' ); ?>>
    <div class="animal-card-inner">
        <div class="animal-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'animal-card' ); ?>
                <?php else : ?>
                    <img src="https://images.unsplash.com/photo-1517849845537-4d257902454a?auto=format&fit=crop&w=600&q=80" alt="<?php the_title(); ?>">
                <?php endif; ?>
            </a>
            <span class="animal-status status-<?php echo esc_attr( $status ); ?>">
                <?php echo esc_html( pawhaven_get_animal_status_label( $status ) ); ?>
            </span>
        </div>

        <div class="animal-content">
            <h3 class="animal-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            
            <div class="animal-meta">
                <?php if ( $age ) : ?>
                    <span class="animal-age"><?php echo esc_html( $age ); ?></span>
                <?php endif; ?>
                <?php if ( $size ) : ?>
                    <span class="animal-separator">•</span>
                    <span class="animal-size"><?php echo esc_html( $size ); ?></span>
                <?php endif; ?>
            </div>

            <div class="animal-excerpt">
                <?php echo wp_trim_words( get_the_excerpt(), 12 ); ?>
            </div>

            <div class="card-footer">
                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">
                    <?php _e( 'Learn More', 'pawhaven' ); ?>
                </a>
            </div>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
