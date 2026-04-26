/**
 * PawHaven - Main Frontend Interactions
 * Vanilla JavaScript / No Dependencies
 */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    // --- 1. CORE MODULES INITIALIZATION ---
    Navigation.init();
    Filtering.init();
    Donations.init();
    Carousel.init();
    Animations.init();
    UX.init();
});

// --- 2. NAVIGATION MODULE ---
const Navigation = {
    init() {
        this.stickyHeader();
        this.mobileMenu();
        this.smoothScroll();
    },

    stickyHeader() {
        const header = document.querySelector('.site-header');
        if (!header) return;

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('is-sticky');
            } else {
                header.classList.remove('is-sticky');
            }
        }, { passive: true });
    },

    mobileMenu() {
        const toggle = document.querySelector('.menu-toggle');
        const menu = document.querySelector('.main-navigation');
        if (!toggle || !menu) return;

        toggle.addEventListener('click', (e) => {
            e.preventDefault();
            const expanded = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', !expanded);
            menu.classList.toggle('is-open');
            document.body.classList.toggle('menu-active');
        });
    },

    smoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                const targetId = anchor.getAttribute('href');
                if (targetId === '#') return;
                
                const target = document.querySelector(targetId);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    }
};

// --- 3. ANIMAL FILTERING SYSTEM ---
const Filtering = {
    filters: {
        species: 'all',
        age: 'all',
        size: 'all',
        temperament: 'all'
    },

    init() {
        this.filterContainer = document.querySelector('.animal-filters');
        this.cards = document.querySelectorAll('.animal-card');
        
        if (!this.filterContainer || this.cards.length === 0) return;
        this.bindEvents();
    },

    bindEvents() {
        const selectFilters = this.filterContainer.querySelectorAll('select, input[type="radio"]');
        selectFilters.forEach(filter => {
            filter.addEventListener('change', (e) => {
                const key = e.target.name || e.target.dataset.filter;
                this.filters[key] = e.target.value;
                this.applyFilters();
            });
        });
    },

    applyFilters() {
        this.showLoader();
        
        // Debounce for visual smoothness
        setTimeout(() => {
            this.cards.forEach(card => {
                const sMatch = this.filters.species === 'all' || card.dataset.species === this.filters.species;
                const aMatch = this.filters.age === 'all' || card.dataset.age === this.filters.age;
                const szMatch = this.filters.size === 'all' || card.dataset.size === this.filters.size;
                const tMatch = this.filters.temperament === 'all' || card.dataset.temperament === this.filters.temperament;

                if (sMatch && aMatch && szMatch && tMatch) {
                    card.style.display = 'block';
                    card.classList.add('fade-in');
                } else {
                    card.style.display = 'none';
                    card.classList.remove('fade-in');
                }
            });
            this.hideLoader();
        }, 300);
    },

    showLoader() {
        const grid = document.querySelector('.animal-grid');
        if (grid) grid.classList.add('is-loading');
    },

    hideLoader() {
        const grid = document.querySelector('.animal-grid');
        if (grid) grid.classList.remove('is-loading');
    }
};

// --- 4. DONATION MODULE ---
const Donations = {
    init() {
        this.buttons = document.querySelectorAll('.donation-amount-btn');
        this.input = document.querySelector('.custom-donation-input');
        this.progressBar = document.querySelector('.donation-progress-fill');
        
        if (this.buttons.length === 0) return;
        this.bindEvents();
        this.animateProgress();
    },

    bindEvents() {
        this.buttons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                this.buttons.forEach(b => b.classList.remove('is-active'));
                btn.classList.add('is-active');
                
                if (this.input) {
                    this.input.value = btn.dataset.amount;
                }
            });
        });
    },

    animateProgress() {
        if (!this.progressBar) return;
        const targetWidth = this.progressBar.dataset.percent || 0;
        
        requestAnimationFrame(() => {
            this.progressBar.style.width = targetWidth + '%';
        });
    }
};

