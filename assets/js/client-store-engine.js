/**
 * Studio Dark Portfolio - Rama 2: Client Store & Session Engine
 * Sistema de selección de fotos, Floating Action Dock y checkout Mercado Pago.
 */

class ClientStoreEngine {
    constructor() {
        this.selectedPhotos = new Map(); // id -> photoObject
        this.currentSessionFilter = 'all';
        this.activeFilters = {
            session: 'all',
            orientation: 'all',
            type: 'all',
            resolution: 'all'
        };
        this.init();
    }

    init() {
        document.addEventListener('DOMContentLoaded', () => {
            this.bindEvents();
            this.bindFacetedFilters();
            this.setupMediaProtection();
            this.updateDock();
        });
    }

    bindEvents() {
        // Selector de Pestañas de Sesiones
        const sessionTabs = document.querySelectorAll('.session-tab-btn');
        sessionTabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                sessionTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                const session = tab.getAttribute('data-session') || 'all';
                this.activeFilters.session = session;
                this.applyFacetedFilters();
            });
        });

        // Botón Limpiar Selección en el Dock
        const clearBtn = document.getElementById('dockClearBtn');
        if (clearBtn) {
            clearBtn.addEventListener('click', () => this.clearSelection());
        }

        // Botón Comprar Selección en el Dock
        const checkoutBtn = document.getElementById('dockCheckoutBtn');
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', () => this.openBatchCheckout());
        }
    }

    bindFacetedFilters() {
        // Botones de filtro facetado (orientación, tipo [foto/video], resolución)
        const filterBtns = document.querySelectorAll('.filter-pill-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const group = btn.closest('.filter-group');
                if (group) {
                    group.querySelectorAll('.filter-pill-btn').forEach(b => b.classList.remove('active'));
                }
                btn.classList.add('active');

                const filterType = btn.getAttribute('data-filter-type'); // orientation, media-type, resolution
                const filterVal = btn.getAttribute('data-filter-val');

                if (filterType === 'orientation') this.activeFilters.orientation = filterVal;
                if (filterType === 'media-type') this.activeFilters.type = filterVal;
                if (filterType === 'resolution') this.activeFilters.resolution = filterVal;

                this.applyFacetedFilters();
            });
        });
    }

    applyFacetedFilters() {
        const cards = document.querySelectorAll('.proof-photo-card');
        cards.forEach(card => {
            const cardSession = card.getAttribute('data-session') || '';
            const cardOrientation = card.getAttribute('data-orientation') || 'horizontal';
            const cardType = card.getAttribute('data-type') || 'photo';
            const cardResolution = card.getAttribute('data-resolution') || '4k';
            const isFav = card.classList.contains('is-selected');

            // Comprobación de cada faceta
            let matchSession = (this.activeFilters.session === 'all') ||
                               (this.activeFilters.session === 'favorites' && isFav) ||
                               (cardSession === this.activeFilters.session);

            let matchOrientation = (this.activeFilters.orientation === 'all') ||
                                   (cardOrientation === this.activeFilters.orientation);

            let matchType = (this.activeFilters.type === 'all') ||
                            (cardType === this.activeFilters.type);

            let matchResolution = (this.activeFilters.resolution === 'all') ||
                                  (cardResolution === this.activeFilters.resolution);

            if (matchSession && matchOrientation && matchType && matchResolution) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    setupMediaProtection() {
        // Deshabilitar menú contextual (clic derecho) sobre previsualizaciones
        const protectedZones = document.querySelectorAll('.watermark-overlay, .video-preview-wrapper, .proof-photo-card');
        protectedZones.forEach(el => {
            el.addEventListener('contextmenu', (e) => {
                e.preventDefault();
                return false;
            });
            el.addEventListener('dragstart', (e) => {
                e.preventDefault();
                return false;
            });
        });
    }

    togglePhotoSelection(photoId, photoData, event) {
        if (event) {
            event.stopPropagation();
            event.preventDefault();
        }

        const card = document.querySelector(`[data-proof-id="${photoId}"]`);
        const heartBtn = card ? card.querySelector('.btn-proof-favorite') : null;

        if (this.selectedPhotos.has(photoId)) {
            this.selectedPhotos.delete(photoId);
            if (card) card.classList.remove('is-selected');
            if (heartBtn) heartBtn.classList.remove('active');
        } else {
            this.selectedPhotos.set(photoId, photoData);
            if (card) card.classList.add('is-selected');
            if (heartBtn) heartBtn.classList.add('active');
        }

        this.updateDock();
    }

    clearSelection() {
        this.selectedPhotos.clear();
        document.querySelectorAll('.proof-photo-card').forEach(c => c.classList.remove('is-selected'));
        document.querySelectorAll('.btn-proof-favorite').forEach(b => b.classList.remove('active'));
        this.updateDock();

        if (this.activeFilters.session === 'favorites') {
            this.applyFacetedFilters();
        }
    }

    updateDock() {
        const dock = document.getElementById('floatingSelectionDock');
        const badgeCount = document.getElementById('dockBadgeCount');
        const countText = document.getElementById('dockCountText');
        const totalPriceEl = document.getElementById('dockTotalPrice');

        const totalItems = this.selectedPhotos.size;

        if (!dock) return;

        if (totalItems > 0) {
            dock.classList.add('is-visible');

            let sum = 0;
            this.selectedPhotos.forEach(item => {
                sum += (item.priceARS || 0);
            });

            if (badgeCount) badgeCount.textContent = totalItems;
            if (countText) countText.textContent = totalItems === 1 ? '1 activo seleccionado' : `${totalItems} activos seleccionados`;
            if (totalPriceEl) totalPriceEl.textContent = `$${sum.toLocaleString('es-AR')} ARS`;
        } else {
            dock.classList.remove('is-visible');
        }
    }

    openBatchCheckout() {
        if (this.selectedPhotos.size === 0) return;

        const items = Array.from(this.selectedPhotos.values());
        if (typeof window.openMercadoPagoBatchCheckout === 'function') {
            window.openMercadoPagoBatchCheckout(items);
        } else {
            alert(`Iniciando checkout de Mercado Pago para ${items.length} obras seleccionadas.`);
        }
    }
}

// Instancia global
window.clientStore = new ClientStoreEngine();

