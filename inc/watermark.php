<?php
/**
 * DP Producciones — Motor de Marca de Agua (burn server-side)
 *
 * Genera una versión reducida de una imagen con la marca de agua INCRUSTADA
 * en los píxeles (no un overlay de CSS). El archivo original de alta resolución
 * nunca se expone: se entrega únicamente como descarga segura tras el pago.
 *
 * Requiere la extensión GD de PHP (disponible por defecto en Hostinger).
 *
 * @package Studio_Dark_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Carpeta de uploads donde se guardan los previews con marca de agua.
 *
 * @return array{dir:string,url:string}
 */
function dp_watermark_storage() {
    $uploads = wp_upload_dir();
    $dir     = trailingslashit( $uploads['basedir'] ) . 'dp-watermarks';
    $url     = trailingslashit( $uploads['baseurl'] ) . 'dp-watermarks';

    if ( ! file_exists( $dir ) ) {
        wp_mkdir_p( $dir );
    }

    return array( 'dir' => $dir, 'url' => $url );
}

/**
 * Devuelve la ruta a un archivo de fuente TrueType utilizable, o false.
 * Prioriza una fuente incluida en el tema (assets/fonts) y luego fuentes
 * típicas del sistema. Si no hay ninguna, el motor usa el fallback bitmap.
 *
 * @return string|false
 */
function dp_watermark_font_path() {
    $candidates = array(
        get_template_directory() . '/assets/fonts/watermark.ttf',
        '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf',
        '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf',
        '/usr/share/fonts/dejavu/DejaVuSans-Bold.ttf',
        '/usr/share/fonts/truetype/liberation/LiberationSans-Bold.ttf',
    );

    foreach ( $candidates as $font ) {
        if ( is_readable( $font ) ) {
            return $font;
        }
    }

    return false;
}

/**
 * Opciones de la marca de agua, filtrables y configurables desde el backoffice.
 *
 * @return array
 */
function dp_watermark_options() {
    $defaults = array(
        'text'       => get_option( 'dp_watermark_text', get_bloginfo( 'name' ) ),
        'opacity'    => (int) get_option( 'dp_watermark_opacity', 38 ), // 0-100
        'max_width'  => 1600,   // ancho máximo del preview generado
        'jpeg_q'     => 82,     // calidad del JPEG de preview
        'angle'      => 30,     // inclinación del texto tileado
    );

    return apply_filters( 'dp_watermark_options', $defaults );
}

/**
 * Genera (o regenera) el preview con marca de agua a partir de una imagen.
 *
 * @param string $source_path Ruta absoluta a la imagen de origen (original HD).
 * @param string $slug        Identificador para el nombre del archivo de salida.
 * @return array{path:string,url:string}|WP_Error
 */
