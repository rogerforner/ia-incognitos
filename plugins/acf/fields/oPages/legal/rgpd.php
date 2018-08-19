<?php

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> TABLA DE CONTENIDOS
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
> Página del "Reglamento General de Protección de Datos"
> Shortcodes
> 
*/

/*
| ------------------------------------------------------------------------------
| Página del "Reglamento General de Protección de Datos"
| ------------------------------------------------------------------------------
| Todos los campos que forman la página del RGPD.
|
*/
require_once get_stylesheet_directory() . '/plugins/acf/fields/oPages/legal/rgpdPagina.php';

/*
| ------------------------------------------------------------------------------
| Shortcodes
| ------------------------------------------------------------------------------
| Shortcodes utilizados para mostrar los datos.
| - Información básica
| - Responsable
| - Finalidad
| - Legitimación
| - Destinatarios
| - Derechos
| - Procedencia
|
*/

/**
 * Información básica.
 * Shortcode utilizado para devolver los datos correspondientes a la primera
 * capa del RGPD (como encabezado de los textos legales).
 * 
 * @return string [legal_rgpdInfoBasica]
 */
function shortRgpdInfoBasica() {
	$salida = "";
	
	// Iniciamos la tabla...
	$salida .= "
		<table>
	";

	// Responsable.
	// =========================================================================
	$responsableTxt    = __('Responsable', 'incognitos');
	$responsable       = get_field('responsable', 'option');
	$responsableNombre = $responsable['identidad'];

	$salida .= "
		<tr>
			<td><strong>$responsableTxt</strong></td>
			<td>$responsableNombre</td>
		</tr>
	";

	// Finalidad.
	// =========================================================================
	$finalidadTxt = __('Finalidad', 'incognitos');

	$salida .= "<tr><td><strong>$finalidadTxt</strong></td><td>";

	// Campo Repeater (ACF).
	if (have_rows('finalidadListado', 'option')) {
		while (have_rows('finalidadListado', 'option')) {
			the_row();

			// Campos ACF.
			$finalidad = get_sub_field('titulo');

			$salida .= "$finalidad ";
		}
	}

	$salida .= "</td></tr>";

	// Legitimación.
	// =========================================================================
	$legitimacionTxt = __('Legitimación', 'incognitos');

	$salida .= "<tr><td><strong>$legitimacionTxt</strong></td><td>";

	// Campo Repeater (ACF): Tipo de legitimación.
	if (have_rows('legitimacionListado', 'option')) {
		while (have_rows('legitimacionListado', 'option')) {
			the_row();

			// La legitimación se define según el valor seleccionado en el apartado
			// "Legitimación por".
			$legitimacion = "";

			if (get_sub_field('legitimacionTipo') == 'consentimiento') {
				$legitimacion = __('Legitimación por consentimiento del interesado', 'incognitos');

			} elseif (get_sub_field('legitimacionTipo') == 'contrato') {
				$legitimacion = __('Legitimación por ejecución de un contrato', 'incognitos');

			} elseif (get_sub_field('legitimacionTipo') == 'interes') {
				$legitimacion = __('Legitimación por Interés legítimo del Responsable, o de un tercero', 'incognitos');

			} elseif (get_sub_field('legitimacionTipo') == 'legal') {
				$legitimacion = __('Legitimación por cumplimiento de una obligación legal', 'incognitos');

			} else {
				$legitimacion = __('Legitimación por misión en Interés público o ejercicio de Poderes Públicos', 'incognitos');
			}

			$salida .= "$legitimacion ";
		}
	}

	$salida .= "</td></tr>";

	// Destinatarios.
	// =========================================================================
	$destinatariosTxt = __('Destinatarios', 'incognitos');

	$salida .= "<tr><td><strong>$destinatariosTxt</strong></td><td>";

	// Campo Repeater (ACF).
	if (have_rows('destinatariosListado', 'option')) {
		while (have_rows('destinatariosListado', 'option')) {
			the_row();

			// Campos ACF.
			$destinatario = get_sub_field('nombre');

			$salida .= "$destinatario. ";
		}
	}

	$salida .= "</td></tr>";

	// Derechos.
	// =========================================================================
	$derechosTxt = __('Derechos', 'incognitos');

	$salida .= "<tr><td><strong>$derechosTxt</strong></td><td>";

	// Campo Repeater (ACF).
	if (have_rows('derechosListado', 'option')) {
		while (have_rows('derechosListado', 'option')) {
			the_row();

			$derecho = "";

			// El derecho se define según el valor seleccionado en el apartado
			// "Derecho a".
			if (get_sub_field('derecho') == 'acceso') {
				$derecho = __('Derecho a solicitar el acceso a los datos personales relativos al interesado', 'incognitos');

			} elseif (get_sub_field('derecho') == 'rectificacion') {
				$derecho = __('Derecho a solicitar su rectificación o supresión', 'incognitos');

			} elseif (get_sub_field('derecho') == 'limitacion') {
				$derecho = __('Derecho a solicitar la limitación de su tratamiento', 'incognitos');

			} elseif (get_sub_field('derecho') == 'oposicion') {
				$derecho = __('Derecho a oponerse al tratamiento', 'incognitos');

			} else {
				$derecho = __('Derecho a la portabilidad de los datos', 'incognitos');
			}

			$salida .= "$derecho. ";
		}
	}

	$salida .= "</td></tr>";


	// Cerramos la tabla.
	$salida .= "
		</table>
	";

	return $salida;
}
add_shortcode('legal_rgpdInfoBasica', 'shortRgpdInfoBasica');

