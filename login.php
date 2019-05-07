<?php
	include_once 'conexao.php';
	session_start();

	if (!empty($_SESSION['rga'])) {
		$stmt = $conn->query("SELECT * FROM pets_profile WHERE rga = ".$_SESSION['rga']);
		$user = $stmt->fetch();
	}

	$message = "";
	$alert = "";

	if ((!empty(filter_input(INPUT_POST, 'rga'))) && (!empty(filter_input(INPUT_POST, 'password')))) {
		$rga = filter_input(INPUT_POST, 'rga');
		$password = filter_input(INPUT_POST, 'password');
		$password = md5($password);

		$sql = ("SELECT rga, password FROM pets_user WHERE rga = '".$rga."' AND password = '".$password."'");
		$res = $conn->prepare($sql);
		$res->execute();
		$count = $res->rowCount();

		if ($count == 1) {
			session_start();
			$_SESSION['rga'] = $rga;
			header('Location: perfil/');
		}else{
			$message = "Verifique seu usuário ou senha!";
			$alert = "alert-danger";
		}
	}else{
		$message = "Preencha os campos abaixo";
		$alert = "alert-info";
	}
?>
<!DOCTYPE html>
<!-- Este site foi desenvolvido em Mobile First -->
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PetMax</title>
		<!-- Ícone do site -->
		<link href="img/icone.png" rel="icon">
		<!-- Estilo -->
		<link rel="stylesheet" href="css/estilo.css">
		<!-- Fonts Awesome -->
		<link rel="stylesheet" href="css/font-awesome.css">

		<script src="js/jquery.min.js"></script>

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
				<img src="img/cat.svg">
			</div>
		</div>
		<!-- Menu do site -->
		<nav>
			<img src="img/logo-light.png" alt="Logo da PetMax">
			<label for="toggle" class="hamburger"><i class="fa fa-bars"></i></label>
			<input type="checkbox" id="toggle">
			<div class="menu-content">
				<ul>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="/">Inicio</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="perfil">Perfil</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="cadastro">Cadastro</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="contato">Contato</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="historia">Nossa Historia</a></li>
				</ul>
			</div>
		</nav>
		<!-- Fim do menu -->
		<!-- Conteúdo do website -->
		<div class="container">
			<?php if (isset($message)): ?>
				<div class="alert <?= $alert?>">
					<span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
					<strong>Atenção!</strong> <?= $message ?>
				</div>
			<?php endif ?>
			<form action="<?=$_SERVER["PHP_SELF"];?>" method="post">
				<div class="grid-container-2">
					<div class="grid-item"><label for="rga" class="label-form">RGA:</label></div>
					<div class="grid-item"><input type="text" id="rga" name="rga" required></div>
					<div class="grid-item"><label for="password" class="label-form">SENHA:</label></div>
					<div class="grid-item"><input type="password" id="password" name="password" required></div>
					<div class="griditem">
						<input type="reset" class="btn btn-white" value="Limpar">
				  		<input type="submit" class="btn btn-blue" value="Entrar">
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