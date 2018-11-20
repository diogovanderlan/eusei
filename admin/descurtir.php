<?php 

include "menu.php";

if ( $_GET ) {
		
	$idResposta = trim( $_GET["id"] );
	$idUsuario = $_SESSION["admin"]["id"];

	$sql = "select * from descurtidas where idUsuario = ? limit 1";
	$consulta = $pdo->prepare( $sql );
	$consulta->bindParam( 1, $idUsuario);
	$consulta->execute();
	$dados = $consulta->fetch(PDO::FETCH_OBJ);	

	if ( empty ( $dados->$idUsuario ) ) {
			//gravar no banco de dados
		$sql = "insert into descurtidas (idUsuario, idResposta) values (?, ?)";
		$consulta = $pdo->prepare( $sql );
		$consulta->bindParam( 1, $idUsuario );
		$consulta->bindParam( 2, $idResposta );
	} else {
		$sql = "delete from descurtidas where idUsuario = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $idUsuario);
	}

	if ( $consulta->execute() ) {
		echo "<script>alert('Curtida Salva');location.href='respostas.php';</script>";
		
	} else {
		echo "<script>alert('Erro ao salvar');history.back();</script>";
	}

}