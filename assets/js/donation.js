/**
 * PawHaven - Donation System Interactions
 * Handles amount selection, progress tracking, and campaign UX.
 */

(function() {
    'use strict';

    class DonationSystem {
        constructor() {
            this.config = {
                formSelector: '#donation-form',
                amountBtnSelector: '.donation-tier-btn',
                customInputSelector: '#donation-custom-amount',
                progressBarSelector: '.donation-progress-fill',
                impactContainerSelector: '#donation-impact-message',
                submitBtnSelector: '#donation-submit-btn',
                minAmount: 50,
                defaultAmount: 500
            };

            this.state = {
                currentAmount: this.config.defaultAmount,
                isSubmitting: false,
                campaignData: null
            };

            this.init();
        }

        init() {
            this.selectors = {
                form: document.querySelector(this.config.formSelector),
                buttons: document.querySelectorAll(this.config.amountBtnSelector),
                customInput: document.querySelector(this.config.customInputSelector),
                progressBars: document.querySelectorAll(this.config.progressBarSelector),
                impactMessage: document.querySelector(this.config.impactContainerSelector),
                submitBtn: document.querySelector(this.config.submitBtnSelector)
            };

            if (!this.selectors.form) return;

            this.bindEvents();
            this.animateAllProgress();
            this.updateUI(this.state.currentAmount);
        }

        bindEvents() {
            // Amount Buttons
            this.selectors.buttons.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const amount = parseFloat(btn.dataset.amount);
                    this.updateAmount(amount, 'button');
                });
            });

            // Custom Input
            if (this.selectors.customInput) {
                this.selectors.customInput.addEventListener('input', (e) => {
                    const amount = parseFloat(e.target.value) || 0;
                    this.updateAmount(amount, 'input');
                });

                this.selectors.customInput.addEventListener('blur', () => {
                    if (this.state.currentAmount < this.config.minAmount) {
                        this.updateAmount(this.config.minAmount, 'input');
                        this.selectors.customInput.value = this.config.minAmount;
                    }
                });
            }

            // Form Submission
            this.selectors.form.addEventListener('submit', (e) => this.handleSubmit(e));
        }

        updateAmount(amount, source) {
            this.state.currentAmount = amount;

            // Sync UI state
            if (source === 'button') {
                this.selectors.buttons.forEach(btn => {
                    btn.classList.toggle('is-active', parseFloat(btn.dataset.amount) === amount);
                });
                if (this.selectors.customInput) {
                    this.selectors.customInput.value = amount;
                }
            } else {
                this.selectors.buttons.forEach(btn => btn.classList.remove('is-active'));
            }

            this.updateImpactMessage(amount);
            this.validateForm();
        }

        updateImpactMessage(amount) {
            if (!this.selectors.impactMessage) return;

            let message = "Your contribution makes a huge difference!";
            
            if (amount >= 1000) {
                message = "This covers vaccinations and checkups for a rescue pet.";
            } else if (amount >= 500) {
                message = "This feeds three rescue animals for a full day.";
            } else if (amount >= 100) {
                message = "This provides clean water and bedding for a week.";
            }

            this.selectors.impactMessage.innerHTML = message;
            this.selectors.impactMessage.classList.add('fade-in');
            setTimeout(() => this.selectors.impactMessage.classList.remove('fade-in'), 300);
        }

        validateForm() {
            const isValid = this.state.currentAmount >= this.config.minAmount;
            if (this.selectors.submitBtn) {
                this.selectors.submitBtn.disabled = !isValid || this.state.isSubmitting;
            }
        }

        animateAllProgress() {
            this.selectors.progressBars.forEach(bar => {
                const target = parseFloat(bar.dataset.percent) || 0;
                this.animateBar(bar, target);
            });
        }

        animateBar(element, target) {
            let start = 0;
            const duration = 1500;
            const startTime = performance.now();

            const step = (timestamp) => {
                const progress = Math.min((timestamp - startTime) / duration, 1);
                const current = progress * target;
                element.style.width = `${current}%`;
                
                // Update percentage label if it exists in a sibling
                const label = element.parentElement.parentElement.querySelector('.progress-label');
                if (label) label.textContent = `${Math.floor(current)}%`;

                if (progress < 1) {
                    requestAnimationFrame(step);
                }
            };

            requestAnimationFrame(step);
        }

        async handleSubmit(e) {
            e.preventDefault();
            if (this.state.isSubmitting) return;

            this.setLoading(true);

            try {
                // Prepare structure for API submission
                const payload = {
                    amount: this.state.currentAmount,
                    campaign_id: this.selectors.form.dataset.campaignId || 1,
                    nonce: this.selectors.form.querySelector('[name="_wpnonce"]')?.value
                };

                // Simulate/Execute API call
                const response = await this.executeSubmit(payload);

                if (response.success) {
                    this.showSuccess();
                } else {
                    this.showError(response.message || 'Donation failed. Please try again.');
                }

            } catch (error) {
                console.error('PawHaven Donation Error:', error);
                this.showError('Network error. Please check your connection.');
            } finally {
                this.setLoading(false);
            }
        }

        async executeSubmit(payload) {
            // Placeholder for real REST API endpoint
            // return fetch('/wp-json/pawhaven/v1/donate', { method: 'POST', ... });
            
            return new Promise((resolve) => {
                setTimeout(() => resolve({ success: true }), 1500);
            });
        }

        setLoading(loading) {
            this.state.isSubmitting = loading;
            if (this.selectors.submitBtn) {
                this.selectors.submitBtn.classList.toggle('is-loading', loading);
                this.selectors.submitBtn.innerHTML = loading ? 'Processing...' : 'Complete Donation';
            }
            this.validateForm();
        }

        showSuccess() {
            const wrap = this.selectors.form.parentElement;
            wrap.innerHTML = `
                <div class="donation-success-state text-center fade-in">
                    <div class="success-icon">🐾</div>
                    <h3>Thank you for your kindness!</h3>
                    <p>Your donation of ₱${this.state.currentAmount} will help our animals thrive.</p>
                    <button class="btn btn-primary" onclick="window.location.reload()">Back to Campaigns</button>
                </div>
            `;
        }

        showError(message) {
            const errorContainer = document.querySelector('.donation-error-container') || this.createErrorContainer();
            errorContainer.textContent = message;
            errorContainer.style.display = 'block';
        }

        createErrorContainer() {
            const div = document.createElement('div');
            div.className = 'donation-error-container';
            this.selectors.form.prepend(div);
            return div;
        }

        updateUI(amount) {
            this.updateAmount(amount, 'button');
        }
    }

    // Initialize on DOM Ready
    document.addEventListener('DOMContentLoaded', () => {
        new DonationSystem();
    });

})();
