<?php

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> TABLA DE CONTENIDOS
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> Página del Horario + Redes Sociales
> Horario
> Redes Sociales
> 
*/

/*
| ------------------------------------------------------------------------------
| Página del Horario + Redes Sociales
| ------------------------------------------------------------------------------
| Todos los campos que forman el apartado "Horario" y "Redes Sociales" de la
| página "Info. Sitio".
|
*/

require_once get_stylesheet_directory() . '/plugins/acf/fields/oPages/info/infoGeneralPagina.php';

/*
| ------------------------------------------------------------------------------
| Horario
| ------------------------------------------------------------------------------
| Shortcodes utilizados para mostrar los datos del horario.
|
*/

/**
 * Horario laboral.
 * Shortcode utilizado para devolver los datos del horario laboral.
 * 
 * @return string [info_horarioGeneral]
 */
function shortInfoHorarioGeneral() {
    $salida = '';

    if (get_field('infoHorarioEstado', 'option') == 'abierto') { // Abierto...
        if (have_rows('infoHorarioGeneral', 'option')) {
            $salida .= '<table class="horarioLaboral">';

            while (have_rows('infoHorarioGeneral', 'option')) {
                the_row();
    
                // Campos ACF.
                // Días de las semana.
                $diaValor = get_sub_field('generalDia');
                $dia      = "";
                switch ($diaValor) {
                    case 'lunes':
                        $dia = __('Lunes', 'incognitos');
                        break;
                    case 'martes':
                        $dia = __('Martes', 'incognitos');
                        break;
                    case 'miercoles':
                        $dia = __('Miércoles', 'incognitos');
                        break;
                    case 'jueves':
                        $dia = __('Jueves', 'incognitos');
                        break;
                    case 'viernes':
                        $dia = __('Viernes', 'incognitos');
                        break;
                    case 'sabado':
                        $dia = __('Sábado', 'incognitos');
                        break;
                    case 'domingo':
                        $dia = __('Domingo', 'incognitos');
                        break;
                }
                // Horas.
                $deHora      = get_sub_field('generalDeHora');
                $aHora       = get_sub_field('generalAHora');
                $horario     = "$deHora - $aHora";
                $deHoraT     = get_sub_field('generalDeHoraTarde');
                $aHoraT      = get_sub_field('generalAHoraTarde');
                $horarioT    = "$deHoraT - $aHoraT";
                $cerrado     = get_sub_field('generalCerrado');
                $cerradoDesc = get_sub_field('generalCerradoDescripcion');
                $isCerrado   = "";

                if ($cerrado && in_array('true', $cerrado)) {
                    $isCerrado = '<span class="estado">'.$cerradoDesc.'</span>';
                } else {
                    if (get_sub_field('generalDeHoraTarde')) {
                        $isCerrado = "$horario<br>$horarioT";
                    } else {
                        $isCerrado = $horario;
                    }
                }
    
                $salida .= '
                    <tr>
                        <td class="dia">'.$dia.'</td>
                        <td class="horas">'.$isCerrado.'</td>
                    </tr>
                ';
            }

            $salida .= '</table>';
        }
    } else { // Cerrado...
        if (have_rows('infoHorarioGeneral', 'option')) {
            $salida .= '<table class="horarioCerrado">';

            while (have_rows('infoHorarioCerrado', 'option')) {
                the_row();
    
                // Campos ACF.
                $titulo  = get_sub_field('cerradoTitulo');
                $deHora  = get_sub_field('cerradoDe');
                $aHora   = get_sub_field('cerradoA');
                $horario = "$deHora - $aHora";


                $salida .= '
                    <tr>
                        <td class="titulo">'.$titulo.'</td>
                    </tr>
                    <tr>
                        <td class="horas">'.$horario.'</td>
                    </tr>
                ';
            }

            $salida .= '</table>';
        }
    }

    return $salida;
}
add_shortcode('info_horarioGeneral', 'shortInfoHorarioGeneral');

/*
| ------------------------------------------------------------------------------
| Redes Sociales
| ------------------------------------------------------------------------------
| Shortcodes utilizados para mostrar las redes sociales.
| - 500px
| - Bitbucket
| - DeviantArt
| - Facebook
| - Flickr
| - GitHub
| - GitLab
| - Google Plus
| - Instagram
| - Kikstarter
| - Linkedin
| - Meetup
| - Pinterest
| - RSS
| - Sina Weibo
| - Snapchat
| - SoundCloud
| - Spotify
| - Steam
| - TripAdvisor
| - Twitch
| - Twitter
| - Viadeo
| - Vimeo
| - vkontakte
| - Xing
| - YouTube
|
*/

