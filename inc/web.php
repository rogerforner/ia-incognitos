<?php

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> TABLA DE CONTENIDOS
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> Limpiar el <head>
> The Open Graph protocol
> 
*/

/*
| ------------------------------------------------------------------------------
| Limpiar el <head>
| ------------------------------------------------------------------------------
| Quitar las meta etiquetas propias de WordPress que puedan dar demasiada info,
| por seguridad.
| - Versión de WP
| - wlwmanifest
| - Query strings
|
*/

// Versión de WP
// Por defecto se inserta la versión.
// =============================================================================
function webQuitarMetaVersion() {
    $nombreSitio = get_bloginfo('name');
	return '<meta name="generator" content="'. $nombreSitio .'" />';
}
add_filter('the_generator', 'webQuitarMetaVersion');

// wlwmanifest
// Utilizado para publicar con el editor "Windows Live Writer".
// =============================================================================
remove_action( 'wp_head', 'wlwmanifest_link');

// Query strings
// De "una-url/de-un-recurso?ver=4.4.2" a "una-url/de-un-recurso".
// =============================================================================
function webQuitarQueryString($src){ 
	$parts = explode('?ver', $src); 
	return $parts[0]; 
} 
add_filter('script_loader_src', 'webQuitarQueryString', 15, 1); 
add_filter('style_loader_src', 'webQuitarQueryString', 15, 1);

/*
| ------------------------------------------------------------------------------
| The Open Graph protocol
| ------------------------------------------------------------------------------
| - Schema.org
| - Open Graph Meta Tags
|
*/

// Schema.org
// =============================================================================
function openGraphHtmlOut() {
	if( is_single() ) {
		$cpt = "Article";

	} elseif ( is_author() ) {
		$cpt = 'Person';

	} elseif ( is_attachment() ) {
		$cpt = 'MediaObject';

	} elseif ( is_search() || is_category() || is_tag() || is_tax() || is_date() ) {
		$cpt = 'SearchResultsPage';

	} elseif ( is_archive() ) {
		$cpt = 'ItemList';

	}  else {
		$cpt = 'WebPage';
	}

	$codigoIdioma = get_bloginfo('language');

    return 'lang="'.$codigoIdioma.'" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" itemscope itemtype="http://schema.org/'.$cpt.'"';
}
add_filter('language_attributes', 'openGraphHtmlOut');

// Open Graph Meta Tags
// =============================================================================
function openGraph() {
	global $post;

	$codigoIdioma   = get_bloginfo('language');
	$nombreSitioWeb = get_bloginfo('name');

	// Título, descripción y URL canónica.
	// =========================================================================
	if (is_home() || is_front_page() || is_404() || is_archive() || is_category() || is_tag() || is_tax() || is_date()) {
        $titulo      = get_bloginfo('name');
        $descripcion = get_bloginfo('description');
		$urlCanonica = get_bloginfo('url');

    } else {
		$titulo = get_the_title();

		if (has_excerpt($post->ID)) {
			$descripcion = get_the_excerpt();
		} else {
			$descripcion = get_bloginfo('description');
		}

		$urlCanonica = get_permalink();
	}

	// Imagen.
	// =========================================================================
	$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
	$imagen        = $thumbnail_src[0];
	
	// Meta Etiquetas Open Graph.
	// =========================================================================
	//MOSTRAR
	echo '
	<!-- Facebook Open Graph -->
	<meta property="og:locale" content="'.$codigoIdioma.'"/>
	<meta property="og:site_name" content="'.$nombreSitioWeb.'"/>
	<meta property="og:title" content="'.$titulo.'"/>
	<meta property="og:url" content="'.$urlCanonica.'"/>
	<meta property="og:type" content="website"/>
	<meta property="og:description" content="'.$descripcion.'"/>
	<meta property="og:image" content="'.$imagen.'" />
	<!-- Google+ / Schema.org -->
	<meta itemprop="name" content="'.$titulo.'"/>
	<meta itemprop="description" content="'.$descripcion.'"/>
	<meta itemprop="image" content="'.$imagen.'">
	<!-- Twitter Cards -->
	<meta name="twitter:title" content="'.$titulo.'"/>
	<meta name="twitter:url" content="'.$urlCanonica.'"/>
	<meta name="twitter:description" content="'.$descripcion.'"/>
	<meta name="twitter:image:src" content="'.$imagen.'">
	<meta name="twitter:card" content="summary_large_image"/>
	';
}
add_action('wp_head', 'openGraph', 5);