<?php

/*
| ------------------------------------------------------------------------------
| Feed
| ------------------------------------------------------------------------------
| - Proyectos
|
*/

function projectFeed() {
	$posts          = array('project');
	$nombreSitioWeb = get_bloginfo('name');
	
    foreach($posts as $post) {
		$feed = get_post_type_archive_feed_link($post);
		
        if ($feed === '' || !is_string($feed)) {
            $feed = get_bloginfo('rss2_url')."?post_type=$post";
		}
		
        echo '<link rel="alternate" type="application/rss+xml" title="'.$nombreSitioWeb.' &raquo; Project Feed" href="'.$feed.'" />';
    }
}
add_action('wp_head', 'projectFeed', 4);