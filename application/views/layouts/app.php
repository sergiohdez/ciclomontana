<!doctype html>
<html lang="es">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

		<title>
            <?php echo isset($title) ? $title .  ' - ': ''; ?>
            Tienda Ciclo Monta&ntilde;a
		</title>

		<style type="text/css">
		/* Sticky footer styles
		-------------------------------------------------- */
		html {
			position: relative;
			min-height: 100%;
		}
		body {
			/* Margin bottom by footer height */
			margin-bottom: 60px;
		}
		.footer {
			position: absolute;
			bottom: 0;
			width: 100%;
			/* Set the fixed height of the footer here */
			height: 60px;
			line-height: 60px; /* Vertically center the text there */
			background-color: #f5f5f5;
		}
		body > .container {
			padding: 60px 15px 0;
		}
		.footer > .container {
			padding-right: 15px;
			padding-left: 15px;
		}
		code {
			font-size: 80%;
		}
		</style>
	</head>

	<body>
        <?php echo isset($header) ? $header : ''; ?>
        <main role="main" class="container">
            <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            <?php echo isset($content) ? $content : ''; ?>
        </main>
        <?php echo isset($footer) ? $footer : ''; ?>
        <?php echo isset($scripts) ? $scripts : ''; ?>
    </body>
</html>