<?php

/*
| ------------------------------------------------------------------------------
| Extracto: Contador de Carecteres
| ------------------------------------------------------------------------------
| Insertar un contador/limitador de caracteres en los extractos.
| https://premium.wpmudev.org/blog/character-counter-excerpt-box/ (adaptado)
|
*/

function extractoContador(){
	echo '<script>jQuery(document).ready(function(){
	jQuery("#postexcerpt .handlediv").after("<div style=\"position:absolute;top:12px;right:34px;color:#666;\"><span id=\"excerpt_counter\"></span><span style=\"font-weight:bold; padding-left:7px;\">/ 156</span></div>"); jQuery("span#excerpt_counter").text(jQuery("#excerpt").val().length);jQuery("#excerpt").keyup( function(){ if(jQuery(this).val().length > 156){ jQuery(this).val(jQuery(this).val().substr(0, 156));}jQuery("span#excerpt_counter").text(jQuery("#excerpt").val().length);});});</script>';
}
add_action('admin_footer-post.php', 'extractoContador');
add_action('admin_footer-post-new.php', 'extractoContador');