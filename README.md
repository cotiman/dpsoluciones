# DP Producciones — Tema WordPress

Tema a medida (portafolio audiovisual + tienda de fotos) con backoffice propio.

## Qué incluye el backoffice

Menú **DP Backoffice** en el panel de WordPress (barra lateral), con:

- **Portfolio (YouTube).** Cargá videos y shorts pegando el enlace de YouTube.
  El tema detecta el ID, la miniatura y arma el reproductor (16:9 para video,
  9:16 para short). Se administra en **Portfolio → Añadir nuevo**.
- **Tienda de fotos (WooCommerce).** Cada foto es un producto. La imagen
  destacada se convierte automáticamente en un preview con **marca de agua
  incrustada**; el archivo original (sin marca) se entrega como descarga segura
  solo después del pago.
- **Mercado Pago.** El cobro se procesa con el plugin oficial de Mercado Pago
  para WooCommerce (país: Uruguay, moneda UYU).
- **Ajustes de marca de agua.** Texto y opacidad configurables.

## Puesta a punto (una sola vez)

1. **WooCommerce**: instalá y activá *WooCommerce*.
2. **Mercado Pago**: instalá *Mercado Pago payments for WooCommerce*, activalo y
   cargá tus credenciales (Uruguay). En **WooCommerce → Ajustes → Pagos**
   habilitá Mercado Pago.
3. **Moneda**: al activar el tema se setea **UYU** automáticamente. Verificalo en
   **WooCommerce → Ajustes → General** (símbolo $U, 0 decimales).
4. **GD**: el motor de marca de agua usa la extensión **GD** de PHP (activa por
   defecto en Hostinger). El panel DP Backoffice avisa si falta.

## Cómo cargar contenido

### Un video o short del portfolio
1. **Portfolio → Añadir nuevo**.
2. Título + (opcional) extracto como bajada.
3. En el panel **🎬 YouTube**: pegá el enlace y elegí *Video* o *Short*.
4. Publicá. Aparece solo en la home, sección Portafolio.

### Una foto a la venta
1. **Productos → Añadir nuevo** (o DP Backoffice → Administrar Fotos).
2. Asigná la categoría **Fotos**.
3. **Imagen destacada** = la foto (se usa para el preview con marca de agua).
4. Pestaña **Avanzado/General**: marcá **Virtual** y **Descargable**, y en
   *Archivos descargables* subí el **archivo original** (sin marca) que recibirá
   el cliente.
5. Pestaña **Datos de Foto (DP)**: orientación y resolución (para los filtros).
6. Precio en UYU. Publicá.

El preview con marca de agua se genera al guardar. Si cambiás la opacidad/texto
global, editá el producto, marcá *Regenerar marca de agua* y guardá.

## Notas técnicas (para el desarrollador)

- **Tailwind**: el markup usa utilidades de Tailwind. Para no depender de un
  build en el hosting, se carga el runtime *Play CDN* (`cdn.tailwindcss.com`) con
  config inline en `functions.php` (`studio_print_tailwind_runtime`). Para
  producción de alto tráfico conviene reemplazarlo por un CSS compilado con la
  CLI de Tailwind escaneando los `.php` del tema, y encolarlo en lugar del CDN.
- **Fuente del watermark**: `inc/watermark.php` busca una fuente TrueType en
  `assets/fonts/watermark.ttf` o en rutas del sistema (DejaVu/Liberation). Si no
  encuentra ninguna, usa la fuente bitmap de GD (menos estética pero funcional).
  Para un resultado óptimo, subí una `watermark.ttf` a `assets/fonts/`.
- **Módulos** en `inc/`: `watermark.php`, `portfolio-admin.php`, `photo-store.php`,
  `frontend-render.php`, `backoffice.php`.
- **Previews** con marca de agua se guardan en `wp-content/uploads/dp-watermarks/`.
