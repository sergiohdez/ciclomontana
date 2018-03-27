<p>
<a href="<?php echo base_url('#'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalView" data-backdrop="static" data-url="<?php echo base_url('visitas/create'); ?>" data-title="Nueva Visita" data-btn="true" data-btn-title="Guardar">Agregar Visita</a>
</p>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-condensed display" id="visitas-items">
        <thead>
            <tr>
                <th class="all">ID</th>
                <th class="all">Fecha</th>
                <th class="min-tablet-l">Vendedor</th>
                <th class="desktop">Valor Neto</th>
                <th class="desktop">Valor Visita</th>
                <th class="desktop">Cliente</th>
                <th class="none">Observaciones</th>
                <th class="all">Acciones</th>
            </tr>
        </thead>
    </table>
</div>