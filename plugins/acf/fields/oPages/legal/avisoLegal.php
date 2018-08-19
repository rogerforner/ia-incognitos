<?php

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> TABLA DE CONTENIDOS
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> Página del "Aviso legal"
> Shortcodes
> 
*/

/*
| ------------------------------------------------------------------------------
| Página del "Aviso legal"
| ------------------------------------------------------------------------------
| Todos los campos que forman la página del aviso legal.
|
*/
require_once get_stylesheet_directory() . '/plugins/acf/fields/oPages/legal/avisoLegalPagina.php';

/*
| ------------------------------------------------------------------------------
| Shortcodes
| ------------------------------------------------------------------------------
| Shortcodes utilizados para mostrar los datos.
| - Condiciones generales
| - Ley aplicable y jurisdicción
| - Exclusión de garantías y responsabilidad
| - Contenido responsable
| - Links o hiperenlaces
| - Restricciones del uso del dominio y subdominios
| - Propiedad intelectual e industrial
|
*/

/**
 * Condiciones generales.
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @return string [legal_condicionesGenerales]
 */
function shortCondicionesGenerales() {
    return get_field('condicionesGenerales', 'option');
}
add_shortcode('legal_condicionesGenerales', 'shortCondicionesGenerales');

/**
 * Ley aplicable y jurisdicción.
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @return string [legal_leyAplicable]
 */
function shortLeyAplicable() {
    return get_field('leyAplicable', 'option');
}
add_shortcode('legal_leyAplicable', 'shortLeyAplicable');

/**
 * Exclusión de garantías y responsabilidad.
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @return string [legal_responsabilidad]
 */
function shortResponsabilidad() {
    return get_field('responsabilidad', 'option');
}
add_shortcode('legal_responsabilidad', 'shortResponsabilidad');

/**
 * Contenido responsable.
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @return string [legal_contenidoResponsable]
 */
function shortContenidoResponsable() {
    return get_field('contenidoResponsable', 'option');
}
add_shortcode('legal_contenidoResponsable', 'shortContenidoResponsable');

/**
 * Links o hiperenlaces.
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @return string [legal_linksHiperenlaces]
 */
function shortLinksHiperenlaces() {
    return get_field('hiperenlaces', 'option');
}
add_shortcode('legal_linksHiperenlaces', 'shortLinksHiperenlaces');

/**
 * Restricciones del uso del dominio y subdominios.
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @return string [legal_dominioSubdominios]
 */
function shortDominioSubdominios() {
    return get_field('dominios', 'option');
}
add_shortcode('legal_dominioSubdominios', 'shortDominioSubdominios');

/**
 * Propiedad intelectual e industrial.
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @return string [legal_propiedadIntelectual]
 */
function shortPropiedadIntelectual() {
    return get_field('propiedadIntelectual', 'option');
}
add_shortcode('legal_propiedadIntelectual', 'shortPropiedadIntelectual');