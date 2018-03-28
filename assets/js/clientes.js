$(document).ready(function () {
	$('#clientes-items').DataTable({
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"autoWidth": false,
		"ajax": {
			"url": base_url + "clientes/data",
			"type": "POST"
		},
		"columns": [
			{"data": "ID_CLIENTE", "name": "ID_CLIENTE"},
			{"data": "NIT", "name": "NIT"},
			{"data": "NOMBRE", "name": "NOMBRE"},
			{"data": "DIRECCION", "name": "DIRECCION"},
			{"data": "TELEFONO", "name": "TELEFONO"},
			{"data": "NOM_CIUDAD", "name": "NOM_CIUDAD"},
			{"data": "NOM_DEPARTAMENTO", "name": "NOM_DEPARTAMENTO"},
			{"data": "NOM_PAIS", "name": "NOM_PAIS"},
			{"data": "CUPO", "name": "CUPO"},
			{"data": "SALDO_CUPO", "name": "SALDO_CUPO"},
			{"data": "PORCENTAJE_VISITAS", "name": "PORCENTAJE_VISITAS"},
			{"data": "ACTIONS", "name": "ACTIONS", "width": "150px"}
		],
		"columnDefs": [
			{
				"targets": -1,
				"data": "ACTIONS",
				"render": function (data, type, full, meta) {
					var html = '';
					html += '<div class="btn-group btn-group-xs" role="group" aria-label="Acciones">';
					html += '<a href="' + base_url + '#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-backdrop="static" data-url="' + base_url + 'clientes/view/' + data + '" data-title="Detalles Cliente" data-btn="false">Ver</a>';
					html += '<a href="' + base_url + '#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-backdrop="static" data-url="' + base_url + 'clientes/edit/' + data + '" data-title="Editar Cliente" data-btn="true" data-btn-title="Guardar">Editar</a>';
					html += '<a href="' + base_url + '#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-backdrop="static" data-url="' + base_url + 'clientes/delete/' + data + '" data-title="Borrar Cliente" data-btn="true">Borrar</a>';
					html += '</div>';
					return (type === 'display') ? html : data;
				},
				"orderable": false,
				"searcheable": false
			},
			{
				"targets": 1,
				"data": "NIT",
				"render": function(data, type, full, meta) {
					var html = number_format(data, 0, ',', '.');
					return (type === 'display') ? html : data;
				}
			},
			{
				"targets": -4,
				"data": "CUPO",
				"render": function(data, type, full, meta) {
					var html = '$ ' + number_format(data, 0, ',', '.');
					return (type === 'display') ? html : data;
				}
			},
			{
				"targets": -3,
				"data": "SALDO_CUPO",
				"render": function(data, type, full, meta) {
					var html = '$ ' + number_format(data, 0, ',', '.');
					return (type === 'display') ? html : data;
				}
			},
			{
				"targets": -2,
				"data": "PORCENTAJE_VISITAS",
				"render": function(data, type, full, meta) {
					var html = data + ' %';
					return (type === 'display') ? html : data;
				}
			}
		],
		"language": {
			"url": base_url + "assets/datatable-style/lang/Spanish.json"
		}
	});
});

function getItems(type, id, selector) {
	var url = base_url + 'clientes/options_combo/' + type + '/' + id;
	$.get(url, function(data){
		$(selector).children('option:not(:first)').remove();
		$.each(JSON.parse(data), function(key, value){
			$(selector).append(
				$('<option></option>')
					.attr('value', value['COD_' + type.toUpperCase()])
					.text(value['NOM_' + type.toUpperCase()])
			);
		});
	}).fail(function (e) {
		var newHTML = parseXHR(e, 'Ocurrió un error al cargar la URL.');
		$('#modalView').find('#modalViewBody').prepend(newHTML);
	});
}