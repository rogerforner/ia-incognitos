<?php

/*
| ------------------------------------------------------------------------------
| Modificar
| ------------------------------------------------------------------------------
| - Versión de WP
| - Query strings
|
*/

// Versión de WP
// Por defecto se inserta la versión.
// =============================================================================
function webQuitarMetaVersion() {
    $miTema = wp_get_theme();
	return '<meta name="generator" content="'. $miTema->get("Name") .' v'. $miTema->get("Version") .', by Roger Forner Fabre" />';
}
add_filter('the_generator', 'webQuitarMetaVersion');

// Query strings
// De "una-url/de-un-recurso?ver=4.4.2" a "una-url/de-un-recurso".
// =============================================================================
function webQuitarQueryString($src){ 
	$parts = explode('?ver', $src); 
	return $parts[0]; 
} 
add_filter('script_loader_src', 'webQuitarQueryString', 15, 1); 
add_filter('style_loader_src', 'webQuitarQueryString', 15, 1);