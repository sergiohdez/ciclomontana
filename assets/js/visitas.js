$(document).ready(function () {
	$('#visitas-items').DataTable({
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"autoWidth": false,
		"ajax": {
			"url": base_url + "visitas/data",
			"type": "POST"
		},
		"columns": [
			{"data": "ID_VISITA", "name": "ID_VISITA"},
			{"data": "FECHA", "name": "FECHA"},
			{"data": "NOM_VENDEDOR", "name": "NOM_VENDEDOR"},
			{"data": "VALOR_NETO", "name": "VALOR_NETO"},
			{"data": "VALOR_VISITA", "name": "VALOR_VISITA"},
			{"data": "NOMBRE", "name": "NOMBRE"},
			{"data": "OBSERVACIONES", "name": "OBSERVACIONES"},
			{"data": "ACTIONS", "name": "ACTIONS", "width": "150px"}
		],
		"columnDefs": [
			{
				"targets": -1,
				"data": "ACTIONS",
				"render": function (data, type, full, meta) {
					var html = '';
					html += '<div class="btn-group btn-group-xs" role="group" aria-label="Acciones">';
					html += '<a href="' + base_url + '#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-backdrop="static" data-url="' + base_url + 'visitas/view/' + data + '" data-title="Detalles Visita" data-btn="false">Ver</a>';
					html += '<a href="' + base_url + '#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-backdrop="static" data-url="' + base_url + 'visitas/edit/' + data + '" data-title="Editar Visita" data-btn="true" data-btn-title="Guardar">Editar</a>';
					html += '<a href="' + base_url + '#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-backdrop="static" data-url="' + base_url + 'visitas/delete/' + data + '" data-title="Borrar Visita" data-btn="true">Borrar</a>';
					html += '</div>';
					return (type === 'display') ? html : data;
				},
				"orderable": false,
				"searcheable": false
			}
		],
		"language": {
			"url": base_url + "assets/datatable-style/lang/Spanish.json"
		}
	});
});