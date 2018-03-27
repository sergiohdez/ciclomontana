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
					html += '<a href="' + base_url + '#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-backdrop="static" data-url="' + base_url + 'matriz_riesgo/view/' + data + '" data-title="Detalles Matriz de Riesgo" data-btn="false"><span class="glyphicon glyphicon-eye-open"></span> Ver</a>';
					html += '<a href="' + base_url + '#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-backdrop="static" data-url="' + base_url + 'matriz_riesgo/edit/' + data + '" data-title="Editar Matriz de Riesgo" data-btn="true" data-btn-title="Guardar"><span class="glyphicon glyphicon-pencil"></span> Editar</a>';
					html += '<a href="' + base_url + '#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-backdrop="static" data-url="' + base_url + 'matriz_riesgo/delete/' + data + '" data-title="Borrar Matriz de Riesgo" data-btn="true"><span class="glyphicon glyphicon-remove"></span> Borrar</a>';
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