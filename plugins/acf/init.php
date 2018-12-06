<?php

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> TABLA DE CONTENIDOS
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> Path
> Dir
> Permisos
> Instanciar
> 
*/

/*
| ------------------------------------------------------------------------------
| Path
| ------------------------------------------------------------------------------
| Definir la ruta en la que se encuentra el plugin ACF (integrado en el tema).
|
*/
function acfSettingsPath( $path ) {
    $path = get_stylesheet_directory() . '/plugins/acf/advanced-custom-fields-pro/';
    return $path;
}
add_filter('acf/settings/path', 'acfSettingsPath');

/*
| ------------------------------------------------------------------------------
| Dir
| ------------------------------------------------------------------------------
| Definir el directorio en el que se encuentra el plugin ACF Pro (integrado en
| el tema).
|
*/
function acfSettingsDir( $dir ) {
    $dir = get_stylesheet_directory_uri() . '/plugins/acf/advanced-custom-fields-pro/';
    return $dir;
}
add_filter('acf/settings/dir', 'acfSettingsDir');

/*
| ------------------------------------------------------------------------------
| Permisos
| ------------------------------------------------------------------------------
| Ocultar el menú de ACF según los permisos del/la usuario/ria.
|
*/

function acfMenuCapability($show) {
    return current_user_can('manage_acf');
}
add_filter('acf/settings/show_admin', 'acfMenuCapability');

/*
| ------------------------------------------------------------------------------
| Localización
| ------------------------------------------------------------------------------
| Insertar funciones de localización en la exportación.
|
*/

function custom_acf_settings_localization($localization){
    return true;
}
add_filter('acf/settings/l10n', 'custom_acf_settings_localization');

function custom_acf_settings_textdomain($domain){
    return 'incognitos';
}
add_filter('acf/settings/l10n_textdomain', 'custom_acf_settings_textdomain');

/*
| ------------------------------------------------------------------------------
| Instanciar
| ------------------------------------------------------------------------------
| Instanciar ACF.
|
*/

include_once(get_stylesheet_directory() . '/plugins/acf/advanced-custom-fields-pro/acf.php');