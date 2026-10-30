<?php
/**
 * DP Producciones — Backoffice (panel central de administración)
 *
 * Un menú único "DP Backoffice" que reúne:
 *  - Accesos directos a Portfolio (YouTube) y Tienda de Fotos (WooCommerce).
 *  - Ajustes de la marca de agua (texto y opacidad).
 *  - Guía de puesta a punto (Mercado Pago, moneda UYU, GD).
 *
 * @package Studio_Dark_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Moneda uruguaya por defecto al activar el tema (sin pisar una config existente).
 */
function dp_set_default_currency() {
    if ( 'UYU' !== get_option( 'woocommerce_currency' ) ) {
        // Solo setear si WooCommerce aún tiene el valor por defecto o está vacío.
        $current = get_option( 'woocommerce_currency' );
        if ( empty( $current ) || 'USD' === $current ) {
            update_option( 'woocommerce_currency', 'UYU' );
            update_option( 'woocommerce_price_num_decimals', 0 );
            update_option( 'woocommerce_currency_pos', 'left_space' );
        }
    }
}
add_action( 'after_switch_theme', 'dp_set_default_currency' );

/**
 * Registra el menú del backoffice.
 */
function dp_register_backoffice_menu() {
    add_menu_page(
        __( 'DP Backoffice', 'studio-dark-portfolio' ),
        __( 'DP Backoffice', 'studio-dark-portfolio' ),
        'manage_options',
        'dp-backoffice',
        'dp_render_backoffice_page',
        'dashicons-admin-customizer',
        3
    );
}
add_action( 'admin_menu', 'dp_register_backoffice_menu' );

/**
 * Registra los ajustes de marca de agua.
 */
function dp_register_settings() {
    register_setting( 'dp_backoffice_settings', 'dp_watermark_text', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => get_bloginfo( 'name' ),
    ) );
    register_setting( 'dp_backoffice_settings', 'dp_watermark_opacity', array(
        'type'              => 'integer',
        'sanitize_callback' => 'absint',
        'default'           => 38,
    ) );
}
add_action( 'admin_init', 'dp_register_settings' );

/**
 * Página del backoffice.
 */
