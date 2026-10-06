<?php
/**
 * DP Producciones — Renderizado del contenido real en el frontend
 *
 * Reemplaza los bloques de demostración hardcodeados por consultas reales:
 *  - Portfolio: CPT "portfolio" con enlaces de YouTube (video/short).
 *  - Tienda: productos de WooCommerce de la categoría "Fotos".
 *
 * @package Studio_Dark_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Pills de filtro del portfolio, generadas desde la taxonomía.
 */
function dp_render_portfolio_filters() {
    echo '<div class="flex flex-wrap gap-3" id="portfolioFilterContainer">';
    echo '<button class="portfolio-filter-pill active" data-filter="all">' . esc_html__( 'TODOS', 'studio-dark-portfolio' ) . '</button>';

    $terms = get_terms( array(
        'taxonomy'   => 'portfolio_category',
        'hide_empty' => true,
    ) );

    if ( ! is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
            printf(
                '<button class="portfolio-filter-pill" data-filter="%1$s">%2$s</button>',
                esc_attr( $term->slug ),
                esc_html( strtoupper( $term->name ) )
            );
        }
    }
    echo '</div>';
}

/**
 * Grilla de proyectos del portfolio (masonry) desde el CPT.
 */
function dp_render_portfolio_grid() {
    $query = new WP_Query( array(
        'post_type'      => 'portfolio',
        'posts_per_page' => 24,
        'post_status'    => 'publish',
    ) );

    if ( ! $query->have_posts() ) {
        dp_render_empty_state(
            __( 'Todavía no hay proyectos en el portfolio.', 'studio-dark-portfolio' ),
            __( 'Agregá tu primer video o short desde Portfolio → Añadir nuevo.', 'studio-dark-portfolio' ),
            admin_url( 'post-new.php?post_type=portfolio' )
        );
        return;
    }

    echo '<div class="portfolio-masonry-grid" id="portfolioMasonry">';

    while ( $query->have_posts() ) {
        $query->the_post();
        $pid   = get_the_ID();
        $kind  = get_post_meta( $pid, '_studio_media_kind', true );
        $yt_id = get_post_meta( $pid, '_studio_youtube_id', true );

        // Miniatura: imagen destacada o, si no hay, miniatura de YouTube.
        if ( has_post_thumbnail() ) {
            $thumb = get_the_post_thumbnail_url( $pid, 'large' );
        } else {
            $thumb = $yt_id ? dp_youtube_thumbnail( $yt_id ) : 'https://via.placeholder.com/1200x800?text=DP+Producciones';
        }

        // Categorías como clases para el filtro JS.
        $cats  = get_the_terms( $pid, 'portfolio_category' );
        $slugs = array();
        $first = '';
        if ( $cats && ! is_wp_error( $cats ) ) {
            foreach ( $cats as $c ) {
                $slugs[] = $c->slug;
            }
            $first = $cats[0]->name;
        }
        $data_cat = esc_attr( implode( ' ', $slugs ) );

        $is_short   = ( 'short' === $kind );
        $badge_icon = $is_short ? 'smartphone' : 'play';
        $badge_text = $is_short ? esc_html__( 'SHORT · VERTICAL', 'studio-dark-portfolio' ) : esc_html__( 'VIDEO · YOUTUBE', 'studio-dark-portfolio' );
        $item_class = 'masonry-item' . ( $is_short ? ' masonry-item--short' : '' );
        ?>
        <div class="<?php echo esc_attr( $item_class ); ?>" data-category="<?php echo $data_cat; ?>" onclick="location.href='<?php echo esc_url( get_permalink() ); ?>'">
            <span class="absolute top-3 left-3 z-10 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/60 backdrop-blur-md border border-white/10 text-[10px] font-semibold tracking-widest uppercase text-white shadow-lg">
                <i data-lucide="<?php echo esc_attr( $badge_icon ); ?>" class="w-3 h-3 fill-current text-[#00D2FF]"></i> <?php echo $badge_text; ?>
            </span>
            <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="masonry-img" loading="lazy" />
            <div class="masonry-overlay">
                <?php if ( $first ) : ?>
                    <span class="masonry-category-label"><?php echo esc_html( $first ); ?></span>
                <?php endif; ?>
                <h3 class="masonry-project-title"><?php the_title(); ?></h3>
                <?php if ( has_excerpt() ) : ?>
                    <div class="cinematic-meta-badge">
                        <i data-lucide="film" class="w-3 h-3"></i>
                        <span><?php echo esc_html( wp_trim_words( get_the_excerpt(), 10 ) ); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    echo '</div>';
    wp_reset_postdata();
}

/**
 * Grilla de la tienda de fotos desde productos de WooCommerce.
 */
function dp_render_store_grid() {
    if ( ! dp_wc_active() ) {
        dp_render_empty_state(
            __( 'La tienda requiere WooCommerce.', 'studio-dark-portfolio' ),
            __( 'Instalá y activá WooCommerce y el plugin oficial de Mercado Pago para vender fotos.', 'studio-dark-portfolio' ),
            admin_url( 'plugin-install.php?s=woocommerce&tab=search&type=term' )
        );
        return;
    }

    $query = new WP_Query( array(
        'post_type'      => 'product',
        'posts_per_page' => 24,
        'post_status'    => 'publish',
        'tax_query'      => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => 'fotos',
            ),
        ),
    ) );

    if ( ! $query->have_posts() ) {
        dp_render_empty_state(
            __( 'Todavía no hay fotos a la venta.', 'studio-dark-portfolio' ),
            __( 'Creá un producto en la categoría "Fotos", subí la imagen destacada y adjuntá el archivo original como descarga.', 'studio-dark-portfolio' ),
            admin_url( 'post-new.php?post_type=product' )
        );
        return;
    }

    echo '<div class="fluid-grid-cards" id="stockGalleryGrid">';

    while ( $query->have_posts() ) {
        $query->the_post();
        $pid      = get_the_ID();
        $product  = wc_get_product( $pid );
        if ( ! $product ) {
            continue;
        }
        $preview  = dp_product_preview_url( $pid );
        $orient   = get_post_meta( $pid, '_dp_orientation', true ) ?: 'horizontal';
        $resol    = get_post_meta( $pid, '_dp_resolution', true ) ?: '4k';
        $price_n  = (float) $product->get_price();
        $title    = get_the_title();
        $cats     = wc_get_product_category_list( $pid );
        $meta_tag = wp_strip_all_tags( $cats ) ?: __( 'Foto · Licencia de uso', 'studio-dark-portfolio' );

        $photo_js = wp_json_encode( array(
            'id'       => $pid,
            'title'    => $title,
            'priceARS' => $price_n, // la clave la consume el engine existente
        ) );
        ?>
        <div class="proof-photo-card" data-proof-id="<?php echo esc_attr( $pid ); ?>" data-product-id="<?php echo esc_attr( $pid ); ?>" data-orientation="<?php echo esc_attr( $orient ); ?>" data-type="photo" data-resolution="<?php echo esc_attr( $resol ); ?>">
            <button class="btn-proof-favorite" onclick='clientStore.togglePhotoSelection("<?php echo esc_js( $pid ); ?>", <?php echo esc_attr( $photo_js ); ?>, event)' title="<?php esc_attr_e( 'Seleccionar', 'studio-dark-portfolio' ); ?>">
                <i data-lucide="heart" class="w-3.5 h-3.5"></i>
            </button>
            <div class="stock-media-wrapper">
                <?php if ( $preview ) : ?>
                    <img src="<?php echo esc_url( $preview ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" oncontextmenu="return false;" draggable="false" />
                <?php endif; ?>
            </div>
            <div class="proof-card-footer">
                <div class="stock-card-meta">
                    <span class="stock-meta-tag"><?php echo esc_html( $meta_tag ); ?></span>
                    <span class="stock-card-title"><?php echo esc_html( $title ); ?></span>
                    <span class="stock-card-price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
                </div>
                <button class="stock-license-btn" onclick="location.href='<?php echo esc_url( get_permalink() ); ?>'">
                    <?php esc_html_e( 'Ver licencia', 'studio-dark-portfolio' ); ?>
                </button>
            </div>
        </div>
        <?php
    }

    echo '</div>';
    wp_reset_postdata();
}

/**
 * Estado vacío uniforme. El CTA al panel solo se muestra a administradores.
 *
 * @param string $title
 * @param string $desc
 * @param string $admin_url
 */
function dp_render_empty_state( $title, $desc, $admin_url = '' ) {
    echo '<div class="glass-card" style="padding:48px 32px;text-align:center;border-radius:24px;max-width:640px;margin:0 auto">';
    echo '<h3 style="color:#fff;font-size:20px;margin-bottom:10px">' . esc_html( $title ) . '</h3>';
    echo '<p style="color:#94A3B8;font-size:14px;line-height:1.7;margin-bottom:18px">' . esc_html( $desc ) . '</p>';
    if ( $admin_url && current_user_can( 'edit_posts' ) ) {
        echo '<a href="' . esc_url( $admin_url ) . '" class="btn-primary" style="text-decoration:none">' . esc_html__( 'Ir al panel', 'studio-dark-portfolio' ) . '</a>';
    }
    echo '</div>';
}