/**
 * Responsable.
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @var array $responsable		Campos del Responsable (ACF Group).
 * @var array $representante	Campos del Representante (ACF Group).
 * @var array $dpd				Campos del DPD (ACF Group).
 * @var string $salida			Texto que devolverá el Shortcode.
 * 
 * @return string [legal_rgpdResponsable]
 */
function shortRgpdResponsable() {
	// Campos ACF.
	$responsable   = get_field('responsable', 'option');
	$representante = get_field('responsableRepresentante', 'option');
	$dpd           = get_field('responsableDpd', 'option');

	// Textos predeterminados, preparados para ser traducidos.
	$responsableTitulo   = __('¿Quién es el/la responsable del sitio web?', 'incognitos');
	$representanteTitulo = __('¿Quién es el/la representante?', 'incognitos');
	$dpdTitulo           = __('¿Quién es el/la Delegado de Protección de Datos (DPD)?', 'incognitos');
	$dpdTituloTxt        = __('Dado que el/la responsable reside fuera de la Unión Europea le presentamos nuestro/a representante dentro de ésta.', 'incognitos');
	$identidadTxt        = __('Identidad', 'incognitos');
	$dirTxt              = __('Dir. Postal', 'incognitos');
	$telTxt              = __('Teléfono', 'incognitos');
	$emailTxt            = __('Correo electrónico', 'incognitos');

	$salida = "";

	// Responsable.
	// =========================================================================
	if ($responsable) {
		$responsableIdentidad = "<strong>$identidadTxt</strong>: " . $responsable['identidad'] . " - " . $responsable['id'] . '<br>';
		$responsableDir       = "<strong>$dirTxt</strong>: " . $responsable['direccion'] . '<br>';
		$responsableEmail     = "<strong>$emailTxt</strong>: " . $responsable['email'];

		if (!$responsable['telefono'] == null) {
			$responsableTel = "<strong>$telTxt</strong>: +" . $responsable['telefono'] . '<br>';

		} else {
			$responsableTel = null;
		}

		$salida = "
			<h4>$responsableTitulo</h4>
			<p>
				$responsableIdentidad
				$responsableDir
				$responsableTel
				$responsableEmail
			</p>
		";
	}

	// Representante (únicamente si se selecciona).
	// =========================================================================
	if ($representante['representante'] == 'true') {
		if ($representante) {
			$representanteIdentidad = "<strong>$identidadTxt</strong>: " . $representante['identidad'] . " - " . $representante['id'] . '<br>';
			$representanteDir       = "<strong>$dirTxt</strong>: " . $representante['direccion'] . '<br>';
			$representanteEmail     = "<strong>$emailTxt</strong>: " . $representante['email'];

			if (!$representante['telefono'] == null) {
				$representanteTel = "<strong>$telTxt</strong>: +" . $representante['telefono'] . '<br>';
			} else {
				$representanteTel = null;
			}

			$salida .= "
				<h4>$representanteTitulo</h4>
				<p>
					$representanteIdentidad
					$representanteDir
					$representanteTel
					$representanteEmail
				</p>
			";
		}
	}

	// DPD: Delegado de Protección de Datos (únicamente si se selecciona).
	// =========================================================================
	if ($dpd['dpd'] == 'false') {
		if ($dpd) {
			$dpdIdentidad = "<strong>$identidadTxt</strong>: " . $dpd['identidad'] . " - " . $dpd['id'] . '<br>';
			$dpdDir       = "<strong>$dirTxt</strong>: " . $dpd['direccion'] . '<br>';
			$dpdEmail     = "<strong>$emailTxt</strong>: " . $dpd['email'];

			$salida .= "
				<h4>$dpdTitulo</h4>
				<p><em>$dpdTituloTxt</em></p>
				<p>
					$dpdIdentidad
					$dpdDir
					$dpdEmail
				</p>
			";
		}
	}

	return $salida;
}
add_shortcode('legal_rgpdResponsable', 'shortRgpdResponsable');

