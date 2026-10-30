<?php
/**
 * DP Producciones — Tienda de Fotos (WooCommerce + Mercado Pago)
 *
 * - Categoría de producto "Fotos".
 * - Metadatos de la foto (orientación / resolución) para los filtros facetados.
 * - Generación automática del preview con marca de agua incrustada al guardar.
 *   El archivo ORIGINAL se adjunta como "archivo descargable" del producto y se
 *   entrega solo tras el pago (WooCommerce ya fuerza descargas protegidas).
 * - Endpoint AJAX para comprar en lote la selección del dock flotante.
 *
 * @package Studio_Dark_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ¿Está WooCommerce activo?
 *
 * @return bool
 */
function dp_wc_active() {
    return class_exists( 'WooCommerce' );
}

/**
 * Asegura que exista la categoría de producto "Fotos".
 */
function dp_ensure_photo_category() {
    if ( ! dp_wc_active() || ! taxonomy_exists( 'product_cat' ) ) {
        return;
    }
    if ( ! term_exists( 'fotos', 'product_cat' ) ) {
        wp_insert_term( __( 'Fotos', 'studio-dark-portfolio' ), 'product_cat', array( 'slug' => 'fotos' ) );
    }
}
add_action( 'init', 'dp_ensure_photo_category', 20 );

/* =========================================================================
 * 1. METADATOS DE LA FOTO (meta box en el editor de producto)
 * ========================================================================= */

/**
 * Añade una pestaña de datos de foto al panel de datos del producto.
 */
function dp_product_data_tab( $tabs ) {
    $tabs['dp_photo'] = array(
        'label'    => __( 'Datos de Foto (DP)', 'studio-dark-portfolio' ),
        'target'   => 'dp_photo_product_data',
        'class'    => array(),
        'priority' => 65,
    );
    return $tabs;
}
add_filter( 'woocommerce_product_data_tabs', 'dp_product_data_tab' );

/**
 * Contenido de la pestaña de datos de foto.
 */
function dp_product_data_panel() {
    global $post;
    if ( ! function_exists( 'woocommerce_wp_select' ) ) {
        return;
    }
    echo '<div id="dp_photo_product_data" class="panel woocommerce_options_panel">';

    woocommerce_wp_select( array(
        'id'      => '_dp_orientation',
        'label'   => __( 'Orientación', 'studio-dark-portfolio' ),
        'options' => array(
            'horizontal' => __( 'Horizontal', 'studio-dark-portfolio' ),
            'vertical'   => __( 'Vertical', 'studio-dark-portfolio' ),
            'square'     => __( 'Cuadrado', 'studio-dark-portfolio' ),
        ),
        'value'   => get_post_meta( $post->ID, '_dp_orientation', true ) ?: 'horizontal',
    ) );

    woocommerce_wp_select( array(
        'id'      => '_dp_resolution',
        'label'   => __( 'Resolución', 'studio-dark-portfolio' ),
        'options' => array(
            '4k' => __( '4K / 8K', 'studio-dark-portfolio' ),
            'hd' => __( 'Full HD', 'studio-dark-portfolio' ),
        ),
        'value'   => get_post_meta( $post->ID, '_dp_resolution', true ) ?: '4k',
    ) );

    woocommerce_wp_checkbox( array(
        'id'          => '_dp_regen_watermark',
        'label'       => __( 'Regenerar marca de agua', 'studio-dark-portfolio' ),
        'description' => __( 'Marcá y guardá para regenerar el preview con marca de agua a partir de la imagen destacada.', 'studio-dark-portfolio' ),
    ) );

    $preview = get_post_meta( $post->ID, '_dp_watermark_preview_url', true );
    if ( $preview ) {
        echo '<p class="form-field"><strong>' . esc_html__( 'Preview con marca de agua:', 'studio-dark-portfolio' ) . '</strong><br>';
        echo '<img src="' . esc_url( $preview ) . '" style="max-width:260px;height:auto;border-radius:6px;border:1px solid #ddd" alt="" /></p>';
    } else {
        echo '<p class="form-field" style="color:#777">' . esc_html__( 'Aún no hay preview. Subí una imagen destacada y guardá el producto para generarlo.', 'studio-dark-portfolio' ) . '</p>';
    }

    echo '</div>';
}
add_action( 'woocommerce_product_data_panels', 'dp_product_data_panel' );

/**
 * Guarda los metadatos y (re)genera el preview con marca de agua.
 *
 * @param int $post_id
 */
