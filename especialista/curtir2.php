<?php 

include "menuEspecialista.php";

if ( $_GET ) {

	$idResposta = trim( $_GET["id"] );
	$idUsuario = $_SESSION["especialista"]["id"];

	if ( empty ( $dados->$idResposta ) ) {
            //gravar no banco de dados
		$sql = "insert into curtidas (idUsuario, idResposta, curtida) values (?, ?, 2)";
		$consulta = $pdo->prepare( $sql );

		$consulta->bindParam( 1, $idUsuario );
		$consulta->bindParam( 2, $idResposta );
	
	} else {

		$sql = "delete from curtidas where idResposta = ? limit 1";
		$consulta = $pdo->prepare( $sql );
		$consulta->bindParam( 1, $idUsuario );
		$consulta->bindParam( 2, $idResposta );

	}

	if ( $consulta->execute() ) {
		echo "<script>alert('Curtida Salva');location.href='respostas.php';</script>";
		
	} else {
		echo "<script>alert('Você Não gostou desta Resposta');history.back();</script>";
	}

}