function dp_generate_watermarked_preview( $source_path, $slug = '' ) {
    if ( ! function_exists( 'imagecreatetruecolor' ) ) {
        return new WP_Error( 'no_gd', __( 'La extensión GD de PHP no está disponible en el servidor.', 'studio-dark-portfolio' ) );
    }

    if ( ! is_readable( $source_path ) ) {
        return new WP_Error( 'no_source', __( 'No se pudo leer la imagen de origen.', 'studio-dark-portfolio' ) );
    }

    $data = @file_get_contents( $source_path );
    if ( false === $data ) {
        return new WP_Error( 'read_fail', __( 'No se pudo cargar la imagen.', 'studio-dark-portfolio' ) );
    }

    $src = @imagecreatefromstring( $data );
    if ( false === $src ) {
        return new WP_Error( 'bad_image', __( 'Formato de imagen no soportado.', 'studio-dark-portfolio' ) );
    }

    $opts    = dp_watermark_options();
    $src_w   = imagesx( $src );
    $src_h   = imagesy( $src );
    $max_w   = max( 400, (int) $opts['max_width'] );

    // Redimensionar manteniendo proporción (solo si excede el máximo).
    if ( $src_w > $max_w ) {
        $ratio = $max_w / $src_w;
        $new_w = $max_w;
        $new_h = (int) round( $src_h * $ratio );
    } else {
        $new_w = $src_w;
        $new_h = $src_h;
    }

    $canvas = imagecreatetruecolor( $new_w, $new_h );
    imagecopyresampled( $canvas, $src, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h );
    imagedestroy( $src );

    // Oscurecer ligeramente para que la marca contraste y para desalentar reuso.
    $dark = imagecreatetruecolor( $new_w, $new_h );
    imagefilledrectangle( $dark, 0, 0, $new_w, $new_h, imagecolorallocate( $dark, 0, 0, 0 ) );
    imagecopymerge( $canvas, $dark, 0, 0, 0, 0, $new_w, $new_h, 12 );
    imagedestroy( $dark );

    $text    = strtoupper( trim( (string) $opts['text'] ) );
    if ( '' === $text ) {
        $text = strtoupper( get_bloginfo( 'name' ) );
    }
    $text   .= '  ·  PREVIEW';
    $opacity = max( 0, min( 100, (int) $opts['opacity'] ) );
    $alpha   = (int) round( 127 - ( $opacity / 100 * 110 ) ); // 127 = transparente, 0 = opaco
    $font    = dp_watermark_font_path();

    if ( $font ) {
        dp_watermark_draw_ttf( $canvas, $new_w, $new_h, $text, $alpha, (float) $opts['angle'], $font );
    } else {
        dp_watermark_draw_bitmap( $canvas, $new_w, $new_h, $text, $alpha );
    }

    // Guardar como JPEG.
    $store = dp_watermark_storage();
    $slug  = sanitize_title( $slug ? $slug : 'wm-' . wp_generate_password( 8, false ) );
    $path  = trailingslashit( $store['dir'] ) . $slug . '.jpg';
    $url   = trailingslashit( $store['url'] ) . $slug . '.jpg';

    $ok = imagejpeg( $canvas, $path, (int) $opts['jpeg_q'] );
    imagedestroy( $canvas );

    if ( ! $ok ) {
        return new WP_Error( 'write_fail', __( 'No se pudo escribir el archivo de preview. Revisá permisos de la carpeta de uploads.', 'studio-dark-portfolio' ) );
    }

    return array( 'path' => $path, 'url' => $url );
}

/**
 * Dibuja el texto tileado y rotado usando una fuente TrueType.
 */
function dp_watermark_draw_ttf( $canvas, $w, $h, $text, $alpha, $angle, $font ) {
    $font_size = max( 14, (int) round( $w / 38 ) );
    $white     = imagecolorallocatealpha( $canvas, 255, 255, 255, $alpha );
    $shadow    = imagecolorallocatealpha( $canvas, 0, 0, 0, min( 127, $alpha + 20 ) );

    // Medir el texto para calcular el paso del mosaico.
    $box      = imagettfbbox( $font_size, $angle, $font, $text );
    $text_w   = abs( $box[2] - $box[0] );
    $text_h   = abs( $box[7] - $box[1] );
    $step_x   = max( 180, $text_w + 120 );
    $step_y   = max( 110, $text_h + 90 );

    for ( $y = 0; $y < $h + $step_y; $y += $step_y ) {
        $offset = ( ( $y / $step_y ) % 2 === 0 ) ? 0 : (int) round( $step_x / 2 );
        for ( $x = -$step_x; $x < $w + $step_x; $x += $step_x ) {
            imagettftext( $canvas, $font_size, $angle, $x + $offset + 1, $y + 1, $shadow, $font, $text );
            imagettftext( $canvas, $font_size, $angle, $x + $offset, $y, $white, $font, $text );
        }
    }
}

/**
 * Fallback sin TrueType: texto bitmap tileado (horizontal) usando la fuente
 * interna de GD. Menos estético pero garantiza protección en cualquier server.
 */
function dp_watermark_draw_bitmap( $canvas, $w, $h, $text, $alpha ) {
    $gd_font = 5; // la más grande incorporada
    $white   = imagecolorallocatealpha( $canvas, 255, 255, 255, $alpha );
    $shadow  = imagecolorallocatealpha( $canvas, 0, 0, 0, min( 127, $alpha + 20 ) );

    $char_w = imagefontwidth( $gd_font );
    $char_h = imagefontheight( $gd_font );
    $text_w = $char_w * strlen( $text );
    $step_x = $text_w + 90;
    $step_y = $char_h + 70;

    for ( $y = 0; $y < $h; $y += $step_y ) {
        $offset = ( ( $y / $step_y ) % 2 === 0 ) ? 0 : (int) round( $step_x / 2 );
        for ( $x = -$step_x; $x < $w + $step_x; $x += $step_x ) {
            imagestring( $canvas, $gd_font, $x + $offset + 1, $y + 1, $text, $shadow );
            imagestring( $canvas, $gd_font, $x + $offset, $y, $text, $white );
        }
    }
}
