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
			{"data": "SEQ_MATRIZ_RIESGO", "name": "SEQ_MATRIZ_RIESGO"},
			{"data": "NOMBRE_MATRIZ", "name": "NOMBRE_MATRIZ"},
			{"data": "NOMBRE_MACRO_PROCESO", "name": "NOMBRE_MACRO_PROCESO"},
			{"data": "INICIALES_MACRO_PROCESO", "name": "INICIALES_MACRO_PROCESO"},
			{"data": "USR_ENCARGADO", "name": "USR_ENCARGADO"},
			{"data": "ACTIVO", "name": "ACTIVO"},
			{"data": "ACTIONS", "name": "ACTIONS", "width": "150px"}
		],
		"columnDefs": [
			{
				"targets": -1,
				"data": "ACTIONS",
				"render": function (data, type, full, meta) {
					var html = '';
					html += '<div class="btn-group btn-group-xs" role="group" aria-label="Acciones">';
					html += permisos["matriz_riesgo"].VER === 'S' ? '<a href="' + base_url + '#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-backdrop="static" data-url="' + base_url + 'matriz_riesgo/view/' + data + '" data-title="Detalles Matriz de Riesgo" data-btn="false"><span class="glyphicon glyphicon-eye-open"></span> Ver</a>' : '';
					html += permisos["matriz_riesgo"].EDITAR === 'S' ? '<a href="' + base_url + '#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-backdrop="static" data-url="' + base_url + 'matriz_riesgo/edit/' + data + '" data-title="Editar Matriz de Riesgo" data-btn="true" data-btn-title="Guardar"><span class="glyphicon glyphicon-pencil"></span> Editar</a>' : '';
					html += permisos["matriz_riesgo"].BORRAR === 'S' ? '<a href="' + base_url + '#" class="btn btn-default" data-toggle="modal" data-target="#modalView" data-backdrop="static" data-url="' + base_url + 'matriz_riesgo/delete/' + data + '" data-title="Borrar Matriz de Riesgo" data-btn="true"><span class="glyphicon glyphicon-remove"></span> Borrar</a>' : '';
					html += '</div>';
					return (type === 'display') ? html : data;
				},
				"orderable": false,
				"searcheable": false
			},
			{
				"targets": -2,
				"data": "ACTIVO",
				"render": function (data, type, full, meta) {
					var html = '';
					html += (data === 'S') ? 'Si' : 'No';
					return (type === 'display') ? html : data;
				}
			},
			{
				"targets": -3,
				"data": "USR_ENCARGADO",
				"render": function (data, type, full, meta) {
					var html = (full['NOMBRE_ENCARGADO'] === '') ? data : full['NOMBRE_ENCARGADO'];
					return html;
				}
			},
			{
				"targets": 1,
				"data": "NOMBRE_MATRIZ",
				"render": function (data, type, full, meta) {
					var html = data;
					if (permisos["riesgos"].VER === 'S' || permisos["matriz_riesgo/mapa_calor"].VER === 'S') {
						html += '<br/>';
						html += '<div class="btn-group btn-group-xs" role="group" aria-label="">';
						html += permisos["riesgos"].VER === 'S' ? '<a href="' + base_url + 'matriz_riesgo/' + full['SEQ_MATRIZ_RIESGO'] + '/riesgos" class="btn btn-default"><span class="glyphicon glyphicon-list"></span> Ver Riesgos</a>' : '';
						html += permisos["mapa_calor"].VER === 'S' ? '<a href="' + base_url + 'matriz_riesgo/' + full['SEQ_MATRIZ_RIESGO'] + '/mapa_calor" class="btn btn-default"><span class="glyphicon glyphicon-fire"></span> Mapas de Calor</a>' : '';
						html += '</div>';
					}
					return (type === 'display') ? html : data;
				}
			},
			{
				"targets": 2,
				"data": "NOMBRE_MACRO_PROCESO",
				"render": function (data, type, full, meta) {
					var html = full['INICIALES_MACRO_PROCESO'] + ' - ' + data;
					return html;
				}
			}
		],
		"language": {
			"url": base_url + "assets/datatable-style/lang/Spanish.json"
		}
	});
});