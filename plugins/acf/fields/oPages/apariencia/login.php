<?php

/*
| ------------------------------------------------------------------------------
| Página del Login
| ------------------------------------------------------------------------------
| Código generado por ACF Pro.
| Ha sido adaptado para traducciones.
|
*/

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5b700b50327c3',
		'title' => __('Login', 'incognitos'),
		'fields' => array(
			array(
				'key' => 'field_5b700b898f9e1',
				'label' => __('Logo', 'incognitos'),
				'name' => 'loginLogo',
				'type' => 'image',
				'instructions' => __('Por defecto, se utiliza el <em>favicon</em>.', 'incognitos'),
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
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_5b700cbd7cbf8',
				'label' => __('Color de fondo', 'incognitos'),
				'name' => 'loginBgColor',
				'type' => 'color_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '#f1f1f1',
			),
			array(
				'key' => 'field_5b700d2f7cbf9',
				'label' => __('Imagen de fondo', 'incognitos'),
				'name' => 'loginBgImg',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'preview_size' => 'full',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-login',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	
endif;