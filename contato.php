<?php
	include_once 'conexao.php';

	$message = "";
	$alert = "";

	if (!empty(filter_input(INPUT_POST, 'name')) && !empty(filter_input(INPUT_POST, 'email')) && !empty(filter_input(INPUT_POST, 'sub')) && !empty(filter_input(INPUT_POST, 'msg'))) {
		$name = filter_input(INPUT_POST, 'name');
		$email = filter_input(INPUT_POST, 'email');
		$sub = filter_input(INPUT_POST, 'sub');
		$msg = filter_input(INPUT_POST, 'msg');

		$stmt = $conn->prepare("INSERT INTO form_contact (name, email, subject, message) VALUES (:name, :email, :sub, :msg)");
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':sub', $sub);
		$stmt->bindParam(':msg', $msg);
		$stmt->execute();

		if ($stmt->execute() === true) {
			$message = "<b>Yey!</b> Sua mensagem foi enviada com sucesso!";
			$alert = "alert-success";
		}else{
			$message = "<b>Ooops!</b> Houve uma falha no envio da mensagem!";
			$alert = "alert-danger";
		}
	}
	?>
<!DOCTYPE html>
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

		<script>
			function topFunction() {
				document.body.scrollTop = 0;
				document.documentElement.scrollTop = 0;
			}
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
			<img src="img/logo-light.png" alt="Logo da PetMax" onclick="topFunction()">
			<label for="toggle" class="hamburger"><i class="fa fa-bars"></i></label>
			<input type="checkbox" id="toggle">
			<div class="menu-content">
				<ul>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="/">Inicio</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="perfil">Perfil</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="cadastro">Cadastro</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="#">Contato</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="historia">Nossa Historia</a></li>
				</ul>
			</div>
		</nav>
		<!-- Fim do menu -->
		<!-- Conteúdo do website -->
		<div class="container">
			<?php if ($message != ""): ?>
				<div class="alert <?= $alert?>">
					<span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
					<?= $message ?>
				</div>
			<?php endif ?>
			<div class="grid-container-2" style="padding-bottom: 0px;">
				<div class="grid-item">
					<p class="label-form">Localidade</p>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.1249306505547!2d-46.58895998548121!3d-23.56395616757215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce5eaec2dc2073%3A0x8cfebeb849d3acdb!2sR.+Rui+Martins%2C+170+-+%C3%81gua+Rasa%2C+S%C3%A3o+Paulo+-+SP%2C+03184-010!5e0!3m2!1spt-BR!2sbr!4v1528647396367" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="grid-item">
					<p class="label-form">Contato</p>
					<div class="contact">
						<p class="label-form"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;(11) 3443-5512 / (11) 3443-5580</p>
						<p class="label-form"><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;(11) 95225-5445</p>
						<p class="label-form"><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;contato@petmax.com.br</p>
						<p class="label-form"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Rua Rui Martins, 170</p>
						<br>
						<a class="btn btn-blue" id="myBtn">Envie uma mensagem</a>
					</div>
				</div>
			</div>
		</div>
		<!-- Fim do conteúdo -->
		<div id="myModal" class="modal">
		  <div class="modal-content">
		    <div class="modal-header">
		    	<span class="close">&times;</span>
		    	<p>Preencha os campos abaixo</p>
		    	<hr>
		    </div>
		    <div class="modal-body">
		    	<form action="<?=$_SERVER["PHP_SELF"];?>" method="post">
		    		<div class="form-modal">
		    			<label class="label-form" for="name">Nome:</label>
		    			<input type="text" id="name" name="name" required>
		    			<label class="label-form" for="email">Email:</label>
		    			<input type="text" id="email" name="email" required>
		    			<label class="label-form" for="sub">Assunto:</label>
		    			<input type="text" id="sub" name="sub" required>
		    			<label class="label-form" for="msg">Mensagem:</label>
		    			<textarea rows="4" name="msg" id="msg" required></textarea>
		    		</div>
		    		<hr>
		    		<br>
		    		<div class="col-25">
					  	<input type="reset" class="btn btn-white" value="Limpar">
					  	<input type="submit" class="btn btn-green" value="Enviar"> 
				  	</div>
		    	</form>
		    </div>
		  </div>
		</div>
		<script>
			var modal = document.getElementById('myModal');
			var btn = document.getElementById("myBtn");
			var span = document.getElementsByClassName("close")[0]; 
			btn.onclick = function() {
			    modal.style.display = "block";
			}
			span.onclick = function() {
			    modal.style.display = "none";
			}
			window.onclick = function(event) {
			    if (event.target == modal) {
			        modal.style.display = "none";
			    }
			}
			document.onkeydown = function(evt) {
				evt = evt || window.event;
				if (evt.keyCode == 27) {
					modal.style.display = "none";
				}
			}
		</script>
		<footer>
			<p>&copy; <?= date("Y");?> - PetMax</p>
			<p>Todos os direitos reservados.</p>
		</footer>
	</body>
</html>