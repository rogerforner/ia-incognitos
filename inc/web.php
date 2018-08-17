<?php

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

/*
| ------------------------------------------------------------------------------
| Minificar el HTML.
| ------------------------------------------------------------------------------
| De https://buff.ly/2Bjr3lL
|
*/

class WP_HTML_Compression {
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;
 
    protected $html;
    public function __construct($html) {
      if (!empty($html)) {
		    $this->parseHTML($html);
	    }
    }
    public function __toString() {
	    return $this->html;
    }
    protected function minifyHTML($html) {
	    $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
	    preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
	    $overriding = false;
	    $raw_tag = false;
	    $html = '';
	    foreach ($matches as $token) {
		    $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
		    $content = $token[0];
		    if (is_null($tag)) {
			    if ( !empty($token['script']) ) {
				    $strip = $this->compress_js;
			    }
			    else if ( !empty($token['style']) ) {
				    $strip = $this->compress_css;
			    }
			    else if ($content == '<!--wp-html-compression no compression-->') {
				    $overriding = !$overriding;
				    continue;
			    }
			    else if ($this->remove_comments) {
				    if (!$overriding && $raw_tag != 'textarea') {
					    $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
				    }
			    }
		    }
		    else {
			    if ($tag == 'pre' || $tag == 'textarea') {
				    $raw_tag = $tag;
			    }
			    else if ($tag == '/pre' || $tag == '/textarea') {
				    $raw_tag = false;
			    }
			    else {
				    if ($raw_tag || $overriding) {
					    $strip = false;
				    }
				    else {
					    $strip = true;
					    $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
					    $content = str_replace(' />', '/>', $content);
				    }
			    }
		    }
		    if ($strip) {
			    $content = $this->removeWhiteSpace($content);
		    }
		    $html .= $content;
	    }
	    return $html;
    }
    public function parseHTML($html) {
	    $this->html = $this->minifyHTML($html);
    }
    protected function removeWhiteSpace($str) {
	    $str = str_replace("\t", ' ', $str);
	    $str = str_replace("\n",  '', $str);
	    $str = str_replace("\r",  '', $str);
	    while (stristr($str, '  ')) {
		    $str = str_replace('  ', ' ', $str);
	    }
	    return $str;
    }
}
function wp_html_compression_finish($html) {
    return new WP_HTML_Compression($html);
}
function wp_html_compression_start() {
    ob_start('wp_html_compression_finish');
}
add_action('get_header', 'wp_html_compression_start');