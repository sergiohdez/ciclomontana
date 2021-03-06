<?php
$html = '';
$form_errors = validation_errors();
if (!empty($form_errors)) {
	$html .= '<div class="alert alert-danger" role="alert">';
	$html .= $form_errors;
	$html .= '</div>';
}
$html .= form_open(base_url(uri_string()), array('id' => 'form-visitas', 'class' => 'form-horizontal'));
$html .= form_hidden('id_visita', $default['id_visita']);
$html .= '<div class="form-group row">';
$html .= form_label('Fecha Visita', 'fecha', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
$html .= '<div class="input-group date">';
$input_conf = array(
	'maxlength' => '10',
	'class' => 'form-control',
	'required' => 'required',
	'placeholder' => '__/__/____',
	'readonly' => 'readonly',
	'data-rule-required' => 'true',
	'data-msg-required' => 'El campo es requerido'
);
$html .= form_input(array('id' => 'fecha', 'name' => 'fecha'), set_value('fecha', $default['fecha'], TRUE), $input_conf);
$html .= '<div class="input-group-addon input-group-append"><span class="input-group-text">Cal</span></div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="form-group row">';
$html .= form_label('Vendedor', 'cod_vendedor', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
$options_select = array('' => '- Seleccione -');
foreach ($vendedores as $e) {
	$options_select[$e['COD_VENDEDOR']] = $e['NOM_VENDEDOR'];
}
$select_config = array(
	'id' => 'cod_vendedor',
	'class' => 'form-control',
	'required' => 'required',
	'placeholder' => 'Vendedor',
	'data-rule-required' => 'true',
	'data-msg-required' => 'El campo es requerido'
);
$html .= form_dropdown('cod_vendedor', $options_select, $default['cod_vendedor'], $select_config);
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="form-group row">';
$html .= form_label('Cliente', 'id_cliente', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
$options_select = array('' => '- Seleccione -');
foreach ($clientes as $e) {
	$options_select[$e['ID_CLIENTE']] = $e['NOMBRE'];
}
$select_config = array(
	'id' => 'id_cliente',
	'class' => 'form-control',
	'required' => 'required',
	'placeholder' => 'Cliente',
	'data-rule-required' => 'true',
	'data-msg-required' => 'El campo es requerido'
);
$html .= form_dropdown('id_cliente', $options_select, $default['id_cliente'], $select_config);
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="form-group row">';
$html .= form_label('Valor Neto', 'valor_neto', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
// $html .= '<div class="input-group">';
$input_config = array(
	'maxlength' => '15',
	'class' => 'form-control',
	'required' => 'required',
	'placeholder' => 'Valor Neto',
	'data-rule-required' => 'true',
	'data-msg-required' => 'El campo es requerido',
	'data-rule-number' => 'true',
    'data-msg-number' => 'El campo debe ser numérico',
    'data-rule-min' => '1',
    'data-msg-min' => 'El campo debe ser mayor igual a 1'
);
$html .= form_input(array('id' => 'valor_neto', 'name' => 'valor_neto'), set_value('valor_neto', $default['valor_neto'], TRUE), $input_config);
// $html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="form-group row">';
$html .= form_label('Observaciones', 'observaciones', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
$input_config = array(
	'maxlength' => '1000',
	'class' => 'form-control',
	'placeholder' => 'Observaciones',
);
$html .= form_textarea(array('rows' => '4', 'id' => 'observaciones', 'name' => 'observaciones'), set_value('observaciones', $default['observaciones'], TRUE), $input_config);
$html .= '</div>';
$html .= '</div>';
if (isset($type) && $type === 'html') {
	$html .= '<div class="form-group row">';
	$html .= '<div class="col-sm-offset-2 col-sm-10">';
	$html .= form_button(array('id' => 'btn-visita', 'type' => 'submit'), "Guardar", array('class' => 'btn btn-primary'));
	$html .= str_repeat('&nbsp;', 2);
	$html .= anchor(base_url('visitas'), "Regresar al listado", array('class' => 'btn btn-outline-secondary'));
	$html .= '</div>';
	$html .= '</div>';
}
$html .= form_close();

echo $html;

$script = '';
$script .= '<script type="text/javascript">';
$script .= '$(\'.input-group.date\').datepicker({';
$script .= '	daysOfWeekDisabled: "0,6",';
$script .= '	clearBtn: true';
$script .= '});';
$script .= '$(\'.input-group.date\').on(\'show\',function(e){ e.stopPropagation() });';
$script .= 'var validVisitas = $("#form-visitas").validate({';
$script .= '	ignore: ".ignore,.ignore:hidden",';
$script .= '	errorPlacement: function(error, element) {';
$script .= '	    if (element.attr("name") == "fecha" )';
$script .= '	        error.insertAfter(".input-group.date");';
$script .= '	    else';
$script .= '	        error.insertAfter(element);';
$script .= '	}';
$script .= '});';
$script .= '$(\'[data-toggle="popover"]\').popover({container:\'body\', html: true});';
$script .= '</script>';
echo $script;
