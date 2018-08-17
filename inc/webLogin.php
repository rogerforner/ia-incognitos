<?php

/*
| ------------------------------------------------------------------------------
| Logotipo
| ------------------------------------------------------------------------------
| Personalizar el logotipo de la página del login de WordPress.
|
*/

// URL
// =============================================================================
function loginLogoUrl() {
    return get_bloginfo('url');
}
add_filter('login_headerurl', 'loginLogoUrl');

// Título (atributo: "title")
// =============================================================================
function loginLogoAttrTitle() {
    return get_bloginfo('name');
}
add_filter('login_headertitle', 'loginLogoAttrTitle');

// Imagen
// =============================================================================
function loginLogo() {
    // Si se ha escogido un logo en el panel de administración, lo utilizamos.
    // En caso contrario utilizaremos el "favicon".
    if (get_field('loginLogo', 'option')) {
        $loginLogoURL = get_field('loginLogo', 'option');
    } else {
        $loginLogoURL = get_site_icon_url();
    }

    if ($loginLogoURL) {
        echo '
        <style type="text/css">
            h1 a {
                background-image: url('.$loginLogoURL.') !important;
            }
        </style>
        ';
    }
}
add_action('login_head', 'loginLogo');

// Estilos de la la página
// =============================================================================
function loginPageStyles() {
    // Color de fondo.
    $colorFondo = get_field('loginBgColor', 'option');

    // Imagen de fondo.
    if (get_field('loginBgImg', 'option')) {
        $img = get_field('loginBgImg', 'option');

        $imgFondo = '
            background: url('.$img.') center center no-repeat !important;
            background-size: cover !important;
        ';
    } else {
        $imgFondo = '';
    }

    echo '
    <style type="text/css">
        /* Fondo de pantalla
        ===================================================================== */
        body
        {
            background-color: '.$colorFondo.';
            '.$imgFondo.'
        }

        #login
        {
            padding: 4% 0 0 !important;
        }
        
        /* Formulario
        ===================================================================== */
        form
        {
            background-color: #ffffff;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            box-shadow: none !important;
            padding: 2%;
            
        }
        form .forgetmenot label
        {
            font-size: 14px !important;
        }

        /* Botón
        ===================================================================== */
        form p .button.button-primary.button-large
        {
            background: #fbfbfb;
            border: 1px solid #dddddd;
            color: #72777c;
            text-shadow: none;
            box-shadow: 0 1px 3px rgba(0,0,0,.12), 0 1px 2px rgba(0,0,0,.24);
        }

        /* Pié
        ===================================================================== */
        p#nav
        {
            text-align: center;
            background-color: #ffffff !important;
            margin: 0 !important;
            box-shadow: none !important;
            padding: 6px 24px !important;
        }
        p#backtoblog
        {
            text-align: center;
            background-color: #ffffff !important;
            margin: 0 !important;
            box-shadow: none !important;
            padding-bottom: 20px !important;
            padding-top: 6px !important;
        }
        div.privacy-policy-page-link
        {
            text-align: center;
            background-color: #ffffff !important;
            margin: 0 !important;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            box-shadow: none !important;
            padding-bottom: 20px !important;
            padding-top: 6px !important;
        }
        p#nav a,
        p#backtoblog a,
        div.privacy-policy-page-link a
        {
            text-decoration: none;
            color: #555d66;
        }
        p#nav a:hover,
        p#backtoblog a:hover,
        div.privacy-policy-page-link a:hover
        {
            color: #0073aa;
        }
    </style>
    ';
}
add_action('login_head', 'loginPageStyles');
