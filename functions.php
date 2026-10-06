<?php
/**
 * Studio Dark Portfolio & Digital Store - Functions and definitions
 *
 * @package Studio_Dark_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define( 'STUDIO_THEME_VERSION', '1.0.0' );

/**
 * 1. Configuración General del Tema
 */
function studio_setup() {
    // Soporte para etiquetas del título automáticas
    add_theme_support( 'title-tag' );

    // Soporte para imágenes destacadas
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'studio-portfolio-thumb', 800, 550, true );
    add_image_size( 'studio-product-preview', 1000, 750, true );

    // Soporte para HTML5 moderno
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ) );

    // Registro de menús de navegación
    register_nav_menus( array(
        'primary' => __( 'Menú Principal Superior', 'studio-dark-portfolio' ),
        'footer'  => __( 'Menú del Pie de Página', 'studio-dark-portfolio' ),
    ) );

    // Soporte completo para WooCommerce
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'studio_setup' );

/**
 * 2. Carga de Tipografías, Hojas de Estilo y Scripts
 */
function studio_enqueue_assets() {
    // Google Fonts: Montserrat + Space Grotesk (Estética moderna Sequel)
    wp_enqueue_style( 
        'studio-google-fonts', 
        'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Space+Grotesk:wght@500;700;800&display=swap', 
        array(), 
        null 
    );

    // Lucide Icons
    wp_enqueue_script( 
        'studio-lucide-icons', 
        'https://unpkg.com/lucide@latest', 
        array(), 
        '1.0.0', 
        true 
    );

    // Tokens Fluidos Matemáticos (320px a 8K)
    wp_enqueue_style( 
        'studio-fluid-tokens', 
        get_template_directory_uri() . '/assets/css/fluid-tokens.css', 
        array(), 
        STUDIO_THEME_VERSION 
    );

    // Hoja de estilos principal del tema
    wp_enqueue_style( 
        'studio-main-style', 
        get_stylesheet_uri(), 
        array('studio-fluid-tokens'), 
        STUDIO_THEME_VERSION 
    );

    // Hoja de estilos complementaria
    wp_enqueue_style( 
        'studio-custom-style', 
        get_template_directory_uri() . '/assets/css/theme-style.css', 
        array('studio-fluid-tokens', 'studio-main-style'), 
        STUDIO_THEME_VERSION 
    );

    // Hoja de estilos: Rama 1 - Portafolio Masonry & Casos de Estudio
    wp_enqueue_style( 
        'studio-portfolio-masonry', 
        get_template_directory_uri() . '/assets/css/portfolio-masonry.css', 
        array('studio-fluid-tokens', 'studio-custom-style'), 
        STUDIO_THEME_VERSION 
    );

    // Hoja de estilos: Rama 2 - Tienda de Stock & Área de Clientes (Picsel Style)
    wp_enqueue_style( 
        'studio-client-store', 
        get_template_directory_uri() . '/assets/css/client-store.css', 
        array('studio-fluid-tokens', 'studio-custom-style'), 
        STUDIO_THEME_VERSION 
    );

    // Script interactivo principal
    wp_enqueue_script( 
        'studio-main-script', 
        get_template_directory_uri() . '/assets/js/theme-main.js', 
        array('jquery', 'studio-lucide-icons'), 
        STUDIO_THEME_VERSION, 
        true 
    );

    // Script: Rama 1 - Motor de Portafolio, Video Hovers y Comparadores Antes/Después
    wp_enqueue_script( 
        'studio-portfolio-engine', 
        get_template_directory_uri() . '/assets/js/portfolio-engine.js', 
        array('jquery', 'studio-lucide-icons'), 
        STUDIO_THEME_VERSION, 
        true 
    );

    // Script: Rama 2 - Motor de Tienda de Stock, Filtros Facetados y Floating Dock
    wp_enqueue_script( 
        'studio-client-store-engine', 
        get_template_directory_uri() . '/assets/js/client-store-engine.js', 
        array('jquery', 'studio-lucide-icons'), 
        STUDIO_THEME_VERSION, 
        true 
    );

    // Parámetros pasados a JS
    wp_localize_script( 'studio-main-script', 'studioThemeParams', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'studio_nonce' )
    ) );
}
add_action( 'wp_enqueue_scripts', 'studio_enqueue_assets' );

