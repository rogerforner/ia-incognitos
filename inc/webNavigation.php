<?php

/*
| ------------------------------------------------------------------------------
| Shortcodes
| ------------------------------------------------------------------------------
| Permitir la inserción de ShortCodes en los menús de navegación.
|
*/

function navShortcodesMenus($menu){
    return do_shortcode($menu);
}
add_filter('wp_nav_menu', 'navShortcodesMenus');