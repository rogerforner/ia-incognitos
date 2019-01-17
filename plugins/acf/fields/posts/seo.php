<?php

/*
| ------------------------------------------------------------------------------
| Meta Box SEO
| ------------------------------------------------------------------------------
| Código generado por ACF Pro.
| Ha sido adaptado para traducciones.
|
*/

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5c4097d874eb2',
        'title' => __('Imagen Open Graph', 'incognitos'),
        'fields' => array(
            array(
                'key' => 'field_5c40989b8c496',
                'label' => '',
                'name' => 'og_imagen',
                'type' => 'image',
                'instructions' => __('Imagen que se mostrará en las Redes Sociales. Por defecto se utiliza la imagen destacada.', 'incognitos'),
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => 600,
                'min_height' => 315,
                'min_size' => '',
                'max_width' => 1200,
                'max_height' => 630,
                'max_size' => '',
                'mime_types' => '.jpg, .png, .gif',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ),
            ),
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'project',
                ),
            ),
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'side',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'field',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));
    
endif;