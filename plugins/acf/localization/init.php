<?php

/*
| ------------------------------------------------------------------------------
| Localización por plugins
| ------------------------------------------------------------------------------
| Código utilizado para permitir la traducción a través de plugins.
| - Polylang
|
*/

// Polylang
// =============================================================================
if (function_exists( 'pll_current_language' )) {
    require_once get_stylesheet_directory() . '/plugins/acf/localization/polylang.php';
}