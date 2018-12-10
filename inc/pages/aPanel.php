<?php

/*
| ------------------------------------------------------------------------------
| Quitar Info WordPress
| ------------------------------------------------------------------------------
| Quitar información predeterminada de WordPress.
| - Logo
| - Pié de página
| - Escritorio
| - Pestañas de ayuda
|
*/

// Logo (barra de navegación)
// =============================================================================
function aPanelQuitarLogo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'aPanelQuitarLogo', 0);

// Pié de página
// =============================================================================
add_filter('admin_footer_text', '__return_empty_string', 11);
add_filter('update_footer',     '__return_empty_string', 11);

// Escritorio (widgets)
// =============================================================================
function aPanelQuitarDashboardWidgets() {
	global $wp_meta_boxes;
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    
    remove_action('welcome_panel', 'wp_welcome_panel');
}
add_action('wp_dashboard_setup', 'aPanelQuitarDashboardWidgets', 999);

// Pestañas de ayuda
// =============================================================================
function aPanelQuitarPestanasAyuda($old_help, $screen_id, $screen) {
	$screen->remove_help_tabs();
	return $old_help;
}
add_filter('contextual_help', 'aPanelQuitarPestanasAyuda', 5, 3);