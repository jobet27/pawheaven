<?php
/**
 * The template for displaying animal archives (Adopt Page)
 */

get_header(); ?>

<section class="page-hero hero-adopt">
    <div class="container text-center animate-on-scroll">
        <h1 class="page-title"><?php _e('Adopt a Friend', 'pawhaven'); ?></h1>
        <p class="hero-subtitle"><?php _e('Find your perfect companion among our rescue residents.', 'pawhaven'); ?></p>
    </div>
</section>

<div class="container container-adopt">
    <aside class="animal-filters-sidebar">
        <form id="animal-filter-form" class="animal-filters">
            <div class="filter-group">
                <label for="species"><?php _e('Species', 'pawhaven'); ?></label>
                <select name="species" id="species">
                    <option value="all"><?php _e('All Species', 'pawhaven'); ?></option>
                    <?php
                    $species = get_terms( array( 'taxonomy' => 'species' ) );
                    foreach( $species as $term ) : ?>
                        <option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-group">
                <label for="age"><?php _e('Age', 'pawhaven'); ?></label>
                <select name="age" id="age">
                    <option value="all"><?php _e('Any Age', 'pawhaven'); ?></option>
                    <?php
                    $ages = get_terms( array( 'taxonomy' => 'age_range' ) );
                    foreach( $ages as $term ) : ?>
                        <option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-group">
                <label for="size"><?php _e('Size', 'pawhaven'); ?></label>
                <select name="size" id="size">
                    <option value="all"><?php _e('Any Size', 'pawhaven'); ?></option>
                    <?php
                    $sizes = get_terms( array( 'taxonomy' => 'animal_size' ) );
                    foreach( $sizes as $term ) : ?>
                        <option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-group">
                <label for="status"><?php _e('Status', 'pawhaven'); ?></label>
                <select name="status" id="status">
                    <option value="available"><?php _e('Available Only', 'pawhaven'); ?></option>
                    <option value="all"><?php _e('All Residents', 'pawhaven'); ?></option>
                </select>
            </div>
        </form>
    </aside>

    <div class="animal-results">
        <div id="animal-grid" class="animal-grid stagger-grid">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/content', 'animal' );
                endwhile;
            else :
                get_template_part( 'template-parts/content', 'none' );
            endif;
            ?>
        </div>
        
        <?php the_posts_pagination(); ?>
    </div>
</div>

<?php
get_footer();
