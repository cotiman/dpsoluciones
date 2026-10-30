<?php
/**
 * Plantilla de producto único para la Tienda de Fotos.
 * Muestra el preview con marca de agua incrustada y el flujo de compra REAL de
 * WooCommerce. El archivo original (sin marca) se entrega como descarga segura
 * tras el pago con Mercado Pago.
 *
 * @package Studio_Dark_Portfolio
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>

<main id="primary" class="site-main pt-28 pb-24 px-4 sm:px-6">
    <div class="studio-container max-w-6xl mx-auto">

        <?php while ( have_posts() ) : the_post(); global $product; ?>
            <?php
            $pid       = get_the_ID();
            $preview   = function_exists( 'dp_product_preview_url' ) ? dp_product_preview_url( $pid ) : get_the_post_thumbnail_url( $pid, 'large' );
            $orient    = get_post_meta( $pid, '_dp_orientation', true ) ?: 'horizontal';
            $resol     = get_post_meta( $pid, '_dp_resolution', true ) ?: '4k';
            $resol_lbl = ( 'hd' === $resol ) ? 'Full HD (1920×1080)' : '4K / 8K UHD';
            ?>

            <div id="product-<?php echo esc_attr( $pid ); ?>" <?php wc_product_class( 'grid grid-cols-1 lg:grid-cols-12 gap-10 items-start', $product ); ?>>

                <!-- Columna Izquierda: Preview con Marca de Agua Incrustada -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="relative rounded-3xl overflow-hidden glass-card p-2 sm:p-3 border border-white/10 shadow-2xl shadow-[#0066FF]/20">
                        <div class="relative rounded-2xl overflow-hidden bg-black group">
                            <?php if ( $preview ) : ?>
                                <img src="<?php echo esc_url( $preview ); ?>"
                                     alt="<?php echo esc_attr( get_the_title() ); ?>"
                                     class="w-full h-auto object-cover select-none"
                                     oncontextmenu="return false;" draggable="false" />
                            <?php endif; ?>

                            <!-- Badge Flotante de Seguridad -->
                            <div class="absolute top-3 left-3 z-30 flex items-center gap-2 px-3 py-1.5 rounded-full bg-black/75 backdrop-blur-md border border-white/15 text-[11px] text-[#00D2FF] font-medium">
                                <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                                <span><?php esc_html_e( 'Previsualización protegida · Original HD tras la compra', 'studio-dark-portfolio' ); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Ficha Técnica del Activo -->
                    <div class="p-6 rounded-2xl glass-panel border border-white/10 space-y-4">
                        <h4 class="text-white font-bold uppercase tracking-wider text-xs flex items-center gap-2 border-b border-white/10 pb-3">
                            <i data-lucide="info" class="w-4 h-4 text-[#00D2FF]"></i>
                            <span><?php esc_html_e( 'Especificaciones del archivo', 'studio-dark-portfolio' ); ?></span>
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-xs">
                            <div>
                                <span class="text-[#94A3B8] block mb-0.5"><?php esc_html_e( 'Resolución', 'studio-dark-portfolio' ); ?></span>
                                <span class="text-white font-semibold"><?php echo esc_html( $resol_lbl ); ?></span>
                            </div>
                            <div>
                                <span class="text-[#94A3B8] block mb-0.5"><?php esc_html_e( 'Orientación', 'studio-dark-portfolio' ); ?></span>
                                <span class="text-white font-semibold"><?php echo esc_html( ucfirst( $orient ) ); ?></span>
                            </div>
                            <div>
                                <span class="text-[#94A3B8] block mb-0.5"><?php esc_html_e( 'Entrega', 'studio-dark-portfolio' ); ?></span>
                                <span class="text-[#00D2FF] font-semibold"><?php esc_html_e( 'Descarga instantánea', 'studio-dark-portfolio' ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha: Compra Real WooCommerce -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="space-y-3">
                        <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.2em] text-[#00D2FF]">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                            <span><?php esc_html_e( 'Foto autoral · Licencia de uso', 'studio-dark-portfolio' ); ?></span>
                        </div>
                        <h1 class="text-2xl sm:text-4xl font-black text-white title-sequel"><?php the_title(); ?></h1>

                        <?php if ( $product->get_short_description() ) : ?>
                            <div class="text-sm text-slate-300 leading-relaxed"><?php echo wp_kses_post( $product->get_short_description() ); ?></div>
                        <?php else : ?>
                            <p class="text-xs text-slate-400">
                                <?php esc_html_e( 'Adquirí los derechos de uso y descargá el archivo original sin marca de agua, con pago seguro vía Mercado Pago.', 'studio-dark-portfolio' ); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Precio + Añadir al carrito (formulario real de WooCommerce) -->
                    <div class="p-6 rounded-2xl glass-card border border-white/10 space-y-5">
                        <div class="text-3xl font-black title-sequel product-price-display">
                            <?php echo wp_kses_post( $product->get_price_html() ); ?>
                        </div>

                        <?php
                        /**
                         * Hook de WooCommerce: imprime el formulario de añadir al carrito
                         * (soporta producto simple y variaciones de licencia si las creás).
                         */
                        woocommerce_template_single_add_to_cart();
                        ?>

                        <div class="flex items-center justify-center gap-4 text-[11px] text-[#94A3B8] pt-1">
                            <span class="flex items-center gap-1"><i data-lucide="lock" class="w-3 h-3 text-[#00D2FF]"></i> <?php esc_html_e( 'Pago 100% seguro', 'studio-dark-portfolio' ); ?></span>
                            <span class="flex items-center gap-1"><i data-lucide="mail" class="w-3 h-3 text-[#00D2FF]"></i> <?php esc_html_e( 'Envío inmediato a tu email', 'studio-dark-portfolio' ); ?></span>
                        </div>
                    </div>

                    <?php if ( function_exists( 'woocommerce_template_single_meta' ) ) { woocommerce_template_single_meta(); } ?>
                </div>

            </div>

        <?php endwhile; ?>

    </div>
</main>

<?php get_footer( 'shop' ); ?>
