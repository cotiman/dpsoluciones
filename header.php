<?php
/**
 * Header template for Studio Dark Portfolio - Advanced Glassmorphism Header
 * Compatible con: Chrome, Firefox, Edge, Opera, Brave, Safari.
 *
 * @package Studio_Dark_Portfolio
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-[#07090E] text-slate-200 antialiased' ); ?>>
<?php wp_body_open(); ?>

<!-- Efectos de Iluminación Ambiental (Ambient Glows) -->
<div class="fixed top-0 left-1/4 w-[600px] h-[600px] bg-[#00D2FF]/10 rounded-full blur-[160px] pointer-events-none -z-10"></div>
<div class="fixed top-1/2 right-10 w-[500px] h-[500px] bg-[#0066FF]/15 rounded-full blur-[180px] pointer-events-none -z-10"></div>

<!-- ==========================================================================
     HEADER PRINCIPAL STICKY CON EFECTO GLASSMORPHISM DINÁMICO
     ========================================================================== -->
<header id="siteHeader" class="site-header">
    <div class="studio-container header-container">
        
        <!-- Mobile Left: Botón Menú Hamburguesa (375px a 768px) -->
        <div class="header-mobile-toggle">
            <button id="mobileMenuOpenBtn" class="mobile-toggle-btn" aria-label="Abrir menú de navegación">
                <i data-lucide="menu" class="w-6 h-6 text-white"></i>
            </button>
        </div>

        <!-- Marca / Logotipo (Centrado en móvil, a la izquierda en desktop) -->
        <div class="header-brand">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-link group">
                <div class="brand-badge">
                    <i data-lucide="aperture" class="w-5 h-5 text-black stroke-[2.5]"></i>
                </div>
                <div class="brand-text">
                    <span class="brand-title title-sequel">
                        <?php bloginfo( 'name' ); ?><span class="text-[#00D2FF]">.</span>
                    </span>
                    <span class="brand-tagline">
                        CINEMA &middot; DRONE &middot; DESIGN
                    </span>
                </div>
            </a>
        </div>

        <!-- Menú de Navegación Desktop con Mega-Menú de Portafolio -->
        <nav class="header-nav-desktop" aria-label="Navegación principal">
            <a href="<?php echo esc_url( home_url( '/#inicio' ) ); ?>" class="nav-item">Inicio</a>

            <!-- Dropdown / Mega-Menú de Portafolio -->
            <div class="mega-menu-trigger-wrapper">
                <a href="<?php echo esc_url( home_url( '/#portfolio' ) ); ?>" class="nav-item mega-nav-link" id="portfolioMegaTrigger">
                    <span>Portafolio</span>
                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-300"></i>
                </a>

                <!-- Panel Flotante del Mega-Menú -->
                <div class="portfolio-mega-menu glass-panel" id="portfolioMegaMenu" role="region" aria-label="Categorías de Portafolio">
                    <div class="mega-menu-grid">
                        
                        <!-- Categoría 1: Producción Comercial -->
                        <a href="<?php echo esc_url( home_url( '/#portfolio?cat=comercial' ) ); ?>" class="mega-card group" data-category="comercial">
                            <div class="mega-card-icon bg-gradient-to-br from-[#00D2FF]/20 to-[#0066FF]/30 text-[#00D2FF] group-hover:scale-110 transition duration-300">
                                <i data-lucide="clapperboard" class="w-5 h-5"></i>
                            </div>
                            <div class="mega-card-content">
                                <h4 class="mega-card-title text-white group-hover:text-[#00D2FF] transition">Producción Comercial</h4>
                                <p class="mega-card-desc">Spots publicitarios, dirección de fotografía 4K/8K y comerciales narrativos con Sony Cinema FX.</p>
                            </div>
                        </a>

                        <!-- Categoría 2: Tomas Aéreas (Drone) -->
                        <a href="<?php echo esc_url( home_url( '/#portfolio?cat=drone' ) ); ?>" class="mega-card group" data-category="drone">
                            <div class="mega-card-icon bg-gradient-to-br from-[#00D2FF]/20 to-[#0066FF]/30 text-[#00D2FF] group-hover:scale-110 transition duration-300">
                                <i data-lucide="navigation" class="w-5 h-5"></i>
                            </div>
                            <div class="mega-card-content">
                                <h4 class="mega-card-title text-white group-hover:text-[#00D2FF] transition">Tomas Aéreas (Drone)</h4>
                                <p class="mega-card-desc">Cinematografía aérea con DJI Mavic 3 Cine y vuelos dinámicos FPV en 5.1K Apple ProRes.</p>
                            </div>
                        </a>

                        <!-- Categoría 3: Diseño Gráfico -->
                        <a href="<?php echo esc_url( home_url( '/#portfolio?cat=diseno' ) ); ?>" class="mega-card group" data-category="diseno">
                            <div class="mega-card-icon bg-gradient-to-br from-[#00D2FF]/20 to-[#0066FF]/30 text-[#00D2FF] group-hover:scale-110 transition duration-300">
                                <i data-lucide="palette" class="w-5 h-5"></i>
                            </div>
                            <div class="mega-card-content">
                                <h4 class="mega-card-title text-white group-hover:text-[#00D2FF] transition">Diseño Gráfico</h4>
                                <p class="mega-card-desc">Identidad de marca, cartelería de cine, key visuals y sistemas tipográficos contemporáneos.</p>
                            </div>
                        </a>

                    </div>
                    
                    <!-- Footer interno del Mega-Menú -->
                    <div class="mega-menu-footer">
                        <span class="text-xs text-slate-400">¿Buscas metraje original para licenciar?</span>
                        <a href="<?php echo esc_url( home_url( '/#tienda' ) ); ?>" class="text-xs font-bold text-[#00D2FF] hover:underline flex items-center gap-1">
                            <span>Explorar Tienda de Stock</span>
                            <i data-lucide="arrow-right" class="w-3 h-3"></i>
                        </a>
                    </div>
                </div>
            </div>

            <a href="<?php echo esc_url( home_url( '/#tienda' ) ); ?>" class="nav-item store-nav-link">
                <span>Tienda de Stock</span>
                <span class="store-badge">Mercado Pago</span>
            </a>
            <a href="<?php echo esc_url( home_url( '/#sobre-mi' ) ); ?>" class="nav-item">Sobre Mí</a>
            <a href="<?php echo esc_url( home_url( '/#contacto' ) ); ?>" class="nav-item">Contacto</a>
        </nav>

        <!-- Acciones a la Derecha: CTA Outline Blanco, Buscador y Carrito -->
        <div class="header-actions flex items-center gap-3">
            
            <!-- Botón CTA "Briefing / Cotizar" Outline Blanco (AGENTS.md V2.1) -->
            <a href="<?php echo esc_url( home_url( '/#contacto' ) ); ?>" class="btn-outline-white hidden sm:inline-flex">
                <span>Briefing / Cotizar</span>
            </a>

            <!-- Botón Lupa (Buscador Inteligente) -->
            <button id="searchBarToggleBtn" class="action-btn" aria-label="Abrir buscador de stock">
                <i data-lucide="search" class="w-4 h-4 text-slate-300 group-hover:text-[#00D2FF] transition"></i>
            </button>

            <!-- Carrito con Badge Dinámico y Apertura Off-Canvas -->
            <button id="cartDrawerOpenBtn" class="action-btn cart-btn group" aria-label="Abrir carrito de compras">
                <i data-lucide="shopping-bag" class="w-4 h-4 text-slate-200 group-hover:text-[#00D2FF] transition"></i>
                <span class="cart-badge" id="headerCartCount">
                    <?php 
                    if ( class_exists( 'WooCommerce' ) && WC()->cart ) {
                        echo esc_html( WC()->cart->get_cart_contents_count() );
                    } else {
                        echo '0';
                    }
                    ?>
                </span>
            </button>

        </div>

    </div>

    <!-- ==========================================================================
         BARRA DE BÚSQUEDA AJAX SUPERPUESTA (AJAX SEARCH OVERLAY)
         ========================================================================== -->
    <div id="ajaxSearchOverlay" class="ajax-search-overlay hidden" role="search">
        <div class="studio-container search-overlay-content">
            <div class="search-input-wrapper">
                <i data-lucide="search" class="w-5 h-5 text-[#00D2FF] search-input-icon"></i>
                <input 
                    type="text" 
                    id="stockSearchInput" 
                    class="stock-search-input" 
                    placeholder="Buscar fotos o clips de stock (ej. Drone, 4K, Cyberpunk, Paisajes)..." 
                    autocomplete="off"
                />
                <button id="searchOverlayCloseBtn" class="search-close-btn" aria-label="Cerrar buscador">
                    <i data-lucide="x" class="w-5 h-5 text-slate-400 hover:text-white transition"></i>
                </button>
            </div>

            <!-- Etiquetas de Búsqueda Rápida -->
            <div class="search-quick-tags">
                <span class="text-[11px] uppercase font-bold text-slate-500 tracking-wider">Tendencias:</span>
                <button class="quick-tag-btn" data-search-term="Drone">Tomas Aéreas Drone</button>
                <button class="quick-tag-btn" data-search-term="4K">Metraje 4K UHD</button>
                <button class="quick-tag-btn" data-search-term="Tokyo">Cyber Tokyo</button>
                <button class="quick-tag-btn" data-search-term="Color">LUTs & Grade</button>
            </div>
            
            <!-- Contenedor de Resultados Dinámicos AJAX -->
            <div id="ajaxSearchResults" class="ajax-search-results hidden"></div>
        </div>
    </div>
</header>

<!-- ==========================================================================
     OFF-CANVAS CART (CARRITO LATERAL DESLIZANTE DE WOOCOMMERCE)
     ========================================================================== -->
<div id="offCanvasCartOverlay" class="offcanvas-overlay hidden" aria-hidden="true"></div>

<aside id="offCanvasCart" class="offcanvas-cart-panel" aria-label="Carrito de compras lateral">
    <div class="offcanvas-header">
        <div class="flex items-center gap-2">
            <i data-lucide="shopping-bag" class="w-5 h-5 text-[#00D2FF]"></i>
            <h3 class="text-base font-extrabold text-white title-sequel">TUS ACTIVOS SELECCIONADOS</h3>
        </div>
        <button id="cartDrawerCloseBtn" class="offcanvas-close-btn" aria-label="Cerrar carrito">
            <i data-lucide="x" class="w-5 h-5 text-slate-400 hover:text-white transition"></i>
        </button>
    </div>

    <!-- Lista de Items en Carrito -->
    <div class="offcanvas-body" id="offCanvasCartItems">
        <div class="cart-empty-state text-center py-16 px-4 space-y-4">
            <div class="w-16 h-16 rounded-full bg-white/5 mx-auto flex items-center justify-center text-slate-500">
                <i data-lucide="sparkles" class="w-8 h-8 stroke-[1.5]"></i>
            </div>
            <h4 class="text-white font-bold text-sm">Tu carrito está vacío</h4>
            <p class="text-xs text-slate-400 max-w-xs mx-auto">
                Explora la tienda de stock y añade fotos de alta resolución o clips 4K con licencia de uso.
            </p>
            <a href="<?php echo esc_url( home_url( '/#tienda' ) ); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 hover:bg-[#00D2FF] hover:text-black font-extrabold text-xs uppercase tracking-wider text-white transition">
                <span>Ver Catálogo de Stock</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>
    </div>

    <!-- Footer con Subtotales y Botón de Pago con Mercado Pago -->
    <div class="offcanvas-footer">
        <div class="flex items-center justify-between py-2 border-b border-white/10 text-xs">
            <span class="text-slate-400 uppercase tracking-wider">Entrega</span>
            <span class="text-[#00D2FF] font-bold">Digital Instantánea</span>
        </div>
        <div class="flex items-center justify-between py-3 text-sm">
            <span class="text-white font-bold">Subtotal Estimado:</span>
            <span class="text-lg font-black text-[#00D2FF] title-sequel" id="offCanvasSubtotal">$U 0</span>
        </div>
        
        <button id="offCanvasCheckoutBtn" class="offcanvas-checkout-btn group">
            <i data-lucide="zap" class="w-4 h-4 fill-current"></i>
            <span>Pagar con Mercado Pago</span>
        </button>
        
        <p class="text-[10px] text-center text-slate-500 flex items-center justify-center gap-1 pt-1">
            <i data-lucide="shield-check" class="w-3 h-3 text-[#00D2FF]"></i>
            <span>Pago seguro encriptado &middot; Descarga directa a tu email</span>
        </p>
    </div>
</aside>

<!-- ==========================================================================
     MENÚ MÓVIL FULL-SCREEN OVERLAY (375px a 768px)
     ========================================================================== -->
<div id="mobileFullscreenMenu" class="mobile-fullscreen-menu hidden" aria-label="Menú móvil completo">
    <div class="mobile-fullscreen-header">
        <span class="text-xs uppercase font-extrabold tracking-widest text-[#00D2FF]">Navegación</span>
        <button id="mobileMenuCloseBtn" class="mobile-close-btn" aria-label="Cerrar menú móvil">
            <i data-lucide="x" class="w-6 h-6 text-white"></i>
        </button>
    </div>

    <div class="mobile-fullscreen-nav">
        <a href="<?php echo esc_url( home_url( '/#inicio' ) ); ?>" class="mobile-nav-link">
            <span>Inicio</span>
        </a>
        <a href="<?php echo esc_url( home_url( '/#portfolio' ) ); ?>" class="mobile-nav-link">
            <span>Portafolio Audiovisual</span>
        </a>
        <div class="mobile-services-list">
            <a href="<?php echo esc_url( home_url( '/#portfolio?cat=comercial' ) ); ?>" class="mobile-service-item">
                <i data-lucide="clapperboard" class="w-4 h-4 text-[#00D2FF]"></i>
                <span>Producción Comercial</span>
            </a>
            <a href="<?php echo esc_url( home_url( '/#portfolio?cat=drone' ) ); ?>" class="mobile-service-item">
                <i data-lucide="navigation" class="w-4 h-4 text-[#00D2FF]"></i>
                <span>Tomas Aéreas (Drone)</span>
            </a>
            <a href="<?php echo esc_url( home_url( '/#portfolio?cat=diseno' ) ); ?>" class="mobile-service-item">
                <i data-lucide="palette" class="w-4 h-4 text-[#00D2FF]"></i>
                <span>Diseño Gráfico</span>
            </a>
        </div>
        <a href="<?php echo esc_url( home_url( '/#tienda' ) ); ?>" class="mobile-nav-link text-[#00D2FF]">
            <span>Tienda de Stock</span>
        </a>
        <a href="<?php echo esc_url( home_url( '/#sobre-mi' ) ); ?>" class="mobile-nav-link">
            <span>Sobre Mí</span>
        </a>
        <a href="<?php echo esc_url( home_url( '/#contacto' ) ); ?>" class="mobile-nav-link">
            <span>Contacto</span>
        </a>
    </div>

    <div class="mobile-fullscreen-footer">
        <p class="text-xs text-slate-400">Cinematografía 4K &middot; Drones DJI &middot; Arte Gráfico</p>
        <div class="flex items-center gap-4 text-[#00D2FF] mt-2">
            <a href="#" aria-label="Instagram"><i data-lucide="instagram" class="w-5 h-5"></i></a>
            <a href="#" aria-label="Vimeo"><i data-lucide="video" class="w-5 h-5"></i></a>
            <a href="#" aria-label="YouTube"><i data-lucide="youtube" class="w-5 h-5"></i></a>
        </div>
    </div>
</div>
