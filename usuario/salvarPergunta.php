<?php 

include "menuUsuario.php";

if ( $_POST ) {
		//recuperar os dados do formulario
	$idPergunta = trim( $_POST["idPergunta"] );
	$pergunta = trim( $_POST["pergunta"] );
	$data = trim( $_POST["data"] );
	$idusuario = trim( $_POST["idusuario"] );		
	$idcategoria = trim ( $_POST["idcategoria"] );
	
	$data = formatardata( $data );	


	if ( empty ( $idPergunta ) ) {
			//gravar no banco de dados
		$sql = "insert into pergunta (idPergunta, pergunta, data, idusuario, idcategoria) values (NULL, ?, ?, ?, ?)";
		$consulta = $pdo->prepare( $sql );
		$consulta->bindParam( 1, $pergunta );
		$consulta->bindParam( 2, $data );
		$consulta->bindParam( 3, $idusuario );
		$consulta->bindParam( 4, $idcategoria );
	} else {
			//atualizar

		$sql = "update pergunta set pergunta = ?, data = ?, idusuario = ?, idcategoria = ? where idPergunta = ? limit 1";
		$consulta = $pdo->prepare( $sql );
		$consulta->bindParam( 1, $pergunta );
		$consulta->bindParam( 2, $data );
		$consulta->bindParam( 3, $idusuario );			
		$consulta->bindParam( 4, $idcategoria );
		$consulta->bindParam( 5, $idPergunta );
	}

	if ( $consulta->execute() ) {
		echo "<script>alert('Registro salvo');location.href='home.php';</script>";
		
	} else {
		echo "<script>alert('Erro ao salvar');history.back();</script>";
	}
	


}


?>