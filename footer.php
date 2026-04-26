	</main><!-- #primary -->

	<footer id="colophon" class="site-footer">
		<div class="container footer-grid">
			<div class="footer-widget footer-about">
				<div class="site-branding mb-6">
                    <span class="brand-icon">🐾</span>
                    <span class="brand-name text-white font-bold text-xl ml-2">PawHaven</span>
                </div>
				<p class="footer-text color-gray-400 mb-8">
                    <?php _e('Dedicated to rescuing, rehabilitating, and rehoming animals in need since 2008. Your support makes our mission possible.', 'pawhaven'); ?>
                </p>
                <div class="footer-socials d-flex gap-4">
                    <a href="#" class="social-icon" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4v-8.5z"/></svg>
                    </a>
                    <a href="#" class="social-icon" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="#" class="social-icon" aria-label="Twitter">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                </div>
			</div>

			<div class="footer-widget">
				<h3 class="footer-title"><?php _e('Quick Links', 'pawhaven'); ?></h3>
				<ul>
					<li><a href="<?php echo get_post_type_archive_link( 'animal' ); ?>"><?php _e('Adopt a Pet', 'pawhaven'); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/donate' ) ); ?>"><?php _e('Make a Donation', 'pawhaven'); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/volunteer' ) ); ?>"><?php _e('Volunteer', 'pawhaven'); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/success-stories' ) ); ?>"><?php _e('Success Stories', 'pawhaven'); ?></a></li>
				</ul>
			</div>

			<div class="footer-widget">
				<h3 class="footer-title"><?php _e('Contact Us', 'pawhaven'); ?></h3>
				<ul class="contact-list">
					<li><span class="icon">📍</span> 123 Rescue Way, Paw City</li>
					<li><span class="icon">📞</span> (555) 123-4567</li>
					<li><span class="icon">✉️</span> hello@pawhaven.org</li>
				</ul>
			</div>

			<div class="footer-widget">
				<h3 class="footer-title"><?php _e('Join Our Pack', 'pawhaven'); ?></h3>
				<p class="text-sm mb-4"><?php _e('Get updates on our rescue missions and success stories.', 'pawhaven'); ?></p>
				<form class="newsletter-form shadow-sm">
					<input type="email" placeholder="<?php _e('Your email', 'pawhaven'); ?>" required>
					<button type="submit" class="btn btn-primary btn-sm"><?php _e('Join', 'pawhaven'); ?></button>
				</form>
			</div>
		</div>

		<div class="site-info">
			<div class="container">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. <?php _e('Working for every paw.', 'pawhaven'); ?></p>
            </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
