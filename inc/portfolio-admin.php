<?php
/**
 * DP Producciones — Administración del Portfolio (YouTube: videos y shorts)
 *
 * Añade al CPT "portfolio" (registrado en functions.php) un panel para pegar
 * la URL de YouTube y marcar si es un VIDEO horizontal o un SHORT vertical.
 * De ahí se derivan automáticamente el ID, el embed y la miniatura.
 *
 * @package Studio_Dark_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Extrae el ID de un video/short de YouTube desde cualquier formato de URL.
 *
 * Soporta:  youtu.be/ID · youtube.com/watch?v=ID · /shorts/ID · /embed/ID · /live/ID
 *
 * @param string $url
 * @return string ID de 11 caracteres o cadena vacía.
 */
function dp_youtube_extract_id( $url ) {
    $url = trim( (string) $url );
    if ( '' === $url ) {
        return '';
    }

    // Si ya es un ID puro.
    if ( preg_match( '/^[A-Za-z0-9_-]{11}$/', $url ) ) {
        return $url;
    }

    $patterns = array(
        '/youtu\.be\/([A-Za-z0-9_-]{11})/',
        '/youtube\.com\/watch\?[^#]*v=([A-Za-z0-9_-]{11})/',
        '/youtube\.com\/shorts\/([A-Za-z0-9_-]{11})/',
        '/youtube\.com\/embed\/([A-Za-z0-9_-]{11})/',
        '/youtube\.com\/live\/([A-Za-z0-9_-]{11})/',
    );

    foreach ( $patterns as $pattern ) {
        if ( preg_match( $pattern, $url, $m ) ) {
            return $m[1];
        }
    }

    return '';
}

/**
 * URL de la miniatura de máxima calidad disponible para un ID de YouTube.
 *
 * @param string $id
 * @return string
 */
function dp_youtube_thumbnail( $id ) {
    $id = sanitize_text_field( $id );
    if ( '' === $id ) {
        return '';
    }
    // maxresdefault no siempre existe; hqdefault está garantizado.
    return 'https://i.ytimg.com/vi/' . $id . '/hqdefault.jpg';
}

/**
 * URL de embed (reproductor) para un ID.
 *
 * @param string $id
 * @return string
 */
function dp_youtube_embed_url( $id ) {
    $id = sanitize_text_field( $id );
    return $id ? 'https://www.youtube-nocookie.com/embed/' . $id . '?rel=0&modestbranding=1' : '';
}

/**
 * Registra el meta box de YouTube en el editor de proyectos.
 */