/**
 * Finalidad.
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @var string $title	Campo "Título".
 * @var string $desc	Campo "Descripción".
 * @var string $salida	Texto que devolverá el Shortcode.
 * 
 * @return string [legal_rgpdFinalidad]
 */
function shortRgpdFinalidad() {
	$salida = "";

	// Campo Repeater (ACF).
	if (have_rows('finalidadListado', 'option')) {
		while (have_rows('finalidadListado', 'option')) {
			the_row();

			// Campos ACF.
			$title = get_sub_field('titulo');
			$desc  = get_sub_field('descripcion');

			$salida .= "
				<h4>$title</h4>
				$desc
			";
		}
	}

	return $salida;
}
add_shortcode('legal_rgpdFinalidad', 'shortRgpdFinalidad');

/**
 * Legitimación.
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @var string $encabezado	Campo "Legitimación por".
 * @var string $title		Campo "Título".
 * @var string $desc		Campo "Descripción".
 * @var string $salida		Texto que devolverá el Shortcode.
 * 
 * @return string [legal_rgpdLegitimacion]
 */
function shortRgpdLegitimacion() {
	$salida = "";

	// Campo Repeater (ACF): Tipo de legitimación.
	if (have_rows('legitimacionListado', 'option')) {
		while (have_rows('legitimacionListado', 'option')) {
			the_row();

			// El encabezado se define según el valor seleccionado en el apartado
			// "Legitimación por".
			$encabezado = "";

			if (get_sub_field('legitimacionTipo') == 'consentimiento') {
				$encabezado = __('Legitimación por consentimiento del interesado', 'incognitos');

			} elseif (get_sub_field('legitimacionTipo') == 'contrato') {
				$encabezado = __('Legitimación por ejecución de un contrato', 'incognitos');

			} elseif (get_sub_field('legitimacionTipo') == 'interes') {
				$encabezado = __('Legitimación por Interés legítimo del Responsable, o de un tercero', 'incognitos');

			} elseif (get_sub_field('legitimacionTipo') == 'legal') {
				$encabezado = __('Legitimación por cumplimiento de una obligación legal', 'incognitos');

			} else {
				$encabezado = __('Legitimación por misión en Interés público o ejercicio de Poderes Públicos', 'incognitos');
			}

			$salida .= "<h4>$encabezado</h4>";

			// Campo Repeater (ACF): Legitimaciones.
			if (have_rows('legitimacion', 'option')) {
				while (have_rows('legitimacion', 'option')) {
					the_row();
					$title = get_sub_field('titulo');
					$desc  = get_sub_field('descripcion');

					$salida .= "
						<h5>$title</h5>
						$desc
					";
				}
			}
		}
	}

	return $salida;
}
add_shortcode('legal_rgpdLegitimacion', 'shortRgpdLegitimacion');

