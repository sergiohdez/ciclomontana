		<?php $ruta = explode('/', uri_string()); ?>
		<header>
			<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-info">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menutienda" aria-controls="menutienda" aria-expanded="false" aria-label="Mostrar menú">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="menutienda">
					<a class="navbar-brand" href="<?php echo base_url(); ?>">Tienda Ciclo Monta&ntilde;a</a>
					<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
						<li class="nav-item <?php echo $ruta[0] === '' ? 'active' : ''; ?>">
							<a class="nav-link" href="<?php echo base_url(); ?>">Inicio</a>
						</li>
						<li class="nav-item <?php echo $ruta[0] === 'visitas' ? 'active' : ''; ?>">
							<a class="nav-link" href="<?php echo base_url('visitas'); ?>">Visitas</a>
						</li>
						<li class="nav-item <?php echo $ruta[0] === 'clientes' ? 'active' : ''; ?>">
							<a class="nav-link" href="<?php echo base_url('clientes'); ?>">Clientes</a>
						</li>
						<li class="nav-item <?php echo $ruta[0] === 'reportes' ? 'active' : ''; ?>">
							<a class="nav-link" href="<?php echo base_url('reportes'); ?>">Reportes</a>
						</li>
					</ul>
				</div>
			</nav>
		</header>