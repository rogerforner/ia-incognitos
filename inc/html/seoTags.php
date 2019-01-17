<?php

/*
| ------------------------------------------------------------------------------
| Meta etiquetas
| ------------------------------------------------------------------------------
| - Meta Tags & Open Graph
|
*/

function openGraph() {
	global $post;
	
	$codigoIdioma   = get_bloginfo('language');
	$nombreSitioWeb = get_bloginfo('name');
	$autor          = get_author_name($post->post_author);

	// Obtener el Título, la descripción y la URL canónica.
	// =========================================================================
	if (is_home() || is_front_page() || is_archive() || is_category() ||
		is_tag() || is_tax() || is_search() || is_404() || is_date()) {
        $titulo      = $nombreSitioWeb;
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

	// Obtener la imagen.
	// =========================================================================
	$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
	$imagen        = '';

	if (get_field('og_imagen', $post->ID)) {
		$imagen = get_field('og_imagen', $post->ID);
	} elseif ($thumbnail_src[0]) {
		$imagen = $thumbnail_src[0];
	} else {
		$imagen = get_site_icon_url();
	}

	// Obtener la taxonmía que represente las etiquetas.
	// =========================================================================
	if (is_singular('post')) {
		$etiquetas = get_the_terms($post->ID, 'post_tag');
	} elseif (is_singular('project')) {
		$etiquetas = get_the_terms($post->ID, 'project_tag');
	}

	// MOSTRAR DATOS
	// =========================================================================
	echo '
	<meta name="web_author" content="Roger Forner Fabre">
	<meta name="copyright" content="'.$nombreSitioWeb.'">
	<meta name="author" content="'.$autor.'">
	<meta name="description" content="'.$descripcion.'">
	';
	$insertarComa = 1;
	if ($etiquetas) {
		echo '<meta name="keywords" content="';
		foreach($etiquetas as $tag) {
			echo $tag->name;
			echo ($insertarComa < count($etiquetas)) ? "," : "";
			$insertarComa++;
		}
		echo '">';
	}

	// Facebook + Twitter
	echo '
	<meta property="og:locale" content="'.$codigoIdioma.'"/>
	<meta property="og:site_name" content="'.$nombreSitioWeb.'"/>
	<meta property="og:title" content="'.$titulo.'"/>
	<meta property="og:url" content="'.$urlCanonica.'"/>
	<meta property="og:type" content="website"/>
	<meta property="og:description" content="'.$descripcion.'"/>
	<meta property="og:image" content="'.$imagen.'" />
	<meta name="twitter:title" content="'.$titulo.'"/>
	<meta name="twitter:url" content="'.$urlCanonica.'"/>
	<meta name="twitter:description" content="'.$descripcion.'"/>
	<meta name="twitter:image:src" content="'.$imagen.'">
	<meta name="twitter:card" content="summary_large_image"/>
	';
}
add_action('wp_head', 'openGraph', 5);