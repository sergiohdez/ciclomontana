<?php

$html = '';

$form_errors = validation_errors();
if (!empty($form_errors)) {
	$html .= '<div class="alert alert-danger" role="alert">';
	$html .= $form_errors;
	$html .= '</div>';
}
$html .= form_open(base_url(uri_string()), array('id' => 'form-visitas', 'class' => 'form-horizontal'));
$html .= form_hidden('id_visita', $id_visita);
$html .= '<p>¿Est&aacute; seguro de borrar el registro?</p>';
if (isset($type) && $type === 'html') {
	$html .= '<div class="form-group row">';
	$html .= '<div class="col-sm-10">';
	$html .= form_button(array('id' => 'btn-visita', 'type' => 'submit'), "Borrar", array('class' => 'btn btn-danger'));
	$html .= str_repeat('&nbsp;', 2);
	$html .= anchor(base_url('visitas'), "Regresar al listado", array('class' => 'btn btn-outline-secondary'));
	$html .= '</div>';
	$html .= '</div>';
}
$html .= form_close();

echo $html;
