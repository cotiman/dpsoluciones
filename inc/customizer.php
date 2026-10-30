<?php
/**
 * DP Producciones — Personalizador del Home (textos, imágenes, logo, contacto)
 *
 * Expone en Apariencia → Personalizar (con vista previa en vivo) todo el
 * contenido editable del inicio: logo e identidad del encabezado, la sección
 * principal (hero), el bloque "Sobre mí" y los datos de contacto/redes.
 *
 * NO incluye (a propósito): servicios, portfolio ni la tienda de fotos.
 *
 * @package Studio_Dark_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Valores por defecto = el contenido original del template. Si el usuario no
 * toca nada, el home se ve igual que siempre.
 *
 * @return array
 */
function dp_home_defaults() {
    return array(
        // Identidad / encabezado
        'dp_brand_tagline'   => 'CINEMA · DRONE · DESIGN',

        // Hero (sección principal)
        'dp_hero_bg'         => 'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?auto=format&fit=crop&w=3840&q=85',
        'dp_hero_badge'      => 'Visual Arts & Fine Photography',
        'dp_hero_title1'     => get_bloginfo( 'name' ),
        'dp_hero_title2'     => 'PORTAL',
        'dp_hero_title3'     => 'CREATIVO',
        'dp_hero_text'       => 'Bienvenido al espacio de creación visual contemporánea. Explora las series autorales en el portafolio o adquiere licencias maestras de alta resolución en la tienda protegida.',
        'dp_hero_cta1_label' => 'Ver Portafolio',
        'dp_hero_cta1_link'  => '#portfolio',
        'dp_hero_cta2_label' => 'Tienda de Fotografías',
        'dp_hero_cta2_link'  => '#tienda',
        'dp_hero_m1_title'   => '8K · 4K UHD',
        'dp_hero_m1_sub'     => 'Master ProRes RAW',
        'dp_hero_m2_title'   => 'Mercado Pago',
        'dp_hero_m2_sub'     => 'Cobro Seguro 24/7',
        'dp_hero_m3_title'   => 'Descarga Instant',
        'dp_hero_m3_sub'     => 'Sin Marcas de Agua',

        // Sobre mí
        'dp_about_photo'     => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=80',
        'dp_about_name'      => get_bloginfo( 'name' ),
        'dp_about_role'      => 'Director Creativo & Fotógrafo',
        'dp_about_badge'     => 'Perfil Híbrido · Dirección Creativa & IT',
        'dp_about_title'     => 'CREACIÓN AUDIOVISUAL, DISEÑO DE MARCA & INFRAESTRUCTURA TÉCNICA',
        'dp_about_text'      => 'Especializado en converger la estética cinematográfica de alta fidelidad con la precisión del diseño gráfico contemporáneo y el rigor de la ingeniería tecnológica. Desde el rodaje publicitario en 4K/8K con ópticas de cine hasta el despliegue de redes corporativas, servidores de datos y almacenamiento masivo para flujos de trabajo de postproducción intensiva.',

        // Contacto / footer / redes
        'dp_footer_brand'    => 'DP Producciones',
        'dp_footer_tagline'  => 'Estética cinematográfica y narrativa visual de alta fidelidad.',
        'dp_footer_location' => 'Montevideo, Uruguay',
        'dp_contact_email'   => 'hola@dpproducciones.com',
        'dp_social_instagram'=> 'https://instagram.com',
        'dp_social_youtube'  => '',
        'dp_social_vimeo'    => 'https://vimeo.com',
        'dp_social_linkedin' => 'https://linkedin.com',
        'dp_footer_copyright'=> 'DP Producciones',
    );
}

/**
 * Lee un ajuste del Personalizador con su valor por defecto del template.
 *
 * @param string $key
 * @return string
 */
function dp_mod( $key ) {
    $defaults = dp_home_defaults();
    $default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
    return get_theme_mod( $key, $default );
}

/**
 * Soporte de logo personalizado para el encabezado.
 */
function dp_customizer_theme_support() {
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 320,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
}
add_action( 'after_setup_theme', 'dp_customizer_theme_support' );

/**
 * Registra el panel, secciones y controles del Personalizador.
 *
 * @param WP_Customize_Manager $wp_customize
 */
