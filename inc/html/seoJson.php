<?php

/*
| ------------------------------------------------------------------------------
| JSON-LD
| ------------------------------------------------------------------------------
| Estructura de datos. Utilizamos campos ACF de "Info. Sitio".
| - WebSite
|
*/

function jsonldWebSite() {
    $nombreSitio = get_bloginfo('name');
    $descripcion = get_bloginfo('description');
    $urlSitio    = home_url('/');

    $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
    $imagenURL     = $thumbnail_src[0];
    $imagenSitio   = "";

    if ($imagenURL) {
        $imagenSitio = '"image": "'.$imagenURL.'",';
    }
    
    $redes  = "";
    
    // 500px
    // -------------------------------------------------------------------------
    $url500px = get_field('500px', 'option');
    if (get_field('500px', 'option')) {
        $redes .= '"'.$url500px.'",';
    }

    // Bitbucket
    // -------------------------------------------------------------------------
    $urlBitbucket = get_field('bitbucket', 'option');
    if (get_field('bitbucket', 'option')) {
        $redes .= '"'.$urlBitbucket.'",';
    }

    // DeviantArt
    // -------------------------------------------------------------------------
    $urlDeviantArt = get_field('deviantart', 'option');
    if (get_field('deviantart', 'option')) {
        $redes .= '"'.$urlDeviantArt.'",';
    }

    // Facebook
    // -------------------------------------------------------------------------
    $urlFacebook = get_field('facebook', 'option');
    if (get_field('facebook', 'option')) {
        $redes .= '"'.$urlFacebook.'",';
    }

    // Flickr
    // -------------------------------------------------------------------------
    $urlFlickr = get_field('flickr', 'option');
    if (get_field('flickr', 'option')) {
        $redes .= '"'.$urlFlickr.'",';
    }

    // GitHub
    // -------------------------------------------------------------------------
    $urlGitHub = get_field('gitHub', 'option');
    if (get_field('gitHub', 'option')) {
        $redes .= '"'.$urlGitHub.'",';
    }

    // GitLab
    // -------------------------------------------------------------------------
    $urlGitLab = get_field('gitLab', 'option');
    if (get_field('gitLab', 'option')) {
        $redes .= '"'.$urlGitLab.'",';
    }

    // Google Plus
    // -------------------------------------------------------------------------
    $urlGooglePlus = get_field('googlePlus', 'option');
    if (get_field('googlePlus', 'option')) {
        $redes .= '"'.$urlGooglePlus.'",';
    }

    // Instagram
    // -------------------------------------------------------------------------
    $urlInstagram = get_field('instagram', 'option');
    if (get_field('instagram', 'option')) {
        $redes .= '"'.$urlInstagram.'",';
    }

    // Kikstarter
    // -------------------------------------------------------------------------
    $urlKickstarter = get_field('kickstarter', 'option');
    if (get_field('kickstarter', 'option')) {
        $redes .= '"'.$urlKickstarter.'",';
    }

    // Linkedin
    // -------------------------------------------------------------------------
    $urlLinkedin = get_field('linkedin', 'option');
    if (get_field('linkedin', 'option')) {
        $redes .= '"'.$urlLinkedin.'",';
    }

    // Meetup
    // -------------------------------------------------------------------------
    $urlMeetup = get_field('meetup', 'option');
    if (get_field('meetup', 'option')) {
        $redes .= '"'.$urlMeetup.'",';
    }

    // Pinterest
    // -------------------------------------------------------------------------
    $urlPinterest = get_field('pinterest', 'option');
    if (get_field('pinterest', 'option')) {
        $redes .= '"'.$urlPinterest.'",';
    }

    // RSS
    // -------------------------------------------------------------------------
    $urlRss = get_field('rss', 'option');
    if (get_field('rss', 'option')) {
        $redes .= '"'.$urlRss.'",';
    }

    // Sina Weibo
    // -------------------------------------------------------------------------
    $urlSinaWeibo = get_field('sinaWeibo', 'option');
    if (get_field('sinaWeibo', 'option')) {
        $redes .= '"'.$urlSinaWeibo.'",';
    }

    // Snapchat
    // -------------------------------------------------------------------------
    $urlSnapchat = get_field('snapchat', 'option');
    if (get_field('snapchat', 'option')) {
        $redes .= '"'.$urlSnapchat.'",';
    }

    // SoundCloud
    // -------------------------------------------------------------------------
    $urlSoundCloud = get_field('soundcloud', 'option');
    if (get_field('soundcloud', 'option')) {
        $redes .= '"'.$urlSoundCloud.'",';
    }

    // Spotify
    // -------------------------------------------------------------------------
    $urlSpotify = get_field('spotify', 'option');
    if (get_field('spotify', 'option')) {
        $redes .= '"'.$urlSpotify.'",';
    }

    // Steam
    // -------------------------------------------------------------------------
    $urlSteam = get_field('steam', 'option');
    if (get_field('steam', 'option')) {
        $redes .= '"'.$urlSteam.'",';
    }

    // TripAdvisor
    // -------------------------------------------------------------------------
    $urlTripAdvisor = get_field('tripAdvisor', 'option');
    if (get_field('tripAdvisor', 'option')) {
        $redes .= '"'.$urlTripAdvisor.'",';
    }

    // Twitch
    // -------------------------------------------------------------------------
    $urlTwitch = get_field('twitch', 'option');
    if (get_field('twitch', 'option')) {
        $redes .= '"'.$urlTwitch.'",';
    }

    // Twitter
    // -------------------------------------------------------------------------
    $urlTwitter = get_field('twitter', 'option');
    if (get_field('twitter', 'option')) {
        $redes .= '"'.$urlTwitter.'",';
    }

    // Viadeo
    // -------------------------------------------------------------------------
    $urlViadeo = get_field('viadeo', 'option');
    if (get_field('viadeo', 'option')) {
        $redes .= '"'.$urlViadeo.'",';
    }

    // Vimeo
    // -------------------------------------------------------------------------
    $urlVimeo = get_field('vimeo', 'option');
    if (get_field('vimeo', 'option')) {
        $redes .= '"'.$urlVimeo.'",';
    }

    // vkontakte
    // -------------------------------------------------------------------------
    $urlVkontakte = get_field('vkontakte', 'option');
    if (get_field('vkontakte', 'option')) {
        $redes .= '"'.$urlVkontakte.'",';
    }

    // Xing
    // -------------------------------------------------------------------------
    $urlXing = get_field('xing', 'option');
    if (get_field('xing', 'option')) {
        $redes .= '"'.$urlXing.'",';
    }

    // YouTube
    // -------------------------------------------------------------------------
    $urlYouTube = get_field('youtube', 'option');
    if (get_field('youtube', 'option')) {
        $redes .= '"'.$urlYouTube.'",';
	}
	
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
        $sameAs = '"sameAs": ['.rtrim($redes, ',').']';
    } else {
        $sameAs = "";
    }

	// SALIDA
    // -------------------------------------------------------------------------
	echo '<script type="application/ld+json">{"@context": "http://schema.org/","@type": "WebSite","@id": "'.$urlSitio.'#website","url": "'.$urlSitio.'","name": "'.addslashes($nombreSitio).'","description": "'.$descripcion.'","potentialAction": {"@type": "SearchAction","target": "'.$urlSitio.'?s={search_term_string}","query-input": "required name=search_term_string"},'.$imagenSitio.''.$sameAs.'}</script>';
}
add_action('wp_head', 'jsonldWebSite', 5);