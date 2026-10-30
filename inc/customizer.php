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

        // Encabezado: Portafolio
        'dp_pf_eyebrow'      => 'PORTAFOLIO AUDIOVISUAL · CASE STUDIES',
        'dp_pf_title'        => 'PRODUCCIÓN CINEMATOGRÁFICA',
        'dp_pf_text'         => 'Transformamos visiones en experiencias cinematográficas. Desde comerciales de alta gama hasta piezas de autor, aplicamos color grading de nivel cinematográfico en cada frame.',

        // Color Grading
        'dp_cg_eyebrow'      => 'TÉCNICA CINEMATOGRÁFICA · ETALONAJE',
        'dp_cg_title'        => 'Cinematic Color Grading: Log to Final Film Look',
        'dp_cg_text'         => 'Transformamos la señal neutra de cámara (S-Log3/V-Log) en una pieza cinematográfica con emulación de película Kodak 2383. Desliza para ver el proceso de etalonaje.',
        'dp_cg_img'          => 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?auto=format&fit=crop&w=2400&q=90',
        'dp_cg_meta'         => '[ CAMERA: SONY A7SIII ]  |  [ COLOR SPACE: REC.709 ]  |  [ LUT: APEX FILM ]',

        // Encabezado: Tienda
        'dp_store_eyebrow'   => 'Catálogo Oficial · Fotografía & Video en Stock',
        'dp_store_title'     => 'METRAJE 4K & FOTOGRAFÍA AUTORAL',
        'dp_store_text'      => 'Seleccioná activos marcándolos con el corazón para armar tu selección y adquirirlos en lote con entrega instantánea.',

        // Servicios / Especialidades
        'dp_sv_label'        => 'Especialidades & Servicios Principales',
        'dp_sv_note'         => 'End-to-End Workflow',
        'dp_sv_c1_title'     => 'Producción Comercial',
        'dp_sv_c1_text'      => 'Spots publicitarios, dirección de fotografía 4K/8K, rodajes aéreos con drones y corrección de color en DaVinci Resolve.',
        'dp_sv_c2_title'     => 'Diseño Gráfico & Indumentaria',
        'dp_sv_c2_text'      => 'Desarrollo de identidad visual, gráfica para indumentaria técnica, dirección de arte, cartelería de cine y packaging.',
        'dp_sv_c3_title'     => 'Soporte IT & Infraestructura',
        'dp_sv_c3_text'      => 'Sistemas de almacenamiento masivo SAN/NAS de alta velocidad para postproducción, redes corporativas y seguridad de datos.',

        // Sección de Contacto (formulario)
        'dp_contact_enable'  => '1',
        'dp_contact_eyebrow' => 'Contacto',
        'dp_contact_title'   => 'Hablemos de tu proyecto',
        'dp_contact_text'    => 'Contanos qué necesitás y te respondemos a la brevedad.',
        'dp_contact_form'    => '',

        // Títulos de columnas del pie
        'dp_footer_col2_title' => 'Producción',
        'dp_footer_col3_title' => 'Tienda de Recursos',
        'dp_footer_col4_title' => 'Conectar',
    );
}

/**
 * Sanitiza un checkbox del Personalizador ('1' o '').
 *
 * @param mixed $value
 * @return string
 */
