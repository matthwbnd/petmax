<?php
	include_once '../../conexao.php';
	session_start();

	if (empty($_SESSION['rga'])) {
		header('Location: 1');
	}

	$name = filter_input(INPUT_POST, 'name');
	$cpf = filter_input(INPUT_POST, 'cpf');
	$email = filter_input(INPUT_POST, 'email');
	$tel = filter_input(INPUT_POST, 'tel');

	if (!empty($name) && !empty($cpf) && !empty($email) && !empty($tel)) {
		
		$sql = ("INSERT INTO pets_owner (rga, owner_name, owner_cpf, owner_email, owner_tel) VALUES (:rga, :name, :cpf, :email, :tel)");
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':rga', $_SESSION['rga']);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':cpf', $cpf);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':tel', $tel);
		$stmt->execute();

		header('Location: ../../perfil');
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

		<script type="text/javascript">
			function fMasc(objeto,mascara) {
				obj=objeto
				masc=mascara
				setTimeout("fMascEx()",1)
			}
			function fMascEx() {
				obj.value=masc(obj.value)
			}
			function mTel(tel) {
				tel=tel.replace(/\D/g,"")
				tel=tel.replace(/^(\d)/,"($1")
				tel=tel.replace(/(.{3})(\d)/,"$1)$2")
				if(tel.length == 9) {
					tel=tel.replace(/(.{1})$/,"-$1")
				} else if (tel.length == 10) {
					tel=tel.replace(/(.{2})$/,"-$1")
				} else if (tel.length == 11) {
					tel=tel.replace(/(.{3})$/,"-$1")
				} else if (tel.length == 12) {
					tel=tel.replace(/(.{4})$/,"-$1")
				} else if (tel.length > 12) {
					tel=tel.replace(/(.{4})$/,"-$1")
				}
				return tel;
			}
			function mCPF(cpf){
				cpf=cpf.replace(/\D/g,"")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
				return cpf
			}
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
				  <div class="grid-item"><label for="name" class="label-form">Nome do Dono:</label></div>
				  <div class="grid-item"><input type="text" id="name" name="name" autofocus required></div>
				  <div class="grid-item"><label for="cpf" class="label-form">CPF:</label></div>  
				  <div class="grid-item"><input type="text" id="cpf" name="cpf" onkeydown="javascript: fMasc(this, mCPF );" maxlength="14" required></div> 
				  <div class="grid-item"><label for="email" class="label-form">E-mail:</label></div>
				  <div class="grid-item"><input type="text" id="email" name="email" required></div>
				  <div class="grid-item"><label for="tel" class="label-form">Telefone:</label></div>
				  <div class="grid-item"><input type="text" id="tel" name="tel" onkeydown="javascript: fMasc(this, mTel );" maxlength="14" required></div> 
				  <div class="col-75">
				  	<input type="reset" class="btn btn-white" value="Limpar">
				  	<input type="submit" class="btn btn-blue" value="Continuar"> 
				  </div>
				</div>
			</form>
		</div>
		<!-- Fim do conteúdo -->
		<footer style="position: absolute;">
			<p>&copy; <?= date("Y");?> - PetMax</p>
			<p>Todos os direitos reservados.</p>
		</footer>
	</body>
</html>