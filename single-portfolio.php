<?php
/**
 * Single template for Audiovisual Portfolio projects (Behance-Style Narrative Case Study)
 *
 * @package Studio_Dark_Portfolio
 */

get_header(); ?>

<main id="primary" class="site-main pt-28 pb-24 px-4 sm:px-6">
    <div class="studio-container max-w-6xl mx-auto space-y-12">
        
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'space-y-12' ); ?>>
                
                <!-- Navegación de Regreso -->
                <div class="flex items-center justify-between border-b border-white/10 pb-6">
                    <a href="<?php echo esc_url( home_url( '/#portfolio' ) ); ?>" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-[#00D2FF] hover:text-white transition">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        <span>Volver al Portafolio Audiovisual</span>
                    </a>
                    
                    <div class="flex items-center gap-2 text-xs text-[#94A3B8]">
                        <i data-lucide="film" class="w-3.5 h-3.5 text-[#00D2FF]"></i>
                        <span>Case Study &middot; Producción Original</span>
                    </div>
                </div>

                <!-- Encabezado Editorial del Proyecto -->
                <header class="space-y-6 text-center max-w-4xl mx-auto">
                    <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full glass-card border border-[#00D2FF]/25">
                        <span class="w-2 h-2 rounded-full bg-[#00D2FF] animate-pulse"></span>
                        <?php
                        $categories = get_the_terms( get_the_ID(), 'portfolio_category' );
                        $cat_name = ( ! empty( $categories ) && ! is_wp_error( $categories ) ) ? $categories[0]->name : 'Comercial & Audiovisual';
                        ?>
                        <span class="text-xs uppercase font-extrabold tracking-widest text-[#E2E8F0]"><?php echo esc_html( $cat_name ); ?></span>
                    </div>

                    <h1 class="text-3xl sm:text-6xl font-black text-white title-sequel tracking-tight leading-[1.08]">
                        <?php the_title(); ?>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto font-normal leading-relaxed">
                        <?php echo has_excerpt() ? get_the_excerpt() : 'Dirección visual, cinematografía y postproducción de color de alta fidelidad para campaña publicitaria y medios digitales.'; ?>
                    </p>
                </header>

                <!-- 1. VIDEO PRINCIPAL (HERO CINEMATOGRÁFICO) -->
                <div class="rounded-3xl overflow-hidden glass-card p-2 sm:p-4 shadow-2xl shadow-[#0066FF]/25">
                    <div class="relative aspect-video rounded-2xl overflow-hidden bg-black group">
                        <?php 
                        $video_embed = get_post_meta( get_the_ID(), '_studio_video_embed', true );
                        $video_mp4   = get_post_meta( get_the_ID(), '_studio_video_mp4', true );

                        if ( ! empty( $video_embed ) ) : 
                            echo '<div class="w-full h-full">' . wp_oembed_get( $video_embed ) . '</div>';
                        elseif ( ! empty( $video_mp4 ) ) : ?>
                            <video controls playsinline preload="metadata" poster="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>" class="w-full h-full object-cover">
                                <source src="<?php echo esc_url( $video_mp4 ); ?>" type="video/mp4">
                                Tu navegador no soporta reproducción de video HTML5.
                            </video>
                        <?php elseif ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover' ) ); ?>
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center pointer-events-none">
                                <div class="w-16 h-16 rounded-full bg-[#00D2FF]/20 border border-[#00D2FF] flex items-center justify-center text-[#00D2FF]">
                                    <i data-lucide="play" class="w-8 h-8 fill-current ml-1"></i>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 2. FICHA TÉCNICA Y ESPECIFICACIONES DE RODAJE (METADATA GRID) -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-6 rounded-2xl glass-panel border border-white/10">
                    <div>
                        <span class="text-[10px] uppercase tracking-widest text-[#94A3B8] block mb-1">Cámara Principal</span>
                        <span class="text-white font-bold text-xs sm:text-sm">Sony FX6 / FX3 Cinema</span>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase tracking-widest text-[#94A3B8] block mb-1">Ópticas / Lentes</span>
                        <span class="text-white font-bold text-xs sm:text-sm">Sony G-Master 35mm &middot; 50mm f/1.2</span>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase tracking-widest text-[#94A3B8] block mb-1">Formato / Códec</span>
                        <span class="text-[#00D2FF] font-bold text-xs sm:text-sm">4K DCI &middot; XAVC-I 10-Bit 4:2:2</span>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase tracking-widest text-[#94A3B8] block mb-1">Color Workflow</span>
                        <span class="text-white font-bold text-xs sm:text-sm">S-Log3 &middot; ACEScc &middot; DaVinci</span>
                    </div>
                </div>

                <!-- 3. COMPARADOR INTERACTIVO ANTES / DESPUÉS (COLOR GRADING BREAKDOWN) -->
                <section class="space-y-4">
                    <div class="border-t border-white/10 pt-8">
                        <h3 class="text-xl sm:text-2xl font-bold text-white title-sequel flex items-center gap-3">
                            <i data-lucide="palette" class="w-6 h-6 text-[#00D2FF]"></i>
                            <span>Desglose de Color Grading & Emulación de Película</span>
                        </h3>
                        <p class="text-sm text-slate-400 mt-1 max-w-2xl">
                            Transformación de señal plana S-Log3 a espacio Rec.709 con emulación fotoquímica de película Kodak 2383 y contraste tonal preservado.
                        </p>
                    </div>

                    <?php 
                    // Renderizar shortcode interactivo de antes/después
                    echo do_shortcode( '[studio_before_after before="https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=1600&q=80" after="https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=1600&q=80" label_before="Log RAW / Sin Procesar" label_after="Final Grade / Rec.709 Master"]' ); 
                    ?>
                </section>

                <!-- 4. CONTENIDO NARRATIVO Y STAGED STILLS (BEHANCE VERTICAL STREAM) -->
                <section class="grid grid-cols-1 lg:grid-cols-12 gap-12 pt-6">
                    <div class="lg:col-span-8 space-y-8 text-slate-300 leading-relaxed text-base">
                        <h3 class="text-2xl font-bold text-white title-sequel">Concepto & Dirección Creativa</h3>
                        
                        <?php the_content(); ?>

                        <!-- Flujo Vertical de Fotogramas (Stills) -->
                        <div class="space-y-6 pt-4">
                            <div class="rounded-2xl overflow-hidden glass-card">
                                <img src="https://images.unsplash.com/photo-1509198397868-475647b2a1e5?auto=format&fit=crop&w=1600&q=80" alt="Producción Audiovisual Still 01" loading="lazy" class="w-full h-auto object-cover" />
                            </div>
                            <div class="rounded-2xl overflow-hidden glass-card">
                                <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=1600&q=80" alt="Producción Audiovisual Still 02" loading="lazy" class="w-full h-auto object-cover" />
                            </div>
                        </div>
                    </div>

                    <!-- Ficha Lateral de Créditos & Call to Action -->
                    <aside class="lg:col-span-4 space-y-6">
                        <div class="p-6 rounded-2xl glass-card space-y-5 text-xs">
                            <h4 class="text-white font-bold uppercase tracking-wider text-sm border-b border-white/10 pb-3 flex items-center gap-2">
                                <i data-lucide="users" class="w-4 h-4 text-[#00D2FF]"></i>
                                <span>Créditos de Producción</span>
                            </h4>
                            
                            <div>
                                <span class="text-[#94A3B8] block mb-0.5">Cliente / Marca:</span>
                                <span class="text-white font-semibold text-sm">Aether Media Group</span>
                            </div>

                            <div>
                                <span class="text-[#94A3B8] block mb-0.5">Director & Cinematógrafo:</span>
                                <span class="text-white font-semibold text-sm"><?php bloginfo( 'name' ); ?></span>
                            </div>

                            <div>
                                <span class="text-[#94A3B8] block mb-0.5">Color Grading & Finishing:</span>
                                <span class="text-[#00D2FF] font-semibold text-sm">Aether Color Labs</span>
                            </div>

                            <div>
                                <span class="text-[#94A3B8] block mb-0.5">Año de Estreno:</span>
                                <span class="text-white font-semibold text-sm"><?php echo get_the_date('Y'); ?></span>
                            </div>

                            <div class="pt-4 border-t border-white/10 space-y-3">
                                <span class="text-[11px] text-slate-400 block leading-tight">
                                    ¿Te interesa licenciar material de esta producción para uso comercial o broadcast?
                                </span>
                                <a href="<?php echo esc_url( home_url( '/#tienda' ) ); ?>" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-[#00D2FF] to-[#0066FF] text-black font-extrabold text-xs uppercase tracking-wider text-center block hover:shadow-lg hover:shadow-[#00D2FF]/40 transition">
                                    Ver Metraje en Stock
                                </a>
                            </div>
                        </div>
                    </aside>
                </section>

                <!-- Navegación Entre Proyectos -->
                <div class="border-t border-white/10 pt-10 flex items-center justify-between">
                    <div>
                        <?php previous_post_link( '%link', '<span class="text-xs text-[#94A3B8] block">Proyecto Anterior</span><span class="text-white font-bold text-sm hover:text-[#00D2FF] transition">&larr; %title</span>' ); ?>
                    </div>
                    <div class="text-right">
                        <?php next_post_link( '%link', '<span class="text-xs text-[#94A3B8] block">Siguiente Proyecto</span><span class="text-white font-bold text-sm hover:text-[#00D2FF] transition">%title &rarr;</span>' ); ?>
                    </div>
                </div>

            </article>
        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>
