<?php

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> TABLA DE CONTENIDOS
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> Instalación del tema
> Plugins
> ACF Pro
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
| - Web
|
*/

// Panel de administración
// =============================================================================
require_once get_stylesheet_directory() . '/inc/aPanel.php';

// Web
// =============================================================================
require_once get_stylesheet_directory() . '/inc/web.php';
require_once get_stylesheet_directory() . '/inc/webLogin.php';
require_once get_stylesheet_directory() . '/inc/webNavigation.php';