function dp_sanitize_checkbox( $value ) {
    return ( ! empty( $value ) ) ? '1' : '';
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
        } elseif ( 'checkbox' === $type ) {
            $sanitize = 'dp_sanitize_checkbox';
        } elseif ( 'shortcode' === $type ) {
            $sanitize = 'sanitize_text_field'; // mantiene [shortcode id="..."]
        }

        $control_type = 'text';
        if ( 'textarea' === $type || 'shortcode' === $type ) {
            $control_type = 'textarea';
        } elseif ( 'url' === $type ) {
            $control_type = 'url';
        } elseif ( 'email' === $type ) {
            $control_type = 'email';
        } elseif ( 'checkbox' === $type ) {
            $control_type = 'checkbox';
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
            'type'        => $control_type,
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
        'title'       => __( 'Identidad & Logo', 'studio-dark-portfolio' ),
        'description' => __( 'El logo del encabezado se sube en “Identidad del sitio → Logo”. Si no cargás uno, se muestra el nombre del sitio con el ícono.', 'studio-dark-portfolio' ),
        'panel'       => 'dp_home_panel',
    ) );
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
    $add( 'dp_footer_col2_title', __( 'Título columna “Producción”', 'studio-dark-portfolio' ), 'dp_sec_contact', 'text' );
    $add( 'dp_footer_col3_title', __( 'Título columna “Tienda de Recursos”', 'studio-dark-portfolio' ), 'dp_sec_contact', 'text' );
    $add( 'dp_footer_col4_title', __( 'Título columna “Conectar”', 'studio-dark-portfolio' ), 'dp_sec_contact', 'text', __( 'Los enlaces de las columnas “Producción” y “Tienda de Recursos” se editan en Apariencia → Menús (ubicaciones “Pie — Columna Producción” y “Pie — Columna Tienda”).', 'studio-dark-portfolio' ) );

    /* ---- Sección: Encabezado del Portafolio ---- */
    $wp_customize->add_section( 'dp_sec_pf', array(
        'title'       => __( 'Portafolio (encabezado)', 'studio-dark-portfolio' ),
        'description' => __( 'Solo los textos del encabezado. Los proyectos se cargan en Portfolio.', 'studio-dark-portfolio' ),
        'panel'       => 'dp_home_panel',
    ) );
    $add( 'dp_pf_eyebrow', __( 'Etiqueta superior', 'studio-dark-portfolio' ), 'dp_sec_pf', 'text' );
    $add( 'dp_pf_title', __( 'Título', 'studio-dark-portfolio' ), 'dp_sec_pf', 'text' );
    $add( 'dp_pf_text', __( 'Párrafo', 'studio-dark-portfolio' ), 'dp_sec_pf', 'textarea' );

    /* ---- Sección: Color Grading ---- */
    $wp_customize->add_section( 'dp_sec_cg', array(
        'title' => __( 'Color Grading (comparador)', 'studio-dark-portfolio' ),
        'panel' => 'dp_home_panel',
    ) );
    $add( 'dp_cg_eyebrow', __( 'Etiqueta superior', 'studio-dark-portfolio' ), 'dp_sec_cg', 'text' );
    $add( 'dp_cg_title', __( 'Título', 'studio-dark-portfolio' ), 'dp_sec_cg', 'text' );
    $add( 'dp_cg_text', __( 'Párrafo', 'studio-dark-portfolio' ), 'dp_sec_cg', 'textarea' );
    $add_image( 'dp_cg_img', __( 'Imagen del comparador', 'studio-dark-portfolio' ), 'dp_sec_cg', __( 'Se muestra con dos tratamientos (plano/etalonado) al deslizar.', 'studio-dark-portfolio' ) );
    $add( 'dp_cg_meta', __( 'Línea técnica', 'studio-dark-portfolio' ), 'dp_sec_cg', 'text' );

    /* ---- Sección: Encabezado de la Tienda ---- */
    $wp_customize->add_section( 'dp_sec_store', array(
        'title'       => __( 'Tienda (encabezado)', 'studio-dark-portfolio' ),
        'description' => __( 'Solo los textos del encabezado. Las fotos se cargan como productos.', 'studio-dark-portfolio' ),
        'panel'       => 'dp_home_panel',
    ) );
    $add( 'dp_store_eyebrow', __( 'Etiqueta superior', 'studio-dark-portfolio' ), 'dp_sec_store', 'text' );
    $add( 'dp_store_title', __( 'Título', 'studio-dark-portfolio' ), 'dp_sec_store', 'text' );
    $add( 'dp_store_text', __( 'Párrafo', 'studio-dark-portfolio' ), 'dp_sec_store', 'textarea' );

    /* ---- Sección: Servicios / Especialidades ---- */
    $wp_customize->add_section( 'dp_sec_services', array(
        'title' => __( 'Servicios / Especialidades', 'studio-dark-portfolio' ),
        'panel' => 'dp_home_panel',
    ) );
    $add( 'dp_sv_label', __( 'Título de la fila', 'studio-dark-portfolio' ), 'dp_sec_services', 'text' );
    $add( 'dp_sv_note', __( 'Etiqueta de la derecha', 'studio-dark-portfolio' ), 'dp_sec_services', 'text' );
    $add( 'dp_sv_c1_title', __( 'Tarjeta 1 — título', 'studio-dark-portfolio' ), 'dp_sec_services', 'text' );
    $add( 'dp_sv_c1_text', __( 'Tarjeta 1 — texto', 'studio-dark-portfolio' ), 'dp_sec_services', 'textarea' );
    $add( 'dp_sv_c2_title', __( 'Tarjeta 2 — título', 'studio-dark-portfolio' ), 'dp_sec_services', 'text' );
    $add( 'dp_sv_c2_text', __( 'Tarjeta 2 — texto', 'studio-dark-portfolio' ), 'dp_sec_services', 'textarea' );
    $add( 'dp_sv_c3_title', __( 'Tarjeta 3 — título', 'studio-dark-portfolio' ), 'dp_sec_services', 'text' );
    $add( 'dp_sv_c3_text', __( 'Tarjeta 3 — texto', 'studio-dark-portfolio' ), 'dp_sec_services', 'textarea' );

    /* ---- Sección: Contacto (formulario) ---- */
    $wp_customize->add_section( 'dp_sec_contact_form', array(
        'title'       => __( 'Contacto (sección con formulario)', 'studio-dark-portfolio' ),
        'description' => __( 'Agrega una sección de contacto al final del home. Pegá el shortcode de tu formulario (p. ej. Contact Form 7).', 'studio-dark-portfolio' ),
        'panel'       => 'dp_home_panel',
    ) );
    $add( 'dp_contact_enable', __( 'Mostrar la sección de contacto', 'studio-dark-portfolio' ), 'dp_sec_contact_form', 'checkbox' );
    $add( 'dp_contact_eyebrow', __( 'Etiqueta superior', 'studio-dark-portfolio' ), 'dp_sec_contact_form', 'text' );
    $add( 'dp_contact_title', __( 'Título', 'studio-dark-portfolio' ), 'dp_sec_contact_form', 'text' );
    $add( 'dp_contact_text', __( 'Párrafo', 'studio-dark-portfolio' ), 'dp_sec_contact_form', 'textarea' );
    $add( 'dp_contact_form', __( 'Shortcode del formulario', 'studio-dark-portfolio' ), 'dp_sec_contact_form', 'shortcode', __( 'Ejemplo: [contact-form-7 id="123" title="Contacto"]. Si lo dejás vacío se muestra tu email de contacto.', 'studio-dark-portfolio' ) );
}
add_action( 'customize_register', 'dp_customize_register' );
