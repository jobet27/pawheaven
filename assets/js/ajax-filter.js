/**
 * PawHaven - AJAX Animal Filtering System
 * Handles dynamic pet adoption filtering via WordPress REST API.
 */

(function() {
    'use strict';

    const AnimalFilter = {
        // --- CONFIGURATION ---
        endpoint: '/wp-json/pawhaven/v1/animals',
        gridSelector: '#animal-grid',
        filterFormSelector: '#animal-filter-form',
        skeletonCount: 6,
        
        // --- STATE ---
        state: {
            species: 'all',
            age: 'all',
            size: 'all',
            temperament: 'all',
            status: 'available',
            page: 1,
            orderby: 'date',
            order: 'desc'
        },
        
        controller: null, // For AbortController
        debounceTimer: null,

        // --- INITIALIZATION ---
        init() {
            this.grid = document.querySelector(this.gridSelector);
            this.form = document.querySelector(this.filterFormSelector);
            
            if (!this.grid || !this.form) return;

            this.bindEvents();
            this.cacheTemplates();
        },

        bindEvents() {
            // Listen for changes on all filter inputs
            this.form.querySelectorAll('select, input[type="radio"], input[type="checkbox"]').forEach(input => {
                input.addEventListener('change', () => this.handleFilterChange());
            });

            // Handle sorting if present
            const sorter = document.querySelector('#animal-sort');
            if (sorter) {
                sorter.addEventListener('change', (e) => {
                    this.state.orderby = e.target.value;
                    this.handleFilterChange();
                });
            }
        },

        cacheTemplates() {
            // Prepare a generic error/empty message
            this.emptyTemplate = `
                <div class="animal-none-found">
                    <p>No animals found matching your criteria. Please try a different filter.</p>
                    <button class="btn btn-secondary reset-filters">Clear All Filters</button>
                </div>
            `;
        },

        // --- CORE LOGIC ---
        handleFilterChange() {
            // Update state from form
            const formData = new FormData(this.form);
            for (let [key, value] of formData.entries()) {
                this.state[key] = value;
            }

            // Debounce the fetch
            clearTimeout(this.debounceTimer);
            this.debounceTimer = setTimeout(() => {
                this.fetchResults();
            }, 350);
        },

        async fetchResults() {
            // Abort previous request if still flying
            if (this.controller) {
                this.controller.abort();
            }

            this.controller = new AbortController();
            const signal = this.controller.signal;

            this.renderSkeletons();
            this.form.classList.add('is-loading');

            try {
                const url = new URL(this.endpoint, window.location.origin);
                Object.keys(this.state).forEach(key => {
                    if (this.state[key] !== 'all') {
                        url.searchParams.append(key, this.state[key]);
                    }
                });

                const response = await fetch(url.toString(), { signal });
                
                if (!response.ok) throw new Error('API request failed');

                const data = await response.json();
                this.renderResults(data);

            } catch (error) {
                if (error.name === 'AbortError') return;
                console.error('PawHaven Filter Error:', error);
                this.renderError();
            } finally {
                this.form.classList.remove('is-loading');
            }
        },

        // --- RENDERING ---
        renderResults(data) {
            this.grid.innerHTML = '';
            
            if (!data || data.length === 0) {
                this.grid.innerHTML = this.emptyTemplate;
                this.bindResetEvent();
                return;
            }

            const fragment = document.createDocumentFragment();
            
            data.forEach((animal, index) => {
                const card = this.createCardElement(animal);
                card.style.animationDelay = `${index * 50}ms`;
                fragment.appendChild(card);
            });

            this.grid.appendChild(fragment);
            
            // Re-trigger global UI observers (if defined in main.js)
            if (window.UX && typeof window.UX.init === 'function') {
                window.UX.bindMicroInteractions();
            }
        },

        createCardElement(animal) {
            const article = document.createElement('article');
            article.className = `animal-card animate-on-scroll is-visible`; // Force visible for AJAX
            article.dataset.id = animal.id;

            // Simple templating logic (Mirroring PHP animal-card.php)
            article.innerHTML = `
                <div class="animal-card-inner">
                    <div class="animal-thumbnail">
                        <img src="${animal.thumbnail || '/placeholder.jpg'}" alt="${animal.title}">
                        <span class="animal-status status-${animal.status}">${animal.status_label}</span>
                    </div>
                    <div class="animal-content">
                        <h3 class="animal-title">${animal.title}</h3>
                        <div class="animal-meta">
                            <span>${animal.age}</span> • <span>${animal.size}</span>
                        </div>
                        <p class="animal-excerpt">${animal.excerpt || ''}</p>
                        <a href="${animal.link}" class="btn btn-primary btn-block">Adopt Me</a>
                    </div>
                </div>
            `;

            return article;
        },

        renderSkeletons() {
            this.grid.innerHTML = '';
            const fragment = document.createDocumentFragment();
            
            for (let i = 0; i < this.skeletonCount; i++) {
                const skeleton = document.createElement('div');
                skeleton.className = 'animal-card-skeleton';
                skeleton.innerHTML = `
                    <div class="skeleton-img"></div>
                    <div class="skeleton-text"></div>
                    <div class="skeleton-text sm"></div>
                `;
                fragment.appendChild(skeleton);
            }

            this.grid.appendChild(fragment);
        },

        renderError() {
            this.grid.innerHTML = `
                <div class="animal-error">
                    <p>Sorry, something went wrong while searching for pets. Please try again.</p>
                    <button class="btn btn-secondary" onclick="window.location.reload()">Retry</button>
                </div>
            `;
        },

        bindResetEvent() {
            const resetBtn = this.grid.querySelector('.reset-filters');
            if (resetBtn) {
                resetBtn.addEventListener('click', () => {
                    this.form.reset();
                    this.handleFilterChange();
                });
            }
        }
    };

    // Auto-init on load
    document.addEventListener('DOMContentLoaded', () => AnimalFilter.init());

})();
