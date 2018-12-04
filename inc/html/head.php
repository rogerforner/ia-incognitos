<?php

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> TABLA DE CONTENIDOS
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> Modificar
> Meta etiquetas
> Feed
> 
*/

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


/*
| ------------------------------------------------------------------------------
| Meta etiquetas
| ------------------------------------------------------------------------------
| - Meta Tags & Open Graph
|
*/

// Meta Tags & Open Graph
// =============================================================================
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
	$imagen        = $thumbnail_src[0];

	// Obtener la taxonmía que represente las etiquetas.
	// =========================================================================
	if (is_singular("post")) {
		$etiquetas = get_the_terms($post->ID, "post_tag");
	} elseif (is_singular("project")) {
		$etiquetas = get_the_terms($post->ID, "project_tag");
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

/*
| ------------------------------------------------------------------------------
| JSON-LD
| ------------------------------------------------------------------------------
| Estructura de datos. Utilizamos campos ACF de "Info. Sitio".
| - WebSite
| - Tipo
| - BlogPosting
|
*/

// WebSite
// =============================================================================
function jsonldWebSite() {
	$nombreSitio    = "";
	$nombreSitioAlt = "";
	$urlSitio       = home_url('/');

	$datos = get_field('datos', 'option');

	if ($datos['datosNombre']) {
		$nombreSitio = $datos['datosNombre'];
	} else {
		$nombreSitio = get_bloginfo('name');
	}

	if ($datos['datosNombreAlternativo']) {
		$nombreSitioAlt = '"alternateName": "'.addslashes($datos['datosNombreAlternativo']).'",';
	} else {
		$nombreSitioAlt = "";
	}

	$redes  = "";

	echo '<script type="application/ld+json">{
        "@context": "http://schema.org/",
        "@type": "WebSite",
        "@id": "'.$urlSitio.'#website",
        "url": "'.$urlSitio.'",
        "name": "'.addslashes($nombreSitio).'",
        '.$nombreSitioAlt.'
        "potentialAction": {
            "@type": "SearchAction",
            "target": "'.$urlSitio.'?s={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }</script>';
}
add_action('wp_head', 'jsonldWebSite', 5);

// Tipo
// -------------------------------------------------------------------------====
function jsonldTipo() {
	$schemaType  = "Organization";
	$nombreSitio = "";
	$urlSitio    = home_url('/');
	$logoSitio   = "";

	$datos = get_field('datos', 'option');

	if ($datos['datosSchema']) {
		$schemaType = $datos['datosSchema'];
	} else {
		$schemaType  = "Organization";
	}

	if ($datos['datosNombre']) {
		$nombreSitio = $datos['datosNombre'];
	} else {
		$nombreSitio = get_bloginfo('name');
	}

	if ($datos['datosLogo']) {
		$logoSitio = '"logo": "'.$datos['datosLogo'].'",';
	} else {
		$logoSitio = "";
	}

	// 500px
    // -------------------------------------------------------------------------
    $url500px = get_field('500px', 'option');
    if (get_field('500px', 'option')) {
        $redes .= '"'.$url500px.'",';
    }

    // Bitbucket
    // -------------------------------------------------------------------------
    $urlBitbucket = get_field('bitbucket', 'option');
    if (get_field('bitbucket', 'option')) {
        $redes .= '"'.$urlBitbucket.'",';
    }

    // DeviantArt
    // -------------------------------------------------------------------------
    $urlDeviantArt = get_field('deviantart', 'option');
    if (get_field('deviantart', 'option')) {
        $redes .= '"'.$urlDeviantArt.'",';
    }

    // Facebook
    // -------------------------------------------------------------------------
    $urlFacebook = get_field('facebook', 'option');
    if (get_field('facebook', 'option')) {
        $redes .= '"'.$urlFacebook.'",';
    }

    // Flickr
    // -------------------------------------------------------------------------
    $urlFlickr = get_field('flickr', 'option');
    if (get_field('flickr', 'option')) {
        $redes .= '"'.$urlFlickr.'",';
    }

    // GitHub
    // -------------------------------------------------------------------------
    $urlGitHub = get_field('gitHub', 'option');
    if (get_field('gitHub', 'option')) {
        $redes .= '"'.$urlGitHub.'",';
    }

    // GitLab
    // -------------------------------------------------------------------------
    $urlGitLab = get_field('gitLab', 'option');
    if (get_field('gitLab', 'option')) {
        $redes .= '"'.$urlGitLab.'",';
    }

    // Google Plus
    // -------------------------------------------------------------------------
    $urlGooglePlus = get_field('googlePlus', 'option');
    if (get_field('googlePlus', 'option')) {
        $redes .= '"'.$urlGooglePlus.'",';
    }

    // Instagram
    // -------------------------------------------------------------------------
    $urlInstagram = get_field('instagram', 'option');
    if (get_field('instagram', 'option')) {
        $redes .= '"'.$urlInstagram.'",';
    }

    // Kikstarter
    // -------------------------------------------------------------------------
    $urlKickstarter = get_field('kickstarter', 'option');
    if (get_field('kickstarter', 'option')) {
        $redes .= '"'.$urlKickstarter.'",';
    }

    // Linkedin
    // -------------------------------------------------------------------------
    $urlLinkedin = get_field('linkedin', 'option');
    if (get_field('linkedin', 'option')) {
        $redes .= '"'.$urlLinkedin.'",';
    }

    // Meetup
    // -------------------------------------------------------------------------
    $urlMeetup = get_field('meetup', 'option');
    if (get_field('meetup', 'option')) {
        $redes .= '"'.$urlMeetup.'",';
    }

    // Pinterest
    // -------------------------------------------------------------------------
    $urlPinterest = get_field('pinterest', 'option');
    if (get_field('pinterest', 'option')) {
        $redes .= '"'.$urlPinterest.'",';
    }

    // RSS
    // -------------------------------------------------------------------------
    $urlRss = get_field('rss', 'option');
    if (get_field('rss', 'option')) {
        $redes .= '"'.$urlRss.'",';
    }

    // Sina Weibo
    // -------------------------------------------------------------------------
    $urlSinaWeibo = get_field('sinaWeibo', 'option');
    if (get_field('sinaWeibo', 'option')) {
        $redes .= '"'.$urlSinaWeibo.'",';
    }

    // Snapchat
    // -------------------------------------------------------------------------
    $urlSnapchat = get_field('snapchat', 'option');
    if (get_field('snapchat', 'option')) {
        $redes .= '"'.$urlSnapchat.'",';
    }

    // SoundCloud
    // -------------------------------------------------------------------------
    $urlSoundCloud = get_field('soundcloud', 'option');
    if (get_field('soundcloud', 'option')) {
        $redes .= '"'.$urlSoundCloud.'",';
    }

    // Spotify
    // -------------------------------------------------------------------------
    $urlSpotify = get_field('spotify', 'option');
    if (get_field('spotify', 'option')) {
        $redes .= '"'.$urlSpotify.'",';
    }

    // Steam
    // -------------------------------------------------------------------------
    $urlSteam = get_field('steam', 'option');
    if (get_field('steam', 'option')) {
        $redes .= '"'.$urlSteam.'",';
    }

    // TripAdvisor
    // -------------------------------------------------------------------------
    $urlTripAdvisor = get_field('tripAdvisor', 'option');
    if (get_field('tripAdvisor', 'option')) {
        $redes .= '"'.$urlTripAdvisor.'",';
    }

    // Twitch
    // -------------------------------------------------------------------------
    $urlTwitch = get_field('twitch', 'option');
    if (get_field('twitch', 'option')) {
        $redes .= '"'.$urlTwitch.'",';
    }

    // Twitter
    // -------------------------------------------------------------------------
    $urlTwitter = get_field('twitter', 'option');
    if (get_field('twitter', 'option')) {
        $redes .= '"'.$urlTwitter.'",';
    }

    // Viadeo
    // -------------------------------------------------------------------------
    $urlViadeo = get_field('viadeo', 'option');
    if (get_field('viadeo', 'option')) {
        $redes .= '"'.$urlViadeo.'",';
    }

    // Vimeo
    // -------------------------------------------------------------------------
    $urlVimeo = get_field('vimeo', 'option');
    if (get_field('vimeo', 'option')) {
        $redes .= '"'.$urlVimeo.'",';
    }

    // vkontakte
    // -------------------------------------------------------------------------
    $urlVkontakte = get_field('vkontakte', 'option');
    if (get_field('vkontakte', 'option')) {
        $redes .= '"'.$urlVkontakte.'",';
    }

    // Xing
    // -------------------------------------------------------------------------
    $urlXing = get_field('xing', 'option');
    if (get_field('xing', 'option')) {
        $redes .= '"'.$urlXing.'",';
    }

    // YouTube
    // -------------------------------------------------------------------------
    $urlYouTube = get_field('youtube', 'option');
    if (get_field('youtube', 'option')) {
        $redes .= '"'.$urlYouTube.'",';
	}
	
	if (
        get_field('500px', 'option') ||
        get_field('bitbucket', 'option') ||
        get_field('deviantart', 'option') ||
        get_field('facebook', 'option') ||
        get_field('flickr', 'option') ||
        get_field('gitHub', 'option') ||
        get_field('gitLab', 'option') ||
        get_field('googlePlus', 'option') ||
        get_field('instagram', 'option') ||
        get_field('kickstarter', 'option') ||
        get_field('linkedin', 'option') ||
        get_field('meetup', 'option') ||
        get_field('pinterest', 'option') ||
        get_field('rss', 'option') ||
        get_field('sinaWeibo', 'option') ||
        get_field('snapchat', 'option') ||
        get_field('soundcloud', 'option') ||
        get_field('spotify', 'option') ||
        get_field('steam', 'option') ||
        get_field('tripAdvisor', 'option') ||
        get_field('twitch', 'option') ||
        get_field('twitter', 'option') ||
        get_field('viadeo', 'option') ||
        get_field('vimeo', 'option') ||
        get_field('vkontakte', 'option') ||
        get_field('xing', 'option') ||
        get_field('youtube', 'option')
    ) {
        $sameAs = '"sameAs": ['.rtrim($redes, ',').']';
    }

	// SALIDA
    // -------------------------------------------------------------------------
	echo '<script type="application/ld+json">{
        "@context": "http://schema.org/",
        "@type": "'.$schemaType.'",
        "@id": "'.$urlSitio.'#'.strtolower($schemaType).'",
        "url": "'.$urlSitio.'",
        "name": "'.addslashes($nombreSitio).'",
        '.$logoSitio.'
        '.$sameAs.'
    }</script>';
}
add_action('wp_head', 'jsonldTipo', 5);

// BlogPosting
// =============================================================================
function jsonldBlogPosting() {
	global $post;

	$autor           = get_author_name($post->post_author);
	$descripcion     = "";
	$publishedDate   = get_the_date('Y-m-d');
	$modifiedDate    = get_the_modified_date('Y-m-d');
	$imagePostObj    = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
	$imagePostURL    = $imagePostObj[0];
	$imagePostWidth  = $imagePostObj[1];
	$imagePostHeight = $imagePostObj[2];
	$imagePostCode   = "";

	if ($imagePostObj) {
		$imagePostCode = '"image": {"@type": "ImageObject","url": "'.$imagePostURL.'","width": '.$imagePostWidth.',"height": '.$imagePostHeight.'},';
	} else {
		$imagePostCode = "";
	}

	$schemaType  = "Organization";
	$nombreSitio = "";
	$urlSitio    = home_url('/');
	$logoSitio   = "";

	if (has_excerpt($post->ID)) {
		$descripcion = get_the_excerpt();
	} else {
		$descripcion = get_bloginfo('description');
	}

	$datos = get_field('datos', 'option');

	if ($datos['datosSchema']) {
		$schemaType = $datos['datosSchema'];
	} else {
		$schemaType  = "Organization";
	}

	if ($datos['datosNombre']) {
		$nombreSitio = $datos['datosNombre'];
	} else {
		$nombreSitio = get_bloginfo('name');
	}

	if ($datos['datosLogo']) {
		$logoSitio = '"logo": "'.$datos['datosLogo'].'",';
	} else {
		$logoSitio = "";
	}

	if (is_singular("post") || is_singular("project")) {
		echo '<script type="application/ld+json">{
            "@context": "http://schema.org",
            "@type": "BlogPosting",
            "@id": "'.$urlSitio.'#blogposting",
            "headline": "'.addslashes($descripcion).'",
            '.$imagePostCode.'
            "datePublished": "'.$publishedDate.'",
            "dateModified": "'.$modifiedDate.'",
            "author": {
                "@type": "Person",
                "name": "'.addslashes($autor).'"
            },
            "publisher": {
                "@type": "'.$schemaType.'",
                "name": "'.addslashes($nombreSitio).'",
                '.$logoSitio.'
            }
        }</script>';
	}
}
add_action('wp_head', 'jsonldBlogPosting', 5);


/*
| ------------------------------------------------------------------------------
| Feed
| ------------------------------------------------------------------------------
| - Proyectos
|
*/

function projectFeed() {
	$posts          = array('project');
	$nombreSitioWeb = get_bloginfo('name');
	
    foreach($posts as $post) {
		$feed = get_post_type_archive_feed_link($post);
		
        if ($feed === '' || !is_string($feed)) {
            $feed = get_bloginfo('rss2_url')."?post_type=$post";
		}
		
        echo '<link rel="alternate" type="application/rss+xml" title="'.$nombreSitioWeb.' &raquo; Project Feed" href="'.$feed.'" />';
    }
}
add_action('wp_head', 'projectFeed', 4);