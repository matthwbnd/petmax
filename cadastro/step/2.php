<?php
	include_once '../../conexao.php';
	session_start();
	if (empty($_SESSION['rga'])) {
		header("Location: ../../perfil/");
	}

	if (!empty(filter_input(INPUT_POST, 'password')) && !empty(filter_input(INPUT_POST, 'confirm_password'))) {
		$p_pass = filter_input(INPUT_POST, 'password');
		$c_pass = filter_input(INPUT_POST, 'confirm_password');

		$p_pass = md5($p_pass);
		$c_pass = md5($c_pass);
	}

	if (!empty($p_pass) && !empty($c_pass)) {
		
		$sql = ("UPDATE pets_user SET password = :p_pass, confirm_password = :c_pass WHERE rga = :rga");
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':p_pass', $p_pass);
		$stmt->bindParam(':c_pass', $c_pass);
		$stmt->bindParam(':rga', $_SESSION['rga']);
		$stmt->execute();

		header('Location: 3');
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
		<!-- Script -->
		<script type="text/javascript" src="js/script.js"></script>

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
			<div class="alert alert-info">
				<span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
				<strong>Parabéns!</strong> Anote seu número de cadastro <u><b><?= $_SESSION['rga'] ?></b></u> (RGA) e escolha sua senha para seu próximo acesso.
			</div>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
				<div class="grid-container">
					<div class="grid-item"><label for="password" class="label-form">Escolha sua senha:</label></div>
					<div class="grid-item"><input type="password" id="password" name="password" required></div>
					<div class="grid-item"><label for="confirm_password" class="label-form">Repita a senha:</label></div>
					<div class="grid-item"><input type="password" id="confirm_password" name="confirm_password" required onkeyup="checkPass(); return false;">
					</div>
					<span id="confirmMessage" class="confirmMessage"></span>
					<div class="col-75">
						<input type="reset" class="btn btn-white" value="Limpar">
				  		<input type="submit" id="send" class="btn btn-blue" value="Salvar">
					</div> 
				</div>
			</form>
		</div>
		<!-- Fim do conteúdo -->
		<footer style="position: absolute; bottom: 0;">
			<p>&copy; <?= date("Y");?> - PetMax</p>
			<p>Todos os direitos reservados.</p>
		</footer>
	</body>
</html>