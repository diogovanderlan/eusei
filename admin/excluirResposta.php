<?php

include "menu.php";

$id = "";
	//recuperar o id enviado por GET
if ( isset ( $_GET["id"] ) ) {
	$id = trim ( $_GET["id"] );
}

	//verificar se trouxe o registro
if ( empty($dados->id) ) {
		//excluir

	$sql = "delete from resposta
	where id = ? limit 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id);
		//verificar se executou corretamente
	if ( $consulta->execute() ) {
			//enviar para a listagem
		echo "<script>location.href='listarResposta.php';</script>";
	} else {
			//deu erro avisar
		echo "<script>alert('Erro ao excluir registro!');history.back();</script>";
	}

} else {
		//mensagem de erro
	echo "<script>alert('Esta resposta contem Denuncias e nao pode ser excluidas ');history.back();</script>";

}
