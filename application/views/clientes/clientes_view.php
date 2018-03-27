<?php

$html = '';
if (count($registro) > 0) {
	$item = $registro[0];
	if (isset($type) && $type === 'html') {
		$html .= anchor(base_url('visitas'), "Regresar al listado", array('class' => 'btn btn-default'));
		$html .= '<hr/>';
	}
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>ID</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['ID_VISITA'] . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Fecha Visita</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['FECHA'] . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Vendedor</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['NOM_VENDEDOR'] . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Valor Neto</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['VALOR_NETO'] . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Valor Visita</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['VALOR_VISITA'] . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Cliente</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['NOMBRE'] . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Observaciones</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['OBSERVACIONES'] . '</div>';
	$html .= '</div>';
	if (isset($type) && $type === 'html') {
		$html .= '<hr/>';
		$html .= '<div class="row">';
		$html .= '<div class="col-sm-offset-2 col-sm-10">';
		$html .= anchor(base_url('visitas/edit/' . $item['ID_VISITA']), 'Editar', array('class' => 'btn btn-default'));
		$html .= str_repeat('&nbsp', 2);
		$html .= anchor(base_url('visitas/delete/' . $item['ID_VISITA']), 'Borrar', array('class' => 'btn btn-default'));
		$html .= '</div>';
		$html .= '</div>';
	}
}
echo $html;
