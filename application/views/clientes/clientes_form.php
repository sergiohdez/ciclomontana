<?php
$html = '';
$form_errors = validation_errors();
if (!empty($form_errors)) {
	$html .= '<div class="alert alert-danger" role="alert">';
	$html .= $form_errors;
	$html .= '</div>';
}
$html .= form_open(base_url(uri_string()), array('id' => 'form-clientes', 'class' => 'form-horizontal'));
$html .= form_hidden('id_cliente', $default['id_cliente']);
$html .= '<div class="form-group row">';
$html .= form_label('NIT', 'nit', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
$input_config = array(
	'maxlength' => '10',
	'class' => 'form-control',
	'required' => 'required',
	'placeholder' => 'NIT',
	'data-rule-required' => 'true',
	'data-msg-required' => 'El campo es requerido',
	'data-rule-numeric' => 'true',
	'data-msg-numeric' => 'El campo es numérico',
    'data-rule-min' => '1',
    'data-msg-min' => 'El campo debe ser mayor igual a 1'
);
$html .= form_input(array('id' => 'nit', 'name' => 'nit'), set_value('nit', $default['nit'], TRUE), $input_config);
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="form-group row">';
$html .= form_label('Nombre', 'nombre', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
$input_config = array(
	'maxlength' => '250',
	'class' => 'form-control',
	'required' => 'required',
	'placeholder' => 'Nombre',
	'data-rule-required' => 'true',
	'data-msg-required' => 'El campo es requerido'
);
$html .= form_input(array('id' => 'nombre', 'name' => 'nombre'), set_value('nombre', $default['nombre'], TRUE), $input_config);
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="form-group row">';
$html .= form_label('Direcci&oacute;n', 'direccion', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
$input_config = array(
	'maxlength' => '250',
	'class' => 'form-control',
	'required' => 'required',
	'placeholder' => 'Direcci&oacute;n',
	'data-rule-required' => 'true',
	'data-msg-required' => 'El campo es requerido'
);
$html .= form_input(array('id' => 'direccion', 'name' => 'direccion'), set_value('direccion', $default['direccion'], TRUE), $input_config);
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="form-group row">';
$html .= form_label('Tel&eacute;fono', 'telefono', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
$input_config = array(
	'maxlength' => '20',
	'class' => 'form-control',
	'required' => 'required',
	'placeholder' => 'Tel&eacute;fono',
	'data-rule-required' => 'true',
	'data-msg-required' => 'El campo es requerido',
	'data-rule-numeric' => 'true',
	'data-msg-numeric' => 'El campo es numérico',
    'data-rule-min' => '1',
    'data-msg-min' => 'El campo debe ser mayor igual a 1'
);
$html .= form_input(array('id' => 'telefono', 'name' => 'telefono'), set_value('telefono', $default['telefono'], TRUE), $input_config);
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="form-group row">';
$html .= form_label('Pa&iacute;s', 'cod_pais', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
$options_select = array('' => '- Seleccione -');
foreach ($paises as $e) {
	$options_select[$e['COD_PAIS']] = $e['NOM_PAIS'];
}
$select_config = array(
	'id' => 'cod_pais',
	'class' => 'form-control',
	'required' => 'required',
	'placeholder' => 'Pa&iacute;s',
	'data-rule-required' => 'true',
	'data-msg-required' => 'El campo es requerido'
);
$html .= form_dropdown('cod_pais', $options_select, $default['cod_pais'], $select_config);
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="form-group row">';
$html .= form_label('Departamento', 'cod_departamento', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
$options_select = array('' => '- Seleccione -');
if (empty($default['cod_departamento']) === FALSE) {
	foreach ($departamentos as $e) {
		$options_select[$e['COD_DEPARTAMENTO']] = $e['NOM_DEPARTAMENTO'];
	}
}
$select_config = array(
	'id' => 'cod_departamento',
	'class' => 'form-control',
	'required' => 'required',
	'placeholder' => 'Departamento',
	'data-rule-required' => 'true',
	'data-msg-required' => 'El campo es requerido'
);
$html .= form_dropdown('cod_departamento', $options_select, $default['cod_departamento'], $select_config);
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="form-group row">';
$html .= form_label('Ciudad', 'cod_ciudad', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
$options_select = array('' => '- Seleccione -');
if (empty($default['cod_ciudad']) === FALSE) {
	foreach ($ciudades as $e) {
		$options_select[$e['COD_CIUDAD']] = $e['NOM_CIUDAD'];
	}
}
$select_config = array(
	'id' => 'cod_ciudad',
	'class' => 'form-control',
	'required' => 'required',
	'placeholder' => 'Ciudad',
	'data-rule-required' => 'true',
	'data-msg-required' => 'El campo es requerido'
);
$html .= form_dropdown('cod_ciudad', $options_select, $default['cod_ciudad'], $select_config);
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="form-group row">';
$html .= form_label('Cupo', 'cupo', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
$input_config = array(
	'maxlength' => '8',
	'class' => 'form-control',
	'required' => 'required',
	'placeholder' => 'Cupo',
	'data-rule-required' => 'true',
	'data-msg-required' => 'El campo es requerido',
	'data-rule-number' => 'true',
    'data-msg-number' => 'El campo debe ser numérico',
    'data-rule-min' => (empty($default['cupo']) ? '1' : $default['saldo_cupo']),
    'data-msg-min' => 'El campo debe ser mayor igual a 1'
);
$html .= form_input(array('id' => 'cupo', 'name' => 'cupo'), set_value('cupo', $default['cupo'], TRUE), $input_config);
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="form-group row">';
$html .= form_label('Saldo Cupo', 'saldo_cupo', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
$input_config = array(
	'maxlength' => '8',
	'class' => 'form-control',
	'required' => 'required',
	'placeholder' => 'Saldo Cupo',
	'data-rule-required' => 'true',
	'data-msg-required' => 'El campo es requerido',
	'readonly' => 'readonly'
);
$html .= form_input(array('id' => 'saldo_cupo', 'name' => 'saldo_cupo'), set_value('saldo_cupo', $default['saldo_cupo'], TRUE), $input_config);
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="form-group row">';
$html .= form_label('Porcentaje Visitas', 'porcentaje_visitas', array('class' => 'col-sm-3 col-form-label'));
$html .= '<div class="col-sm-9">';
$input_config = array(
	'maxlength' => '3',
	'class' => 'form-control',
	'required' => 'required',
	'placeholder' => 'Porcentaje Visitas',
	'data-rule-required' => 'true',
	'data-msg-required' => 'El campo es requerido',
	'data-rule-number' => 'true',
    'data-msg-number' => 'El campo debe ser numérico',
    'data-rule-range' => '[1,100]',
    'data-msg-range' => 'El campo debe estar entre 1 y 100'
);
$html .= form_input(array('id' => 'porcentaje_visitas', 'name' => 'porcentaje_visitas'), set_value('porcentaje_visitas', $default['porcentaje_visitas'], TRUE), $input_config);
$html .= '</div>';
$html .= '</div>';
if (isset($type) && $type === 'html') {
	$html .= '<div class="form-group row">';
	$html .= '<div class="col-sm-offset-2 col-sm-10">';
	$html .= form_button(array('id' => 'btn-cliente', 'type' => 'submit'), "Guardar", array('class' => 'btn btn-primary'));
	$html .= str_repeat('&nbsp;', 2);
	$html .= anchor(base_url('clientes'), "Regresar al listado", array('class' => 'btn btn-outline-secondary'));
	$html .= '</div>';
	$html .= '</div>';
}
$html .= form_close();

echo $html;

$script = '';
$script .= '<script type="text/javascript">';
$script .= 'var validClientes = $("#form-clientes").validate({';
$script .= '	ignore: ".ignore,.ignore:hidden",';
$script .= '	errorPlacement: function(error, element) {';
$script .= '	    if (element.attr("name") == "fecha" )';
$script .= '	        error.insertAfter(".input-group.date");';
$script .= '	    else';
$script .= '	        error.insertAfter(element);';
$script .= '	}';
$script .= '});';
$script .= '$(\'[data-toggle="popover"]\').popover({container:\'body\', html: true});';
if (empty($default['cupo']) === TRUE) {
	$script .= '$(\'#form-clientes #cupo\').on(\'keyup\', function() {';
	$script .= '	$(\'#form-clientes #saldo_cupo\').val($(this).val());';
	$script .= '});';
}
$script .= '</script>';
echo $script;
