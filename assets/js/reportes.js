$(document).ready(function () {
    graficoVisitasCiudad(dataCiudades, dataVisitas);
    graficoCuposCliente(dataFechas, dataCupos);
    $('#id_cliente').on('change', function() {
        var url = base_url + 'reportes/cupos_cliente/' + $(this).val();
        $.get(url, function(data){
            dataFechas = [];
            dataCupos = [];
            $.each(JSON.parse(data), function(key, value){
                dataFechas[key] = value['FECHA'];
                dataCupos[key] = value['CUPO_CLIENTE'];
                graficoCuposCliente(dataFechas, dataCupos);
            });
        }).fail(function (e) {
            var newHTML = parseXHR(e, 'Ocurrió un error al cargar la URL.');
            $('#modalView').find('#modalViewBody').prepend(newHTML);
        });
    });
});

function graficoVisitasCiudad(dataCiudades, dataVisitas) {
    var ctx = document.getElementById('visitas_ciudad');
    var chartVisitasCiudades = new Chart(ctx, {
        type: 'bar',
        data: {
                labels: dataCiudades,
                datasets: [{
                    data: dataVisitas,
                    lineTension: 0,
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    borderWidth: 2,
                    pointBackgroundColor: '#007bff'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false
                        }
                    }]
                },
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: 'Visitas a Cliente por Ciudad'
                },
                responsive: true,
                maintainAspectRatio: true
            }
    });
}

function graficoCuposCliente(dataFechas, dataCupos) {
    var ctx = document.getElementById('cupos_cliente');
    var chartVisitasCiudades = new Chart(ctx, {
        type: 'line',
        data: {
                labels: dataFechas,
                datasets: [{
                    data: dataCupos,
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#ff007b',
                    borderWidth: 2,
                    pointBackgroundColor: '#ff007b'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false
                        }
                    }]
                },
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: 'Evolucion cupo del cliente'
                },
                responsive: true,
                maintainAspectRatio: true
            }
    });
}