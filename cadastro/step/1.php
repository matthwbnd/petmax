<?php
	include_once '../../conexao.php';

	if (isset($_SESSION['rga'])) {
		header('Location: 2');
	}

	$rga = filter_input(INPUT_POST, 'rga');
	$name = filter_input(INPUT_POST, 'petname');
	$type = filter_input(INPUT_POST, 'pettype');
	$line = filter_input(INPUT_POST, 'petlineage');
	$date = filter_input(INPUT_POST, 'petdate');
	$color = filter_input(INPUT_POST, 'petcolor');
	$size = filter_input(INPUT_POST, 'petsize');

	$sql = ("SELECT rga FROM pets_profile WHERE rga = '".$rga."'");
	$res = $conn->prepare($sql);
	$res->execute();
	$row = $res->rowCount();

	if ($row != 0) {
		$rga = rand(10000, 99999);
	}

	if (!empty($rga) && !empty($name) && !empty($type) && !empty($line) && !empty($date) && !empty($color) && !empty($size)) {
		$stmt = $conn->prepare("INSERT INTO pets_profile (rga, pet_name, pet_type, pet_line, pet_date, pet_color, pet_size) VALUES (:rga, :pet_name, :pet_type, :pet_line, :pet_date, :pet_color, :pet_size)");
		$stmt->bindParam(':rga', $rga);
		$stmt->bindParam(':pet_name', $name);
		$stmt->bindParam(':pet_type', $type);
		$stmt->bindParam(':pet_line', $line);
		$stmt->bindParam(':pet_date', $date);
		$stmt->bindParam(':pet_color', $color);
		$stmt->bindParam(':pet_size', $size);

		$stmt->execute();

		$pet_user = $conn->prepare("INSERT INTO pets_user (rga) VALUES (:rga)");
		$pet_user->bindParam(':rga', $rga);
		$pet_user->execute();

		session_start();
		$_SESSION["rga"] = $rga;

		header('Location: 2');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PetMax</title>
		<!-- Ícone do site -->
		<link href="../../img/icone.png" rel="icon">
		<!-- Estilo -->
		<link rel="stylesheet" href="../../css/estilo.css">
		<!-- Fonts Awesome -->
		<link rel="stylesheet" href="../../css/font-awesome.css">

		<script src="../../js/jquery.min.js"></script>

		<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery("#status").fadeOut();
			jQuery("#preloader").delay(1).fadeOut("fast");
		});
		</script>
	</head>
	<body>
		<div id="preloader">
			<div id="status">
				<img src="../../img/cat.svg">
			</div>
		</div>
		<!-- Menu do site -->
		<nav>
			<img src="../../img/logo-light.png" alt="Logo da PetMax">
			<label for="toggle" class="hamburger"><i class="fa fa-bars"></i></label>
			<input type="checkbox" id="toggle">
			<div class="menu-content">
				<ul>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="../../">Inicio</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="../../perfil/">Perfil</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="#">Cadastro</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="../../contato">Contato</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="../../historia">Nossa Historia</a></li>
				</ul>
			</div>
		</nav>
		<!-- Fim do menu -->
		<!-- Conteúdo do website -->
		<div class="container">
			<form action="<?= $_SERVER["PHP_SELF"];?>" method="post">
				<input type="hidden" name="rga" value="<?= rand(10000, 99999) ?>">
				<div class="grid-container">
				  <div class="grid-item"><label for="petname" class="label-form">Nome do Pet:</label></div>
				  <div class="grid-item"><input type="text" id="petname" name="petname" autofocus required></div>
				  <div class="grid-item"><label for="pettype" class="label-form">Tipo de Pet:</label></div>  
				  <div class="grid-item">
				  	<select name="pettype" id="pettype" required>
				  		<option value="ave">Ave</option>
				  		<option value="cachorro">Cachorro</option>
				  		<option value="gato">Gato</option>
				  		<option value="peixe">Peixe</option>
				  		<option value="reptil">Réptil</option>
				  		<option value="roedor">Roedor</option>
				  	</select>
				  </div> 
				  <div class="grid-item"><label for="petlineage" class="label-form">Linhagem:</label></div>
				  <div class="grid-item"><input type="text" id="petlineage" name="petlineage" required></div>
				  <div class="grid-item"><label for="petdate" class="label-form">Nascimento:</label></div>
				  <div class="grid-item"><input type="date" id="petdate" name="petdate" required></div> 
				  <div class="grid-item"><label for="petcolor" class="label-form">Cor do Pet:</label></div>
				  <div class="grid-item"><input type="color" id="petcolor" name="petcolor" required></div>
				  <div class="grid-item"><label for="petsize" class="label-form">Porte:</label></div>
				  <div class="grid-item">
				  	<select name="petsize" id="petsize" required>
				  		<option value="pequeno">Pequeno</option>
				  		<option value="mediano">Mediano</option>
				  		<option value="grande">Grande</option>
				  	</select>
				  </div>
				  <div class="col-75">
				  	<input type="reset" class="btn btn-white" value="Limpar">
				  	<input type="submit" class="btn btn-blue" value="Continuar"> 
				  </div>
				</div>
			</form>
		</div>
		<br><br><br><br><br><br>
		<!-- Fim do conteúdo -->
		<footer style="position: relative;">
			<p>&copy; <?= date("Y");?> - PetMax</p>
			<p>Todos os direitos reservados.</p>
		</footer>
	</body>
</html>