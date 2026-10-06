<?php
/**
 * Single template para proyectos de Portfolio (YouTube video / short).
 *
 * @package Studio_Dark_Portfolio
 */

get_header(); ?>

<main id="primary" class="site-main pt-28 pb-24 px-4 sm:px-6">
    <div class="studio-container max-w-5xl mx-auto space-y-12">

        <?php while ( have_posts() ) : the_post(); ?>
            <?php
            $pid    = get_the_ID();
            $url    = get_post_meta( $pid, '_studio_youtube_url', true );
            $yt_id  = get_post_meta( $pid, '_studio_youtube_id', true );
            if ( ! $yt_id && $url ) {
                $yt_id = dp_youtube_extract_id( $url );
            }
            $kind   = get_post_meta( $pid, '_studio_media_kind', true );
            $is_short = ( 'short' === $kind );

            $categories = get_the_terms( $pid, 'portfolio_category' );
            $cat_name   = ( ! empty( $categories ) && ! is_wp_error( $categories ) ) ? $categories[0]->name : __( 'Producción Audiovisual', 'studio-dark-portfolio' );
            ?>
            <article id="post-<?php echo esc_attr( $pid ); ?>" <?php post_class( 'space-y-12' ); ?>>

                <!-- Navegación de Regreso -->
                <div class="flex items-center justify-between border-b border-white/10 pb-6">
                    <a href="<?php echo esc_url( home_url( '/#portfolio' ) ); ?>" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-[#00D2FF] hover:text-white transition">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        <span><?php esc_html_e( 'Volver al Portafolio', 'studio-dark-portfolio' ); ?></span>
                    </a>
                    <div class="flex items-center gap-2 text-xs text-[#94A3B8]">
                        <i data-lucide="<?php echo $is_short ? 'smartphone' : 'youtube'; ?>" class="w-3.5 h-3.5 text-[#00D2FF]"></i>
                        <span><?php echo $is_short ? esc_html__( 'Short · YouTube', 'studio-dark-portfolio' ) : esc_html__( 'Video · YouTube', 'studio-dark-portfolio' ); ?></span>
                    </div>
                </div>

                <!-- Encabezado Editorial -->
                <header class="space-y-6 text-center max-w-3xl mx-auto">
                    <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full glass-card border border-[#00D2FF]/25">
                        <span class="w-2 h-2 rounded-full bg-[#00D2FF] animate-pulse"></span>
                        <span class="text-xs uppercase font-extrabold tracking-widest text-[#E2E8F0]"><?php echo esc_html( $cat_name ); ?></span>
                    </div>
                    <h1 class="text-3xl sm:text-5xl font-black text-white title-sequel tracking-tight leading-[1.08]">
                        <?php the_title(); ?>
                    </h1>
                    <?php if ( has_excerpt() ) : ?>
                        <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto font-normal leading-relaxed">
                            <?php echo esc_html( get_the_excerpt() ); ?>
                        </p>
                    <?php endif; ?>
                </header>

                <!-- Reproductor de YouTube (video 16:9 o short 9:16) -->
                <?php if ( $yt_id ) : ?>
                    <?php if ( $is_short ) : ?>
                        <div class="mx-auto" style="max-width:420px;">
                            <div class="rounded-3xl overflow-hidden glass-card p-2 sm:p-3 shadow-2xl shadow-[#0066FF]/25">
                                <div class="relative rounded-2xl overflow-hidden bg-black" style="aspect-ratio:9/16;">
                                    <iframe src="<?php echo esc_url( dp_youtube_embed_url( $yt_id ) ); ?>"
                                            title="<?php echo esc_attr( get_the_title() ); ?>"
                                            style="position:absolute;inset:0;width:100%;height:100%;border:0;"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="rounded-3xl overflow-hidden glass-card p-2 sm:p-4 shadow-2xl shadow-[#0066FF]/25">
                            <div class="relative rounded-2xl overflow-hidden bg-black" style="aspect-ratio:16/9;">
                                <iframe src="<?php echo esc_url( dp_youtube_embed_url( $yt_id ) ); ?>"
                                        title="<?php echo esc_attr( get_the_title() ); ?>"
                                        style="position:absolute;inset:0;width:100%;height:100%;border:0;"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen loading="lazy"></iframe>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php elseif ( has_post_thumbnail() ) : ?>
                    <div class="rounded-3xl overflow-hidden glass-card p-2 sm:p-4">
                        <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto rounded-2xl' ) ); ?>
                    </div>
                <?php endif; ?>

                <!-- Descripción / Concepto -->
                <?php if ( trim( get_the_content() ) ) : ?>
                    <section class="max-w-3xl mx-auto space-y-6 text-slate-300 leading-relaxed text-base">
                        <h2 class="text-2xl font-bold text-white title-sequel"><?php esc_html_e( 'Sobre el proyecto', 'studio-dark-portfolio' ); ?></h2>
                        <div class="space-y-4"><?php the_content(); ?></div>
                    </section>
                <?php endif; ?>

                <!-- CTA a la tienda -->
                <div class="max-w-3xl mx-auto text-center border-t border-white/10 pt-10">
                    <p class="text-sm text-slate-400 mb-4"><?php esc_html_e( '¿Buscás fotografía de alta resolución con licencia de uso?', 'studio-dark-portfolio' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/#tienda' ) ); ?>" class="btn-primary" style="text-decoration:none;display:inline-flex;">
                        <i data-lucide="sparkles" class="w-4 h-4"></i>
                        <span><?php esc_html_e( 'Ver tienda de fotos', 'studio-dark-portfolio' ); ?></span>
                    </a>
                </div>

                <!-- Navegación Entre Proyectos -->
                <div class="border-t border-white/10 pt-10 flex items-center justify-between gap-4">
                    <div><?php previous_post_link( '%link', '<span class="text-xs text-[#94A3B8] block">' . esc_html__( 'Anterior', 'studio-dark-portfolio' ) . '</span><span class="text-white font-bold text-sm hover:text-[#00D2FF] transition">&larr; %title</span>' ); ?></div>
                    <div class="text-right"><?php next_post_link( '%link', '<span class="text-xs text-[#94A3B8] block">' . esc_html__( 'Siguiente', 'studio-dark-portfolio' ) . '</span><span class="text-white font-bold text-sm hover:text-[#00D2FF] transition">%title &rarr;</span>' ); ?></div>
                </div>

            </article>
        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>
