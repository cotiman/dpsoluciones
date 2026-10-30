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
        <!-- Imagen de Fondo Inmersiva (editable en Personalizar → Inicio) -->
        <?php $dp_hero_bg = dp_mod( 'dp_hero_bg' ); ?>
        <?php if ( $dp_hero_bg ) : ?>
            <img src="<?php echo esc_url( $dp_hero_bg ); ?>"
                 alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                 class="hero-bg-img" fetchpriority="high" decoding="async">
        <?php endif; ?>

        <!-- Capa de Superposición Oscura Sutil para Máxima Legibilidad -->
        <div class="hero-bg-overlay"></div>

        <!-- Contenedor Central Glassmorphism -->
        <div class="hero-portal-card glass-panel">
            <?php if ( dp_mod( 'dp_hero_badge' ) ) : ?>
                <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full glass-card border border-[#00D2FF]/30">
                    <span class="w-2 h-2 rounded-full bg-[#00D2FF] animate-ping"></span>
                    <span class="text-xs uppercase font-bold tracking-widest text-[#E2E8F0]"><?php echo esc_html( dp_mod( 'dp_hero_badge' ) ); ?></span>
                </div>
            <?php endif; ?>

            <h1 class="hero-display-title title-sequel">
                <span class="text-white"><?php echo esc_html( dp_mod( 'dp_hero_title1' ) ); ?></span><br>
                <span class="text-metallic"><?php echo esc_html( dp_mod( 'dp_hero_title2' ) ); ?></span> <span class="text-blue-electric"><?php echo esc_html( dp_mod( 'dp_hero_title3' ) ); ?></span>
            </h1>

            <p class="text-slate-300 max-w-xl mx-auto" style="font-size: var(--fluid-text-base);">
                <?php echo esc_html( dp_mod( 'dp_hero_text' ) ); ?>
            </p>

            <!-- Dos Botones de Llamada a la Acción (CTA) de Igual Jerarquía -->
            <div class="portal-cta-group">
                <a href="<?php echo esc_url( dp_mod( 'dp_hero_cta1_link' ) ); ?>" class="portal-btn portal-btn-portfolio">
                    <i data-lucide="eye" class="w-4 h-4 stroke-[2.5]"></i>
                    <span><?php echo esc_html( dp_mod( 'dp_hero_cta1_label' ) ); ?></span>
                </a>

                <a href="<?php echo esc_url( dp_mod( 'dp_hero_cta2_link' ) ); ?>" class="portal-btn portal-btn-store">
                    <i data-lucide="sparkles" class="w-4 h-4 stroke-[2.5]"></i>
                    <span><?php echo esc_html( dp_mod( 'dp_hero_cta2_label' ) ); ?></span>
                </a>
            </div>

            <!-- Datos destacados (editables en Personalizar → Inicio) -->
            <div class="grid grid-cols-3 gap-3 sm:gap-4 pt-4 border-t border-white/10 w-full max-w-lg">
                <div class="p-3 sm:p-3.5 rounded-2xl bg-white/[0.03] border border-white/10 text-center">
                    <div class="title-sequel font-bold text-white text-xs sm:text-sm"><?php echo esc_html( dp_mod( 'dp_hero_m1_title' ) ); ?></div>
                    <div class="text-[10px] text-[#94A3B8] uppercase tracking-wider mt-0.5"><?php echo esc_html( dp_mod( 'dp_hero_m1_sub' ) ); ?></div>
                </div>
                <div class="p-3 sm:p-3.5 rounded-2xl bg-[#00D2FF]/[0.05] border border-[#00D2FF]/20 text-center">
                    <div class="title-sequel font-bold text-[#00D2FF] text-xs sm:text-sm"><?php echo esc_html( dp_mod( 'dp_hero_m2_title' ) ); ?></div>
                    <div class="text-[10px] text-[#94A3B8] uppercase tracking-wider mt-0.5"><?php echo esc_html( dp_mod( 'dp_hero_m2_sub' ) ); ?></div>
                </div>
                <div class="p-3 sm:p-3.5 rounded-2xl bg-white/[0.03] border border-white/10 text-center">
                    <div class="title-sequel font-bold text-white text-xs sm:text-sm"><?php echo esc_html( dp_mod( 'dp_hero_m3_title' ) ); ?></div>
                    <div class="text-[10px] text-[#94A3B8] uppercase tracking-wider mt-0.5"><?php echo esc_html( dp_mod( 'dp_hero_m3_sub' ) ); ?></div>
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
                    <?php echo esc_html( dp_mod( 'dp_pf_eyebrow' ) ); ?>
                </p>

                <!-- Título Masivo — Behance Bold -->
                <h2 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold title-sequel text-white" style="letter-spacing: -0.04em; line-height: 1.0; color: #FFFFFF; margin-bottom: 1.5rem;">
                    <?php echo esc_html( dp_mod( 'dp_pf_title' ) ); ?>
                </h2>

                <!-- Párrafo: color #888888, line-height 1.8, 16px -->
                <p style="color: #888888; line-height: 1.8; font-size: 16px; font-weight: 300; max-width: 700px; margin: 0 0 3rem 0;">
                    <?php echo esc_html( dp_mod( 'dp_pf_text' ) ); ?>
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
                    <?php echo esc_html( dp_mod( 'dp_cg_eyebrow' ) ); ?>
                </p>
                <h2 class="font-extrabold text-white title-sequel" style="font-size: clamp(2rem, 1.5rem + 2.5vw, 5rem); letter-spacing: -0.04em; line-height: 1.0; margin-bottom: 1.25rem;">
                    <?php echo esc_html( dp_mod( 'dp_cg_title' ) ); ?>
                </h2>
                <p style="color: #888888; line-height: 1.8; font-size: 16px; font-weight: 300; max-width: 640px; margin: 0 auto;">
                    <?php echo esc_html( dp_mod( 'dp_cg_text' ) ); ?>
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
                        src="<?php echo esc_url( dp_mod( 'dp_cg_img' ) ); ?>"
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
                            src="<?php echo esc_url( dp_mod( 'dp_cg_img' ) ); ?>"
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
                        <?php echo esc_html( dp_mod( 'dp_cg_meta' ) ); ?>
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
                    <?php echo esc_html( dp_mod( 'dp_store_eyebrow' ) ); ?>
                </p>
                <h2 class="font-extrabold text-white title-sequel" style="font-size: clamp(2rem, 1.5rem + 2.5vw, 4.5rem); letter-spacing: -0.05em; line-height: 1.0; margin-bottom: 1rem;">
                    <?php echo esc_html( dp_mod( 'dp_store_title' ) ); ?>
                </h2>
                <p style="color: #888888; font-size: 16px; font-weight: 300; line-height: 1.8; max-width: 600px; margin: 0 auto;">
                    <?php echo esc_html( dp_mod( 'dp_store_text' ) ); ?>
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
                        <img src="<?php echo esc_url( dp_mod( 'dp_about_photo' ) ); ?>" alt="<?php echo esc_attr( dp_mod( 'dp_about_name' ) ); ?>" class="w-full aspect-[4/5] object-cover rounded-2xl grayscale hover:grayscale-0 transition duration-700" />
                        <div class="absolute bottom-5 left-5 right-5 p-4 rounded-xl bg-black/80 backdrop-blur-lg border border-white/10">
                            <h4 class="text-white font-bold text-sm"><?php echo esc_html( dp_mod( 'dp_about_name' ) ); ?></h4>
                            <p class="text-xs text-[#00D2FF]"><?php echo esc_html( dp_mod( 'dp_about_role' ) ); ?></p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8 space-y-5">
                    <?php if ( dp_mod( 'dp_about_badge' ) ) : ?>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#00D2FF]/10 border border-[#00D2FF]/30 text-[#00D2FF] text-xs font-bold uppercase tracking-widest">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                            <span><?php echo esc_html( dp_mod( 'dp_about_badge' ) ); ?></span>
                        </div>
                    <?php endif; ?>
                    <h3 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight title-sequel">
                        <?php echo esc_html( dp_mod( 'dp_about_title' ) ); ?>
                    </h3>
                    <p class="text-gray-300 leading-relaxed text-sm sm:text-base">
                        <?php echo esc_html( dp_mod( 'dp_about_text' ) ); ?>
                    </p>
                </div>
            </div>

            <!-- Especialidades (Grid de 3 Tarjetas con Fondos Oscuros y Elevación al Hover) -->
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <h4 class="text-xs uppercase font-extrabold tracking-widest text-[#E2E8F0] flex items-center gap-2">
                        <i data-lucide="layers" class="w-4 h-4 text-[#00D2FF]"></i>
                        <span><?php echo esc_html( dp_mod( 'dp_sv_label' ) ); ?></span>
                    </h4>
                    <span class="text-[11px] text-slate-500 font-mono"><?php echo esc_html( dp_mod( 'dp_sv_note' ) ); ?></span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
                    
                    <!-- Tarjeta 1: Producción Comercial -->
                    <div class="p-6 sm:p-8 rounded-2xl bg-gray-900/50 border border-white/10 hover:-translate-y-1 hover:border-[#00D2FF]/40 transition duration-300 shadow-xl space-y-4">
                        <div class="w-12 h-12 rounded-xl bg-[#00D2FF]/10 border border-[#00D2FF]/20 text-[#00D2FF] flex items-center justify-center">
                            <i data-lucide="clapperboard" class="w-6 h-6"></i>
                        </div>
                        <h4 class="text-white font-bold text-lg"><?php echo esc_html( dp_mod( 'dp_sv_c1_title' ) ); ?></h4>
                        <p class="text-sm text-gray-400 leading-relaxed">
                            <?php echo esc_html( dp_mod( 'dp_sv_c1_text' ) ); ?>
                        </p>
                    </div>

                    <!-- Tarjeta 2: Diseño Gráfico & Indumentaria -->
                    <div class="p-6 sm:p-8 rounded-2xl bg-gray-900/50 border border-white/10 hover:-translate-y-1 hover:border-[#00D2FF]/40 transition duration-300 shadow-xl space-y-4">
                        <div class="w-12 h-12 rounded-xl bg-[#00D2FF]/10 border border-[#00D2FF]/20 text-[#00D2FF] flex items-center justify-center">
                            <i data-lucide="palette" class="w-6 h-6"></i>
                        </div>
                        <h4 class="text-white font-bold text-lg"><?php echo esc_html( dp_mod( 'dp_sv_c2_title' ) ); ?></h4>
                        <p class="text-sm text-gray-400 leading-relaxed">
                            <?php echo esc_html( dp_mod( 'dp_sv_c2_text' ) ); ?>
                        </p>
                    </div>

                    <!-- Tarjeta 3: Soporte IT & Infraestructura -->
                    <div class="p-6 sm:p-8 rounded-2xl bg-gray-900/50 border border-white/10 hover:-translate-y-1 hover:border-[#00D2FF]/40 transition duration-300 shadow-xl space-y-4">
                        <div class="w-12 h-12 rounded-xl bg-[#00D2FF]/10 border border-[#00D2FF]/20 text-[#00D2FF] flex items-center justify-center">
                            <i data-lucide="server" class="w-6 h-6"></i>
                        </div>
                        <h4 class="text-white font-bold text-lg"><?php echo esc_html( dp_mod( 'dp_sv_c3_title' ) ); ?></h4>
                        <p class="text-sm text-gray-400 leading-relaxed">
                            <?php echo esc_html( dp_mod( 'dp_sv_c3_text' ) ); ?>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- ========================================== -->
    <!-- 5. SECCIÓN DE CONTACTO (FORMULARIO)        -->
    <!-- ========================================== -->
    <?php if ( dp_mod( 'dp_contact_enable' ) ) : ?>
    <section id="contacto" class="border-t border-white/5 bg-[#0D0D0D] relative overflow-hidden" style="padding-top: 140px; padding-bottom: 140px;">
        <div class="absolute top-1/3 left-1/2 -translate-x-1/2 w-[800px] h-[380px] bg-[#0066FF]/10 rounded-full blur-[170px] pointer-events-none"></div>

        <div class="studio-container max-w-3xl mx-auto relative z-10">
            <div class="text-center mb-10">
                <?php if ( dp_mod( 'dp_contact_eyebrow' ) ) : ?>
                    <p class="store-eyebrow" style="margin: 0 0 1.25rem 0; display: block; text-align: center;">
                        <?php echo esc_html( dp_mod( 'dp_contact_eyebrow' ) ); ?>
                    </p>
                <?php endif; ?>
                <h2 class="font-extrabold text-white title-sequel" style="font-size: clamp(1.8rem, 1.4rem + 2vw, 3.5rem); letter-spacing: -0.03em; line-height: 1.05; margin-bottom: 1rem;">
                    <?php echo esc_html( dp_mod( 'dp_contact_title' ) ); ?>
                </h2>
                <?php if ( dp_mod( 'dp_contact_text' ) ) : ?>
                    <p style="color: #888888; font-size: 16px; font-weight: 300; line-height: 1.8; max-width: 560px; margin: 0 auto;">
                        <?php echo esc_html( dp_mod( 'dp_contact_text' ) ); ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="glass-card p-6 sm:p-10 rounded-3xl border border-white/10 dp-contact-form">
                <?php
                $dp_form = trim( (string) dp_mod( 'dp_contact_form' ) );
                if ( '' !== $dp_form ) {
                    // Formulario del plugin (Contact Form 7, WPForms, etc.).
                    echo do_shortcode( $dp_form );
                } else {
                    // Fallback sin plugin: mostrar el email de contacto.
                    $dp_email = dp_mod( 'dp_contact_email' );
                    echo '<div class="text-center space-y-4">';
                    echo '<p class="text-slate-300 text-sm">' . esc_html__( 'Escribinos directamente a:', 'studio-dark-portfolio' ) . '</p>';
                    if ( $dp_email ) {
                        echo '<a href="mailto:' . esc_attr( $dp_email ) . '" class="btn-primary" style="text-decoration:none;display:inline-flex;"><i data-lucide="mail" class="w-4 h-4"></i><span>' . esc_html( $dp_email ) . '</span></a>';
                    }
                    if ( current_user_can( 'manage_options' ) ) {
                        echo '<p class="text-xs text-slate-500 mt-4">' . esc_html__( 'Sugerencia: instalá “Contact Form 7” y pegá su shortcode en Personalizar → DP · Contenido del Home → Contacto.', 'studio-dark-portfolio' ) . '</p>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
