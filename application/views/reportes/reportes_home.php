<canvas id="visitas_ciudades" width="900" height="380"></canvas>
<script type="text/javascript">
var dataCiudades = [];
var dataVisitas = [];
<?php
foreach ($visitas_ciudad as $k => $e) {
    echo "dataCiudades[{$k}] = '{$e['NOM_CIUDAD']}';\n";
    echo "dataVisitas[{$k}] = '{$e['CANTIDAD']}';\n";
}
?>
var ctx = document.getElementById('visitas_ciudades');
var chartVisitasCiudades = new Chart(ctx, {
    type: 'bar',
    data: {
            labels: dataCiudades,
            datasets: [{
                data: dataVisitas,
                lineTension: 0,
                backgroundColor: 'transparent',
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
</script>