<!doctype html>
<html lang="es">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

		<title>
            <?php echo isset($title) ? $title .  ' - ': ''; ?>Tienda Ciclo Monta&ntilde;a
		</title>

		<link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>" >
		<?php echo isset($styles) ? $styles : ''; ?>
	</head>

	<body>
        <?php echo isset($header) ? $header : ''; ?>
        <main role="main" class="container">
			<?php echo isset($title) ? '<h2>' . $title . '</h2>' : ''; ?>
            <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
			<?php
			if (isset($success) && !is_null($success)) {
				echo '<div class="alert alert-success alert-dismissible fade in" role="alert">';
				echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
				echo '<span aria-hidden="true">&times;</span>';
				echo '</button>' . $success . '</div>';
			}
			if (isset($errors) && !is_null($errors)) {
				echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">';
				echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
				echo '<span aria-hidden="true">&times;</span>';
				echo '</button>' . $errors . '</div>';
			}
			?>
            <?php echo isset($content) ? $content : ''; ?>
        </main>
		
		<!-- Ventana modal para uso de crear/ver/editar/borrar -->
		<div class="modal fade" id="modalView" role="dialog" aria-labelledby="ActionsModalView">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalViewTitle"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="modalViewBody">
						Cargando...
					</div>
					<div class="modal-footer" id="modalViewBtn" style="display: none;">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-primary" id="modalViewBtnAccept">Aceptar</button>
					</div>
				</div>
			</div>
		</div>
        <?php echo isset($footer) ? $footer : ''; ?>
		<?php echo script_tag('assets/js/app.js'); ?>
		<script type="text/javascript">
		var base_url = '<?php echo base_url(); ?>';
		</script>
        <?php echo isset($scripts) ? $scripts : ''; ?>
    </body>
</html>