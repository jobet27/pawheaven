<?php
/**
 * Template Name: Donation Page
 */

get_header(); ?>

<section class="page-hero hero-donate">
    <div class="container text-center animate-on-scroll">
        <h1 class="page-title"><?php _e('Make a Difference', 'pawhaven'); ?></h1>
        <p class="hero-subtitle"><?php _e('Your contribution directly supports our rescue and rehabilitation efforts.', 'pawhaven'); ?></p>
    </div>
</section>

<div class="container container-donate-flow">
    <div class="donation-grid grid-2-cols">
        
        <!-- Left: Donation Form -->
        <div class="donation-card donation-form-wrapper animate-on-scroll">
            <h2 class="section-title"><?php _e('One-Time Donation', 'pawhaven'); ?></h2>
            <p class="section-desc"><?php _e('Choose an amount to support our mission.', 'pawhaven'); ?></p>
            
            <form id="donation-form" class="donation-form" data-campaign-id="1">
                <?php wp_nonce_field( 'pawhaven_donation', '_wpnonce' ); ?>
                
                <div class="donation-tiers grid-3-cols">
                    <button type="button" class="donation-tier-btn" data-amount="100">₱100</button>
                    <button type="button" class="donation-tier-btn is-active" data-amount="500">₱500</button>
                    <button type="button" class="donation-tier-btn" data-amount="1000">₱1000</button>
                </div>

                <div class="custom-amount-group">
                    <label for="donation-custom-amount"><?php _e('Custom Amount (₱)', 'pawhaven'); ?></label>
                    <input type="number" id="donation-custom-amount" name="amount" value="500" min="50">
                </div>

                <div id="donation-impact-message" class="donation-impact">
                    <!-- Updated via donation.js -->
                </div>

                <button type="submit" id="donation-submit-btn" class="btn btn-primary btn-lg btn-block">
                    <?php _e('Complete Donation', 'pawhaven'); ?>
                </button>

                <p class="donation-note">
                    <?php _e('Secure payment processing. All donations are tax-deductible.', 'pawhaven'); ?>
                </p>
            </form>
        </div>

        <!-- Right: Campaign Progress & Impact -->
        <div class="donation-sidebar animate-on-scroll">
            <div class="campaign-progress-card">
                <h3 class="card-title"><?php _e('Seasonal Food Fund', 'pawhaven'); ?></h3>
                <div class="progress-meta">
                    <span class="progress-amount"><strong>₱4,500</strong> raised</span>
                    <span class="progress-target">of ₱10,000 goal</span>
                </div>
                <div class="donation-progress-bar">
                    <div class="donation-progress-fill" data-percent="45"></div>
                </div>
                <p class="campaign-desc">
                    <?php _e('We are stocking up on high-quality nutrition for the upcoming winter months. Help us fill the pantry.', 'pawhaven'); ?>
                </p>
            </div>

            <div class="impact-stats-card">
                <h3 class="card-title"><?php _e('Your Impact Last Year', 'pawhaven'); ?></h3>
                <ul class="impact-list">
                    <li>🐕 <strong>150+</strong> Dogs found forever homes</li>
                    <li>🐈 <strong>220+</strong> Cats rescued and rehabilitated</li>
                    <li>🏥 <strong>₱45k+</strong> In medical bills covered by donors</li>
                </ul>
            </div>
        </div>

    </div>
</div>

<?php
get_footer();
