<?php
/**
 * Footer template for Studio Dark Portfolio
 * FASE FINAL — 4 Columnas Audiovisual
 * Col 1: Identidad / Tagline
 * Col 2: Producción
 * Col 3: Tienda de Recursos (Picsel)
 * Col 4: Conectar / Social
 * Fondo: #0D0D0D | Tipografía: 14px Light #888 | line-height: 2.4
 * Padding top: 100px | Separador: 0.5px solid #222
 *
 * @package Studio_Dark_Portfolio
 */
?>

    <!-- ==========================================================================
         FOOTER AUDIOVISUAL — 4 COLUMNAS
         ========================================================================== -->
    <footer id="contacto" class="site-footer">

        <style>
            /* ── FOOTER BASE ──────────────────────────────────────────────────── */
            .av-footer {
                background-color: #0D0D0D;
                padding-top: 100px;
                padding-bottom: 72px;
                position: relative;
            }

            .av-footer__inner {
                max-width: 1600px;
                margin: 0 auto;
                padding: 0 clamp(1.25rem, 1rem + 3vw, 6rem);
            }

            /* Línea horizontal 0.5px antes de las columnas */
            .av-footer__rule {
                width: 100%;
                height: 0.5px;
                background-color: #222222;
                margin-bottom: 72px;
            }

            /* ── GRILLA 4 COLUMNAS ──────────────────────────────────────────── */
            .av-footer__grid {
                display: grid;
                grid-template-columns: 1.8fr 1fr 1fr 1fr;
                gap: 48px;
                align-items: start;
            }

            /* ── COLUMNA 1: IDENTIDAD ───────────────────────────────────────── */
            .av-footer__brand {
                display: flex;
                flex-direction: column;
                gap: 1.25rem;
            }

            .av-footer__brand-name {
                font-family: var(--font-title, 'Space Grotesk', system-ui, sans-serif);
                font-size: clamp(2.25rem, 1.5rem + 2.5vw, 3.75rem);
                font-weight: 800;
                color: #FFFFFF;
                letter-spacing: -0.05em;
                line-height: 1.0;
                text-transform: uppercase;
                margin: 0;
            }

            .av-footer__tagline {
                font-size: 14px;
                font-weight: 300;
                color: #555555;
                line-height: 1.7;
                max-width: 280px;
                margin: 0;
            }

            /* ── COLUMNAS 2–4: LISTAS DE ENLACES ───────────────────────────── */
            .av-footer__col {
                display: flex;
                flex-direction: column;
                gap: 0;
            }

            .av-footer__col-title {
                font-family: var(--font-title, 'Space Grotesk', system-ui, sans-serif);
                font-size: 14px;
                font-weight: 700;
                color: #FFFFFF;
                text-transform: uppercase;
                letter-spacing: 0.04em;
                margin: 0 0 0.75rem 0;
            }

            .av-footer__links {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .av-footer__links li {
                line-height: 2.4; /* Behance: columnas altas y elegantes */
            }

            .av-footer__links a {
                font-size: 14px;
                font-weight: 300;
                color: #888888;
                text-decoration: none;
                transition: color 0.18s ease;
            }

            .av-footer__links a:hover {
                color: #FFFFFF;
            }

            /* ── SOCIAL CON ICONOS INLINE ───────────────────────────────────── */
            .av-footer__social-link {
                display: inline-flex;
                align-items: center;
                gap: 0.55rem;
            }

            .av-footer__social-link svg {
                opacity: 0.5;
                transition: opacity 0.18s ease;
                flex-shrink: 0;
            }

            .av-footer__social-link:hover svg {
                opacity: 1;
            }

            /* ── BOTTOM BAR ─────────────────────────────────────────────────── */
            .av-footer__bottom {
                margin-top: 72px;
                padding-top: 24px;
                border-top: 0.5px solid #1A1A1A;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                text-align: center;
            }

            .av-footer__credit {
                font-size: 12px;
                font-weight: 300;
                color: #333333;
                letter-spacing: 0.05em;
                margin: 0;
            }

            .av-footer__credit span {
                color: #222222;
                margin: 0 0.5rem;
            }

            /* ── RESPONSIVE ─────────────────────────────────────────────────── */
            @media (max-width: 1023px) {
                .av-footer__grid {
                    grid-template-columns: 1fr 1fr;
                    gap: 48px 40px;
                }
            }

            @media (max-width: 599px) {
                .av-footer {
                    padding-top: 80px;
                    padding-bottom: 56px;
                }
                .av-footer__grid {
                    grid-template-columns: 1fr;
                    gap: 40px;
                }
                .av-footer__rule {
                    margin-bottom: 48px;
                }
                .av-footer__brand-name {
                    font-size: clamp(2.5rem, 10vw, 3.5rem);
                }
            }
        </style>

        <div class="av-footer">
            <div class="av-footer__inner">

                <!-- Línea divisoria 0.5px antes de columnas -->
                <div class="av-footer__rule"></div>

                <!-- GRILLA 4 COLUMNAS -->
                <div class="av-footer__grid">

                    <!-- ══ COL 1: IDENTIDAD ════════════════════════════════════ -->
                    <div class="av-footer__brand">
                        <h2 class="av-footer__brand-name"><?php echo esc_html( dp_mod( 'dp_footer_brand' ) ); ?></h2>
                        <p class="av-footer__tagline">
                            <?php echo esc_html( dp_mod( 'dp_footer_tagline' ) ); ?>
                        </p>
                        <p style="font-size: 11px; font-weight: 400; color: #333333; letter-spacing: 0.08em; text-transform: uppercase; margin: 0.5rem 0 0 0;">
                            <?php echo esc_html( dp_mod( 'dp_footer_location' ) ); ?>
                        </p>
                    </div>

                    <!-- ══ COL 2: PRODUCCIÓN ═══════════════════════════════════ -->
                    <div class="av-footer__col">
                        <h3 class="av-footer__col-title">Producción</h3>
                        <ul class="av-footer__links">
                            <li><a href="#portfolio">Spots Comerciales</a></li>
                            <li><a href="#portfolio">Piezas de Autor</a></li>
                            <li><a href="#color-grading">Color Grading</a></li>
                            <li><a href="#portfolio">Cinematografía Aérea</a></li>
                            <li><a href="#portfolio">Casos de Estudio</a></li>
                        </ul>
                    </div>

                    <!-- ══ COL 3: TIENDA DE RECURSOS ══════════════════════════ -->
                    <div class="av-footer__col">
                        <h3 class="av-footer__col-title">Tienda de Recursos</h3>
                        <ul class="av-footer__links">
                            <li><a href="#tienda">Cinematic LUTs</a></li>
                            <li><a href="#tienda">Stock Footage 4K</a></li>
                            <li><a href="#tienda">Texturas de Cine</a></li>
                            <li><a href="#tienda">Licencias de Uso</a></li>
                            <li><a href="#tienda">Catálogo Completo</a></li>
                        </ul>
                    </div>

                    <!-- ══ COL 4: CONECTAR ════════════════════════════════════ -->
                    <div class="av-footer__col">
                        <h3 class="av-footer__col-title">Conectar</h3>
                        <ul class="av-footer__links">
                            <li><a href="#contacto">Briefing de Proyecto</a></li>
                            <li><a href="mailto:<?php echo esc_attr( dp_mod( 'dp_contact_email' ) ); ?>"><?php echo esc_html( dp_mod( 'dp_contact_email' ) ); ?></a></li>
                            <!-- Redes con iconos inline -->
                            <li>
                                <a href="<?php echo esc_url( dp_mod( 'dp_social_instagram' ) ); ?>" target="_blank" rel="noopener noreferrer" class="av-footer__social-link">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                    </svg>
                                    Instagram
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url( dp_mod( 'dp_social_vimeo' ) ); ?>" target="_blank" rel="noopener noreferrer" class="av-footer__social-link">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2.2 7.6c.1 2.2 1.6 5.1 4.5 8.7 3 3.7 5.5 5.5 7.6 5.5 1.3 0 2.4-1.2 3.3-3.6.9-3.4 1.5-6 1.8-7.8.4-2.1.2-3.1-.7-3.1-.6 0-1.5.5-2.7 1.5l-1.5 1.3c.5-1.7 1.3-3 2.5-3.8 1.2-.9 2.5-1.3 3.9-1.3 1.8 0 2.9 1 3.2 3 .3 2.1-.2 4.9-1.5 8.4-1.4 3.7-3.2 5.5-5.5 5.5-2.2 0-3.9-1.6-5.1-4.7L10.2 11c-.7-2.6-1.5-3.9-2.4-3.9-.3 0-.9.4-1.8 1.2L4.5 9.4l-2.3-1.8z"></path>
                                    </svg>
                                    Vimeo
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url( dp_mod( 'dp_social_linkedin' ) ); ?>" target="_blank" rel="noopener noreferrer" class="av-footer__social-link">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                        <rect x="2" y="9" width="4" height="12"></rect>
                                        <circle cx="4" cy="4" r="2"></circle>
                                    </svg>
                                    LinkedIn
                                </a>
                            </li>
                        </ul>
                    </div>

                </div><!-- /.av-footer__grid -->

                <!-- BOTTOM BAR CENTRADO -->
                <div class="av-footer__bottom">
                    <p class="av-footer__credit">
                        <?php echo esc_html( dp_mod( 'dp_footer_location' ) ); ?>. Disponible para proyectos globales.
                        <span>&mdash;</span>
                        &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( dp_mod( 'dp_footer_copyright' ) ); ?>
                    </p>
                </div>

            </div><!-- /.av-footer__inner -->
        </div><!-- /.av-footer -->

    </footer>

    <?php wp_footer(); ?>
</body>
</html>