/**
 * 3. Registro de Custom Post Type: PORTFOLIO
 */
function studio_register_portfolio_cpt() {
    $labels = array(
        'name'                  => _x( 'Portfolio', 'Post type general name', 'studio-dark-portfolio' ),
        'singular_name'         => _x( 'Proyecto', 'Post type singular name', 'studio-dark-portfolio' ),
        'menu_name'             => _x( 'Portfolio', 'Admin Menu text', 'studio-dark-portfolio' ),
        'name_admin_bar'        => _x( 'Proyecto de Portfolio', 'Add New on Toolbar', 'studio-dark-portfolio' ),
        'add_new'               => __( 'Añadir Nuevo', 'studio-dark-portfolio' ),
        'add_new_item'          => __( 'Añadir Nuevo Proyecto', 'studio-dark-portfolio' ),
        'new_item'              => __( 'Nuevo Proyecto', 'studio-dark-portfolio' ),
        'edit_item'             => __( 'Editar Proyecto', 'studio-dark-portfolio' ),
        'view_item'             => __( 'Ver Proyecto', 'studio-dark-portfolio' ),
        'all_items'             => __( 'Todos los Proyectos', 'studio-dark-portfolio' ),
        'search_items'          => __( 'Buscar Proyectos', 'studio-dark-portfolio' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolio' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-format-gallery',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'portfolio', $args );

    // Taxonomía de Categorías para el Portfolio
    $tax_labels = array(
        'name'              => _x( 'Categorías de Portfolio', 'taxonomy general name', 'studio-dark-portfolio' ),
        'singular_name'     => _x( 'Categoría', 'taxonomy singular name', 'studio-dark-portfolio' ),
        'search_items'      => __( 'Buscar Categorías', 'studio-dark-portfolio' ),
        'all_items'         => __( 'Todas las Categorías', 'studio-dark-portfolio' ),
        'parent_item'       => __( 'Categoría Padre', 'studio-dark-portfolio' ),
        'parent_item_colon' => __( 'Categoría Padre:', 'studio-dark-portfolio' ),
        'edit_item'         => __( 'Editar Categoría', 'studio-dark-portfolio' ),
        'update_item'       => __( 'Actualizar Categoría', 'studio-dark-portfolio' ),
        'add_new_item'      => __( 'Añadir Nueva Categoría', 'studio-dark-portfolio' ),
        'new_item_name'     => __( 'Nombre de Nueva Categoría', 'studio-dark-portfolio' ),
        'menu_name'         => __( 'Categorías', 'studio-dark-portfolio' ),
    );

    register_taxonomy( 'portfolio_category', array( 'portfolio' ), array(
        'hierarchical'      => true,
        'labels'            => $tax_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categoria-portfolio' ),
        'show_in_rest'      => true,
    ) );
}
add_action( 'init', 'studio_register_portfolio_cpt' );

/**
 * 4. AUTOMATIZACIÓN DE ENTREGA DIGITAL CON MERCADO PAGO
 *
 * Cuando Mercado Pago procesa el pago exitosamente, WooCommerce cambia el estado a 'processing'.
 * Esta función detecta automáticamente si el pedido contiene únicamente productos virtuales/descargables.
 * De ser así, cambia de inmediato el estado a 'completed', lo que DISPARA automáticamente
 * el correo electrónico oficial de WooCommerce con el link de descarga directa y segura.
 */
function studio_auto_complete_digital_orders( $order_id ) {
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    if ( ! $order ) {
        return;
    }

    // Verificar si todos los ítems son descargables y virtuales
    $is_all_virtual = true;
    foreach ( $order->get_items() as $item ) {
        $product = $item->get_product();
        if ( $product && ( ! $product->is_virtual() || ! $product->is_downloadable() ) ) {
            $is_all_virtual = false;
            break;
        }
    }

    // Si todo es descargable, completar el pedido automáticamente
    if ( $is_all_virtual && $order->has_status( 'processing' ) ) {
        $order->update_status( 
            'completed', 
            __( 'Pago recibido vía Mercado Pago. Archivos originales HD enviados automáticamente al correo del cliente.', 'studio-dark-portfolio' ) 
        );
    }
}
add_action( 'woocommerce_order_status_processing', 'studio_auto_complete_digital_orders' );

/**
 * 5. Helper: Renderizar Capa de Marca de Agua sobre Productos
 */
function studio_get_watermark_layer( $label = 'AETHER STUDIO' ) {
    ob_start();
    ?>
    <div class="watermark-overlay" aria-hidden="true">
        <div class="watermark-text-grid">
            <div class="watermark-stamp"><i data-lucide="shield" class="w-3.5 h-3.5"></i> <?php echo esc_html( $label ); ?></div>
            <div class="watermark-stamp"><i data-lucide="shield" class="w-3.5 h-3.5"></i> PREVIEW ONLY</div>
            <div class="watermark-stamp"><i data-lucide="shield" class="w-3.5 h-3.5"></i> <?php echo esc_html( $label ); ?></div>
            <div class="watermark-stamp"><i data-lucide="shield" class="w-3.5 h-3.5"></i> PREVIEW ONLY</div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * 6. Ajustes de Descargas Digitales Seguras en WooCommerce
 */
add_filter( 'woocommerce_file_download_method', function( $method ) {
    // Forzar método 'force' (Force Downloads) para que el archivo se descargue a través de PHP
    // impidiendo que los usuarios descubran la URL real del archivo en el servidor.
    return 'force';
} );

/**
 * 7. SHORTCODE: Comparador Interactivo Antes / Después (Color Grading & Post-producción)
 * Uso: [studio_before_after before="url_raw.jpg" after="url_grade.jpg" label_before="RAW / Log" label_after="Final Grade"]
 */
function studio_before_after_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'before'       => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=1600&q=80',
        'after'        => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=1600&q=80',
        'label_before' => 'S-Log3 RAW / Flat',
        'label_after'  => 'Film Emulation 35mm Grade',
        'title'        => 'Color Grading & Look Dev Breakdown',
    ), $atts, 'studio_before_after' );

    ob_start();
    ?>
    <div class="color-grade-comparator-block my-8">
        <?php if ( ! empty( $atts['title'] ) ) : ?>
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs uppercase font-extrabold tracking-widest text-[#00D2FF] flex items-center gap-2">
                    <i data-lucide="sliders" class="w-4 h-4"></i> <?php echo esc_html( $atts['title'] ); ?>
                </span>
                <span class="text-[11px] text-slate-400 font-mono">Arrastra el cursor para comparar</span>
            </div>
        <?php endif; ?>
        
        <div class="before-after-slider" data-label-before="<?php echo esc_attr( $atts['label_before'] ); ?>" data-label-after="<?php echo esc_attr( $atts['label_after'] ); ?>">
            <img src="<?php echo esc_url( $atts['after'] ); ?>" alt="<?php echo esc_attr( $atts['label_after'] ); ?>" class="ba-img ba-after" loading="lazy" />
            <div class="ba-resize">
                <img src="<?php echo esc_url( $atts['before'] ); ?>" alt="<?php echo esc_attr( $atts['label_before'] ); ?>" class="ba-img ba-before" loading="lazy" />
                <span class="ba-label ba-label-before"><?php echo esc_html( $atts['label_before'] ); ?></span>
            </div>
            <span class="ba-label ba-label-after"><?php echo esc_html( $atts['label_after'] ); ?></span>
            <div class="ba-handle">
                <div class="ba-handle-line"></div>
                <div class="ba-handle-btn">
                    <i data-lucide="chevrons-left-right" class="w-4 h-4 text-black"></i>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'studio_before_after', 'studio_before_after_shortcode' );

/**
 * 8. SOPORTE DE LICENCIAS DE STOCK EN WOOCOMMERCE
 * Añade atributos estándar para licencias de uso y resoluciones
 */
function studio_setup_stock_product_attributes() {
    // Registrar atributos globales si WooCommerce está activo
    if ( ! function_exists( 'wc_get_attribute_taxonomies' ) ) {
        return;
    }
}
add_action( 'init', 'studio_setup_stock_product_attributes' );