function dp_customize_register( $wp_customize ) {
    $defaults = dp_home_defaults();

    // Panel contenedor.
    $wp_customize->add_panel( 'dp_home_panel', array(
        'title'       => __( 'DP · Contenido del Home', 'studio-dark-portfolio' ),
        'description' => __( 'Editá textos, imágenes, logo y datos de contacto del inicio.', 'studio-dark-portfolio' ),
        'priority'    => 20,
    ) );

    // Helper interno para agregar ajuste + control.
    $add = function ( $id, $label, $section, $type = 'text', $desc = '' ) use ( $wp_customize, $defaults ) {
        $sanitize = 'sanitize_text_field';
        if ( 'textarea' === $type ) {
            $sanitize = 'wp_kses_post';
        } elseif ( 'url' === $type ) {
            $sanitize = 'esc_url_raw';
        } elseif ( 'email' === $type ) {
            $sanitize = 'sanitize_email';
        }

        $wp_customize->add_setting( $id, array(
            'default'           => isset( $defaults[ $id ] ) ? $defaults[ $id ] : '',
            'sanitize_callback' => $sanitize,
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( $id, array(
            'label'       => $label,
            'description' => $desc,
            'section'     => $section,
            'type'        => ( 'textarea' === $type ) ? 'textarea' : ( 'url' === $type ? 'url' : ( 'email' === $type ? 'email' : 'text' ) ),
        ) );
    };

    // Helper para imágenes.
    $add_image = function ( $id, $label, $section, $desc = '' ) use ( $wp_customize, $defaults ) {
        $wp_customize->add_setting( $id, array(
            'default'           => isset( $defaults[ $id ] ) ? $defaults[ $id ] : '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, array(
            'label'       => $label,
            'description' => $desc,
            'section'     => $section,
        ) ) );
    };

    /* ---- Sección: Identidad / Logo ---- */
    $wp_customize->add_section( 'dp_sec_identity', array(
        'title' => __( 'Identidad & Logo', 'studio-dark-portfolio' ),
        'panel' => 'dp_home_panel',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'dp_logo_hint', array(
        'label'       => __( 'Logo del encabezado', 'studio-dark-portfolio' ),
        'description' => __( 'El logo se sube en “Identidad del sitio → Logo”. Si no cargás uno, se muestra el nombre del sitio con el ícono.', 'studio-dark-portfolio' ),
        'section'     => 'dp_sec_identity',
        'settings'    => array(),
    ) ) );
    $add( 'dp_brand_tagline', __( 'Bajada del encabezado', 'studio-dark-portfolio' ), 'dp_sec_identity', 'text' );

    /* ---- Sección: Inicio (Hero) ---- */
    $wp_customize->add_section( 'dp_sec_hero', array(
        'title' => __( 'Inicio (sección principal)', 'studio-dark-portfolio' ),
        'panel' => 'dp_home_panel',
    ) );
    $add_image( 'dp_hero_bg', __( 'Imagen de fondo', 'studio-dark-portfolio' ), 'dp_sec_hero' );
    $add( 'dp_hero_badge', __( 'Etiqueta superior', 'studio-dark-portfolio' ), 'dp_sec_hero', 'text' );
    $add( 'dp_hero_title1', __( 'Título — línea 1 (blanco)', 'studio-dark-portfolio' ), 'dp_sec_hero', 'text' );
    $add( 'dp_hero_title2', __( 'Título — palabra 2 (plata)', 'studio-dark-portfolio' ), 'dp_sec_hero', 'text' );
    $add( 'dp_hero_title3', __( 'Título — palabra 3 (celeste)', 'studio-dark-portfolio' ), 'dp_sec_hero', 'text' );
    $add( 'dp_hero_text', __( 'Párrafo principal', 'studio-dark-portfolio' ), 'dp_sec_hero', 'textarea' );
    $add( 'dp_hero_cta1_label', __( 'Botón 1 — texto', 'studio-dark-portfolio' ), 'dp_sec_hero', 'text' );
    $add( 'dp_hero_cta1_link', __( 'Botón 1 — enlace', 'studio-dark-portfolio' ), 'dp_sec_hero', 'text' );
    $add( 'dp_hero_cta2_label', __( 'Botón 2 — texto', 'studio-dark-portfolio' ), 'dp_sec_hero', 'text' );
    $add( 'dp_hero_cta2_link', __( 'Botón 2 — enlace', 'studio-dark-portfolio' ), 'dp_sec_hero', 'text' );
    $add( 'dp_hero_m1_title', __( 'Dato 1 — título', 'studio-dark-portfolio' ), 'dp_sec_hero', 'text' );
    $add( 'dp_hero_m1_sub', __( 'Dato 1 — subtítulo', 'studio-dark-portfolio' ), 'dp_sec_hero', 'text' );
    $add( 'dp_hero_m2_title', __( 'Dato 2 — título', 'studio-dark-portfolio' ), 'dp_sec_hero', 'text' );
    $add( 'dp_hero_m2_sub', __( 'Dato 2 — subtítulo', 'studio-dark-portfolio' ), 'dp_sec_hero', 'text' );
    $add( 'dp_hero_m3_title', __( 'Dato 3 — título', 'studio-dark-portfolio' ), 'dp_sec_hero', 'text' );
    $add( 'dp_hero_m3_sub', __( 'Dato 3 — subtítulo', 'studio-dark-portfolio' ), 'dp_sec_hero', 'text' );

    /* ---- Sección: Sobre mí ---- */
    $wp_customize->add_section( 'dp_sec_about', array(
        'title' => __( 'Sobre mí', 'studio-dark-portfolio' ),
        'panel' => 'dp_home_panel',
    ) );
    $add_image( 'dp_about_photo', __( 'Foto de perfil', 'studio-dark-portfolio' ), 'dp_sec_about' );
    $add( 'dp_about_name', __( 'Nombre', 'studio-dark-portfolio' ), 'dp_sec_about', 'text' );
    $add( 'dp_about_role', __( 'Rol / cargo', 'studio-dark-portfolio' ), 'dp_sec_about', 'text' );
    $add( 'dp_about_badge', __( 'Etiqueta', 'studio-dark-portfolio' ), 'dp_sec_about', 'text' );
    $add( 'dp_about_title', __( 'Título', 'studio-dark-portfolio' ), 'dp_sec_about', 'textarea' );
    $add( 'dp_about_text', __( 'Texto / biografía', 'studio-dark-portfolio' ), 'dp_sec_about', 'textarea' );

    /* ---- Sección: Contacto & Redes ---- */
    $wp_customize->add_section( 'dp_sec_contact', array(
        'title' => __( 'Contacto & Redes', 'studio-dark-portfolio' ),
        'panel' => 'dp_home_panel',
    ) );
    $add( 'dp_footer_brand', __( 'Nombre de marca (pie)', 'studio-dark-portfolio' ), 'dp_sec_contact', 'text' );
    $add( 'dp_footer_tagline', __( 'Bajada del pie', 'studio-dark-portfolio' ), 'dp_sec_contact', 'textarea' );
    $add( 'dp_footer_location', __( 'Ubicación', 'studio-dark-portfolio' ), 'dp_sec_contact', 'text' );
    $add( 'dp_contact_email', __( 'Email de contacto', 'studio-dark-portfolio' ), 'dp_sec_contact', 'email' );
    $add( 'dp_social_instagram', __( 'Instagram (URL)', 'studio-dark-portfolio' ), 'dp_sec_contact', 'url' );
    $add( 'dp_social_youtube', __( 'YouTube (URL)', 'studio-dark-portfolio' ), 'dp_sec_contact', 'url' );
    $add( 'dp_social_vimeo', __( 'Vimeo (URL)', 'studio-dark-portfolio' ), 'dp_sec_contact', 'url' );
    $add( 'dp_social_linkedin', __( 'LinkedIn (URL)', 'studio-dark-portfolio' ), 'dp_sec_contact', 'url' );
    $add( 'dp_footer_copyright', __( 'Nombre en el copyright', 'studio-dark-portfolio' ), 'dp_sec_contact', 'text' );
}
add_action( 'customize_register', 'dp_customize_register' );
