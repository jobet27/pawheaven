<?php
/**
 * The front page template - Overhauled for Premium Style
 */

get_header(); ?>

<!-- Overhauled Hero Section -->
<section class="section-hero">
    <div class="hero-wrap">
        <img class="hero-image-bg" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero.png' ); ?>" alt="Hero Background">
        <div class="hero-content-overlay animate-on-scroll">
            <h1><?php _e('Give a Second Chance. Find Your Forever Friend.', 'pawhaven'); ?></h1>
            <p><?php _e('Welcome to PawHaven. We rescue, rehabilitate, and rehome companion animals in need.', 'pawhaven'); ?></p>
            <div class="hero-btns">
                <a href="<?php echo get_post_type_archive_link( 'animal' ); ?>" class="btn btn-teal btn-lg"><?php _e('Meet Our Adoptables', 'pawhaven'); ?></a>
                <a href="<?php echo esc_url( home_url( '/volunteer' ) ); ?>" class="btn btn-outline-white btn-lg"><?php _e('Volunteer Today', 'pawhaven'); ?></a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Residents & News Section -->
<section class="section-featured bg-soft-cream py-20">
    <div class="container container-flex-layout">
        <div class="main-content-residents">
            <h2 class="sidebar-title mb-10"><?php _e('Featured Residents', 'pawhaven'); ?></h2>
            
            <div class="resident-grid-horizontal-sidebar">
                <!-- Hardcoded Resident 1 -->
                <div class="resident-card animate-on-scroll">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/charlie.png' ); ?>" alt="Charlie">
                    <div class="resident-info">
                        <h3>Charlie</h3>
                        <p><?php _e('Dog, joyful', 'pawhaven'); ?></p>
                        <a href="#" class="btn-stat btn-solid"><?php _e('View Profile', 'pawhaven'); ?></a>
                    </div>
                </div>

                <!-- Hardcoded Resident 2 -->
                <div class="resident-card animate-on-scroll">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/bella.png' ); ?>" alt="Bella">
                    <div class="resident-info">
                        <h3>Bella</h3>
                        <p><?php _e('Cat, playful', 'pawhaven'); ?></p>
                        <a href="#" class="btn-stat btn-outline"><?php _e('View Profile', 'pawhaven'); ?></a>
                    </div>
                </div>

                <!-- Hardcoded Resident 3 -->
                <div class="resident-card animate-on-scroll">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/cooper.png' ); ?>" alt="Cooper">
                    <div class="resident-info">
                        <h3>Cooper</h3>
                        <p><?php _e('Puppy, happy', 'pawhaven'); ?></p>
                        <a href="#" class="btn-stat btn-solid"><?php _e('View Profile', 'pawhaven'); ?></a>
                    </div>
                </div>

                <!-- Hardcoded Resident 4 -->
                <div class="resident-card animate-on-scroll">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/lucy.png' ); ?>" alt="Lucy">
                    <div class="resident-info">
                        <h3>Lucy</h3>
                        <p><?php _e('Dog, loving', 'pawhaven'); ?></p>
                        <a href="#" class="btn-stat btn-outline"><?php _e('View Profile', 'pawhaven'); ?></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar: Latest News & Events -->
        <aside class="home-sidebar pl-10">
            <div class="sidebar-block mb-12">
                <h2 class="sidebar-title"><?php _e('Latest News', 'pawhaven'); ?></h2>
                <div class="news-list">
                    <article class="news-item">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/news-1.png' ); ?>" class="news-thumb" alt="News">
                        <div class="news-info">
                            <h4><?php _e('New Rescue Van Arrives! Our mission reaches further.', 'pawhaven'); ?></h4>
                            <span><?php _e('3 hours ago', 'pawhaven'); ?></span>
                        </div>
                    </article>
                    <article class="news-item">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/news-2.png' ); ?>" class="news-thumb" alt="News">
                        <div class="news-info">
                            <h4><?php _e('Summer Adoption Event: Meet your match this Saturday!', 'pawhaven'); ?></h4>
                            <span><?php _e('8 hours ago', 'pawhaven'); ?></span>
                        </div>
                    </article>
                </div>
                <a href="#" class="btn btn-teal btn-sm" style="display:inline-block; border-radius:10px; width:auto;"><?php _e('Show more', 'pawhaven'); ?></a>
            </div>

            <div class="sidebar-block">
                <h2 class="sidebar-title"><?php _e('Upcoming Events', 'pawhaven'); ?></h2>
                <div class="news-list">
                     <article class="news-item">
                        <div class="event-date-box" style="background:#f4f1ea; padding:10px; border-radius:12px; text-align:center; min-width:55px;">
                            <span style="display:block; font-size:10px; opacity:0.6; text-transform:uppercase;"><?php _e('FRI', 'pawhaven'); ?></span>
                            <strong style="font-size:20px; color:#1e3a24;">29</strong>
                        </div>
                        <div class="news-info">
                            <h4><?php _e('Community Shelter Clean-up & Volunteer Day', 'pawhaven'); ?></h4>
                            <span><?php _e('9:00 AM - 2:00 PM', 'pawhaven'); ?></span>
                        </div>
                    </article>
                </div>
            </div>
        </aside>
    </div>
