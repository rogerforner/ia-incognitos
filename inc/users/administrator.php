<?php

/*
| ------------------------------------------------------------------------------
| Capacidades (permisos)
| ------------------------------------------------------------------------------
| Proporcionar capacidades nuevas al rol administrador.
|
*/

function userCapabilitiesAdministrator() {
    // Seleccionar el rol al que proporcionar las nuevas capacidades.
    $role = get_role('administrator');

    // Capacidades.
    $role->add_cap('manage_acf');
    $role->add_cap('manage_acf_legal');
    $role->add_cap('manage_acf_info');
    $role->add_cap('manage_acf_login');
}
add_action('init', 'userCapabilitiesAdministrator', 11);