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
|   - Informar por la dependencia de ACF Pro.
|
*/

// ACF Pro
// =============================================================================
require_once get_stylesheet_directory() . '/plugins/acf/init.php';
require_once get_stylesheet_directory() . '/plugins/acf/fields/oPages.php';

/*
| ------------------------------------------------------------------------------
| Configuración del tema
| ------------------------------------------------------------------------------
| Código utilizado para personalizar WordPress.
| - Panel de administración
| - HTML
| - Shortcodes
|
*/

// Panel de administración
// =============================================================================
require_once get_stylesheet_directory() . '/inc/aPanel.php';

// HTML
// =============================================================================
require_once get_stylesheet_directory() . '/inc/html/head.php';
require_once get_stylesheet_directory() . '/inc/html/login.php';

// Shortcodes
// =============================================================================
require_once get_stylesheet_directory() . '/inc/shortcodes/menusNav.php';