function infoGeneralRedesSociales() {
    $redes  = "";

    // 500px
    // =========================================================================
    $url500px = get_field('500px', 'option');
    $red500px = '<li class="et-social-icon"><a href="'.$url500px.'" class="icon"><i class="fab fa-500px"></i></a></li>';

    if (get_field('500px', 'option')) {
        $redes .= "
            var red500px = '$red500px';
            $('ul.et-social-icons').append(red500px);
        ";
    }

    // Bitbucket
    // =========================================================================
    $urlBitbucket = get_field('bitbucket', 'option');
    $redBitbucket = '<li class="et-social-icon"><a href="'.$urlBitbucket.'" class="icon"><i class="fab fa-bitbucket"></i></a></li>';

    if (get_field('bitbucket', 'option')) {
        $redes .= "
            var redBitbucket = '$redBitbucket';
            $('ul.et-social-icons').append(redBitbucket);
        ";
    }

    // DeviantArt
    // =========================================================================
    $urlDeviantArt = get_field('deviantart', 'option');
    $redDeviantArt = '<li class="et-social-icon"><a href="'.$urlDeviantArt.'" class="icon"><i class="fab fa-deviantart"></i></a></li>';

    if (get_field('deviantart', 'option')) {
        $redes .= "
            var redDeviantArt = '$redDeviantArt';
            $('ul.et-social-icons').append(redDeviantArt);
        ";
    }

    // Facebook
    // =========================================================================
    $urlFacebook = get_field('facebook', 'option');
    $redFacebook = '<li class="et-social-icon"><a href="'.$urlFacebook.'" class="icon"><i class="fab fa-facebook-f"></i></a></li>';

    if (get_field('facebook', 'option')) {
        $redes .= "
            var redFacebook = '$redFacebook';
            $('ul.et-social-icons').append(redFacebook);
            $('ul.et-social-icons li.et-social-facebook').remove();
        ";
    }

    // Flickr
    // =========================================================================
    $urlFlickr = get_field('flickr', 'option');
    $redFlickr = '<li class="et-social-icon"><a href="'.$urlFlickr.'" class="icon"><i class="fab fa-flickr"></i></a></li>';

    if (get_field('flickr', 'option')) {
        $redes .= "
            var redFlickr = '$redFlickr';
            $('ul.et-social-icons').append(redFlickr);
        ";
    }

    // GitHub
    // =========================================================================
    $urlGitHub = get_field('gitHub', 'option');
    $redGitHub = '<li class="et-social-icon"><a href="'.$urlGitHub.'" class="icon"><i class="fab fa-github"></i></a></li>';

    if (get_field('gitHub', 'option')) {
        $redes .= "
            var redGitHub = '$redGitHub';
            $('ul.et-social-icons').append(redGitHub);
        ";
    }

    // GitLab
    // =========================================================================
    $urlGitLab = get_field('gitLab', 'option');
    $redGitLab = '<li class="et-social-icon"><a href="'.$urlGitLab.'" class="icon"><i class="fab fa-gitlab"></i></a></li>';

    if (get_field('gitLab', 'option')) {
        $redes .= "
            var redGitLab = '$redGitLab';
            $('ul.et-social-icons').append(redGitLab);
        ";
    }

    // Google Plus
    // =========================================================================
    $urlGooglePlus = get_field('googlePlus', 'option');
    $redGooglePlus = '<li class="et-social-icon"><a href="'.$urlGooglePlus.'" class="icon"><i class="fab fa-google-plus-g"></i></a></li>';

    if (get_field('googlePlus', 'option')) {
        $redes .= "
            var redGooglePlus = '$redGooglePlus';
            $('ul.et-social-icons').append(redGooglePlus);
            $('ul.et-social-icons li.et-social-google-plus').remove();
        ";
    }

    // Instagram
    // =========================================================================
    $urlInstagram = get_field('instagram', 'option');
    $redInstagram = '<li class="et-social-icon"><a href="'.$urlInstagram.'" class="icon"><i class="fab fa-instagram"></i></a></li>';

    if (get_field('instagram', 'option')) {
        $redes .= "
            var redInstagram = '$redInstagram';
            $('ul.et-social-icons').append(redInstagram);
        ";
    }

    // Kikstarter
    // =========================================================================
    $urlKickstarter = get_field('kickstarter', 'option');
    $redKickstarter = '<li class="et-social-icon"><a href="'.$urlKickstarter.'" class="icon"><i class="fab fa-kickstarter"></i></a></li>';

    if (get_field('kickstarter', 'option')) {
        $redes .= "
            var redKickstarter = '$redKickstarter';
            $('ul.et-social-icons').append(redKickstarter);
        ";
    }

    // Linkedin
    // =========================================================================
    $urlLinkedin = get_field('linkedin', 'option');
    $redLinkedin = '<li class="et-social-icon"><a href="'.$urlLinkedin.'" class="icon"><i class="fab fa-linkedin"></i></a></li>';

    if (get_field('linkedin', 'option')) {
        $redes .= "
            var redLinkedin = '$redLinkedin';
            $('ul.et-social-icons').append(redLinkedin);
        ";
    }

    // Meetup
    // =========================================================================
    $urlMeetup = get_field('meetup', 'option');
    $redMeetup = '<li class="et-social-icon"><a href="'.$urlMeetup.'" class="icon"><i class="fab fa-meetup"></i></a></li>';

    if (get_field('meetup', 'option')) {
        $redes .= "
            var redMeetup = '$redMeetup';
            $('ul.et-social-icons').append(redMeetup);
        ";
    }

    // Pinterest
    // =========================================================================
    $urlPinterest = get_field('pinterest', 'option');
    $redPinterest = '<li class="et-social-icon"><a href="'.$urlPinterest.'" class="icon"><i class="fab fa-pinterest"></i></a></li>';

    if (get_field('pinterest', 'option')) {
        $redes .= "
            var redPinterest = '$redPinterest';
            $('ul.et-social-icons').append(redPinterest);
        ";
    }

    // RSS
    // =========================================================================
    $urlRss = get_field('rss', 'option');
    $redRss = '<li class="et-social-icon"><a href="'.$urlRss.'" class="icon"><i class="fas fa-rss-square"></i></a></li>';

    if (get_field('rss', 'option')) {
        $redes .= "
            var redRss = '$redRss';
            $('ul.et-social-icons').append(redRss);
            $('ul.et-social-icons li.et-social-rss').remove();
        ";
    }

    // Sina Weibo
    // =========================================================================
    $urlSinaWeibo = get_field('sinaWeibo', 'option');
    $redSinaWeibo = '<li class="et-social-icon"><a href="'.$urlSinaWeibo.'" class="icon"><i class="fab fa-weibo"></i></a></li>';

    if (get_field('sinaWeibo', 'option')) {
        $redes .= "
            var redSinaWeibo = '$redSinaWeibo';
            $('ul.et-social-icons').append(redSinaWeibo);
        ";
    }

    // Snapchat
    // =========================================================================
    $urlSnapchat = get_field('snapchat', 'option');
    $redSnapchat = '<li class="et-social-icon"><a href="'.$urlSnapchat.'" class="icon"><i class="fab fa-snapchat-ghost"></i></a></li>';

    if (get_field('snapchat', 'option')) {
        $redes .= "
            var redSnapchat = '$redSnapchat';
            $('ul.et-social-icons').append(redSnapchat);
        ";
    }

    // SoundCloud
    // =========================================================================
    $urlSoundCloud = get_field('soundcloud', 'option');
    $redSoundCloud = '<li class="et-social-icon"><a href="'.$urlSoundCloud.'" class="icon"><i class="fab fa-soundcloud"></i></a></li>';

    if (get_field('soundcloud', 'option')) {
        $redes .= "
            var redSoundCloud = '$redSoundCloud';
            $('ul.et-social-icons').append(redSoundCloud);
        ";
    }

    // Spotify
    // =========================================================================
    $urlSpotify = get_field('spotify', 'option');
    $redSpotify = '<li class="et-social-icon"><a href="'.$urlSpotify.'" class="icon"><i class="fab fa-spotify"></i></a></li>';

    if (get_field('spotify', 'option')) {
        $redes .= "
            var redSpotify = '$redSpotify';
            $('ul.et-social-icons').append(redSpotify);
        ";
    }

    // Steam
    // =========================================================================
    $urlSteam = get_field('steam', 'option');
    $redSteam = '<li class="et-social-icon"><a href="'.$urlSteam.'" class="icon"><i class="fab fa-steam"></i></a></li>';

    if (get_field('steam', 'option')) {
        $redes .= "
            var redSteam = '$redSteam';
            $('ul.et-social-icons').append(redSteam);
        ";
    }

    // TripAdvisor
    // =========================================================================
    $urlTripAdvisor = get_field('tripAdvisor', 'option');
    $redTripAdvisor = '<li class="et-social-icon"><a href="'.$urlTripAdvisor.'" class="icon"><i class="fab fa-tripadvisor"></i></a></li>';

    if (get_field('tripAdvisor', 'option')) {
        $redes .= "
            var redTripAdvisor = '$redTripAdvisor';
            $('ul.et-social-icons').append(redTripAdvisor);
        ";
    }

    // Twitch
    // =========================================================================
    $urlTwitch = get_field('twitch', 'option');
    $redTwitch = '<li class="et-social-icon"><a href="'.$urlTwitch.'" class="icon"><i class="fab fa-twitch"></i></a></li>';

    if (get_field('twitch', 'option')) {
        $redes .= "
            var redTwitch = '$redTwitch';
            $('ul.et-social-icons').append(redTwitch);
        ";
    }

    // Twitter
    // =========================================================================
    $urlTwitter = get_field('twitter', 'option');
    $redTwitter = '<li class="et-social-icon"><a href="'.$urlTwitter.'" class="icon"><i class="fab fa-twitter"></i></a></li>';

    if (get_field('twitter', 'option')) {
        $redes .= "
            var redTwitter = '$redTwitter';
            $('ul.et-social-icons').append(redTwitter);
            $('ul.et-social-icons li.et-social-twitter').remove();
        ";
    }

    // Viadeo
    // =========================================================================
    $urlViadeo = get_field('viadeo', 'option');
    $redViadeo = '<li class="et-social-icon"><a href="'.$urlViadeo.'" class="icon"><i class="fab fa-viadeo"></i></a></li>';

    if (get_field('viadeo', 'option')) {
        $redes .= "
            var redViadeo = '$redViadeo';
            $('ul.et-social-icons').append(redViadeo);
        ";
    }

    // Vimeo
    // =========================================================================
    $urlVimeo = get_field('vimeo', 'option');
    $redVimeo = '<li class="et-social-icon"><a href="'.$urlVimeo.'" class="icon"><i class="fab fa-vimeo-v"></i></a></li>';

    if (get_field('vimeo', 'option')) {
        $redes .= "
            var redVimeo = '$redVimeo';
            $('ul.et-social-icons').append(redVimeo);
        ";
    }

    // vkontakte
    // =========================================================================
    $urlVkontakte = get_field('vkontakte', 'option');
    $redVkontakte = '<li class="et-social-icon"><a href="'.$urlVkontakte.'" class="icon"><i class="fab fa-vk"></i></a></li>';

    if (get_field('vkontakte', 'option')) {
        $redes .= "
            var redVkontakte = '$redVkontakte';
            $('ul.et-social-icons').append(redVkontakte);
        ";
    }

    // Xing
    // =========================================================================
    $urlXing = get_field('xing', 'option');
    $redXing = '<li class="et-social-icon"><a href="'.$urlXing.'" class="icon"><i class="fab fa-xing"></i></a></li>';

    if (get_field('xing', 'option')) {
        $redes .= "
            var redXing = '$redXing';
            $('ul.et-social-icons').append(redXing);
        ";
    }

    // YouTube
    // =========================================================================
    $urlYouTube = get_field('youtube', 'option');
    $redYouTube = '<li class="et-social-icon"><a href="'.$urlYouTube.'" class="icon"><i class="fab fa-youtube"></i></a></li>';

    if (get_field('youtube', 'option')) {
        $redes .= "
            var redYouTube = '$redYouTube';
            $('ul.et-social-icons').append(redYouTube);
        ";
    }

    // SALIDA
    // =========================================================================
    if (
        get_field('500px', 'option') ||
        get_field('bitbucket', 'option') ||
        get_field('deviantart', 'option') ||
        get_field('facebook', 'option') ||
        get_field('flickr', 'option') ||
        get_field('gitHub', 'option') ||
        get_field('gitLab', 'option') ||
        get_field('googlePlus', 'option') ||
        get_field('instagram', 'option') ||
        get_field('kickstarter', 'option') ||
        get_field('linkedin', 'option') ||
        get_field('meetup', 'option') ||
        get_field('pinterest', 'option') ||
        get_field('rss', 'option') ||
        get_field('sinaWeibo', 'option') ||
        get_field('snapchat', 'option') ||
        get_field('soundcloud', 'option') ||
        get_field('spotify', 'option') ||
        get_field('steam', 'option') ||
        get_field('tripAdvisor', 'option') ||
        get_field('twitch', 'option') ||
        get_field('twitter', 'option') ||
        get_field('viadeo', 'option') ||
        get_field('vimeo', 'option') ||
        get_field('vkontakte', 'option') ||
        get_field('xing', 'option') ||
        get_field('youtube', 'option')
    ) {
        echo '
        <script type="text/javascript"> 
        jQuery(function($) {
            $(document).ready(function() {
                '.$redes.'
                $("ul.et-social-icons a").attr("target", "_blank");
            });
        });
        </script>
        ';
    }
};
add_action('wp_footer', 'infoGeneralRedesSociales');