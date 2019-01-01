<?php

/*
| ------------------------------------------------------------------------------
| Etiquetas
| ------------------------------------------------------------------------------
| Permitir la utilización de las etiquetas de las "Entradas" en "Medios".
|
*/

function imagesClassificationTag() {
    register_taxonomy_for_object_type('post_tag', 'attachment');
}
add_action('init', 'imagesClassificationTag' );