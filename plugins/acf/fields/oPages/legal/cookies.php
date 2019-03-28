<?php

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> TABLA DE CONTENIDOS
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> Página de la "Política de Cookies"
> Shortcodes
> 
*/

/*
| ------------------------------------------------------------------------------
| Página de la "Política de Cookies"
| ------------------------------------------------------------------------------
| Todos los campos que forman la página de la Política de Cookies.
|
*/
require_once get_stylesheet_directory() . '/plugins/acf/fields/oPages/legal/cookiesPagina.php';

/*
| ------------------------------------------------------------------------------
| Shortcodes
| ------------------------------------------------------------------------------
| Shortcodes utilizados para mostrar los datos.
| - Aviso
| - Información
| - Cookies
|
*/

/**
 * Aviso.
 * Utilizado para mostrar el aviso de las cookies en el sitio web.
 * Se utiliza la libreria JavaScript de https://cookieconsent.insites.com/
 * 
 * @return string Meta etiquetas en el <head>.
 */
function cookiesAvisoWeb() {
	$link          = get_field('cookiesPopupPagEnlace', 'option');
	$linkTxt       = get_field('cookiesPopupPagTxt', 'option');
	$contenido     = get_field('cookiesPopupCont', 'option');
	$btnTxt        = get_field('cookiesPopupBtnTxt', 'option');
	$btnColorTxt   = get_field('cookiesPopupBtnColorTxt', 'option');
	$btnColor      = get_field('cookiesPopupBtnColor', 'option');
	$popupColor    = get_field('cookiesPopupColor', 'option');
	$popupColorTxt = get_field('cookiesPopupColorTxt', 'option');

    echo '
    <style>.cc-banner.cc-bottom {z-index:999999;}</style>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>

    <script>
    window.addEventListener("load", function() {
    window.cookieconsent.initialise({
      "palette": {
        "popup": {
          "background": "'. $popupColor .'",
          "text": "'. $popupColorTxt .'"
        },
        "button": {
          "background": "'. $btnColor .'",
          "text": "'. $btnColorTxt .'"
        }
      },
      "content": {
        "message": "'. $contenido .'",
        "dismiss": "'. $btnTxt .'",
        "link": "'. $linkTxt .'",
        "href": "'. $link .'"
      }
    })});
    </script>
    ';

}
add_action('wp_head', 'cookiesAvisoWeb');

/**
 * Información (contenido).
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @return string [legal_cookiesInfo]
 */
function shortCookiesInfo() {
    return get_field('cookiesInfo', 'option');
}
add_shortcode('legal_cookiesInfo', 'shortCookiesInfo');

/**
 * Cookies.
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @var string $cookies		Campo "Cookies".
 * @var string $tipo		Campo "Tipo".
 * @var string $duracion	Campo "Duración".
 * @var string $desc		Campo "Descripción".
 * @var string $salida		Texto que devolverá el Shortcode.
 * 
 * @return string [legal_cookiesUtilizadas]
 */
function shortCookiesUtilizadas() {
	$salida = "";

	// Textos predeterminados, preparados para ser traducidos.
	$cookieTxt   = __('Cookie', 'incognitos');
	$tipoTxt     = __('Tipo', 'incognitos');
	$duracionTxt = __('Duración', 'incognitos');
	$descTxt     = __('Descripción', 'incognitos');

	// Campo Repeater (ACF).
	if (have_rows('cookiesUtilizadas', 'option')) {
		// Inicio de la tabla...
    $salida .= "
    <div style='overflow-x:auto;'>
			<table>
				<tr>
					<th>$cookieTxt</th>
					<th>$tipoTxt</th>
					<th>$duracionTxt</th>
					<th>$descTxt</th>
				</tr>
		";

		while (have_rows('cookiesUtilizadas', 'option')) {
			the_row();

			// Campos ACF.
			$cookies  = get_sub_field('cookie');
			$tipo     = get_sub_field('tipo');
			$duracion = get_sub_field('duracion');
			$desc     = get_sub_field('descripcion');

			$salida .= "
				<tr>
					<td>$cookies</td>
					<td>$tipo</td>
					<td>$duracion</td>
					<td>$desc</td>
				</tr>
			";
		}

		// Final de la tabla.
    $salida .= "
      </table>
    </div>
    ";
	}

	return $salida;
}
add_shortcode('legal_cookiesUtilizadas', 'shortCookiesUtilizadas');