function dp_render_backoffice_page() {
    $wc  = dp_wc_active();
    $gd  = function_exists( 'imagecreatetruecolor' );
    $mp  = class_exists( 'WC_WooMercadoPago_Module' ) || class_exists( 'MercadoPago\MercadoPagoConfig' ) || defined( 'WC_WOOMERCADOPAGO_VERSION' );
    $cur = $wc ? get_option( 'woocommerce_currency' ) : '—';
    ?>
    <div class="wrap">
        <h1>🎛️ DP Backoffice</h1>
        <p style="font-size:14px;color:#555;max-width:760px">
            <?php esc_html_e( 'Panel central para administrar el portfolio de YouTube (videos y shorts) y la venta de fotos con marca de agua y pago por Mercado Pago.', 'studio-dark-portfolio' ); ?>
        </p>

        <h2 class="title"><?php esc_html_e( 'Estado del sistema', 'studio-dark-portfolio' ); ?></h2>
        <table class="widefat" style="max-width:760px;margin-bottom:24px">
            <tbody>
                <tr>
                    <td><strong>WooCommerce</strong></td>
                    <td><?php echo $wc ? '✅ ' . esc_html__( 'Activo', 'studio-dark-portfolio' ) : '⚠️ ' . esc_html__( 'No instalado — necesario para vender fotos', 'studio-dark-portfolio' ); ?></td>
                </tr>
                <tr>
                    <td><strong><?php esc_html_e( 'Plugin Mercado Pago', 'studio-dark-portfolio' ); ?></strong></td>
                    <td><?php echo $mp ? '✅ ' . esc_html__( 'Detectado', 'studio-dark-portfolio' ) : '⚠️ ' . esc_html__( 'No detectado — instalá "Mercado Pago payments for WooCommerce"', 'studio-dark-portfolio' ); ?></td>
                </tr>
                <tr>
                    <td><strong><?php esc_html_e( 'Moneda', 'studio-dark-portfolio' ); ?></strong></td>
                    <td><?php echo esc_html( $cur ); ?> <?php echo ( 'UYU' === $cur ) ? '✅' : '⚠️ ' . esc_html__( '(se recomienda UYU para Uruguay)', 'studio-dark-portfolio' ); ?></td>
                </tr>
                <tr>
                    <td><strong><?php esc_html_e( 'Extensión GD (marca de agua)', 'studio-dark-portfolio' ); ?></strong></td>
                    <td><?php echo $gd ? '✅ ' . esc_html__( 'Disponible', 'studio-dark-portfolio' ) : '❌ ' . esc_html__( 'No disponible — pedí a Hostinger que active GD', 'studio-dark-portfolio' ); ?></td>
                </tr>
            </tbody>
        </table>

        <div style="display:flex;gap:16px;flex-wrap:wrap;margin-bottom:28px">
            <a class="button button-primary button-hero" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>">🎨 <?php esc_html_e( 'Editar textos/imágenes del Home', 'studio-dark-portfolio' ); ?></a>
            <a class="button button-primary button-hero" href="<?php echo esc_url( admin_url( 'edit.php?post_type=portfolio' ) ); ?>">🎬 <?php esc_html_e( 'Administrar Portfolio', 'studio-dark-portfolio' ); ?></a>
            <a class="button button-primary button-hero" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=portfolio' ) ); ?>">➕ <?php esc_html_e( 'Nuevo video / short', 'studio-dark-portfolio' ); ?></a>
            <?php if ( $wc ) : ?>
                <a class="button button-hero" href="<?php echo esc_url( admin_url( 'edit.php?post_type=product&product_cat=fotos' ) ); ?>">🖼️ <?php esc_html_e( 'Administrar Fotos', 'studio-dark-portfolio' ); ?></a>
                <a class="button button-hero" href="<?php echo esc_url( admin_url( 'edit.php?post_type=shop_order' ) ); ?>">🧾 <?php esc_html_e( 'Ventas / Pedidos', 'studio-dark-portfolio' ); ?></a>
            <?php endif; ?>
        </div>

        <h2 class="title"><?php esc_html_e( 'Ajustes de marca de agua', 'studio-dark-portfolio' ); ?></h2>
        <form method="post" action="options.php" style="max-width:520px">
            <?php settings_fields( 'dp_backoffice_settings' ); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="dp_watermark_text"><?php esc_html_e( 'Texto de la marca', 'studio-dark-portfolio' ); ?></label></th>
                    <td><input name="dp_watermark_text" id="dp_watermark_text" type="text" class="regular-text"
                               value="<?php echo esc_attr( get_option( 'dp_watermark_text', get_bloginfo( 'name' ) ) ); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="dp_watermark_opacity"><?php esc_html_e( 'Opacidad (0–100)', 'studio-dark-portfolio' ); ?></label></th>
                    <td><input name="dp_watermark_opacity" id="dp_watermark_opacity" type="number" min="0" max="100" step="1"
                               value="<?php echo esc_attr( get_option( 'dp_watermark_opacity', 38 ) ); ?>" />
                        <p class="description"><?php esc_html_e( 'Al cambiar esto, regenerá el preview de cada foto (editá y guardá el producto marcando "Regenerar marca de agua").', 'studio-dark-portfolio' ); ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>

        <h2 class="title"><?php esc_html_e( 'Guía rápida', 'studio-dark-portfolio' ); ?></h2>
        <ol style="max-width:760px;font-size:14px;line-height:1.8">
            <li><?php esc_html_e( 'Portfolio: creá un proyecto, pegá el enlace de YouTube (video o short) y marcá el tipo. La miniatura y el reproductor se cargan solos.', 'studio-dark-portfolio' ); ?></li>
            <li><?php esc_html_e( 'Fotos: creá un producto en la categoría "Fotos". La imagen destacada se usa para el preview con marca de agua; adjuntá el archivo original en la pestaña "Avanzado → Archivos descargables" y marcá "Virtual" y "Descargable".', 'studio-dark-portfolio' ); ?></li>
            <li><?php esc_html_e( 'Mercado Pago: en WooCommerce → Ajustes → Pagos, activá Mercado Pago y cargá tus credenciales (país Uruguay). El cliente paga y recibe el original por email automáticamente.', 'studio-dark-portfolio' ); ?></li>
        </ol>
    </div>
    <?php
}

/**
 * Aviso si falta GD (impide generar marcas de agua).
 */
function dp_admin_notices() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    $screen = get_current_screen();
    if ( $screen && 'toplevel_page_dp-backoffice' === $screen->id ) {
        return; // ya se muestra el estado en la propia página
    }
    if ( ! function_exists( 'imagecreatetruecolor' ) ) {
        echo '<div class="notice notice-error"><p><strong>DP Producciones:</strong> ' .
            esc_html__( 'La extensión GD de PHP no está activa; no se pueden generar marcas de agua. Activala desde el panel de Hostinger o pedilo a soporte.', 'studio-dark-portfolio' ) .
            '</p></div>';
    }
}
add_action( 'admin_notices', 'dp_admin_notices' );