</section>

<!-- Donation Impact Section -->
<section class="section-donation-impact py-24 bg-white">
    <div class="container">
        <div class="section-header text-center mb-16 animate-on-scroll">
            <h2 class="sidebar-title mb-4"><?php _e('Our Life-Saving Work Starts with You', 'pawhaven'); ?></h2>
            <p class="section-subtitle max-w-2xl mx-auto"><?php _e('Every donation, no matter the size, provides essential care for our residents as they wait for their forever homes.', 'pawhaven'); ?></p>
        </div>

        <div class="impact-tiers-grid">
            <div class="tier-card animate-on-scroll">
                <div class="tier-icon">🦴</div>
                <div class="tier-amount">₱100</div>
                <h3 class="tier-title"><?php _e('Daily Kibble & Treats', 'pawhaven'); ?></h3>
                <p class="tier-desc"><?php _e('Provides high-protein nutrition and healthy rewards for a rescue dog or cat.', 'pawhaven'); ?></p>
            </div>
            <div class="tier-card animate-on-scroll">
                <div class="tier-icon">🐾</div>
                <div class="tier-amount">₱500</div>
                <h3 class="tier-title"><?php _e('Comfort Pet Bed', 'pawhaven'); ?></h3>
                <p class="tier-desc"><?php _e('Ensures a durable, warm, and orthopedic bed for a resident to call their own.', 'pawhaven'); ?></p>
            </div>
            <div class="tier-card animate-on-scroll">
                <div class="tier-icon">🩺</div>
                <div class="tier-amount">₱1,000</div>
                <h3 class="tier-title"><?php _e('Essential Vet Care', 'pawhaven'); ?></h3>
                <p class="tier-desc"><?php _e('Covers critical puppy/kitten vaccinations and a full health check-up.', 'pawhaven'); ?></p>
            </div>
            <div class="tier-card animate-on-scroll">
                <div class="tier-icon">🐕</div>
                <div class="tier-amount">₱2,500</div>
                <h3 class="tier-title"><?php _e('Animal Haven Sponsorship', 'pawhaven'); ?></h3>
                <p class="tier-desc"><?php _e('Supports a full week of toys, behavioral enrichment, and a safe home for one pet.', 'pawhaven'); ?></p>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="<?php echo esc_url( home_url('/donate') ); ?>" class="btn btn-primary btn-lg"><?php _e('Support Our Mission', 'pawhaven'); ?></a>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="section-newsletter py-20 bg-soft-cream">
    <div class="container">
        <div class="newsletter-wrap animate-on-scroll">
            <div class="newsletter-content">
                <h2><?php _e('Stay Pawsitive!', 'pawhaven'); ?></h2>
                <p><?php _e('Join our mailing list to receive heartwarming success stories and updates on new residents ready for adoption.', 'pawhaven'); ?></p>
                <form class="newsletter-hero-form">
                    <input type="email" placeholder="<?php _e('Your email address', 'pawhaven'); ?>" required>
                    <button type="submit" class="btn-stat btn-solid"><?php _e('Subscribe', 'pawhaven'); ?></button>
                </form>
            </div>
            <div class="newsletter-image">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/charlie.png' ); ?>" alt="Newsletter">
            </div>
        </div>
    </div>
</section>

<?php
get_footer();

