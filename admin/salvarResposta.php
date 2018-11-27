<?php
include "menu.php";

if ( $_POST ) {
		//RECUPERAR OS DADOS DO FORMULARIO	

	$id = trim( $_POST["id"] );
	$resposta = trim( $_POST["resposta"] );
	$data = trim( $_POST["data"] );
	$idUsuario = trim( $_POST["idUsuario"] );
	$idPergunta = trim( $_POST["idPergunta"] );
	
	$data = formatardata( $data );

	if ( empty ( $id ) ) {
			//GRAVAR NO BANCO DE DADOS
		$sql = "insert into resposta (id, resposta, data, idUsuario, idPergunta ) values (NULL, ?, ?, ?, ?)";
		$consulta = $pdo->prepare( $sql );
		$consulta->bindParam( 1, $resposta );
		$consulta->bindParam( 2, $data );
		$consulta->bindParam( 3, $idUsuario );
		$consulta->bindParam( 4, $idPergunta );
	} else {
			//ATUALIZAR

		$sql = "update resposta set resposta = ?, data = ?, idUsuario = ? where id = ? limit 1";
		$consulta = $pdo->prepare( $sql );
		$consulta->bindParam( 1, $resposta );
		$consulta->bindParam( 2, $data );
		$consulta->bindParam( 3, $idUsuario );
		$consulta->bindParam( 4, $id );

	}

	if ( $consulta->execute() ) {
		echo "<script>alert('Registro Salvo');location.href='home.php';</script>";
	} else {
		echo "<script>alert('Erro ao Salvar');history.back();</script>";
	}

}

?>