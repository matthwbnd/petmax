<?php
	include_once '../conexao.php';
	session_start();

	if (!isset($_SESSION['rga'])) {
		header('Location: ../login');
	}

	$message = "";
	$alert = "";

	$stmt = $conn->prepare("SELECT * FROM pets_profile WHERE rga = ".$_SESSION['rga']);
	$stmt->execute();
	$user = $stmt->fetch();

	//Inserção da imagem
	if(isset($_FILES['pet_pic'])){
		$allow = array('jpg', 'png', 'jpeg');
        $tmp = explode('.', $_FILES['pet_pic']['name']);
        $extensao = end($tmp);
        $novoNome = "petmax_".md5(time()). "." . $extensao;
        $dir = "pet_photo/";

        if (in_array($extensao, $allow) === true) {
        	move_uploaded_file($_FILES['pet_pic']['tmp_name'],$dir.$novoNome);
	        $sql = "UPDATE pets_profile SET pet_photo = '$novoNome' WHERE rga = ".$_SESSION['rga'];
	        $sth = $conn->prepare($sql);
	        $sth->execute();
	        header('refresh: 0');
        }else{
        	$message = "Você enviou um arquivo do tipo '.".$extensao."', por favor envie um arquivo '.jpg', '.jpeg' ou '.png'";
        	$alert = "alert-danger";
        }
	}

	//Inserção de vacina
	if (!empty(filter_input(INPUT_POST, 'type')) && !empty(filter_input(INPUT_POST, 'date'))) {

		$type = filter_input(INPUT_POST, 'type');
		$date = filter_input(INPUT_POST, 'date');

		$vacc = $conn->prepare("INSERT INTO pets_vaccine (rga, vaccine_type, vaccine_date
) VALUES (:rga, :type, :dat)");
		$vacc->bindParam(':rga', $_SESSION['rga']);
		$vacc->bindParam(':type', $type);
		$vacc->bindParam(':dat', $date);
		$vacc->execute();

		$message = "Vacina registrada com sucesso!";
		$alert = "alert-success";
	}

	//Deletar vacina
	if (!empty($_GET['del'])) {
		$id = $_GET['del'];
		$del = $conn->prepare("DELETE FROM pets_vaccine WHERE id = $id");
		$del->execute();
		$message = "Vacina excluida";
		$alert = "alert-success";
	}

	$value = "";
	if ($user['pet_photo'] == "") {
		$value = "Salvar";
	}else{
		$value = "Alterar";
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PetMax</title>
		<!-- Ícone do site -->
		<link href="../img/icone.png" rel="icon">
		<!-- Estilo -->
		<link rel="stylesheet" href="../css/estilo.css">
		<!-- Fonts Awesome -->
		<link rel="stylesheet" href="../css/font-awesome.css">
		<!-- Script -->
		<script type="text/javascript" src="script.js"></script>
		
		<script src="../js/jquery.min.js"></script>

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
				<img src="../img/cat.svg">
			</div>
		</div>
		<nav>
			<img src="../img/logo-light.png" alt="Logo da PetMax" onclick="topFunction()">
			<label for="toggle" class="hamburger"><i class="fa fa-bars"></i></label>
			<input type="checkbox" id="toggle">
			<div class="menu-content">
				<ul>
					<li class="menu-item"><i class="fa fa-paw"></i><a href="logout">Sair</a></li>
				</ul>
			</div>
		</nav>
		<div class="container">
			<?php if ($message != ""): ?>
				<div class="alert <?= $alert?>">
					<span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
					<strong>Atenção!</strong> <?= $message ?>
				</div>
			<?php endif ?>
			<div class="grid-container-2">
				<div class="grid-item">
					<div class="profile-photo">
						<form method="post" enctype="multipart/form-data">
							<?php if ($user['pet_photo'] != ""): ?>
								<p style="color: #fff; font-size: 20px" class="label-form"><?= $user['pet_name']; ?></p>
							<?php else: ?>
								<p style="color: #fff; font-size: 20px" class="label-form">Selecione uma foto para seu pet</p>
							<?php endif; ?>
							<label for="photo">
								<div class="pet-pic">
									<?php if ($user['pet_photo'] != ""): ?>
										<img id="output_image" src="pet_photo/<?= $user['pet_photo'];?>">
									<?php else: ?>
										<img id="output_image">
									<?php endif; ?>
									<i class="fa fa-camera"></i>
								</div>
							</label>
							<input type="file" id="photo" name="pet_pic" class="input-file" required onchange="preview_image(event);">
							<input type="submit" style="width: 180px" name="enviar" class="btn btn-blue" value="<?= $value ?>">
						</form>
					</div>
				</div>
				<div class="grid-item">
					<div class="profile-data">
						<table>
							<tr>
								<td>RGA:</td>
								<td><?= $user['rga'] ?></td>
							</tr>
							<tr>
								<td>Nome:</td>
								<td><?= $user['pet_name'] ?></td>
							</tr>
							<tr>
								<td>Nascimento:</td>
								<td><?= date("d/m/Y", strtotime($user['pet_date'])) ?></td>
							</tr>
							<tr>
								<td>Tipo:</td>
								<td><?= $user['pet_type'] ?></td>
							</tr>
							<tr>
								<td>Linhagem:</td>
								<td><?= $user['pet_line'] ?></td>
							</tr>
							<tr>
								<td>Cor:</td>
								<td><div class="profile-color" style="background-color: <?= $user['pet_color'] ?>"></div></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="grid-item">
					<div class="profile-data">
						<table>
							<tr>
								<td>
									<i class="fa fa-health" aria-hidden="true"></i>&nbsp;Vacinas</a>
								</td>
								<td style="float: right;">
									<a title="Incluir" id="myBtn"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
								</td>
							</tr>
							<tr>
								<?php
									$sql = $conn->prepare("SELECT * FROM pets_vaccine WHERE rga = ".$_SESSION['rga']);
									$sql->execute();
									$users = $sql->fetchAll();

									if (!$users):
								?>
								<td><p style="font-size: 20px;">Nenhuma vacina encontrada</p></td>
							</tr>
								<?php 
									else: 
										foreach ($users as $user) {
											echo "<tr'>";
											echo "<td style='font-size: 18px; font-family: 'heveltica-neue', sans-serif;'>".$user['vaccine_type']."</td>";
											echo "<td style='font-size: 18px;'>".date('d/m/Y', strtotime($user['vaccine_date']))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?del=".$user['id']."'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
											echo "</tr>";
										}
									endif;
								?>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div id="myModal" class="modal">
		  <div class="modal-content">
		    <div class="modal-header">
		    	<span class="close">&times;</span>
		    	<p>Registrar vacina</p>
		    	<hr>
		    </div>
		    <div class="modal-body">
		    	<form action="<?=$_SERVER["PHP_SELF"];?>" method="post">
		    		<div class="form-modal">
		    			<label class="label-form" for="type">Vacinas:</label>
		    			<input type="text" id="type" name="type">
		    			<label class="label-form" for="date">Data:</label>
		    			<input type="date" id="date" name="date">
		    		</div>
		    		<hr>
		    		<br>
		    		<div class="col-25">
					  	<input type="reset" class="btn btn-white" value="Limpar">
					  	<input type="submit" class="btn btn-blue" value="Continuar"> 
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
		<br>
		<footer style="position: relative;">
			<p>&copy; <?= date("Y");?> - PetMax</p>
			<p>Todos os direitos reservados.</p>
		</footer>
	</body>
</html>