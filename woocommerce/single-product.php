<?php
/**
 * Custom WooCommerce Single Product Template for Stock Assets (Photo & Video Rights)
 * Inspirado en la interfaz de usuario de https://picsel.app/
 *
 * @package Studio_Dark_Portfolio
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>

<main id="primary" class="site-main pt-28 pb-24 px-4 sm:px-6">
    <div class="studio-container max-w-6xl mx-auto">

        <?php while ( have_posts() ) : the_post(); global $product; ?>
            
            <div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'grid grid-cols-1 lg:grid-cols-12 gap-10 items-start', $product ); ?>>

                <!-- Columna Izquierda: Vista Previa Segura con Marca de Agua y/o Reproductor de Video -->
                <div class="lg:col-span-7 space-y-6">
                    
                    <!-- Contenedor de Medios Protegido -->
                    <div class="relative rounded-3xl overflow-hidden glass-card p-2 sm:p-3 border border-white/10 shadow-2xl shadow-[#0066FF]/20">
                        <div class="relative rounded-2xl overflow-hidden bg-black aspect-[16/10] group">
                            
                            <?php 
                            // Comprobar si es un activo de Video o Foto
                            $is_video = has_term( 'video', 'product_cat' ) || get_post_meta( get_the_ID(), '_studio_is_video_stock', true );
                            $preview_video = get_post_meta( get_the_ID(), '_studio_preview_video_url', true );

                            if ( $is_video && ! empty( $preview_video ) ) : ?>
                                <!-- Reproductor de Video de Previsualización Protegido -->
                                <div class="video-preview-wrapper w-full h-full">
                                    <video controls playsinline controlsList="nodownload" oncontextmenu="return false;" class="video-preview-element">
                                        <source src="<?php echo esc_url( $preview_video ); ?>" type="video/mp4">
                                    </video>
                                    <div class="video-watermark-overlay">
                                        <div class="video-watermark-stamp">AETHER STOCK &middot; PREVIEW</div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <!-- Imagen con Marca de Agua Diagonal Continua -->
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover select-none', 'oncontextmenu' => 'return false;', 'draggable' => 'false' ) ); ?>
                                <?php endif; ?>
                                
                                <?php echo studio_get_watermark_layer( get_bloginfo( 'name' ) ); ?>
                            <?php endif; ?>

                            <!-- Badge Flotante de Seguridad -->
                            <div class="absolute top-3 left-3 z-30 flex items-center gap-2 px-3 py-1.5 rounded-full bg-black/75 backdrop-blur-md border border-white/15 text-[11px] text-[#00D2FF] font-medium">
                                <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                                <span>Previsualización Protegida &middot; RAW HD tras compra</span>
                            </div>

                        </div>
                    </div>

                    <!-- Ficha Técnica del Activo Digital (Picsel Style Specs) -->
                    <div class="p-6 rounded-2xl glass-panel border border-white/10 space-y-4">
                        <h4 class="text-white font-bold uppercase tracking-wider text-xs flex items-center gap-2 border-b border-white/10 pb-3">
                            <i data-lucide="info" class="w-4 h-4 text-[#00D2FF]"></i>
                            <span>Especificaciones Técnicas del Activo</span>
                        </h4>
                        
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
                            <div>
                                <span class="text-[#94A3B8] block mb-0.5">Resolución Máxima</span>
                                <span class="text-white font-semibold">8K DCI (7680 &times; 4320)</span>
                            </div>
                            <div>
                                <span class="text-[#94A3B8] block mb-0.5">Espacio de Color</span>
                                <span class="text-white font-semibold">Rec.2020 / DCI-P3 10-Bit</span>
                            </div>
                            <div>
                                <span class="text-[#94A3B8] block mb-0.5">Formato Original</span>
                                <span class="text-[#00D2FF] font-semibold">ProRes 422 HQ / RAW</span>
                            </div>
                            <div>
                                <span class="text-[#94A3B8] block mb-0.5">Entrega</span>
                                <span class="text-white font-semibold">Descarga Instantánea</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Columna Derecha: Opciones de Compra por Licencias (Picsel Model) -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <div class="space-y-3">
                        <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.2em] text-[#00D2FF]">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                            <span>Activo Digital Autoral &middot; Licencia de Uso</span>
                        </div>
                        <h1 class="text-2xl sm:text-4xl font-black text-white title-sequel"><?php the_title(); ?></h1>
                        <p class="text-xs text-slate-400">
                            Adquiere derechos de uso directo sin marcas de agua con descarga inmediata a tu correo electrónico vía Mercado Pago o Stripe.
                        </p>
                    </div>

                    <!-- SELECTOR DE LICENCIAS (TARJETAS RADIO) -->
                    <div class="space-y-3 pt-2">
                        <label class="text-xs uppercase font-extrabold tracking-wider text-slate-300 block">
                            1. Selecciona el Tipo de Licencia:
                        </label>
                        
                        <div class="license-selector-group">
                            <!-- Opción 1: Licencia Estándar -->
                            <div class="license-radio-card active" id="licenseStdCard" onclick="selectLicense('standard', 14500)">
                                <div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-white font-bold text-xs uppercase tracking-wide">Licencia Estándar</span>
                                        <span class="w-2.5 h-2.5 rounded-full bg-[#00D2FF]"></span>
                                    </div>
                                    <div class="license-price-tag" id="priceStd">$14.500 ARS</div>
                                </div>
                                <ul class="license-benefits-list">
                                    <li><i data-lucide="check" class="w-3 h-3 text-[#00D2FF]"></i> Uso en Web, Redes y Blogs</li>
                                    <li><i data-lucide="check" class="w-3 h-3 text-[#00D2FF]"></i> Hasta 50.000 reproducciones</li>
                                    <li><i data-lucide="check" class="w-3 h-3 text-[#00D2FF]"></i> Descarga Full HD (1080p)</li>
                                </ul>
                            </div>

                            <!-- Opción 2: Licencia Comercial Extendida -->
                            <div class="license-radio-card" id="licenseExtCard" onclick="selectLicense('extended', 32000)">
                                <div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-white font-bold text-xs uppercase tracking-wide">Comercial / Broadcast</span>
                                        <span class="w-2.5 h-2.5 rounded-full border border-white/30"></span>
                                    </div>
                                    <div class="license-price-tag" id="priceExt">$32.000 ARS</div>
                                </div>
                                <ul class="license-benefits-list">
                                    <li><i data-lucide="check" class="w-3 h-3 text-[#00D2FF]"></i> TV, Cine, Streaming y Vallas</li>
                                    <li><i data-lucide="check" class="w-3 h-3 text-[#00D2FF]"></i> Tirada y alcance ilimitado</li>
                                    <li><i data-lucide="check" class="w-3 h-3 text-[#00D2FF]"></i> Master 4K / 8K RAW ProRes</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- SELECTOR DE RESOLUCIÓN -->
                    <div class="space-y-2 pt-2">
                        <label class="text-xs uppercase font-extrabold tracking-wider text-slate-300 block">
                            2. Resolución del Archivo Maestro:
                        </label>
                        <div class="grid grid-cols-2 gap-3">
                            <button type="button" class="px-4 py-3 rounded-xl bg-white/5 border border-white/15 text-white font-bold text-xs text-left hover:border-[#00D2FF]/50 transition flex items-center justify-between active">
                                <div>
                                    <span class="block">Full HD 1080p</span>
                                    <span class="text-[10px] text-slate-400">1920 &times; 1080 px</span>
                                </div>
                                <i data-lucide="check-circle" class="w-4 h-4 text-[#00D2FF]"></i>
                            </button>

                            <button type="button" class="px-4 py-3 rounded-xl bg-white/5 border border-white/15 text-white font-bold text-xs text-left hover:border-[#00D2FF]/50 transition flex items-center justify-between">
                                <div>
                                    <span class="block">Master 4K / 8K UHD</span>
                                    <span class="text-[10px] text-slate-400">Resolución Nativa</span>
                                </div>
                                <i data-lucide="circle" class="w-4 h-4 text-slate-500"></i>
                            </button>
                        </div>
                    </div>

                    <!-- BOTÓN DE COMPRA INSTANTÁNEA MERCADO PAGO -->
                    <div class="pt-4 space-y-3">
                        <a href="?add-to-cart=<?php echo get_the_ID(); ?>" class="w-full py-4 rounded-xl bg-gradient-to-r from-[#00D2FF] to-[#0066FF] hover:from-[#38bdf8] hover:to-[#2563eb] text-black font-black text-sm uppercase tracking-wider text-center flex items-center justify-center gap-2 shadow-xl shadow-[#0066FF]/35 transition transform hover:-translate-y-0.5">
                            <i data-lucide="zap" class="w-4 h-4 stroke-[3]"></i>
                            <span>Comprar Licencia y Descargar</span>
                        </a>

                        <div class="flex items-center justify-center gap-4 text-[11px] text-[#94A3B8] pt-1">
                            <span class="flex items-center gap-1"><i data-lucide="lock" class="w-3 h-3 text-[#00D2FF]"></i> Pago 100% Seguro</span>
                            <span class="flex items-center gap-1"><i data-lucide="mail" class="w-3 h-3 text-[#00D2FF]"></i> Envío Inmediato a tu Email</span>
                        </div>
                    </div>

                </div>

            </div>

        <?php endwhile; ?>

    </div>
</main>

<script>
function selectLicense(type, price) {
    const cardStd = document.getElementById('licenseStdCard');
    const cardExt = document.getElementById('licenseExtCard');
    if (type === 'standard') {
        cardStd.classList.add('active');
        cardExt.classList.remove('active');
    } else {
        cardExt.classList.add('active');
        cardStd.classList.remove('active');
    }
}
</script>

<?php get_footer( 'shop' ); ?>
