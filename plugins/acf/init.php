<?php

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
| Instanciar
| ------------------------------------------------------------------------------
| Instanciar ACF.
|
*/
include_once(get_stylesheet_directory() . '/plugins/acf/advanced-custom-fields-pro/acf.php');