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
					<li class="menu-item"><i class="fa fa-paw"></i><a href="contato">Contato</a></li>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="historia">Nossa Historia</a></li>
				</ul>
			</div>
		</nav>
		<!-- Fim do menu -->
		<!-- Conteúdo do website -->
		<div class="container">
			<div class="title">
				<h1>Seja Bem-Vindo</h1>
			</div>
			<div class="slideshow-container">
				<div class="mySlides fade">
					<div class="numbertext">1 / 3</div>
					<img src="img/slideshow/01.jpg">
					<div class="text">Bem-vindo a PetMax!</div>
				</div>
				<div class="mySlides fade">
					<div class="numbertext">2 / 3</div>
					<img src="img/slideshow/02.jpg">
					<div class="text">Aqui cuidamos do seu pet...</div>
				</div>
				<div class="mySlides fade">
					<div class="numbertext">3 / 3</div>
					<img src="img/slideshow/03.jpg">
					<div class="text">...com amor e carinho!</div>
				</div>
			</div>
			<br>
			<div style="text-align: center;">
				<span class="dot" onclick="currentSlide(1)"></span>
				<span class="dot" onclick="currentSlide(2)"></span>
				<span class="dot" onclick="currentSlide(3)"></span>
			</div>
		</div>
		<div class="info-pane">
			<h1><i class="fa fa-paw"></i>&nbsp;Contribue com algo maravilhoso. Adote!&nbsp;<i class="fa fa-paw"></i></h1>
			<img src="img/caes-gatos.png">
			<p>Adotar um animal doméstico é uma ação que ajuda no desenvolvimento dos seus filhos e também pode ser uma solução para quem fica muito sozinho, principalmente os idosos. Eles são animais fiéis e trazem alegria para o ambiente familiar, por isso, a cada dia mais, as feiras de adoções recebem indivíduos interessados em doar seu tempo a um animalzinho. Para que você fique ainda mais perto de levar um amigo de para casa, não deixe de conferir os Eventos PetMax. É possível encontrar Cães e Gatos de todos os portes e idades, garantindo muito mais saúde para todos.</p>
		</div>
		<footer style="position: relative;">
			<p>&copy; <?= date("Y");?> - PetMax</p>
			<p>Todos os direitos reservados.</p>
		</footer>
		<script>
			var slideIndex = 0;
			showSlides();

			function showSlides() {
			    var i;
			    var slides = document.getElementsByClassName("mySlides");
			    var dots = document.getElementsByClassName("dot");
			    for (i = 0; i < slides.length; i++) {
			       slides[i].style.display = "none";  
			    }
			    slideIndex++;
			    if (slideIndex > slides.length) {slideIndex = 1}    
			    for (i = 0; i < dots.length; i++) {
			        dots[i].className = dots[i].className.replace(" active", "");
			    }
			    slides[slideIndex-1].style.display = "block";  
			    dots[slideIndex-1].className += " active";
			    setTimeout(showSlides, 4000); //Muda a imagem a cada 4 segundos
			}
		</script>
		<!-- Fim do conteúdo -->
	</body>
</html>