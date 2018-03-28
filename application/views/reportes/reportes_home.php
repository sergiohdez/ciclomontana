<div class="row">
    <div class="col-sm-12">
        <canvas id="visitas_ciudad" width="900" height="380"></canvas>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-sm-4 col-offset-sm-8">
<?php
$html = '';
$html .= form_open(base_url(uri_string()), array('id' => 'form-reportes', 'class' => 'form-horizontal'));
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
	'placeholder' => 'Cliente'
);
$html .= form_dropdown('id_cliente', $options_select, '', $select_config);
$html .= '</div>';
$html .= '</div>';
$html .= form_close();
echo $html;
?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <canvas id="cupos_cliente" width="900" height="380"></canvas>
    </div>
</div>
<script type="text/javascript">
var dataCiudades = [];
var dataVisitas = [];
<?php
foreach ($visitas_ciudad as $k => $e) {
    echo "dataCiudades[{$k}] = '{$e['NOM_CIUDAD']}';\n";
    echo "dataVisitas[{$k}] = '{$e['CANTIDAD']}';\n";
}
?>
var dataFechas = [];
var dataCupos = [];
<?php
foreach ($cupos_cliente as $k => $e) {
    echo "dataFechas[{$k}] = '{$e['FECHA']}';\n";
    echo "dataCupos[{$k}] = '{$e['CUPO_CLIENTE']}';\n";
}
?>
</script>