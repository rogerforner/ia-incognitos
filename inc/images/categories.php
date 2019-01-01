<?php

/*
| ------------------------------------------------------------------------------
| Categorías
| ------------------------------------------------------------------------------
| Permitir la utilización de las categorías de las "Entradas" en "Medios".
|
*/

function imagesClassificationCat() {
    register_taxonomy_for_object_type('category', 'attachment');
}
add_action('init', 'imagesClassificationCat' );