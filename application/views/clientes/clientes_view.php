<?php

$html = '';
if (count($registro) > 0) {
	$item = $registro[0];
	if (isset($type) && $type === 'html') {
		$html .= anchor(base_url('clientes'), "Regresar al listado", array('class' => 'btn btn-outline-secondary'));
		$html .= '<hr/>';
	}
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>ID</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['ID_CLIENTE'] . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>NIT</strong></div>';
	$html .= '<div class="col-sm-9">' . number_format($item['NIT'], 0, ',', '.') . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Nombre</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['NOMBRE'] . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Direcci&oacute;n</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['DIRECCION'] . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Tel&eacute;fono</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['TELEFONO'] . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Ciudad</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['NOM_CIUDAD'] . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Departamento</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['NOM_DEPARTAMENTO'] . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Pa&iacute;s</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['NOM_PAIS'] . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Cupo</strong></div>';
	$html .= '<div class="col-sm-9">$ ' . number_format(doubleval($item['CUPO']), 0, ',', '.') . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Saldo Cupo</strong></div>';
	$html .= '<div class="col-sm-9">$ ' . number_format(doubleval($item['SALDO_CUPO']), 0, ',', '.') . '</div>';
	$html .= '</div>';
	$html .= '<hr/>';
	$html .= '<div class="row">';
	$html .= '<div class="col-sm-3"><strong>Porcentaje Visitas</strong></div>';
	$html .= '<div class="col-sm-9">' . $item['PORCENTAJE_VISITAS'] . ' %</div>';
	$html .= '</div>';
	if (isset($type) && $type === 'html') {
		$html .= '<hr/>';
		$html .= '<div class="row">';
		$html .= '<div class="col-sm-offset-2 col-sm-10">';
		$html .= anchor(base_url('clientes/edit/' . $item['ID_CLIENTE']), 'Editar', array('class' => 'btn btn-primary'));
		$html .= str_repeat('&nbsp', 2);
		$html .= anchor(base_url('clientes/delete/' . $item['ID_CLIENTE']), 'Borrar', array('class' => 'btn btn-danger'));
		$html .= '</div>';
		$html .= '</div>';
	}
}
echo $html;
