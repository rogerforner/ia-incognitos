<?php

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> TABLA DE CONTENIDOS
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> Instalación del tema
> Plugins
> Configuración del tema
>
*/

/*
| ------------------------------------------------------------------------------
| Instalación del tema
| ------------------------------------------------------------------------------
| Referenciar al tema principal (padre) Divi y definición del directorio de
| idiomas.
|
*/

require_once get_stylesheet_directory() . '/inc/init.php';

/*
| ------------------------------------------------------------------------------
| Plugins
| ------------------------------------------------------------------------------
| Código escrito para ampliar las funcionalidades del tema pero que requiere de
| plugins para su correcto funcionamiento.
| Los plugins utilizados son:
| - ACF Pro
| -- Informar por la dependencia de ACF Pro.
|
*/

// ACF Pro
// =============================================================================
require_once get_stylesheet_directory() . '/plugins/acf/init.php';
require_once get_stylesheet_directory() . '/plugins/acf/fields/oPages.php';
require_once get_stylesheet_directory() . '/plugins/acf/localization/init.php';

/*
| ------------------------------------------------------------------------------
| Configuración del tema
| ------------------------------------------------------------------------------
| Código utilizado para personalizar WordPress.
| - Páginas
| -- Panel de administración
| -- Login
| - HTML
| -- WordPress (limpiar)
| -- Feed
| -- SEO
| - Imágenes
| -- Etiquetas
| -- Categorías
| - Shortcodes
|
*/

// Páginas
// =============================================================================
require_once get_stylesheet_directory() . '/inc/pages/aPanel.php';
require_once get_stylesheet_directory() . '/inc/pages/login.php';

// HTML
// =============================================================================
require_once get_stylesheet_directory() . '/inc/html/wordpress.php';
require_once get_stylesheet_directory() . '/inc/html/feed.php';
if (!class_exists('WPSEO_Options')) {
    require_once get_stylesheet_directory() . '/inc/html/seoTags.php';
    require_once get_stylesheet_directory() . '/inc/html/seoJson.php';
}

// Imágenes
// =============================================================================
require_once get_stylesheet_directory() . '/inc/images/tags.php';
require_once get_stylesheet_directory() . '/inc/images/categories.php';

// Shortcodes
// =============================================================================
require_once get_stylesheet_directory() . '/inc/shortcodes/menusNav.php';
