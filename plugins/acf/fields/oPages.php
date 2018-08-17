<?php

/*
| ------------------------------------------------------------------------------
| Menús de administración
| ------------------------------------------------------------------------------
| Menús:
| - Textos legales (aviso legal)
| - Login (apariencia)
|
*/

if(function_exists('acf_add_options_page')) {
	// Textos legales.
	// =========================================================================
	# Aviso legal.
	acf_add_options_page(array(
		'page_title' => __('Aviso legal', 'incognitos'),
		'menu_title' => __('Aviso legal', 'incognitos'),
		'menu_slug'  => 'ws-legal-info',
		'capability' => 'manage_acf_legal',
		'position'   => '3',
		'icon_url'   => 'dashicons-forms',
		'redirect'   => false
	));
	
	# RGPD.
	acf_add_options_sub_page(array(
		'page_title'  => __('Reglamento General de Protección de Datos', 'incognitos'),
		'menu_title'  => __('RGPD', 'incognitos'),
		'parent_slug' => 'ws-legal-info',
		'capability'  => 'manage_acf_legal'
	));

	# Cookies.
	acf_add_options_sub_page(array(
		'page_title'  => __('Política de Cookies', 'incognitos'),
		'menu_title'  => __('Cookies', 'incognitos'),
		'parent_slug' => 'ws-legal-info',
		'capability'  => 'manage_acf_legal'
	));

	// Info.
	// =========================================================================
	acf_add_options_page(array(
		'page_title' => __('Información general del sitio web', 'incognitos'),
		'menu_title' => __('Info. Sitio', 'incognitos'),
		'menu_slug'  => 'ws-general-info',
		'capability' => 'edit_theme_options',
		'position'   => '3.1',
		'icon_url'   => 'dashicons-info',
		'redirect'   => false
	));

	// Login.
	// =========================================================================
	acf_add_options_sub_page(array(
		'page_title'  => __('Personalizar la página de Inicio de Sesión', 'incognitos'),
		'menu_title'  => __('Login', 'incognitos'),
		'parent_slug' => 'themes.php',
		'capability'  => 'edit_theme_options'
	));
}

/*
| ------------------------------------------------------------------------------
| Páginas de opciones de los "Textos legales"
| ------------------------------------------------------------------------------
| Páginas de opciones para obtener los datos necesarios para el Aviso legal,
| el Reglamento General de Protección de Datos y la Política de Cookies.
|
*/

require_once get_stylesheet_directory() . '/plugins/acf/fields/oPages/legal/avisoLegal.php';
require_once get_stylesheet_directory() . '/plugins/acf/fields/oPages/legal/rgpd.php';
require_once get_stylesheet_directory() . '/plugins/acf/fields/oPages/legal/cookies.php';

/*
| ------------------------------------------------------------------------------
| Página de opciones de la "Página de Información del Sitio"
| ------------------------------------------------------------------------------
| Página de opciones para obtener los datos necesarios para la inserción de un
| horario laboral o las redes sociales.
|
*/

require_once get_stylesheet_directory() . '/plugins/acf/fields/oPages/info/infoGeneral.php';

/*
| ------------------------------------------------------------------------------
| Página de opciones de la "Página de Inicio de Sesión"
| ------------------------------------------------------------------------------
| Página de opciones para obtener los datos necesarios para la personalización
| de la Página del Login (logo, color de fondo e imagen de fondo).
|
*/

require_once get_stylesheet_directory() . '/plugins/acf/fields/oPages/apariencia/login.php';