function dp_portfolio_add_meta_box() {
    add_meta_box(
        'dp_portfolio_youtube',
        __( '🎬 YouTube — Video / Short', 'studio-dark-portfolio' ),
        'dp_portfolio_meta_box_render',
        'portfolio',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'dp_portfolio_add_meta_box' );

/**
 * Renderiza el meta box.
 *
 * @param WP_Post $post
 */
function dp_portfolio_meta_box_render( $post ) {
    wp_nonce_field( 'dp_portfolio_save', 'dp_portfolio_nonce' );

    $url   = get_post_meta( $post->ID, '_studio_youtube_url', true );
    $kind  = get_post_meta( $post->ID, '_studio_media_kind', true );
    $kind  = $kind ? $kind : 'video';
    $id    = dp_youtube_extract_id( $url );
    $thumb = $id ? dp_youtube_thumbnail( $id ) : '';
    ?>
    <style>
        .dp-field{margin:14px 0}
        .dp-field label{display:block;font-weight:600;margin-bottom:5px}
        .dp-field input[type=url]{width:100%;max-width:640px}
        .dp-kind{display:inline-flex;gap:18px;margin-top:4px}
        .dp-hint{color:#666;font-size:12px;margin-top:4px}
        .dp-thumb{margin-top:10px}
        .dp-thumb img{max-width:320px;height:auto;border-radius:8px;border:1px solid #ddd}
        .dp-badge{display:inline-block;background:#111;color:#00D2FF;padding:2px 8px;border-radius:4px;font-size:11px;font-weight:700;letter-spacing:.05em}
    </style>

    <div class="dp-field">
        <label for="dp_youtube_url"><?php esc_html_e( 'Enlace de YouTube', 'studio-dark-portfolio' ); ?></label>
        <input type="url" id="dp_youtube_url" name="dp_youtube_url"
               value="<?php echo esc_attr( $url ); ?>"
               placeholder="https://www.youtube.com/watch?v=…  ó  https://youtube.com/shorts/…" />
        <p class="dp-hint">
            <?php esc_html_e( 'Pegá el enlace del video o del Short. Se detecta el ID y la miniatura automáticamente.', 'studio-dark-portfolio' ); ?>
            <?php if ( $id ) : ?>
                &nbsp;<span class="dp-badge"><?php echo esc_html( 'ID: ' . $id ); ?></span>
            <?php endif; ?>
        </p>
    </div>

    <div class="dp-field">
        <label><?php esc_html_e( 'Tipo de pieza', 'studio-dark-portfolio' ); ?></label>
        <span class="dp-kind">
            <label><input type="radio" name="dp_media_kind" value="video" <?php checked( $kind, 'video' ); ?> /> <?php esc_html_e( 'Video (horizontal 16:9)', 'studio-dark-portfolio' ); ?></label>
            <label><input type="radio" name="dp_media_kind" value="short" <?php checked( $kind, 'short' ); ?> /> <?php esc_html_e( 'Short (vertical 9:16)', 'studio-dark-portfolio' ); ?></label>
        </span>
    </div>

    <div class="dp-thumb">
        <?php if ( $thumb ) : ?>
            <strong><?php esc_html_e( 'Miniatura detectada:', 'studio-dark-portfolio' ); ?></strong><br>
            <img src="<?php echo esc_url( $thumb ); ?>" alt="" />
        <?php else : ?>
            <p class="dp-hint"><?php esc_html_e( 'La miniatura aparecerá aquí al guardar con un enlace válido. Si no subís una imagen destacada, se usa la miniatura de YouTube.', 'studio-dark-portfolio' ); ?></p>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Guarda los campos del meta box.
 *
 * @param int $post_id
 */
function dp_portfolio_save_meta( $post_id ) {
    if ( ! isset( $_POST['dp_portfolio_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['dp_portfolio_nonce'] ), 'dp_portfolio_save' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $url = isset( $_POST['dp_youtube_url'] ) ? esc_url_raw( wp_unslash( $_POST['dp_youtube_url'] ) ) : '';
    update_post_meta( $post_id, '_studio_youtube_url', $url );

    // Compatibilidad con la plantilla single (usa _studio_video_embed para el oEmbed).
    update_post_meta( $post_id, '_studio_video_embed', $url );

    $kind = ( isset( $_POST['dp_media_kind'] ) && 'short' === $_POST['dp_media_kind'] ) ? 'short' : 'video';
    update_post_meta( $post_id, '_studio_media_kind', $kind );

    // Cachear el ID para consultas rápidas en el frontend.
    update_post_meta( $post_id, '_studio_youtube_id', dp_youtube_extract_id( $url ) );
}
add_action( 'save_post_portfolio', 'dp_portfolio_save_meta' );

/**
 * Columna "YouTube" en el listado de proyectos del admin.
 */
function dp_portfolio_admin_columns( $columns ) {
    $new = array();
    foreach ( $columns as $key => $label ) {
        $new[ $key ] = $label;
        if ( 'title' === $key ) {
            $new['dp_media'] = __( 'YouTube', 'studio-dark-portfolio' );
        }
    }
    return $new;
}
add_filter( 'manage_portfolio_posts_columns', 'dp_portfolio_admin_columns' );

/**
 * Contenido de la columna "YouTube".
 */
function dp_portfolio_admin_column_content( $column, $post_id ) {
    if ( 'dp_media' !== $column ) {
        return;
    }
    $id   = get_post_meta( $post_id, '_studio_youtube_id', true );
    $kind = get_post_meta( $post_id, '_studio_media_kind', true );
    if ( $id ) {
        $label = ( 'short' === $kind ) ? '📱 Short' : '🎬 Video';
        printf(
            '<span style="font-weight:600">%s</span><br><code style="font-size:11px">%s</code>',
            esc_html( $label ),
            esc_html( $id )
        );
    } else {
        echo '<span style="color:#b32d2e">' . esc_html__( 'Sin enlace', 'studio-dark-portfolio' ) . '</span>';
    }
}
add_action( 'manage_portfolio_posts_custom_column', 'dp_portfolio_admin_column_content', 10, 2 );
