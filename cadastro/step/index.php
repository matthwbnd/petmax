<?php
	include_once '../../conexao.php';

	session_start();
	$sessao = $_SESSION['rga'];

	if (empty($sessao)) {
		header('Location: step/1');
	}else{
		$sql = ("SELECT password FROM pets_user WHERE password = 0 AND rga = $sessao");
		$res = $conn->prepare($sql);
		$res->execute();
		$row = $res->rowCount();

		switch ($row) {
			case 1:
				header('Location: 2');
				break;
			default:
				header('Location: ../perfil/');
		}
	}