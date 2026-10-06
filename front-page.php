<?php
/**
 * Front-page template for Studio Dark Portfolio
 *
 * @package Studio_Dark_Portfolio
 */

get_header(); ?>

<main id="primary" class="site-main">

    <!-- ========================================== -->
    <!-- 1. HERO PORTAL A PANTALLA COMPLETA (100vh) -->
    <!-- ========================================== -->
    <section id="inicio" class="hero-portal-section">
        <!-- Imagen de Fondo Inmersiva con Soporte para Formatos de Nueva Generación (AVIF/WebP) -->
        <picture class="hero-bg-picture">
            <source srcset="https://images.unsplash.com/photo-1509198397868-475647b2a1e5?auto=format&fit=crop&w=3840&q=85&fm=avif" type="image/avif">
            <source srcset="https://images.unsplash.com/photo-1509198397868-475647b2a1e5?auto=format&fit=crop&w=3840&q=85&fm=webp" type="image/webp">
            <img 
                src="https://images.unsplash.com/photo-1509198397868-475647b2a1e5?auto=format&fit=crop&w=3840&q=85" 
                alt="<?php bloginfo( 'name' ); ?> - Portada Inmersiva" 
                class="hero-bg-img" 
                fetchpriority="high" 
                decoding="async"
            >
        </picture>

        <!-- Capa de Superposición Oscura Sutil para Máxima Legibilidad -->
        <div class="hero-bg-overlay"></div>

        <!-- Contenedor Central Glassmorphism -->
        <div class="hero-portal-card glass-panel">
            <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full glass-card border border-[#00D2FF]/30">
                <span class="w-2 h-2 rounded-full bg-[#00D2FF] animate-ping"></span>
                <span class="text-xs uppercase font-bold tracking-widest text-[#E2E8F0]">Visual Arts & Fine Photography</span>
            </div>

            <h1 class="hero-display-title title-sequel">
                <span class="text-white"><?php bloginfo( 'name' ); ?></span><br>
                <span class="text-metallic">PORTAL</span> <span class="text-blue-electric">CREATIVO</span>
            </h1>

            <p class="text-slate-300 max-w-xl mx-auto" style="font-size: var(--fluid-text-base);">
                Bienvenido al espacio de creación visual contemporánea. Explora las series autorales en el portafolio o adquiere licencias maestras de alta resolución en la tienda protegida.
            </p>

            <!-- Dos Botones de Llamada a la Acción (CTA) de Igual Jerarquía -->
            <div class="portal-cta-group">
                <a href="#portfolio" class="portal-btn portal-btn-portfolio">
                    <i data-lucide="eye" class="w-4 h-4 stroke-[2.5]"></i>
                    <span>Ver Portafolio</span>
                </a>

                <a href="#tienda" class="portal-btn portal-btn-store">
                    <i data-lucide="sparkles" class="w-4 h-4 stroke-[2.5]"></i>
                    <span>Tienda de Fotografías</span>
                </a>
            </div>

            <!-- Métricas de Alto Valor y Confianza (Pod Glassmorphism) -->
            <div class="grid grid-cols-3 gap-3 sm:gap-4 pt-4 border-t border-white/10 w-full max-w-lg">
                <div class="p-3 sm:p-3.5 rounded-2xl bg-white/[0.03] border border-white/10 text-center">
                    <div class="title-sequel font-bold text-white text-xs sm:text-sm">8K &bull; 4K UHD</div>
                    <div class="text-[10px] text-[#94A3B8] uppercase tracking-wider mt-0.5">Master ProRes RAW</div>
                </div>
                <div class="p-3 sm:p-3.5 rounded-2xl bg-[#00D2FF]/[0.05] border border-[#00D2FF]/20 text-center">
                    <div class="title-sequel font-bold text-[#00D2FF] text-xs sm:text-sm">Mercado Pago</div>
                    <div class="text-[10px] text-[#94A3B8] uppercase tracking-wider mt-0.5">Cobro Seguro 24/7</div>
                </div>
                <div class="p-3 sm:p-3.5 rounded-2xl bg-white/[0.03] border border-white/10 text-center">
                    <div class="title-sequel font-bold text-white text-xs sm:text-sm">Descarga Instant</div>
                    <div class="text-[10px] text-[#94A3B8] uppercase tracking-wider mt-0.5">Sin Marcas de Agua</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 2. SECCIÓN PORTFOLIO AUDIOVISUAL (BEHANCE) -->
    <!-- ========================================== -->
    <section id="portfolio" class="border-t border-white/5 bg-[#0D0D0D] relative" style="padding-top: 160px; padding-bottom: 160px;">
        <div class="studio-container max-w-[1600px] mx-auto space-y-16">

            <!-- Cabecera del Portafolio: Behance Style -->
            <div class="max-w-[800px]" style="margin-bottom: 64px;">
                <!-- Eyebrow ultra-minimal: solo texto uppercase con línea -->
                <p class="flex items-center gap-4 mb-8" style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.3em; color: #888888; margin: 0 0 2rem 0;">
                    <span style="display: inline-block; width: 2rem; height: 1px; background: #444444;"></span>
                    PORTAFOLIO AUDIOVISUAL &middot; CASE STUDIES
                </p>

                <!-- Título Masivo — Behance Bold -->
                <h2 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold title-sequel text-white" style="letter-spacing: -0.04em; line-height: 1.0; color: #FFFFFF; margin-bottom: 1.5rem;">
                    PRODUCCIÓN<br>CINEMATOGRÁFICA
                </h2>

                <!-- Párrafo: color #888888, line-height 1.8, 16px -->
                <p style="color: #888888; line-height: 1.8; font-size: 16px; font-weight: 300; max-width: 700px; margin: 0 0 3rem 0;">
                    Transformamos visiones en experiencias cinematográficas. Desde comerciales de alta gama hasta piezas de autor, aplicamos color grading de nivel cinematográfico en cada frame.
                </p>

                <!-- Pills de Filtro generadas desde la taxonomía de Portfolio -->
                <?php dp_render_portfolio_filters(); ?>
            </div>

            <!-- Grilla de Proyectos (CPT Portfolio · YouTube videos/shorts) -->
            <?php dp_render_portfolio_grid(); ?>


        </div>
    </section>

    <!-- ========================================== -->
    <!-- SECCIÓN COLOR GRADING COMPARISON (BEFORE/AFTER) -->
    <!-- ========================================== -->
    <section id="color-grading" class="border-t border-white/5 bg-[#0D0D0D] relative overflow-hidden" style="padding-top: 160px; padding-bottom: 160px;">
        <!-- Resplandor Atmosférico de Fondo -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[350px] bg-[#0066FF]/10 rounded-full blur-[160px] pointer-events-none"></div>

        <div class="studio-container max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- Encabezado: max-w-[800px] per Behance spec -->
            <div class="max-w-[800px] mx-auto text-center mb-16">
                <p style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.3em; color: #888888; margin: 0 0 1.5rem 0;">
                    TÉCNICA CINEMATOGRÁFICA &middot; ETALONAJE
                </p>
                <h2 class="font-extrabold text-white title-sequel" style="font-size: clamp(2rem, 1.5rem + 2.5vw, 5rem); letter-spacing: -0.04em; line-height: 1.0; margin-bottom: 1.25rem;">
                    Cinematic Color Grading:<br>Log to Final Film Look
                </h2>
                <p style="color: #888888; line-height: 1.8; font-size: 16px; font-weight: 300; max-width: 640px; margin: 0 auto;">
                    Transformamos la señal neutra de cámara (S-Log3/V-Log) en una pieza cinematográfica con emulación de película Kodak 2383. Desliza para ver el proceso de etalonaje.
                </p>
            </div>

            <!-- ═══ SLIDER ARTLIST — FASE 3 ═══════════════════════════════════ -->
            <div style="width: 100%; max-width: 1100px; margin: 0 auto;">

                <!-- BLOQUE SÓLIDO DEL COMPARADOR -->
                <div
                    id="cgComparator"
                    style="
                        position: relative;
                        width: 100%;
                        aspect-ratio: 16 / 9;
                        border-radius: 12px;
                        overflow: hidden;
                        background: #000;
                        cursor: ew-resize;
                        user-select: none;
                        -webkit-user-select: none;
                        touch-action: none;
                        display: block;
                    "
                >
                    <!-- ── CAPA BASE: SOURCE (S-Log3 flat) ──────────────────── -->
                    <img
                        id="cgSourceImg"
                        src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?auto=format&fit=crop&w=2400&q=90"
                        alt="Source — S-Log3 Flat Profile"
                        style="
                            position: absolute; inset: 0;
                            width: 100%; height: 100%;
                            object-fit: cover;
                            pointer-events: none;
                            filter: saturate(0.18) contrast(0.68) brightness(1.22);
                            z-index: 1;
                        "
                        loading="eager"
                    />

                    <!-- Label SOURCE — esquina inferior derecha, opacidad 50% -->
                    <span id="cgLabelSource" style="
                        position: absolute;
                        bottom: 20px; right: 22px;
                        z-index: 4;
                        font-family: ui-sans-serif, system-ui, sans-serif;
                        font-size: 11px;
                        font-weight: 600;
                        text-transform: uppercase;
                        letter-spacing: 0.2em;
                        color: #FFFFFF;
                        opacity: 0.5;
                        pointer-events: none;
                        user-select: none;
                    ">Source</span>

                    <!-- ── CAPA SUPERIOR: APEX (Graded Film Look) ───────────── -->
                    <!-- El width de este div es lo que controla el slider -->
                    <div
                        id="cgApexWrapper"
                        style="
                            position: absolute; top: 0; left: 0;
                            height: 100%; width: 50%;
                            overflow: hidden;
                            z-index: 10;
                            pointer-events: none;
                            will-change: width;
                        "
                    >
                        <!-- Imagen Apex: anclada al tamaño del padre — se sincroniza vía JS -->
                        <img
                            id="cgApexImg"
                            src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?auto=format&fit=crop&w=2400&q=90"
                            alt="Apex — Rec.709 Film Emulation"
                            style="
                                position: absolute; top: 0; left: 0;
                                height: 100%;
                                object-fit: cover;
                                pointer-events: none;
                                filter: saturate(1.52) contrast(1.28) brightness(0.94) hue-rotate(-5deg);
                            "
                            loading="eager"
                        />

                        <!-- Label APEX — esquina inferior izquierda, opacidad 50% -->
                        <span style="
                            position: absolute;
                            bottom: 20px; left: 22px;
                            z-index: 12;
                            font-family: ui-sans-serif, system-ui, sans-serif;
                            font-size: 11px;
                            font-weight: 600;
                            text-transform: uppercase;
                            letter-spacing: 0.2em;
                            color: #FFFFFF;
                            opacity: 0.5;
                            pointer-events: none;
                            user-select: none;
                        ">Apex</span>

                        <!-- ── LÍNEA DIVISORIA: 1px blanca, sutil ──────────── -->
                        <div style="
                            position: absolute; top: 0; right: 0; bottom: 0;
                            width: 1px;
                            background-color: rgba(255, 255, 255, 0.85);
                            z-index: 20;
                        "></div>

                        <!-- ── HANDLE CIRCULAR PEQUEÑO (28px) con flechas < > ─ -->
                        <div style="
                            position: absolute;
                            top: 50%; right: 0;
                            transform: translate(50%, -50%);
                            width: 28px; height: 28px;
                            background: #FFFFFF;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
                            z-index: 25;
                            pointer-events: none;
                            user-select: none;
                            gap: 0;
                        ">
                            <!-- Flecha izquierda < -->
                            <svg width="9" height="9" viewBox="0 0 10 10" fill="none" style="flex-shrink:0;">
                                <path d="M7 1L3 5L7 9" stroke="#000000" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <!-- Flecha derecha > -->
                            <svg width="9" height="9" viewBox="0 0 10 10" fill="none" style="flex-shrink:0;">
                                <path d="M3 1L7 5L3 9" stroke="#000000" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>

                    </div><!-- /cgApexWrapper -->

                    <!-- ── INSTRUCCIÓN FLOTANTE (fade-out a los 2.5s) ──────── -->
                    <div
                        id="cgInstruction"
                        style="
                            position: absolute;
                            top: 16px; left: 50%; transform: translateX(-50%);
                            z-index: 30;
                            padding: 5px 14px;
                            border-radius: 9999px;
                            background: rgba(0, 0, 0, 0.55);
                            backdrop-filter: blur(8px);
                            -webkit-backdrop-filter: blur(8px);
                            border: 1px solid rgba(255, 255, 255, 0.1);
                            font-family: ui-sans-serif, system-ui, sans-serif;
                            font-size: 10px;
                            font-weight: 500;
                            text-transform: uppercase;
                            letter-spacing: 0.15em;
                            color: rgba(255, 255, 255, 0.65);
                            pointer-events: none;
                            white-space: nowrap;
                            transition: opacity 0.6s ease;
                        "
                    >Desliza para comparar</div>

                </div><!-- /cgComparator -->

                <!-- JS del slider — rAF para suavidad de 60fps -->
                <script>
                (function () {
                    var container   = document.getElementById('cgComparator');
                    var apexWrapper = document.getElementById('cgApexWrapper');
                    var apexImg     = document.getElementById('cgApexImg');
                    var instruction = document.getElementById('cgInstruction');
                    if (!container || !apexWrapper || !apexImg) return;

                    var raf      = null;
                    var targetX  = 50; /* porcentaje */
                    var firstMove = false;

                    /* Sincroniza el ancho exacto de la imagen interior */
                    function syncWidth() {
                        var w = container.offsetWidth;
                        if (w > 0) {
                            apexImg.style.width    = w + 'px';
                            apexImg.style.minWidth = w + 'px';
                        }
                    }
                    syncWidth();
                    window.addEventListener('resize', syncWidth);

                    /* Calcula porcentaje desde coordenada X de pantalla */
                    function calcPercent(clientX) {
                        var rect = container.getBoundingClientRect();
                        if (rect.width <= 0) return 50;
                        var pct = ((clientX - rect.left) / rect.width) * 100;
                        return Math.max(0, Math.min(100, pct));
                    }

                    /* Aplica el width — llamado desde rAF */
                    function applyWidth() {
                        apexWrapper.style.width = targetX + '%';
                        raf = null;
                    }

                    function setTarget(clientX) {
                        targetX = calcPercent(clientX);
                        if (!raf) { raf = requestAnimationFrame(applyWidth); }
                        /* Oculta instrucción en el primer movimiento */
                        if (!firstMove) {
                            firstMove = true;
                            if (instruction) { instruction.style.opacity = '0'; }
                        }
                    }

                    /* Auto-ocultar instrucción después de 2.5s si no hay movimiento */
                    setTimeout(function () {
                        if (instruction && !firstMove) { instruction.style.opacity = '0'; }
                    }, 2500);

                    /* ── Eventos Mouse ── */
                    container.addEventListener('mousemove',  function (e) { setTarget(e.clientX); });
                    container.addEventListener('mouseenter', function (e) { syncWidth(); setTarget(e.clientX); });

                    /* ── Eventos Touch (soporte móvil) ── */
                    container.addEventListener('touchmove', function (e) {
                        if (e.touches && e.touches.length > 0) { setTarget(e.touches[0].clientX); }
                    }, { passive: true });
                    container.addEventListener('touchstart', function (e) {
                        syncWidth();
                        if (e.touches && e.touches.length > 0) { setTarget(e.touches[0].clientX); }
                    }, { passive: true });

                    /* ── API pública para botones SOURCE / SPLIT / APEX ── */
                    window.setSliderPercent = function (pct) {
                        targetX = pct;
                        apexWrapper.style.transition = 'width 0.4s cubic-bezier(0.16, 1, 0.3, 1)';
                        apexWrapper.style.width = pct + '%';
                        setTimeout(function () { apexWrapper.style.transition = ''; }, 400);
                    };
                })();
                </script>

                <!-- Metadata técnica + botones de vista rápida -->
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; padding-top: 1.25rem;">
                    <div style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.18em; color: #444444; font-family: ui-monospace, monospace; font-weight: 500;">
                        [ CAMERA: SONY A7SIII ] &nbsp;|&nbsp; [ COLOR SPACE: REC.709 ] &nbsp;|&nbsp; [ LUT: APEX FILM ]
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.15em; color: #333333; font-family: ui-monospace, monospace;">Vista:</span>
                        <button type="button" onclick="setSliderPercent(0)" style="padding: 4px 10px; border: 1px solid #2A2A2A; background: transparent; color: #666666; font-size: 10px; font-family: ui-monospace, monospace; text-transform: uppercase; letter-spacing: 0.12em; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.color='#FFFFFF';this.style.borderColor='#FFFFFF';" onmouseout="this.style.color='#666666';this.style.borderColor='#2A2A2A';">SOURCE</button>
                        <button type="button" onclick="setSliderPercent(50)" style="padding: 4px 10px; border: 1px solid #2A2A2A; background: transparent; color: #666666; font-size: 10px; font-family: ui-monospace, monospace; text-transform: uppercase; letter-spacing: 0.12em; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.color='#FFFFFF';this.style.borderColor='#FFFFFF';" onmouseout="this.style.color='#666666';this.style.borderColor='#2A2A2A';">SPLIT</button>
                        <button type="button" onclick="setSliderPercent(100)" style="padding: 4px 10px; border: 1px solid #2A2A2A; background: transparent; color: #666666; font-size: 10px; font-family: ui-monospace, monospace; text-transform: uppercase; letter-spacing: 0.12em; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.color='#FFFFFF';this.style.borderColor='#FFFFFF';" onmouseout="this.style.color='#666666';this.style.borderColor='#2A2A2A';">APEX</button>
                    </div>
                </div>

            </div><!-- /max-w-[1100px] wrapper -->


        </div>
    </section>

    <!-- ========================================== -->
    <!-- 3. SECCIÓN TIENDA DE STOCK DIGITAL        -->
    <!-- ========================================== -->
    <section id="tienda" class="border-t border-white/5 relative overflow-hidden bg-[#0D0D0D]" style="padding-top: 160px; padding-bottom: 160px;">
        <div class="absolute top-1/3 left-1/2 -translate-x-1/2 w-[900px] h-[400px] bg-[#0066FF]/10 rounded-full blur-[180px] pointer-events-none"></div>

        <div class="studio-container max-w-[1600px] mx-auto space-y-8 relative z-10">

            <!-- Cabecera Monocromática -->
            <div class="text-center max-w-[800px] mx-auto" style="margin-bottom: 56px;">
                <p class="store-eyebrow" style="margin: 0 0 1.5rem 0; display: block; text-align: center;">
                    Catálogo Oficial &middot; Fotografía & Video en Stock
                </p>
                <h2 class="font-extrabold text-white title-sequel" style="font-size: clamp(2rem, 1.5rem + 2.5vw, 4.5rem); letter-spacing: -0.05em; line-height: 1.0; margin-bottom: 1rem;">
                    METRAJE 4K &<br>FOTOGRAFÍA AUTORAL
                </h2>
                <p style="color: #888888; font-size: 16px; font-weight: 300; line-height: 1.8; max-width: 600px; margin: 0 auto;">
                    Seleccioná activos marcándolos con el corazón para armar tu selección y adquirirlos en lote con entrega instantánea.
                </p>
            </div>

            <!-- Tabs de Sesión -->
            <div class="session-filter-nav">
                <button class="session-tab-btn active" data-session="all"><?php esc_html_e( 'Todas las Fotos', 'studio-dark-portfolio' ); ?></button>
                <button class="session-tab-btn" data-session="favorites"><?php esc_html_e( 'Mi Selección', 'studio-dark-portfolio' ); ?></button>
            </div>

            <!-- Filtros Facetados — monocromáticos -->
            <div class="faceted-filter-bar">
                <div class="filter-group">
                    <span class="filter-group-label">Orientación</span>
                    <button class="filter-pill-btn active" data-filter-type="orientation" data-filter-val="all">Todas</button>
                    <button class="filter-pill-btn" data-filter-type="orientation" data-filter-val="horizontal">Horizontal</button>
                    <button class="filter-pill-btn" data-filter-type="orientation" data-filter-val="vertical">Vertical</button>
                    <button class="filter-pill-btn" data-filter-type="orientation" data-filter-val="square">Cuadrado</button>
                </div>
                <div class="filter-group">
                    <span class="filter-group-label">Resolución</span>
                    <button class="filter-pill-btn active" data-filter-type="resolution" data-filter-val="all">Todas</button>
                    <button class="filter-pill-btn" data-filter-type="resolution" data-filter-val="4k">4K / 8K</button>
                    <button class="filter-pill-btn" data-filter-type="resolution" data-filter-val="hd">Full HD</button>
                </div>
            </div>

            <!-- ═══ GRILLA DE STOCK (Productos WooCommerce · categoría Fotos) ═══ -->
            <?php dp_render_store_grid(); ?>

            <!-- FLOATING DOCK — MONOCROMÁTICO -->
            <div class="floating-selection-dock" id="floatingSelectionDock">
                <div class="dock-counter-pill">
                    <span class="dock-badge-num" id="dockBadgeCount">0</span>
                    <span id="dockCountText">activos seleccionados</span>
                    <span class="dock-total-price" id="dockTotalPrice"></span>
                </div>
                <div class="dock-actions">
                    <button class="dock-btn-clear" id="dockClearBtn">Vaciar</button>
                    <button class="dock-btn-checkout" id="dockCheckoutBtn">
                        Comprar con Mercado Pago
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </section>


    <!-- ========================================== -->
    <!-- 4. SECCIÓN SOBRE MÍ & PERFIL HÍBRIDO      -->
    <!-- ========================================== -->
    <section id="sobre-mi" class="border-t border-white/5 bg-[#0D0D0D]" style="padding-top: 160px; padding-bottom: 160px;">
        <div class="studio-container max-w-[1600px] mx-auto space-y-12">
            
            <!-- Presentación Superior: Foto + Perfil Híbrido -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <div class="lg:col-span-4 relative">
                    <div class="relative rounded-3xl overflow-hidden glass-card p-2">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=80" alt="Lead Visual Artist" class="w-full aspect-[4/5] object-cover rounded-2xl grayscale hover:grayscale-0 transition duration-700" />
                        <div class="absolute bottom-5 left-5 right-5 p-4 rounded-xl bg-black/80 backdrop-blur-lg border border-white/10">
                            <h4 class="text-white font-bold text-sm"><?php bloginfo( 'name' ); ?></h4>
                            <p class="text-xs text-[#00D2FF]">Director Creativo & Fotógrafo</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#00D2FF]/10 border border-[#00D2FF]/30 text-[#00D2FF] text-xs font-bold uppercase tracking-widest">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                        <span>Perfil Híbrido &bull; Dirección Creativa & IT</span>
                    </div>
                    <h3 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight title-sequel">
                        CREACIÓN AUDIOVISUAL, <span class="text-[#00D2FF]">DISEÑO DE MARCA</span> & INFRAESTRUCTURA TÉCNICA
                    </h3>
                    <p class="text-gray-300 leading-relaxed text-sm sm:text-base">
                        Especializado en converger la estética cinematográfica de alta fidelidad con la precisión del diseño gráfico contemporáneo y el rigor de la ingeniería tecnológica. Desde el rodaje publicitario en 4K/8K con ópticas de cine hasta el despliegue de redes corporativas, servidores de datos y almacenamiento masivo para flujos de trabajo de postproducción intensiva.
                    </p>
                </div>
            </div>

            <!-- Especialidades (Grid de 3 Tarjetas con Fondos Oscuros y Elevación al Hover) -->
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <h4 class="text-xs uppercase font-extrabold tracking-widest text-[#E2E8F0] flex items-center gap-2">
                        <i data-lucide="layers" class="w-4 h-4 text-[#00D2FF]"></i>
                        <span>Especialidades & Servicios Principales</span>
                    </h4>
                    <span class="text-[11px] text-slate-500 font-mono">End-to-End Workflow</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
                    
                    <!-- Tarjeta 1: Producción Comercial -->
                    <div class="p-6 sm:p-8 rounded-2xl bg-gray-900/50 border border-white/10 hover:-translate-y-1 hover:border-[#00D2FF]/40 transition duration-300 shadow-xl space-y-4">
                        <div class="w-12 h-12 rounded-xl bg-[#00D2FF]/10 border border-[#00D2FF]/20 text-[#00D2FF] flex items-center justify-center">
                            <i data-lucide="clapperboard" class="w-6 h-6"></i>
                        </div>
                        <h4 class="text-white font-bold text-lg">Producción Comercial</h4>
                        <p class="text-sm text-gray-400 leading-relaxed">
                            Spots publicitarios, dirección de fotografía 4K/8K, rodajes aéreos con drones y corrección de color en DaVinci Resolve.
                        </p>
                    </div>

                    <!-- Tarjeta 2: Diseño Gráfico & Indumentaria -->
                    <div class="p-6 sm:p-8 rounded-2xl bg-gray-900/50 border border-white/10 hover:-translate-y-1 hover:border-[#00D2FF]/40 transition duration-300 shadow-xl space-y-4">
                        <div class="w-12 h-12 rounded-xl bg-[#00D2FF]/10 border border-[#00D2FF]/20 text-[#00D2FF] flex items-center justify-center">
                            <i data-lucide="palette" class="w-6 h-6"></i>
                        </div>
                        <h4 class="text-white font-bold text-lg">Diseño Gráfico & Indumentaria</h4>
                        <p class="text-sm text-gray-400 leading-relaxed">
                            Desarrollo de identidad visual, gráfica para indumentaria técnica, dirección de arte, cartelería de cine y packaging.
                        </p>
                    </div>

                    <!-- Tarjeta 3: Soporte IT & Infraestructura -->
                    <div class="p-6 sm:p-8 rounded-2xl bg-gray-900/50 border border-white/10 hover:-translate-y-1 hover:border-[#00D2FF]/40 transition duration-300 shadow-xl space-y-4">
                        <div class="w-12 h-12 rounded-xl bg-[#00D2FF]/10 border border-[#00D2FF]/20 text-[#00D2FF] flex items-center justify-center">
                            <i data-lucide="server" class="w-6 h-6"></i>
                        </div>
                        <h4 class="text-white font-bold text-lg">Soporte IT & Infraestructura</h4>
                        <p class="text-sm text-gray-400 leading-relaxed">
                            Sistemas de almacenamiento masivo SAN/NAS de alta velocidad para postproducción, redes corporativas y seguridad de datos.
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>
