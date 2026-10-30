/**
 * Studio Dark Portfolio - Main Theme JavaScript & Header/Footer Engine
 * Compatible con: Chrome, Firefox, Edge, Opera, Brave, Safari.
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Inicializar iconos de Lucide
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // 2. Transición Sticky con Glassmorphism en Scroll
    const siteHeader = document.getElementById('siteHeader');
    if (siteHeader) {
        const handleHeaderScroll = () => {
            if (window.scrollY > 30) {
                siteHeader.classList.add('scrolled');
            } else {
                siteHeader.classList.remove('scrolled');
            }
        };
        window.addEventListener('scroll', handleHeaderScroll, { passive: true });
        handleHeaderScroll(); // Ejecución inicial
    }

    // 3. Buscador AJAX Superpuesto (Search Overlay)
    const searchToggleBtn = document.getElementById('searchBarToggleBtn');
    const searchOverlay = document.getElementById('ajaxSearchOverlay');
    const searchCloseBtn = document.getElementById('searchOverlayCloseBtn');
    const stockSearchInput = document.getElementById('stockSearchInput');
    const quickTagBtns = document.querySelectorAll('.quick-tag-btn');

    if (searchToggleBtn && searchOverlay) {
        searchToggleBtn.addEventListener('click', () => {
            searchOverlay.classList.remove('hidden');
            if (stockSearchInput) {
                setTimeout(() => stockSearchInput.focus(), 50);
            }
        });

        if (searchCloseBtn) {
            searchCloseBtn.addEventListener('click', () => {
                searchOverlay.classList.add('hidden');
            });
        }

        // Búsqueda en vivo al teclear (filtra elementos de stock en la página)
        if (stockSearchInput) {
            stockSearchInput.addEventListener('input', (e) => {
                const query = e.target.value.toLowerCase().trim();
                const stockCards = document.querySelectorAll('.proof-photo-card');
                
                if (stockCards.length > 0) {
                    stockCards.forEach(card => {
                        const title = card.querySelector('h4') ? card.querySelector('h4').textContent.toLowerCase() : '';
                        const meta = card.textContent.toLowerCase();
                        if (query === '' || title.includes(query) || meta.includes(query)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                }
            });
        }

        // Quick tags click
        quickTagBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const term = btn.getAttribute('data-search-term');
                if (stockSearchInput) {
                    stockSearchInput.value = term;
                    stockSearchInput.dispatchEvent(new Event('input'));
                }
            });
        });
    }

    // 4. Off-Canvas Cart (Carrito Lateral Deslizante)
    const cartOpenBtn = document.getElementById('cartDrawerOpenBtn');
    const offCanvasCart = document.getElementById('offCanvasCart');
    const offCanvasOverlay = document.getElementById('offCanvasCartOverlay');
    const cartCloseBtn = document.getElementById('cartDrawerCloseBtn');
    const offCanvasCheckoutBtn = document.getElementById('offCanvasCheckoutBtn');

    const openCartDrawer = () => {
        if (offCanvasCart && offCanvasOverlay) {
            offCanvasOverlay.classList.remove('hidden');
            offCanvasCart.classList.add('open');
            document.body.style.overflow = 'hidden'; // Prevenir scroll de fondo
        }
    };

    const closeCartDrawer = () => {
        if (offCanvasCart && offCanvasOverlay) {
            offCanvasCart.classList.remove('open');
            offCanvasOverlay.classList.add('hidden');
            document.body.style.overflow = '';
        }
    };

    if (cartOpenBtn) {
        cartOpenBtn.addEventListener('click', openCartDrawer);
    }
    if (cartCloseBtn) {
        cartCloseBtn.addEventListener('click', closeCartDrawer);
    }
    if (offCanvasOverlay) {
        offCanvasOverlay.addEventListener('click', closeCartDrawer);
    }

    if (offCanvasCheckoutBtn) {
        offCanvasCheckoutBtn.addEventListener('click', () => {
            const store = window.dpStore || {};
            // Si hay fotos seleccionadas en el dock, usar ese flujo (carrito + checkout).
            const dockCheckout = document.getElementById('dockCheckoutBtn');
            if (window.clientStore && window.clientStore.selectedPhotos && window.clientStore.selectedPhotos.size > 0 && dockCheckout) {
                closeCartDrawer();
                dockCheckout.click();
            } else if (store.checkoutUrl) {
                // Ir directo al checkout de WooCommerce (donde actúa Mercado Pago).
                window.location.href = store.checkoutUrl;
            } else {
                alert((store.i18n && store.i18n.noStore) || 'La tienda todavía no está configurada.');
            }
        });
    }

    // 5. Menú Móvil Full-Screen Overlay
    const mobileOpenBtn = document.getElementById('mobileMenuOpenBtn');
    const mobileFullscreenMenu = document.getElementById('mobileFullscreenMenu');
    const mobileCloseBtn = document.getElementById('mobileMenuCloseBtn');

    if (mobileOpenBtn && mobileFullscreenMenu) {
        mobileOpenBtn.addEventListener('click', () => {
            mobileFullscreenMenu.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });

        const closeMobileMenu = () => {
            mobileFullscreenMenu.classList.add('hidden');
            document.body.style.overflow = '';
        };

        if (mobileCloseBtn) {
            mobileCloseBtn.addEventListener('click', closeMobileMenu);
        }

        mobileFullscreenMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });
    }

    // Cerrar modales con tecla ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (searchOverlay && !searchOverlay.classList.contains('hidden')) {
                searchOverlay.classList.add('hidden');
            }
            if (offCanvasCart && offCanvasCart.classList.contains('open')) {
                closeCartDrawer();
            }
            if (mobileFullscreenMenu && !mobileFullscreenMenu.classList.contains('hidden')) {
                mobileFullscreenMenu.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }
    });

    // 6. Newsletter Minimalista (Feedback visual)
    const newsletterForm = document.getElementById('footerNewsletterForm');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const input = document.getElementById('subscriberEmail');
            if (input && input.value) {
                const originalText = newsletterForm.innerHTML;
                newsletterForm.innerHTML = `
                    <div class="flex items-center gap-2 py-3 text-[#00D2FF] font-bold text-xs">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        <span>¡Bienvenido a la lista privada! Revisa tu bandeja de entrada.</span>
                    </div>
                `;
                if (typeof lucide !== 'undefined') lucide.createIcons();
            }
        });
    }

    // 7. Mega-Menú links directos a filtros de portfolio
    document.querySelectorAll('.mega-card').forEach(card => {
        card.addEventListener('click', (e) => {
            const cat = card.getAttribute('data-category');
            const targetBtn = document.querySelector(`.portfolio-filter-btn[data-filter="${cat}"]`);
            if (targetBtn) {
                targetBtn.click();
            }
        });
    });

    // 8. Protección de previews contra clic derecho
    const protectedElements = document.querySelectorAll('.watermark-overlay, [data-protected-image], .video-preview-wrapper');
    protectedElements.forEach(el => {
        el.addEventListener('contextmenu', (e) => e.preventDefault());
    });
});
