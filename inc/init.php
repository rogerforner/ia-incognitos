<?php

/*
| ------------------------------------------------------------------------------
| Estilos
| ------------------------------------------------------------------------------
| Referenciar la hoja de estilos del tema principal (padre) Divi.
|
*/

function temaDivi() {
    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . '/style.css'
    );
}
add_action('wp_enqueue_scripts', 'temaDivi');

/*
| ------------------------------------------------------------------------------
| Librerias externas
| ------------------------------------------------------------------------------
| Referenciar hojas de estilos o librerias externas.
|
*/

function temaLibreriasExternas() {
    wp_enqueue_style(
        'font-awesome',
        'https://use.fontawesome.com/releases/v5.2.0/css/all.css'
    );
}
add_action('wp_enqueue_scripts', 'temaLibreriasExternas');

/*
| ------------------------------------------------------------------------------
| Idiomas
| ------------------------------------------------------------------------------
| Hacer referencia al directorio que contendrá los idiomas del tema.
|
*/

function my_child_theme_locale() {
    load_child_theme_textdomain( 'incognitos', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'my_child_theme_locale' );