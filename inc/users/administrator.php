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
    $role->add_cap('manage_acf', true);
    $role->add_cap('manage_acf_legal', true);
}
add_action('init', 'userCapabilitiesAdministrator', 11);