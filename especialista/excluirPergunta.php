<?php

include "menuEspecialista.php";

$idPergunta = "";
	//recuperar o id enviado por GET
if ( isset ( $_GET["id"] ) ) {
	$idPergunta = trim ( $_GET["id"] );
}

	//verificar se trouxe o registro
if ( empty($dados->idPergunta) ) {
		//excluir

	$sql = "delete from pergunta
	where idPergunta = ? limit 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $idPergunta);
		//verificar se executou corretamente
	if ( $consulta->execute() ) {
			//enviar para a listagem
		echo "<script>location.href='listarPergunta.php';</script>";
	} else {
			//deu erro avisar
		echo "<script>alert('Erro ao excluir registro!');history.back();</script>";
	}

}