// --- 5. SUCCESS STORIES CAROUSEL ---
const Carousel = {
    current: 0,
    isTransitioning: false,

    init() {
        this.slider = document.querySelector('.stories-slider');
        this.slides = document.querySelectorAll('.story-slide');
        this.prev = document.querySelector('.carousel-prev');
        this.next = document.querySelector('.carousel-next');

        if (!this.slider || this.slides.length === 0) return;
        this.bindEvents();
        this.startAutoPlay();
    },

    bindEvents() {
        if (this.prev) this.prev.addEventListener('click', () => this.goTo(this.current - 1));
        if (this.next) this.next.addEventListener('click', () => this.goTo(this.current + 1));
        
        // Touch events for mobile
        let startX = 0;
        this.slider.addEventListener('touchstart', (e) => startX = e.touches[0].clientX, { passive: true });
        this.slider.addEventListener('touchend', (e) => {
            const endX = e.changedTouches[0].clientX;
            if (startX - endX > 50) this.goTo(this.current + 1);
            if (startX - endX < -50) this.goTo(this.current - 1);
        });
    },

    goTo(index) {
        if (this.isTransitioning) return;
        this.isTransitioning = true;
        
        this.slides[this.current].classList.remove('is-active');
        
        if (index >= this.slides.length) index = 0;
        if (index < 0) index = this.slides.length - 1;
        
        this.current = index;
        this.slides[this.current].classList.add('is-active');
        
        setTimeout(() => this.isTransitioning = false, 500);
    },

    startAutoPlay() {
        this.autoPlayInterval = setInterval(() => this.goTo(this.current + 1), 5000);
        this.slider.addEventListener('mouseenter', () => clearInterval(this.autoPlayInterval));
        this.slider.addEventListener('mouseleave', () => this.startAutoPlay());
    }
};

// --- 6. SCROLL ANIMATIONS ---
const Animations = {
    init() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    
                    // If target is an impact item, animate counts
                    if (entry.target.classList.contains('impact-item')) {
                        this.countUp(entry.target);
                    }

                    // If target is a grid, stagger children
                    if (entry.target.classList.contains('stagger-grid')) {
                        this.staggerChildren(entry.target);
                    }
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll, .stagger-grid, .impact-item').forEach(el => {
            observer.observe(el);
        });
    },

    countUp(container) {
        const numberEl = container.querySelector('.impact-number');
        if (!numberEl) return;

        const target = parseInt(numberEl.getAttribute('data-target'));
        const duration = 2000;
        const start = performance.now();

        const step = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            const eased = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
            const current = Math.floor(eased * target);

            // Responsive formatting
            if (target >= 1000) {
                numberEl.textContent = (current / 1000).toFixed(current % 1000 === 0 ? 0 : 1) + 'k+';
                if (current < 1000) numberEl.textContent = current + '+';
            } else {
                numberEl.textContent = current + '+';
            }

            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                numberEl.textContent = target >= 1000 ? (target/1000).toFixed(0) + 'k+' : target + '+';
            }
        };
        requestAnimationFrame(step);
    },

    staggerChildren(parent) {
        const children = parent.children;
        Array.from(children).forEach((child, index) => {
            child.style.transitionDelay = `${index * 100}ms`;
            child.classList.add('is-visible');
        });
    }
};

// --- 7. UX & UTILS ---
const UX = {
    init() {
        this.bindMicroInteractions();
        this.handleModals();
    },

    bindMicroInteractions() {
        document.querySelectorAll('.btn, .animal-card').forEach(el => {
            el.addEventListener('mousedown', () => el.style.transform = 'scale(0.98)');
            el.addEventListener('mouseup', () => el.style.transform = '');
            el.addEventListener('mouseleave', () => el.style.transform = '');
        });
    },

    handleModals() {
        const triggers = document.querySelectorAll('[data-modal]');
        const closeBtns = document.querySelectorAll('.modal-close');

        triggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                const modalId = trigger.dataset.modal;
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('is-active');
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        closeBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const modal = btn.closest('.modal');
                if (modal) {
                    modal.classList.remove('is-active');
                    document.body.style.overflow = '';
                }
            });
        });
    }
};

// --- 8. REST API INTEGRATION UTILITY ---
const API = {
    async fetchAnimals(params) {
        const endpoint = `/wp-json/pawhaven/v1/animals?${new URLSearchParams(params)}`;
        try {
            const response = await fetch(endpoint);
            if (!response.ok) throw new Error('Network response was not ok');
            return await response.json();
        } catch (error) {
            console.error('Fetch error:', error);
            return null;
        }
    }
};