function dp_save_product_photo_meta( $post_id ) {
    // WooCommerce ya valida nonce/permows en el guardado de producto; reforzamos.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['_dp_orientation'] ) ) {
        update_post_meta( $post_id, '_dp_orientation', sanitize_text_field( wp_unslash( $_POST['_dp_orientation'] ) ) );
    }
    if ( isset( $_POST['_dp_resolution'] ) ) {
        update_post_meta( $post_id, '_dp_resolution', sanitize_text_field( wp_unslash( $_POST['_dp_resolution'] ) ) );
    }

    $thumb_id = get_post_thumbnail_id( $post_id );
    if ( ! $thumb_id ) {
        return;
    }

    $existing = get_post_meta( $post_id, '_dp_watermark_preview_url', true );
    $regen    = isset( $_POST['_dp_regen_watermark'] ) && 'yes' === $_POST['_dp_regen_watermark'];
    $src_hash = md5( (string) $thumb_id );
    $prev_hash = get_post_meta( $post_id, '_dp_watermark_src_hash', true );

    // Generar si: no existe, se pidió regenerar, o cambió la imagen destacada.
    if ( $existing && ! $regen && $src_hash === $prev_hash ) {
        return;
    }

    $source = get_attached_file( $thumb_id );
    if ( ! $source ) {
        return;
    }

    $result = dp_generate_watermarked_preview( $source, 'product-' . $post_id );
    if ( is_wp_error( $result ) ) {
        // Dejar aviso para el admin sin romper el guardado.
        update_post_meta( $post_id, '_dp_watermark_error', $result->get_error_message() );
        return;
    }

    delete_post_meta( $post_id, '_dp_watermark_error' );
    update_post_meta( $post_id, '_dp_watermark_preview_url', $result['url'] );
    update_post_meta( $post_id, '_dp_watermark_preview_path', $result['path'] );
    update_post_meta( $post_id, '_dp_watermark_src_hash', $src_hash );
}
add_action( 'woocommerce_process_product_meta', 'dp_save_product_photo_meta', 20 );

/**
 * URL del preview a mostrar en el frontend (watermark si existe; si no, la
 * imagen destacada como último recurso).
 *
 * @param int $product_id
 * @return string
 */
function dp_product_preview_url( $product_id ) {
    $wm = get_post_meta( $product_id, '_dp_watermark_preview_url', true );
    if ( $wm ) {
        return $wm;
    }
    $img = get_the_post_thumbnail_url( $product_id, 'large' );
    return $img ? $img : '';
}

/* =========================================================================
 * 2. MONEDA Y VISUALIZACIÓN
 * ========================================================================= */

/**
 * Formatea un precio en la moneda de WooCommerce; si WC no está, UYU simple.
 *
 * @param float $amount
 * @return string
 */
function dp_price( $amount ) {
    if ( dp_wc_active() && function_exists( 'wc_price' ) ) {
        return wp_strip_all_tags( wc_price( $amount ) );
    }
    return '$U ' . number_format( (float) $amount, 0, ',', '.' );
}

/* =========================================================================
 * 3. COMPRA EN LOTE DESDE EL DOCK FLOTANTE (AJAX)
 * ========================================================================= */

/**
 * Añade los productos seleccionados al carrito y devuelve la URL de checkout.
 * El pago final se procesa con el método Mercado Pago configurado en WooCommerce.
 */
function dp_ajax_batch_to_cart() {
    check_ajax_referer( 'studio_nonce', 'nonce' );

    if ( ! dp_wc_active() || ! WC()->cart ) {
        wp_send_json_error( array( 'message' => __( 'La tienda no está disponible en este momento.', 'studio-dark-portfolio' ) ) );
    }

    $ids = isset( $_POST['ids'] ) ? array_map( 'absint', (array) $_POST['ids'] ) : array();
    $ids = array_filter( array_unique( $ids ) );

    if ( empty( $ids ) ) {
        wp_send_json_error( array( 'message' => __( 'No seleccionaste ninguna foto.', 'studio-dark-portfolio' ) ) );
    }

    $added = 0;
    foreach ( $ids as $id ) {
        $product = wc_get_product( $id );
        if ( $product && $product->is_purchasable() ) {
            if ( WC()->cart->add_to_cart( $id ) ) {
                $added++;
            }
        }
    }

    if ( ! $added ) {
        wp_send_json_error( array( 'message' => __( 'No se pudieron agregar las fotos al carrito.', 'studio-dark-portfolio' ) ) );
    }

    wp_send_json_success( array(
        'added'        => $added,
        'checkout_url' => wc_get_checkout_url(),
        'cart_count'   => WC()->cart->get_cart_contents_count(),
    ) );
}
add_action( 'wp_ajax_dp_batch_to_cart', 'dp_ajax_batch_to_cart' );
add_action( 'wp_ajax_nopriv_dp_batch_to_cart', 'dp_ajax_batch_to_cart' );

/**
 * Expone datos de la tienda a JavaScript.
 */
function dp_localize_store_params() {
    wp_localize_script( 'studio-client-store-engine', 'dpStore', array(
        'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
        'nonce'       => wp_create_nonce( 'studio_nonce' ),
        'wcActive'    => dp_wc_active(),
        'checkoutUrl' => dp_wc_active() ? wc_get_checkout_url() : '',
        'cartUrl'     => dp_wc_active() ? wc_get_cart_url() : '',
        'i18n'        => array(
            'adding'   => __( 'Agregando al carrito…', 'studio-dark-portfolio' ),
            'error'    => __( 'Ocurrió un error. Intentá de nuevo.', 'studio-dark-portfolio' ),
            'noStore'  => __( 'La tienda todavía no está configurada.', 'studio-dark-portfolio' ),
        ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'dp_localize_store_params', 20 );
