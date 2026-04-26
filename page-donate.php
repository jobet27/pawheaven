<?php
/**
 * Template Name: Donate Now Page
 */

get_header(); ?>

<div class="donate-page-hero">
    <div class="container text-center">
        <h1 class="hero-title animate-on-scroll"><?php _e('Every Donation Saves a Life.', 'pawhaven'); ?></h1>
        <p class="hero-desc animate-on-scroll"><?php _e('Your contribution directly supports our mission to rescue, rehabilitate, and rehome animals in need.', 'pawhaven'); ?></p>
    </div>
</div>

<div class="container py-20">
    <div class="grid-2-cols gap-16">
        <!-- Donation Content -->
        <div class="donate-content-area animate-on-scroll">
            <h2 class="sidebar-title mb-6"><?php _e('Choose Your Impact', 'pawhaven'); ?></h2>
            <p class="mb-10"><?php _e('Since 1995, PawHaven has relied on the kindness of people like you to keep our doors open and our residents thriving.', 'pawhaven'); ?></p>
            
            <div class="impact-tiers-small">
                <div class="tier-item">
                    <span class="tier-icon">🦴</span>
                    <div>
                        <strong>₱100 - <?php _e('Nutrition Pack', 'pawhaven'); ?></strong>
                        <p><?php _e('High-quality meals for 3 dogs for a full day.', 'pawhaven'); ?></p>
                    </div>
                </div>
                <div class="tier-item">
                    <span class="tier-icon">🐾</span>
                    <div>
                        <strong>₱500 - <?php _e('Comfort Bundle', 'pawhaven'); ?></strong>
                        <p><?php _e('Warm bedding and a new toy for a rescue kitten.', 'pawhaven'); ?></p>
                    </div>
                </div>
                <div class="tier-item">
                    <span class="tier-icon">🩺</span>
                    <div>
                        <strong>₱1,000 - <?php _e('Medical Care', 'pawhaven'); ?></strong>
                        <p><?php _e('Essential vaccinations and health screening.', 'pawhaven'); ?></p>
                    </div>
                </div>
            </div>

            <div class="trust-badge mt-10 p-6 bg-soft-cream rounded-xl">
                 <h3>🛡️ <?php _e('Secure Donation', 'pawhaven'); ?></h3>
                 <p><?php _e('All transactions are encrypted and secure. We respect your privacy and will never share your information.', 'pawhaven'); ?></p>
            </div>
        </div>

        <!-- Donation Form -->
        <div class="donate-form-area animate-on-scroll">
            <div class="donate-card p-10 bg-white shadow-xl rounded-3xl border border-gray-100">
                <form id="donation-form" class="pro-form">
                    <div class="form-group mb-6">
                        <label><?php _e('Select Amount', 'pawhaven'); ?></label>
                        <div class="amount-grid">
                            <button type="button" class="btn-amount donation-tier-btn" data-amount="250">₱250</button>
                            <button type="button" class="btn-amount donation-tier-btn" data-amount="500">₱500</button>
                            <button type="button" class="btn-amount donation-tier-btn is-active" data-amount="1000">₱1,000</button>
                            <button type="button" class="btn-amount donation-tier-btn" data-amount="2000">₱2,000</button>
                            <input type="number" id="donation-custom-amount" name="custom_amount" placeholder="<?php _e('Other', 'pawhaven'); ?>" class="input-custom-amount">
                        </div>
                    </div>

                    <div class="form-group mb-6">
                        <label><?php _e('Full Name', 'pawhaven'); ?></label>
                        <input type="text" name="donor_name" required>
                    </div>

                    <div class="form-group mb-6">
                        <label><?php _e('Email Address', 'pawhaven'); ?></label>
                        <input type="email" name="donor_email" required>
                    </div>

                    <div class="form-group mb-8">
                        <label><?php _e('Dedication (Optional)', 'pawhaven'); ?></label>
                        <textarea name="dedication" placeholder="<?php _e('In honor of...', 'pawhaven'); ?>"></textarea>
                    </div>
                    
                    <div id="donation-impact-message" class="mb-6 text-sm text-gray-600 font-medium italic"></div>

                    <button type="submit" id="donation-submit-btn" class="btn btn-primary btn-lg btn-block"><?php _e('Proceed to Payment', 'pawhaven'); ?></button>
                </form>
                <div id="donation-response"></div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
