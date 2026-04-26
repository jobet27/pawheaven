<?php
/**
 * The template for displaying single animal posts
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <?php
    $id     = get_the_ID();
    $status = get_post_meta( $id, '_animal_status', true ) ?: 'available';
    $age    = wp_get_post_terms( $id, 'age_range', array( 'fields' => 'names' ) )[0] ?? '';
    $size   = wp_get_post_terms( $id, 'animal_size', array( 'fields' => 'names' ) )[0] ?? '';
    $temperament = get_post_meta( $id, '_animal_temperament', true );
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'animal-single-container' ); ?>>
        <div class="container">
            <div class="animal-single-grid">
                
                <!-- Left: Visuals -->
                <div class="animal-gallery animate-on-scroll">
                    <div class="animal-main-image">
                        <?php the_post_thumbnail( 'animal-single' ); ?>
                    </div>
                </div>

                <!-- Right: Content & CTA -->
                <div class="animal-info animate-on-scroll">
                    <div class="info-header">
                        <span class="status-badge ph-badge-info"><?php echo esc_html( pawhaven_get_animal_status_label( $status ) ); ?></span>
                        <h1 class="animal-name"><?php the_title(); ?></h1>
                        <div class="quick-meta">
                            <span><strong><?php _e('Age:', 'pawhaven'); ?></strong> <?php echo esc_html( $age ); ?></span>
                            <span class="sep">•</span>
                            <span><strong><?php _e('Size:', 'pawhaven'); ?></strong> <?php echo esc_html( $size ); ?></span>
                        </div>
                    </div>

                    <div class="animal-description entry-content">
                        <?php the_content(); ?>
                    </div>

                    <div class="animal-attributes">
                        <div class="attr-item">
                            <span class="attr-label"><?php _e('Temperament', 'pawhaven'); ?></span>
                            <span class="attr-value"><?php echo esc_html( $temperament ?: __('Friendly & Calm', 'pawhaven') ); ?></span>
                        </div>
                    </div>

                    <div class="animal-actions">
                        <a href="#adopt-form" class="btn btn-primary btn-lg btn-block"><?php _e('Apply to Adopt', 'pawhaven'); ?></a>
                        <a href="<?php echo esc_url( pawhaven_get_donate_url() ); ?>" class="btn btn-secondary btn-lg btn-block"><?php _e('Sponsor this Friend', 'pawhaven'); ?></a>
                    </div>
                </div>

            </div>
        </div>
    </article>

<?php endwhile; ?>

<?php
get_footer();