/**
 * Destinatarios.
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @var string $nombre	Campo "Nombre".
 * @var string $url		Campo "URL del sitio web...".
 * @var string $desc	Campo "Descripción".
 * @var string $salida	Texto que devolverá el Shortcode.
 * 
 * @return string [legal_rgpdDestinatarios]
 */
function shortRgpdDestinatarios() {
	$salida = "";

	// Campo Repeater (ACF).
	if (have_rows('destinatariosListado', 'option')) {
		while (have_rows('destinatariosListado', 'option')) {
			the_row();

			$nombre = get_sub_field('nombre');
			$url    = get_sub_field('url');
			$desc   = get_sub_field('descripcion');

			$salida .= "
				<p>Cualquier duda que pudiera tener el/la usuario/ria sobre la privacidad de sus datos, en relación al destinatario, deberá ser resuelta por éste/ta mismo/ma (el/la usuario/ria) accediendo a los textos legales proporcionados por éste (el destinatario). El/La responsable del sitio web contrata servicios que cumplen la legislación española y la europea y es por ello que no está obligado a resolver estas dudas.</p>
				<h4>$nombre</h4>
				<p><a href='$url' target='_blank' rel='noopener noreferrer'>
					$url
				</a></p>
				$desc
			";
		}
	}

	return $salida;
}
add_shortcode('legal_rgpdDestinatarios', 'shortRgpdDestinatarios');

/**
 * Derechos.
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @var string $encabezado	Campo "Derecho a".
 * @var string $desc		Campo "Descripción".
 * @var string $salida		Texto que devolverá el Shortcode.
 * 
 * @return string [legal_rgpdDerechos]
 */
function shortRgpdDerechos() {
	$salida = "";

	// Campo Repeater (ACF).
	if (have_rows('derechosListado', 'option')) {
		while (have_rows('derechosListado', 'option')) {
			the_row();

			$encabezado = "";
			$desc       = get_sub_field('descripcion');

			// El encabezado se define según el valor seleccionado en el apartado
			// "Derecho a".
			if (get_sub_field('derecho') == 'acceso') {
				$encabezado = __('Derecho a solicitar el acceso a los datos personales relativos al interesado', 'incognitos');

			} elseif (get_sub_field('derecho') == 'rectificacion') {
				$encabezado = __('Derecho a solicitar su rectificación o supresión', 'incognitos');

			} elseif (get_sub_field('derecho') == 'limitacion') {
				$encabezado = __('Derecho a solicitar la limitación de su tratamiento', 'incognitos');

			} elseif (get_sub_field('derecho') == 'oposicion') {
				$encabezado = __('Derecho a oponerse al tratamiento', 'incognitos');

			} else {
				$encabezado = __('Derecho a la portabilidad de los datos', 'incognitos');
			}

			$salida .= "
				<h4>$encabezado</h4>
				$desc
			";
		}
	}

	return $salida;
}
add_shortcode('legal_rgpdDerechos', 'shortRgpdDerechos');

/**
 * Procedencia.
 * Shortcode utilizado para devolver los datos del apartado.
 * 
 * @return string [legal_linksProcedencia]
 */
function shortLinksProcedencia() {
    return get_field('procedenciaDescripcion', 'option');
}
add_shortcode('legal_linksProcedencia', 'shortLinksProcedencia');