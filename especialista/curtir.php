<?php 

include "menuEspecialista.php";

if ( $_GET ) {

	$idResposta = trim( $_GET["id"] );
	$idUsuario = $_SESSION["especialista"]["id"];

	if ( empty ( $dados->$idUsuario ) ) {
            //gravar no banco de dados
		$sql = "insert into curtidas (idUsuario, idResposta, curtida) values (?, ?, 1)";
		$consulta = $pdo->prepare( $sql );

		$consulta->bindParam( 1, $idUsuario );
		$consulta->bindParam( 2, $idResposta );
	
	} else if ( empty ( $dados->$idUsuario ) ) {

		$sql = "delete from curtidas where idResposta = ?";
		$consulta = $pdo->prepare( $sql );
		$consulta->bindParam( 1, $idUsuario );
		$consulta->bindParam( 2, $idResposta );
		$consulta->bindParam( 2, $curtidas );

	}

	if ( $consulta->execute() ) {
		echo "<script>alert('Curtida Salva');location.href='respostas.php';</script>";
		
	} else {
		echo "<script>alert('Você ja curtiu essa Resposta');history.back();</script>";
	}

}