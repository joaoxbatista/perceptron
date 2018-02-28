<?php

include __DIR__  . '/vendor/autoload.php';

use App\Neuronio;

//Entradas
$entradas = [
	[-1, 0],
	[0, 1],
	[0, 0],
];

//Repostas esperadas
$respostas_esperadas = [-1, 1, 0];

$neuronio = new Neuronio(2);
$neuronio->treinamento($entradas, $respostas_esperadas);

?>

<html>
<header>
	<title>Percepton Simples</title>
	<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</header>

<body>
	<div class="container">
		<form method="post">
			<div class="row" style="margin-top: 20px;">
				<div class="col-md-12">
					<h3>Perceptron Simples</h3>
				</div>
			</div>
			<div class="row" style="margin-top: 10px;">

				<div class="form-group col-md-2">
					<input type="text" name="entrada1" class="form-control" placeholder="entrada x1">
				</div>

				<div class="form-group col-md-2">
					<input type="text" name="entrada2" class="form-control" placeholder="entrada x2">
				</div>

				<div class="col-md-2">
					<button class="btn btn-success" type="submit" name="calcuarSaida">
						Calcular saida
					</button>
				</div>
			</div>
		</form>

		<div class="row">
			<div class="col-md-12">
				<?php
					if(isset($_POST['calcuarSaida'])):
					
						$entrada = [$_POST['entrada1'], $_POST['entrada2']];
						$saida = $neuronio->classificar($entrada);
					
				?>
				<div class="alert alert-success">
					Com a entrada <?= $entrada[0] ?> e <?= $entrada[1] ?>,  o neurônio obteve o sinal  <?= $saida ?>
				</div>
				<?php
					endif;
				?>
			</div>
		</div>
	</div>
</body>
</html>