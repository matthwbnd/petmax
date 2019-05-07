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
					<li class="menu-item"><i class="fa fa-paw"></i><a href="/perfil">Perfil</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="cadastro">Cadastro</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="contato">Contato</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="#">Nossa Historia</a></li>
				</ul>
			</div>
		</nav>
		<!-- Fim do menu -->
		<!-- Conteúdo do website -->
		<div class="info-pane" style="margin-top: 90px;">
				<h1><i class="fa fa-paw"></i>&nbsp;Sobre a PetMax&nbsp;<i class="fa fa-paw"></i></h1>
				<img src="img/pets.jpg">
				<p>A PetMax foi criado em 2013 pela família Pereira, com intuito de oferecer serviços de qualidade,
				além de um atendimento diferenciado, em um ambiente familiar e agradável, tratando com
				carinho, dedicação e respeito de todo e qualquer pet, com foco total no bem estar animal.</p>
				<br>
				<p>Localizado no bairro Alto da Mooca, na Zona Leste de São Paulo, a PetMax conta com
				instalações de acordo com as normas da Vigilância Sanitária para funcionamento de
				estabelecimentos veterinários, contando com área de atendimento, sala de banho e tosa com ar
				condicionado e sala para consultas e tratamentos.</p>
				<br>
				<p>Dentre o leque de serviços prestados estão: consultas em consultório, vacinação, coleta de
				exames, fluido terapia, inalação, sutura e curativos em geral, além de serviços estéticos, tais
				como banho, tosa (geral, de raça e higiênica), hidratação e tintura de pelagem.</p>
				<br>
				<p>Todos os serviços são prestados por profissionais qualificados e especializados visando a
				segurança de seu pet.</p>
			</div>
		<!-- Fim do conteúdo -->
		<footer style="position: relative;">
			<p>&copy; <?= date("Y");?> - PetMax</p>
			<p>Todos os direitos reservados.</p>
		</footer>
	</body>
</html>